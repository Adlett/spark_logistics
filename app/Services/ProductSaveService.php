<?php


namespace App\Services;


use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductSaveService
{

    /**
     * @var Product
     */
    protected $_product;

    protected $_data = [];

    protected $_errors = [];

    public function __construct(Product $product, array $data)
    {
        $this->_product = $product;
        $this->_data = $data;
    }

    public function execute()
    {
        $validator = Validator::make($this->_data, $this->_product->rules(), $this->_product->messages());
        if ($validator->fails()) {
            $this->_errors = $validator->errors()->toArray();
            return false;
        }

        $this->_product->fill($this->_data);

        return $this->saveModels();
    }

    protected function saveModels()
    {
        $success = true;
        DB::beginTransaction();
        try {

            $this->_product->fill($this->_data);

            if ($this->_product->save()) {
                $productId = $this->_product->id;
                ProductCategory::where('product_id', $productId)->delete();
                $categories = data_get($this->_data, 'categoriesEId', []);

                foreach ($categories as $catId) {
                    $productCategory = new ProductCategory();
                    $productCategory->product_id = $productId;
                    $productCategory->category_id = $catId;
                    if (!$productCategory->save()) {
                        $success = false;
                        $this->_errors[] = 'cannot save product_categories model'; //todo write normal message for front
                        break;
                    }
                }
            } else {
                $this->_errors[] = 'cannot save products model'; //todo write normal message for front
            }

            if ($success) {
                DB::commit();
            } else {
                DB::rollBack();
            }
        } catch (\Exception $e) {
            $this->_errors[] = 'internal server error';
            Log::error($e->getMessage());
            Log::error($e->getFile());
            Log::error($e->getLine());
            $success = false;
            DB::rollBack();
        }
        return $success;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->_errors;
    }


}
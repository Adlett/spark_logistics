<?php


namespace App\Services;


use App\Models\Category;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CategorySaveService
{

    /**
     * @var Category
     */
    protected $_category;

    protected $_data = [];

    protected $_errors = [];

    public function __construct(Category $category, array $data)
    {
        $this->_category = $category;
        $this->_data = $data;
    }

    public function execute()
    {
        $validator = Validator::make($this->_data, $this->_category->rules(), $this->_category->messages());
        if ($validator->fails()) {
            $this->_errors = $validator->errors()->toArray();
            return false;
        }

        $this->_category->fill($this->_data);

        return $this->_category->save();
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->_errors;
    }


}
<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use App\Services\CategorySaveService;
use App\Services\ProductSaveService;
use Illuminate\Console\Command;

class FillProductsAndCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fill:models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Заполняет Продукты и категори из файлов products.json и categories.json';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->fillCategories();
        $this->fillProducts();
        return 0;
    }

    protected function fillProducts(){
        $filename = 'products.json';

        if(!file_exists($filename)){
            echo "file {$filename} is not exists\n";
            return;
        }
        $productsStr = file_get_contents($filename);

        $products = json_decode($productsStr);

        foreach ($products as $productData){

            $values = json_decode(json_encode($productData), true);

            $productModel = Product::firstOrNew(array_filter($values, function($item){
                return !is_array($item);
            }));

            $service = new ProductSaveService($productModel, $values);

            if(!$service->execute()){
                echo "cannot save product, details: " . json_encode($service->getErrors());
            }

        }
    }

    protected function fillCategories(){
        $filename = 'categories.json';

        if(!file_exists($filename)){
            echo "file {$filename} is not exists\n";
            return;
        }
        $categoriesStr = file_get_contents($filename);

        $categories = json_decode($categoriesStr);

        foreach ($categories as $categoryData){

            $values = json_decode(json_encode($categoryData), true);

            $categoryModel = Category::firstOrNew($values);

            $service = new CategorySaveService($categoryModel, $values);

            if(!$service->execute()){
                echo "cannot save category, details: " . json_encode($service->getErrors());
            }

        }
    }
}

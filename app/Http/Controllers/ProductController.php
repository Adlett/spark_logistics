<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\ProductSaveService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $products = Product::paginate(10);
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        return view('products.create', ['product' => $product]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $product = new Product();

        $service = new ProductSaveService($product, $request->all());

        if($service->execute()){
            return redirect(route('product.index'));
        } else {
            return redirect()->back()->withInput($request->all())->withErrors($service->getErrors());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return void
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
//        dd($product->getCategoryIds());
        return view('products.edit', ['product' => $product, 'selectedCategories' => $product->getCategoryIds()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Partner $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $service = new ProductSaveService($product, $request->all());

        if($service->execute()){
            return redirect(route('product.index'));
        } else {
            return redirect()->back()->withInput($request->all())->withErrors($service->getErrors());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Partner $partner
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect('/admin/partners');
    }
}

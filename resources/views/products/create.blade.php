@extends('layouts.app')

@section('title', 'Создание нового продукта')

@section('page-title')
    @yield('title')
@endsection

@section('content')
    {{-- @include('common.errors')--}}
    @include('products.partial._form', [
        'product' => $product,
        'action' => route('product.store'),
        'method' => 'POST',
        'selectedCategories' => []
        ])

@endsection
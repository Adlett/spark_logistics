@extends('layouts.app')

@section('content')
    @include('products.partial._form', [
    'product' => $product,
    'action' => route('product.update', $product),
    'method' => 'PATCH',
    'selectedCategories' => $selectedCategories
    ])
@endsection
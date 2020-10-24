@extends('layouts.app')

@section('title', 'Команда')

@section('content')
    <a href="{{route('product.create')}}" class="btn btn-xs btn-success pull-right"><i class="fa fa-plus"></i> Создать</a>
@include('products.partial._table')
@endsection
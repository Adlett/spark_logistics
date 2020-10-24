<?php
/* @var $product \App\Models\Product */
?>

@extends('layouts.app')

@section('content')
    <table class="table table-striped task-table">

        <!-- Заголовок таблицы -->
        <thead>
        <th>Цена</th>
        <th>Title</th>
        <th>Категории</th>
        </thead>

        <!-- Тело таблицы -->
        <tbody>
        <tr>
            <td>
                {{$product->price}}
            </td>
            <td>
                {{$product->title}}
            </td>
            <td>
                @foreach($product->categories as $category)
                    {{$category->title}}<br>
                @endforeach
            </td>
        </tr>
        </tbody>
    </table>
@endsection

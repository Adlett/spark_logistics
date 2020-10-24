<?php
/* @var $product \App\Models\Product */
/* @var $action string */
?>

<!-- Форма новой задачи -->
<form action="{{ $action }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field($method) }}

    <!-- Имя задачи -->
    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label for="title" class="col-sm-3 control-label">Title</label>
        <div class="col-sm-6">
            <input type="text" name="title" id="title" value="{{ old('title',$product->title) }}" class="form-control">
            @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
            @endif
        </div>
    </div>


        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
            <label for="title" class="col-sm-3 control-label">Price</label>
            <div class="col-sm-6">
                <input type="text" name="price" id="price" value="{{ old('price',$product->price) }}" class="form-control">
                @if ($errors->has('price'))
                    <span class="help-block">
                <strong>{{ $errors->first('price') }}</strong>
            </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <select name="categoriesEId[]" class="mdb-select colorful-select dropdown-primary md-form" multiple>
                <option value="" disabled>Select category</option>

                @foreach(\App\Models\Category::list() as $id => $name)
                    <option value="{{$id}}" {{in_array($id, $selectedCategories) ? 'selected' : ''}}>{{$name}}</option>
                @endforeach
            </select>
            <label class="mdb-main-label">Label example</label>
        </div>

    <!-- Кнопка добавления задачи -->
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-plus"></i> Сохранить
            </button>
        </div>
    </div>
</form>
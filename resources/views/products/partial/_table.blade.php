<table class="table table-striped task-table">

    <!-- Заголовок таблицы -->
    <thead>
        <th>Цена</th>
        <th>Title</th>
        <th> </th>
    </thead>

    <!-- Тело таблицы -->
    <tbody>
        @if (count($products) > 0)
        @foreach ($products as $product)
        <tr>
            <!-- Имя задачи -->
            <td>{{ $product->price }}</td>
            <td>{{ $product->title }}</td>
            <td class="td-buttons">
                <form action="{{ route('product.delete', $product) }}" method="POST" style="display:inline-block">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" id="delete-member-{{ $product->id }}" class="btn btn-danger">
                        <i class="fa fa-btn fa-trash"></i>Удалить
                    </button>
                </form>
                <a href="{{route('product.edit', $product)}}" class="btn btn-success">Редактировать</a>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <!-- Имя задачи -->
            <td colspan="4">Нет данных</td>
        </tr>
        @endif
    </tbody>
</table>
{{ $products->render() }}
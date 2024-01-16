@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <table class="table table-hover table-striped mb-3">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Название товара</th>
                <th scope="col">Цена</th>
                <th scope="col">Количество</th>
                <th scope="col">Хит продаж</th>
                <th scope="col">Статус товара</th>
                <th scope="col">Категория товара</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">{{$product->id}}</th>
                <td>{{$product->title}}</td>
                <td>{{$product->price}}грн.</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->hit === 1 ? '✓' : '-'}}</td>
                <td>{{$product->is_published === 1 ? "Включен" : "Отключен"}}</td>
                <td>@foreach($categories as $category)
                        {{$product->category_id === $category->id ? $category->name : ""}}
                    @endforeach</td>
            </tr>
            </tbody>
        </table>
        <div class="col-md-9 pr-3">
            <div class="flex flex-column mb-3">
                <div class="mb-2 font-weight-bold">URI товара</div>
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">{{$product->uri_product}}</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-column">
                <div class="mb-2 font-weight-bold">Описание товара</div>
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">{!! $product->description !!}</p>
                    </div>
                </div>
            </div>
            <div class="mb-2 font-weight-bold">Характеристики товара</div>
            <table class="table table-hover mb-3">
                <thead>
                <tr>
                    <th scope="col">Характеристика</th>
                    <th scope="col">Значение</th>
                </tr>
                </thead>
                <tbody>
                @foreach($characteristics as $characteristic)
                    <tr>
                        <td>{{$characteristic->characteristic_name}}</td>
                        <td>{{$characteristic->pivot->value}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a href="{{route('products.edit', $product->id)}}" class="btn btn-warning">Редактировать продукт</a>
            <a class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal">Удалить
                продукт
            </a>
            <a href="{{route('products.index')}}" class="btn btn-primary">Назад</a>
        </div>
        <div class="col-md-3 mb-3">
            <p class="font-weight-bold">Изображение товара</p>
            <div class="d-flex flex-wrap">
                @foreach(json_decode($product->images) as $image)
                    <img src="{{ asset('storage/' . $image) }}" class="mr-2 mb-2 img-fluid"
                         style="width: 150px; height: 150px;" alt="Изображение товара">
                @endforeach
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
         aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Подтвердите удаление</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Вы уверены, что хотите удалить товар: {{$product->title}}?
                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary" data-dismiss="modal">Отмена</a>
                    <form action="{{route('products.destroy', $product->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

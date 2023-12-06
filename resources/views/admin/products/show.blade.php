@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <table class="table table-hover table-striped mt-3 mb-3">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Название товара</th>
                <th scope="col">Цена</th>
                <th scope="col">Количество</th>
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
                <td>{{$product->is_published === 1 ? "Включен" : "Отключен"}}</td>
                @foreach($categories as $category)
                    <td>{{$product->category_id === $category->id ? $category->name : ""}}</td>
                @endforeach
            </tr>
            </tbody>
        </table>
        <div class="col-md-9 pr-3">
            <div class="flex flex-column">
                <p class="font-weight-bold">Описание товара</p>
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">{!! $product->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <p class="font-weight-bold">Изображение товара</p>
            <img src="{{ asset('storage/' . $product->images) }}" alt="Изображение товара">
        </div>
    </div>
    <a href="" class="btn btn-warning">Редактировать продукт</a>
    <a href="" class="btn btn-danger">Удалить продукт</a>
    <a href="{{route('products.index')}}" class="btn btn-primary">Назад</a>
@endsection

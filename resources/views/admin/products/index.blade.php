@extends('layouts.admin.index')
@section('content')
    <table class="table table-hover table-striped">
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
        @foreach($products as $product)
            <tr>
                <th scope="row">{{$product->id}}</th>
                <td><a href="{{route('products.show', $product->id)}}">{{$product->title}}</a></td>
                <td>{{$product->price}}грн.</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->hit === 1 ? '✓' : '-'}}</td>
                <td>{{$product->is_published === 1 ? "Включен" : "Отключен"}}</td>
                <td> @foreach($categories as $category)
                        {{$product->category_id === $category->id ? $category->name : ""}}
                    @endforeach</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{$products->links()}}
    </div>
    <a href="{{route('products.create')}}" class="btn btn-primary">Добавить товар</a>
@endsection

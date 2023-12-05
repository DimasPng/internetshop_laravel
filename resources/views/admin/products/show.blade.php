@extends('layouts.admin.index')
@section('content')
    <table class="table table-hover table-striped">
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
                <td>{{$product->category_id}}</td>
            </tr>
        </tbody>
    </table>
@endsection

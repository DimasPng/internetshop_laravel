@extends('layouts.admin.index')
@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">ID категории</th>
            <th scope="col">Имя категории</th>
            <th scope="col">Топ категория</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <th scope="row">{{ $category->id  }}</th>
                <td><a href="{{route('categories.show', $category->id)}}">{{ $category->name }}</a></td>
                <td>{{$category->top_category === 1 ? '✓' : '-'}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{route('categories.create')}}" class="btn btn-primary ml-2">Добавить категорию</a>
@endsection

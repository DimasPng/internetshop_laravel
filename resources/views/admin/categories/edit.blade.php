@extends('layouts.admin.index')
@section('content')
    <form method="post" action="{{route('categories.update', $category->id)}}">
        @csrf
        @method('patch')
        <div class="mb-3">
            <label for="title" class="form-label">Название категории</label>
            <input name="name" type="text" class="form-control form-control-lg"
                   placeholder="Введите новое название категории" id="title" aria-describedby="addCategory"
                   value="{{$category->name}}"
            >
            @error('name')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="flex">
            <button type="submit" class="btn btn-warning">Изменить категорию</button>
            <a href="{{route('categories.index')}}" class="btn btn-primary">Назад</a>
        </div>
    </form>
@endsection

@extends('layouts.admin.index')
@section('content')
    <form method="post" action={{route('categories.store')}}>
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Название категории</label>
            <input name="name" type="text" class="form-control form-control-lg" placeholder="Введите название категории"
                   id="title" aria-describedby="addCategory">
            @error('name')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="flex">
            <button type="submit" class="btn btn-primary">Добавить категорию</button>
            <a href={{route('categories.index')}} class="btn btn-warning">Назад</a>
        </div>
    </form>
@endsection

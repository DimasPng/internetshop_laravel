@extends('layouts.admin.index')
@section('content')
    <form method="post" action="{{route('categories.update', $category->id)}}" enctype="multipart/form-data">
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
        <div class="mb-3">
            <label for="title" class="form-label">URI категории*</label>
            <input name="uri_category" value="{{$category->uri_category}}" type="text" class="form-control form-control-lg"
                   placeholder="Введите uri категории, латыницей"
                   id="title" aria-describedby="addCategory">
            @error('uri_category')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3 col-3">
            <label for="formFileMultiple" class="form-label">Выберите изображение категории</label>
            <input name="image" class="form-control form-control-lg" id="formFileMultiple" type="file">
            @error('image')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3 form-check form-switch">
            <input type="hidden" name="top_category" value="0">
            <input name="top_category" class="form-check-input" type="checkbox" role="switch"
                   id="flexSwitchCheckChecked"
                {{$category->top_category === 1 ? 'checked' : ''}} >
            <label class="form-check-label" for="flexSwitchCheckChecked">Топ категория</label>
            @error('top_category')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="flex">
            <button type="submit" class="btn btn-warning">Изменить категорию</button>
            <a href="{{route('categories.index')}}" class="btn btn-primary">Назад</a>
        </div>
    </form>
@endsection

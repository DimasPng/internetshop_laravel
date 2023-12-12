@extends('layouts.admin.index')
@section('content')
    <form method="post" action="{{route('categories.store')}}">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Название категории*</label>
            <input name="name" value="{{old('name')}}" type="text" class="form-control form-control-lg" placeholder="Введите название категории"
                   id="title" aria-describedby="addCategory">
            @error('name')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">URI категории*</label>
            <input name="uri_category" value="{{old('uri_category')}}" type="text" class="form-control form-control-lg" placeholder="Введите uri категории, латыницей"
                   id="title" aria-describedby="addCategory">
            @error('uri_category')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3 form-check form-switch">
            <input type="hidden" name="top_category" value="0">
            <input name="top_category" class="form-check-input" type="checkbox" role="switch"
                   id="flexSwitchCheckChecked">
            <label class="form-check-label" for="flexSwitchCheckChecked">Топ категория</label>
            @error('top_category')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="flex">
            <button type="submit" class="btn btn-primary">Добавить категорию</button>
            <a href="{{route('categories.index')}}" class="btn btn-warning">Назад</a>
        </div>
    </form>
@endsection

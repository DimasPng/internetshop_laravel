@extends('layouts.admin.index')
@section('content')
    <form method="post" action="{{route('products.store')}}" enctype="multipart/form-data" id="productForm">
        @csrf
        <div class="mb-3 col-9">
            <label for="exampleInputEmail1" class="form-label">Название товара</label>
            <input value="{{old('title')}}" name="title" type="text" class="form-control form-control-lg"
                   id="exampleInputEmail1"
                   aria-describedby="emailHelp">
            @error('title')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3 col-9">
            <label for="exampleFormControlTextarea1" class="form-label">Описание товара</label>
            <textarea name="description" class="tinymce" id="exampleFormControlTextarea1"
                      rows="3">{{old('description')}}</textarea>
            @error('description')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        @include('admin.products.components.characteristics-form')

        <div class="d-flex border rounded col-9 p-3 mb-4 ">
            <div class="mb-3 flex-fill mr-3">
                <label for="exampleInputEmail1" class="form-label">Укажите цену товара в гривне</label>
                <input value="{{old('price')}}" name="price" type="text" class="form-control form-control-lg"
                       id="exampleInputEmail1"
                       aria-describedby="emailHelp">
                @error('price')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3 flex-fill mr-3">
                <label for="exampleInputEmail1" class="form-label">Укажите количество товара</label>
                <input value="{{old('quantity')}}" name="quantity" type="text" class="form-control form-control-lg"
                       id="exampleInputEmail1"
                       aria-describedby="emailHelp">
                @error('quantity')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3 flex-fill">
                <label for="exampleInputEmail1" class="form-label">Укажите uri товара</label>
                <input value="{{old('uri_product')}}" name="uri_product" type="text"
                       class="form-control form-control-lg"
                       id="exampleInputEmail1"
                       aria-describedby="emailHelp">
                @error('uri_product')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="d-flex border rounded col-9 p-3 mb-3">
            <div class="mb-3 flex-fill mr-4">
                <p class="font-weight-bold">Выберите категорию товара</p>
                <select name="category_id" class="form-select" size="3" aria-label="Size 3 select example">
                    @foreach($categories as $category)
                        <option
                            {{(string)$category->id === old('category_id') ? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="formFileMultiple" class="form-label">Выберите изображения товара</label>
                <input name="images[]" class="form-control form-control-lg" id="formFileMultiple" type="file" multiple>
                @error('images')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="d-flex mb-3" id="last">
            <div class="mr-3 form-check form-switch">
                <input type="hidden" name="is_published" value="0">
                <input name="is_published" class="form-check-input" type="checkbox" role="switch"
                       id="flexSwitchCheckChecked" checked>
                <label class="form-check-label" for="flexSwitchCheckChecked">Товар включен</label>
                @error('is_published')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-check form-switch">
                <input type="hidden" name="hit" value="0">
                <input name="hit" class="form-check-input" type="checkbox" role="switch"
                       id="flexSwitchCheckChecked">
                <label class="form-check-label" for="flexSwitchCheckChecked">Хит продаж</label>
                @error('hit')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn-lg btn-primary">Добавить товар</button>
    </form>

    @include('admin.products.components.new-characteristic-modal')

    <script src="{{ asset('js/tinymce.js') }}"></script>

@endsection

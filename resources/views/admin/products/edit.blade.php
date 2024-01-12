@extends('layouts.admin.index')
@section('content')
    <form method="post" action="{{route('product.update', $product->id)}}" enctype="multipart/form-data" id="productForm">
        @csrf
        @method('patch')
        <div class="mb-3 col-9 p-0">
            <label for="exampleInputEmail1" class="form-label">Название товара</label>
            <input value="{{old('title') ?? $product->title}}" name="title" type="text"
                   class="form-control form-control-lg"
                   id="exampleInputEmail1"
                   aria-describedby="emailHelp">
            @error('title')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3 col-9  p-0">
            <label for="exampleFormControlTextarea1" class="form-label">Описание товара</label>
            <textarea name="description" class="tinymce" id="exampleFormControlTextarea1"
                      rows="3">{{old('description') ?? $product->description}}</textarea>
            @error('description')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        @include('admin.products.components.characteristics-form')

        <div class="d-flex border rounded col-9 p-3 mb-4 ">
        <div class="mb-3 col-3">
            <label for="exampleInputEmail1" class="form-label">Укажите цену товара в гривне</label>
            <input value="{{old('price') ?? $product->price}}" name="price" type="text"
                   class="form-control form-control-lg" id="exampleInputEmail1"
                   aria-describedby="emailHelp">
            @error('price')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3 col-3">
            <label for="exampleInputEmail1" class="form-label">Укажите количество товара</label>
            <input value="{{old('quantity') ?? $product->quantity}}" name="quantity" type="text"
                   class="form-control form-control-lg" id="exampleInputEmail1"
                   aria-describedby="emailHelp">
            @error('quantity')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3 col-3">
            <label for="exampleInputEmail1" class="form-label">Укажите uri товара</label>
            <input value="{{old('uri_product') ?? $product->uri_product}}" name="uri_product" type="text"
                   class="form-control form-control-lg"
                   id="exampleInputEmail1"
                   aria-describedby="emailHelp">
            @error('uri_product')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        </div>
        <div class="d-flex border rounded col-9 p-3 mb-3">
            <div class="mb-3 col-4">
                <label for="existingImages" class="form-label">Существующие изображения</label>
                <div id="existingImages" class="d-flex flex-wrap">
                    @foreach(json_decode($product->images) as $key => $image)
                        <div class="existing-image mr-2 mb-2 d-flex flex-column" data-image-id="{{$key}}">
                            <img src="{{ asset('storage/' . $image) }}" class="img-fluid"
                                 style="width: 150px; height: 150px;" alt="Изображение товара">
                            <a type="button" class="btn btn-danger mt-2 remove-image">Удалить</a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mb-3 col-3">
                <label for="formFileMultiple" class="form-label">Выберите изображения товара</label>
                <input name="images[]" class="form-control form-control-lg" id="formFileMultiple" type="file" multiple>
                @error('images')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3 col-3">
            <p class="font-weight-bold">Выберите категорию товара</p>
            <select name="category_id" class="form-select" size="3" aria-label="Size 3 select example">
                @foreach($categories as $category)
                    <option
                        {{$category->id === $product->category_id ? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            @error('category_id')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="d-flex mb-3">
            <div class="mr-3 form-check form-switch">
                <input type="hidden" name="is_published" value="0">
                <input name="is_published" class="form-check-input" type="checkbox" role="switch"
                       id="flexSwitchCheckChecked" {{$product->is_published === 1 ? 'checked' : ''}}>
                <label class="form-check-label" for="flexSwitchCheckChecked">Товар включен</label>
                @error('is_published')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-check form-switch">
                <input type="hidden" name="hit" value="0">
                <input name="hit" class="form-check-input" type="checkbox" role="switch"
                       id="flexSwitchCheckChecked" {{$product->hit === 1 ? 'checked' : ''}} >
                <label class="form-check-label" for="flexSwitchCheckChecked">Хит продаж</label>
                @error('hit')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="d-flex flex-wrap">
            <button type="submit" class="btn btn-warning mr-2">Обновить товар</button>
            <a href="{{route('products.index')}}" class="btn btn-primary">Назад</a>
        </div>
    </form>

    @include('admin.products.components.new-characteristic-modal')

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/tinymce.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.remove-image').forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();

                    let imageId = this.parentElement.getAttribute('data-image-id');
                    console.log(imageId)
                    window.axios.post("{{ route('products.removeImage', $product->id) }}", {imageId: imageId})
                        .then(response => {
                            if (response.data.success) {
                                this.closest('.existing-image').remove();
                            } else {
                                console.log('Error', response.data);
                                console.error('Error:', response.data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Axios error:', error);
                        });
                });
            });
        });
    </script>
@endsection

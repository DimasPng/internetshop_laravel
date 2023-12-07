@extends('layouts.admin.index')
@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">ID категории</th>
            <th scope="col">Имя категории</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">{{ $category->id  }}</th>
            <td>{{ $category->name }}</td>
        </tr>
        </tbody>
    </table>
    <div class="flex">
        <a href="{{route('categories.edit', $category->id )}}" class="btn btn-primary">Редактировать категорию</a>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal">
            Удалить категорию
        </button>
        <a href="{{route('categories.index')}}" class="btn btn-warning">Назад</a>
    </div>

    <!-- Модальное окно подтверждения удаления -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
         aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Подтвердите удаление</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Вы уверены, что хотите удалить категорию: {{$category->name}}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <form action="{{route('categories.destroy', $category->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

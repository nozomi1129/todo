@extends('layouts.app')
@section('content')
<div class="todo-alert">
    @if(session('success'))
        <div class="todo-alert-success">
            {{ session('success') }}
        </div>
    @endif
    @error('content')
    <div class="todo-alert-danger">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="todo-content">
    <div class="new-ttl">
        <h2>新規作成</h2>
    </div>
        <form class="todo-create" action="/todos" method="post">
        @csrf
            <input class="todo-create-form" type="text" name="content" value="{{ old('content') }}">
                <select class="todo-create-cat-select" name="category_id">
                    @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
                <button class="todo-create-btn" type="submit">作成</button>
        </form>

    <div class="search-ttl">
        <h2>Todo検索</h2>
    </div>
        <form class="todo-create" action="/todos/search" method="get">
        @csrf
            <input class="todo-search-form" type="text" name="keyword" value="{{ old('keyword') }}">
                <select class="todo-create-cat-select" name="category_id">
                    <option value="">カテゴリ</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
                <button class="todo-search-btn" type="submit">検索</button>
        </form>

    <div class="todo-table">
        <table class="todo-table__inner">
            <tr class="todo-table__row">
                <th class="todo-table__header">
                    <span class="todo-table__header-span">Todo</span>
                    <span class="todo-table__header-span">カテゴリ</span> 
                </th>
            </tr>
        @foreach ($todos as $todo)
            <tr class="todo-table__row">
                <td class="todo-table__item">
                    <form class="update-form" action="/todos/update" method="post">
                    @method('PATCH') @csrf
                        <div class="update-form__item">
                            <input class="update-form__item-input" type="text" name="content" value="{{ $todo['content'] }}" />
                            <input type="hidden" name="id" value="{{ $todo['id'] }}" />
                        </div>
                        <div class="update-form__item">
                            <p class="update-form__item-p">{{ $todo['category']['name'] }}</p>
                        </div>
                        <div class="update-form__button">
                            <button class="update-form__button-submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="todo-table__item">
                    <form class="delete-form" action="/todos/delete" method="post">
                    @method('DELETE') @csrf
                        <div class="delete-form__button">
                            <button class="delete-form__button-submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
        </table>
    </div>
</div>
@endsection
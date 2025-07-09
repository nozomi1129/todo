<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
</head>
<body>
    <!-- @extends('layouts.app'); -->
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
            Todo
            </a>
        </div>
    </header>
    <main>
    <div class="todo-alert">
        <!-- @if(session('success')) -->
            <div class="todo-alert-success">
                {{ session('success') }}
            </div>
        <!-- @endif -->
        @error('content')
        <div class="todo-alert-danger">

            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="todo-content">
        <div class="todo-create">
            <form action="/todos" method="post">
                @csrf
                    <input class="todo-create-form" type="text" name="content">
                    <button class="todo-create-btn" type="submit">作成</button>
            </form>
        </div>
        <div class="todo-list">
            <div class="todo-list-ttl">Todo</div>
            <div class="todo-list-content">
            @foreach ($todos as $todo )
            <form class="todo-list-form" action="/todos/update" method="POST">
            @method('PATCH')
            @csrf
                <div class="todo-list-item">
                    <input class="todo-list-item-text" type="text" name="content" value="{{ $todo['content'] }}">
                    <input type="hidden" name="id" value="{{ $todo['id'] }}">
                    <div class="todo-list-item-btn-re">
                        <button class="todo-list-item-re">更新</button>
                    </div>
            </form>
            <form class="todo-list-form" action="/todos/delete" method="POST">
            @method('DELETE')
            @csrf
                    <div class="todo-list-item-btn-de">
                        <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        <button class="todo-list-item-de">削除</button>
                    </div>
                </div>
            </form>
            @endforeach
            </div>
        </div>
    </div>

    </main>
</body>
</html>
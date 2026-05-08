@extends('layouts.app')

@section('content')
<div class="container">
    <h1>アカウント編集</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('account.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">名前</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>

        <div class="mb-3">
            <label class="form-label">メールアドレス</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>

        <hr>

        <div class="mb-3">
            <label class="form-label">新しいパスワード（変更する場合のみ）</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">パスワード確認</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">更新する</button>
        <a href="{{ route('mypage.index') }}" class="btn btn-secondary">マイページへ戻る</a>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>お問い合わせ</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('contact.send') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>名前</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>メールアドレス</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>お問い合わせ内容</label>
            <textarea name="message" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">送信</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection

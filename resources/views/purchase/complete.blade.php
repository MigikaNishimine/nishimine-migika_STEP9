@extends('layouts.app')

@section('content')
<div class="container">
    <h1>購入が完了しました</h1>

    <p>ご購入ありがとうございます。</p>

    <a href="{{ route('mypage.index') }}" class="btn btn-primary">マイページへ戻る</a>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">商品一覧へ</a>
</div>
@endsection

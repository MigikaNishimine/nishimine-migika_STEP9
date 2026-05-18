@extends('layouts.app')

@section('content')

<h1>商品詳細</h1>
<p>商品名: {{ $product->product_name }}</p>
<p>価格: {{ $product->price }}</p>
<p>会社名: {{ $product->company->company_name }}</p>
<p>コメント: {{ $product->comment }}</p>

<p>画像:
    @if ($product->img_path)
        <img src="{{ asset('storage/' . $product->img_path) }}" 
             alt="{{ $product->product_name }}" 
             width="200">
    @else
        <span class="text-muted">画像なし</span>
    @endif
</p>

<p>登録日時: {{ $product->created_at }}</p>
<p>更新日時: {{ $product->updated_at }}</p>

<a href="{{ route('products.index') }}">一覧に戻る</a>
<hr>

<form action="{{ route('products.like', $product->id) }}" method="POST" style="display:inline-block;">
    @csrf
    <button type="submit" class="btn {{ $isLiked ? 'btn-danger' : 'btn-outline-danger' }}">
        ♥ お気に入り
    </button>
</form>

@if(Auth::id() == $product->user_id)
    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">編集</a>

    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">
            削除
        </button>
    </form>
@endif

<a href="{{ route('purchase.show', $product->id) }}" class="btn btn-success">購入する</a>
<a href="{{ route('mypage.index') }}" class="btn btn-secondary">マイページへ戻る</a>

@endsection

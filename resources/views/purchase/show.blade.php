@extends('layouts.app')

@section('content')
<div class="container">
    <h1>購入画面</h1>

    <p>商品名：{{ $product->product_name }}</p>
    <p>価格：{{ $product->price }}</p>

    <form action="{{ route('purchase.store') }}" method="POST">
        @csrf

        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <div class="mb-3">
            <label class="form-label">数量</label>
            <input type="number" name="quantity" class="form-control" min="1" value="1">
        </div>

        <button type="submit" class="btn btn-primary">購入する</button>
        <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')

<h1>商品編集</h1>
<form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <p>商品名：<input type="text" name="product_name" value="{{ $product->product_name }}"></p>
    <p>価格：<input type="number" name="price" value="{{ $product->price }}"></p>
    <p>会社名：
        <select name="company_id">
            @foreach ($compnies as $company)
                <option value="{{ $company->id }}" {{ $company->id == $product->company_id ? 'selected' : ''}}>
                    {{ $company->company_name }}
                </opton>
            @endforeach
        </select>
    </p>
    <p>コメント：<textarea name="comment">{{ $product->comment }}</textarea></p>
    <p>画像：<input type="file" name="img_path"></p>
    <button type="submit">更新する</button>
</form>

<a href="{{ route('products.show',$product->id) }}">詳細に戻る</a>
@endsection

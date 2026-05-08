@extends('layouts.app')

@section('content')

<h1>商品新規登録</h1>

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <p>商品名：<input type="text" name="product_name"></p>

    <p>価格：<input type="number" name="price"></p>

    <p>会社名：
        <select name="company_id">
            @foreach ($companies as $company)
                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
            @endforeach
        </select>
    </p>

    <p>コメント：<textarea name="comment"></textarea></p>

    <p>画像：<input type="file" name="img_path"></p>

    <button type="submit">登録する</button>
</form>

<a href="{{ route('products.index') }}">一覧に戻る</a>
@endsection
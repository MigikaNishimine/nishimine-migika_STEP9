@extends('layouts.app')

@section('content')
<div class="container">
    <h1>マイページ</h1>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h3>ユーザー情報</h3>
    <p>名前：{{ $user->name }}</p>
    <p>メール：{{ $user->email }}</p>

    <hr>
    <hr>
    
   
    <div class="d-flex justify-content-between align-items-center mb-2">
    <h3>出品商品</h3>
    <a href="{{ route('products.create') }}" class="btn btn-primary">新規登録</a>
</div>

    @if($myProducts->isEmpty())
        <p>出品した商品はありません。</p>
    @else
        <table class="table">
            <tr>
                <th>商品名</th>
                <th>価格</th>
                <th>詳細</th>
            </tr>
            @foreach($myProducts as $product)
                <tr>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">
                            詳細
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

    <h3>購入履歴</h3>
    @if($purchaseHistory->isEmpty())
        <p>購入履歴はありません。</p>
    @else
        <table class="table">
            <tr>
                <th>商品名</th>
                <th>価格</th>
                <th>数量</th>
                <th>購入日</th>
                <th>詳細</th>
            </tr>
            @foreach($purchaseHistory as $history)
            <tr>
                <td>{{ $history->product_name }}</td>
                <td>{{ $history->price }}</td>
                <td>{{ $history->quantity }}</td>
                <td>{{ $history->created_at }}</td>
                <td>
                    <a href="{{ route('products.show', $history->product_id) }}" class="btn btn-primary">
                        詳細
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
    @endif
    <hr>

    <h3>お気に入り一覧</h3>

    @if($favoriteProducts->isEmpty())
    <p>お気に入りはありません。</p>
    @else
        <table class="table">
            <tr>
                <th>商品名</th>
                <th>価格</th>
                <th>会社名</th>
                <th>画像</th>
                <th>詳細</th>
            </tr>
            @foreach($favoriteProducts as $product)
            <tr>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->company_name }}</td>
                <td>
                    <img src="{{ asset('storage/' . $product->img_path) }}" width="80">
                </td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">
                        詳細
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
    @endif
    <hr>
    <a href="{{ route('account.edit') }}" class="btn btn-secondary">アカウント編集へ</a>
</div>
@endsection

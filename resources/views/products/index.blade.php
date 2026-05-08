@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="mb-4">商品一覧</h1>

    <div class="card p-4 mb-4">
        <form action="{{ route('products.index') }}" method="GET">
            <div class="row g-3">

                <div class="col-md-4">
                    <label class="form-label">商品名</label>
                    <input type="text" name="product_name" class="form-control"
                        value="{{ request('product_name') }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">会社名</label>
                    <select name="company_id" class="form-select">
                        <option value="">すべて</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}"
                                {{ request('company_id') == $company->id ? 'selected' : '' }}>
                                {{ $company->company_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">価格（最小）</label>
                    <input type="number" name="price_min" class="form-control"
                        value="{{ request('price_min') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label">価格（最大）</label>
                    <input type="number" name="price_max" class="form-control"
                        value="{{ request('price_max') }}">
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary mt-3">検索</button>
                </div>

            </div>
        </form>
    </div>

    <div class="card p-3">
        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th>商品番号</th>
                    <th>商品名</th>
                    <th>商品説明</th>
                    <th>画像</th>
                    <th>料金(¥)</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>

                    <td>{{ $product->product_name }}</td>

                    <td>{{ $product->description ?? '説明なし' }}</td>


                    <td>
                @if($product->img_path)
                    <img src="{{ asset('storage/' . $product->img_path) }}" width="80" class="rounded">
                @else
                    <span class="text-muted">画像なし</span>
                @endif

                    </td>

                    <td>{{ number_format($product->price) }}</td>

                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-success btn-sm">詳細</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>

</div>
@endsection

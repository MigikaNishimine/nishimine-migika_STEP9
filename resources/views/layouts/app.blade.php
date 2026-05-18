<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cytech EC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

    
    <header class="bg-light border-bottom mb-4">
        <div class="container d-flex justify-content-between align-items-center py-3">
            <h2 class="m-0">Cytech EC</h2>

            <div class="d-flex align-items-center gap-3">

            @guest
                <a href="{{ route('login') }}">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endguest

            @auth
                <a href="{{ route('products.index') }}">Home</a>
                <a href="{{ route('mypage.index') }}">マイページ</a>
                <span>ログインユーザー: {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-sm">ログアウト</button>
                </form>
            @endauth

            </div>
        </div>        
    </header>


    <main class="container mb-5">
        @yield('content')
    </main>


    <footer class="mt-auto bg-light border-top py-3">
        <div class="container text-center">
            <a href="{{ route('contact.form') }}" class="btn btn-primary mb-2">お問い合わせ</a>
            <div class="mb-2">
                <a href="{{ route('products.index') }}">Home</a> |
                <a href="{{ route('mypage.index') }}">マイページ</a>
            </div>
            <small>© 2026 Company, Inc</small>
        </div>
    </footer>

</body>
</html>

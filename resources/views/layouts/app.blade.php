<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>GLF Imobiliaria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        body {
            padding-top: 93px;
            padding-bottom: 20px;
        }
        .btn-light {
            background-color: #c6c6c6;
            color: #000000;
            border-color: #c6c6c6;
        }
        .btn-light:hover {
            background-color: #cccccc;
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-primary fixed-top p-1 navbar-dark">
        <div class="container-fluid">
            <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
                <img src="{{ asset('storage/logo.png') }}" class="p-2" alt="Logo" style="height:64px;">
            </a>

            <button class="navbar-toggler text-light" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse text-light" id="navbarSupportedContent">
                {{-- Menu principal --}}
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    {{-- Imoveis --}}
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('holdings.index') }}">
                            <i class="fa-solid fa-house"></i> Imoveis
                        </a>
                    </li>
                    {{-- Produtos --}}
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('products.index') }}">
                            <i class="fa-solid fa-box"></i> Produtos
                        </a>
                    </li>

                    {{-- Pedidos --}}
                    @auth
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('orders.index') }}">
                            <i class="fa-solid fa-receipt"></i> Meus pedidos
                        </a>
                    </li>
                    @endauth

                    {{-- Checkout --}}
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('checkout.index') }}">
                            <i class="fa-solid fa-credit-card"></i> Finalizar compra
                        </a>
                    </li>

                </ul>
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    {{-- Carrinho --}}
                    <li class="nav-item me-lg-2">
                        <a class="nav-link position-relative text-light" href="{{ route('cart.index') }}">
                            <i class="fa-solid fa-cart-shopping"></i> Carrinho
                            @if(count(session()->get('cart', [])))
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ array_sum(array_column(session()->get('cart', []), 'quantity')) }}
                                </span>
                            @endif
                        </a>
                    </li>

                    {{-- Admin --}}
                    @auth
                        @if(auth()->user()->is_admin)
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('admin.dashboard') }}">
                                    <i class="fa-solid fa-user-gear"></i> Admin
                                </a>
                            </li>
                        @endif
                    @endauth

                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('login')) ? 'active' : '' }} text-light" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('register')) ? 'active' : '' }} text-light" href="{{ route('register') }}">Cadastro</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Sair
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- Conteudo principal --}}
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    {{-- Rodape --}}
    <footer class="container-fluid bg-dark p-3 text-center mt-5">
        <p class="text-light mb-0">&copy;2025 - {{ now()->year }} - Gustavo & Renan</p>
    </footer>

    {{-- JS Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>

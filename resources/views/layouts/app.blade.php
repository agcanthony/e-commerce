<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Minha Loja')</title>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>
    <header class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">Minha Loja</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Produtos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/cart') }}">Carrinho</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/orders') }}">Pedidos</a>
                </li>
                @if(Session::get('authenticated'))
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="waves-effect waves-teal btn-flat">Sair</button>
                    </form>
                </li>
                @endif
                <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ url('/cart') }}">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge" id="cart-count">0</span>
                    </a>
                </li> -->
            </ul>
        </div>
    </header>
    <div class="" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item linha">
                <a class="nav-link" href="{{ url('/cart') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="badge" id="cart-count">0</span>
                </a>
            </li>
        </ul>
    </div>
    <main class="container mt-4">
        @yield('content')
    </main>
    <footer class="footer bg-light text-center py-3">
        <p>&copy; 2024 Minha Loja</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    @yield('scripts')
    <script>
        function updateCartCount() {
            fetch('/cart/count')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('cart-count').textContent = data.count;
                })
                .catch(error => console.error('Erro ao buscar a contagem do carrinho:', error));
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
        });

        // Atualizar a contagem do carrinho após uma ação que possa alterar o carrinho
        document.addEventListener('cartUpdated', function() {
            updateCartCount();
        });
    </script>
</body>

</html>
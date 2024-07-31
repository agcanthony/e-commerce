@extends('layouts.app')

@section('title', 'Lista de Produtos')

@section('content')
<h1>Produtos</h1>
<ul id="product-list">
    <div class="row">
        @foreach($products as $product)
        <div class="col s12 m6">
            <div class="card">
                <div class="card-image">
                    <img src="images/produto1.jpg">
                    <form class="add-to-cart-form" action="/add-to-cart" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-info btn-sm"><i class="material-icons">+</i></button>
                    </form>
                </div>
                <div class="card-content">
                    <p>{{ $product->description }} - ${{ $product->price }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</ul>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.add-to-cart-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                let formData = new FormData(this);

                fetch('/add-to-cart', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    }).then(response => response.json())
                    .then(data => {                        
                        document.dispatchEvent(new Event('cartUpdated'));
                        Swal.fire("Produto Adicionado", "O produto foi adicionado ao carrinho.", "success");
                    }).catch(error => {
                        Swal.fire("Erro", "Ocorreu um erro ao adicionar o produto ao carrinho.", "error");
                    });
            });
        });
    });
</script>
@endsection
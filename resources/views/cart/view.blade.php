@extends('layouts.app')

@section('title', 'Carrinho de Compras')

@section('content')
<h1>Carrinho de Compras</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cart as $item)
        <tr>
            <td>{{ $item['product']['description'] }}</td>
            <td>${{ $item['product']['price'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>
                <form class="remove-from-cart-from" action="/remove" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $item['product']['id'] }}">
                    <button type="submit" class="btn-floating custom-btn waves-effect waves-light red">
                        <i class="fas f fa-trash icone-delete icone-delete"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<form id="checkout-form" action="/checkout" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary">Finalizar Pedido</button>
</form>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('.remove-from-cart-from').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            let formData = new FormData(this);
            console.log(formData);
            fetch('/remove', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(response => response.json())
                .then(data => {                   
                    document.dispatchEvent(new Event('cartUpdated'));
                    Swal.fire("Produto Removido", "O produto foi removido do carrinho.", "success");

                }).catch(error => {
                    Swal.fire("Erro", "Ocorreu um erro ao remover o produto do carrinho.", "error");
                });
        });
    });

    document.getElementById('checkout-form').addEventListener('submit', function(event) {
        event.preventDefault();
        let formData = new FormData(this);

        fetch('/checkout', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(response => response.json())
            .then(data => {
                document.dispatchEvent(new Event('cartUpdated'));
                Swal.fire("Pedido Finalizado", "Seu pedido foi finalizado com sucesso.", "success").then(() => {
                    window.location.href = '/orders';
                });
            }).catch(error => {
                Swal.fire("Erro", "Ocorreu um erro ao finalizar o pedido.", "error");
            });
    });
</script>
@endsection
@extends('layouts.app')

@section('title', 'Pedidos')

@section('content')
<h1>Pedidos</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID do Pedido</th>
            <th>Descrição do Produto</th>
            <th>Preço</th>
            <th>Quantidade</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            @foreach(json_decode($order->products, true) as $item)
                <tr>
                    @if ($loop->first)
                        <td rowspan="{{ count(json_decode($order->products, true)) }}">{{ $order->id }}</td>
                    @endif
                    <td>{{ $item['product']['description'] }}</td>
                    <td>${{ $item['product']['price'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
@endsection

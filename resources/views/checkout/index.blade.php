@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1>Checkout</h1>
    </div>
</div>

@if(count($cartItems) > 0)
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Resumo do pedido</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Tipo</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                        <tr>
                            <td>
                                @php
                                    $photoPath = !empty($item['photo']) ? asset('storage/'.$item['photo']) : asset('storage/semfoto.png');
                                @endphp
                                <img src="{{ $photoPath }}" width="50" class="me-2" alt="Foto do item">
                                {{ $item['name'] ?? 'Item' }}
                            </td>
                            <td class="text-capitalize">{{ $item['type'] ?? '-' }}</td>
                            <td>{{ $item['quantity'] ?? 1 }}</td>
                            <td>R$ {{ number_format($item['price'] ?? 0, 2, ',', '.') }}</td>
                            <td>R$ {{ number_format($item['subtotal'] ?? 0, 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Total:</strong></td>
                            <td>R$ {{ number_format($total, 2, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4>Confirmar pedido</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100">Finalizar pedido</button>
                </form>
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-12">
        <div class="alert alert-info">
            Seu carrinho está vazio. <a href="{{ route('holdings.index') }}">Veja os imóveis</a> ou <a href="{{ route('products.index') }}">navegue pelos produtos</a>.
        </div>
    </div>
</div>
@endif
@endsection

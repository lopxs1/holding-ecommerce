@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1>Carrinho</h1>
    </div>
</div>

@if(count($cartItems) > 0)
<div class="row">
    <div class="col-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Tipo</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Total</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr>
                    <td>
                        @php
                            $photoPath = !empty($item['photo']) ? asset('storage/'.$item['photo']) : asset('storage/semfoto.png');
                        @endphp
                        <img src="{{ $photoPath }}" width="50" class="me-2" alt="Foto">
                        {{ $item['name'] }}
                    </td>
                    <td class="text-capitalize">{{ $item['type'] }}</td>
                    <td>R$ {{ number_format($item['price'], 2, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('cart.update', $item['key']) }}" method="POST" class="d-flex align-items-center gap-2">
                            @csrf
                            <input type="number" name="quantity" value="{{ $item['quantity'] ?? 1 }}" min="1" class="form-control form-control-sm" style="width: 70px;">
                            <button type="submit" class="btn btn-outline-secondary btn-sm">Atualizar</button>
                        </form>
                    </td>
                    <td>R$ {{ number_format(($item['quantity'] ?? 1) * $item['price'], 2, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $item['key']) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-12 text-end">
        @php
            $cartTotal = collect($cartItems)->sum(function ($item) {
                return ($item['quantity'] ?? 1) * ($item['price'] ?? 0);
            });
        @endphp
        <p class="mb-2"><strong>Total:</strong> R$ {{ number_format($cartTotal, 2, ',', '.') }}</p>
        <a href="{{ route('holdings.index') }}" class="btn btn-secondary">Ver imóveis</a>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary ms-2">Ver produtos</a>
        <a href="{{ route('checkout.index') }}" class="btn btn-primary ms-2">Prosseguir para checkout</a>
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

@extends('layouts.app')

@section('content')
<h1 class="mb-3">Pedido #{{ $order->id }}</h1>

<div class="mb-3">
    <p><strong>Cliente:</strong> {{ $order->user->name ?? '-' }}</p>
    <p><strong>Total:</strong> R$ {{ number_format($order->total, 2, ',', '.') }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    <p><strong>Data:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
</div>

<h4>Itens</h4>
@if($order->items->count())
<table class="table table-sm">
    <thead>
        <tr>
            <th>Item</th>
            <th>Tipo</th>
            <th>Quantidade</th>
            <th>Preço unitário (R$)</th>
            <th>Subtotal (R$)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        <tr>
            <td>{{ $item->product->name ?? $item->holding->name ?? 'Item removido' }}</td>
            <td class="text-capitalize">{{ $item->product_id ? 'produto' : 'imóvel' }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->unit_price, 2, ',', '.') }}</td>
            <td>{{ number_format($item->unit_price * $item->quantity, 2, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="alert alert-info">Nenhum item neste pedido.</div>
@endif

<a href="{{ route('admin.orders.index') }}" class="btn btn-light mt-3">Voltar</a>
@endsection

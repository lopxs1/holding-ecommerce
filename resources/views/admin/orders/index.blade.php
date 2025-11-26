@extends('layouts.app')

@section('content')
<h1 class="mb-3">Pedidos</h1>

@if($orders->count())
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Total (R$)</th>
            <th>Status</th>
            <th>Data</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user->name ?? '-' }}</td>
            <td>{{ number_format($order->total, 2, ',', '.') }}</td>
            <td><span class="badge bg-{{ $order->status === 'completed' ? 'success' : 'warning' }}">{{ ucfirst($order->status) }}</span></td>
            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
            <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-primary">Ver</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $orders->links() }}
@else
<div class="alert alert-info">Nenhum pedido encontrado.</div>
@endif
@endsection

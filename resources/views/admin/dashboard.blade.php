@extends('layouts.app')

@section('content')
<h1 class="mb-4">Dashboard</h1>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-bg-primary">
            <div class="card-body">
                <div class="fw-bold">Imoveis</div>
                <div class="display-6">{{ $metrics['holdings'] ?? 0 }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-success">
            <div class="card-body">
                <div class="fw-bold">Pedidos</div>
                <div class="display-6">{{ $metrics['orders'] ?? 0 }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-dark">
            <div class="card-body">
                <div class="fw-bold">Receita (R$)</div>
                <div class="display-6">{{ number_format($metrics['revenue'] ?? 0, 2, ',', '.') }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-secondary">
            <div class="card-body">
                <div class="fw-bold">Usuarios</div>
                <div class="display-6">{{ $metrics['users'] ?? 0 }}</div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Ultimos pedidos</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.holdings.index') }}" class="btn btn-outline-primary btn-sm d-flex align-items-center gap-2">
            <i class="fa-solid fa-building"></i>
            <span>Gerenciar imoveis</span>
        </a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-2">
            <i class="fa-solid fa-box"></i>
            <span>Gerenciar produtos</span>
        </a>
    </div>
</div>
@if(($latestOrders ?? collect())->count())
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Total (R$)</th>
            <th>Status</th>
            <th>Data</th>
        </tr>
    </thead>
    <tbody>
        @foreach($latestOrders as $order)
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
@else
<div class="alert alert-info">Nenhum pedido ainda.</div>
@endif

@endsection

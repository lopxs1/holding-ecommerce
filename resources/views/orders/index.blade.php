@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1>Meus pedidos</h1>
    </div>
</div>

<div class="row">
    <div class="col-12">
        @if($orders->count() > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Pedido #</th>
                    <th>Data</th>
                    <th>Total (R$)</th>
                    <th>Status</th>
                    <th>Acoes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>{{ number_format($order->total, 2, ',', '.') }}</td>
                    <td>
                        <span class="badge bg-{{ $order->status === 'completed' ? 'success' : 'warning' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-primary">Ver</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
        @else
        <div class="alert alert-info">
            Voce ainda nao fez pedidos. <a href="{{ route('holdings.index') }}">Veja os imoveis</a>.
        </div>
        @endif
    </div>
</div>
@endsection

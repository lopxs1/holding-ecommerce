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
                            <th>Imovel</th>
                            <th>Endereco</th>
                            <th>Proprietario</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                        <tr>
                            <td>
                                <img src="{{ $item['photo'] ?? 'https://via.placeholder.com/50' }}" width="50" class="me-2" alt="Foto do imovel">
                                {{ $item['name'] ?? 'Imovel' }}
                            </td>
                            <td>{{ $item['address'] ?? '-' }}</td>
                            <td>{{ $item['owner'] ?? '-' }}</td>
                            <td>{{ $item['quantity'] ?? 1 }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total estimado:</strong></td>
                            <td>R$ {{ number_format($total, 2, ',', '.') }} (sem preco cadastrado)</td>
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
                    <p class="mb-3">Sem cobranca: imoveis nao possuem preco cadastrado.</p>
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
            Seu carrinho esta vazio. <a href="{{ route('holdings.index') }}">Veja os imoveis</a>.
        </div>
    </div>
</div>
@endif
@endsection

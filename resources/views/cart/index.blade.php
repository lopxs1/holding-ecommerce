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
                    <th>Imóvel</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr>
                    <td>
                        <img src="{{ $item['photo'] ?? 'https://via.placeholder.com/50' }}" width="50" class="me-2" alt="Foto do imóvel">
                        {{ $item['name'] }}
                    </td>
                    <td>
                        <form action="{{ route('cart.remove', $item['holding_id']) }}" method="POST" class="d-inline">
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
        <a href="{{ route('holdings.index') }}" class="btn btn-secondary">Continuar buscando imóveis</a>
        <a href="{{ route('checkout.index') }}" class="btn btn-primary">Prosseguir para checkout</a>
    </div>
</div>
@else
<div class="row">
    <div class="col-12">
        <div class="alert alert-info">
            Seu carrinho está vazio. <a href="{{ route('holdings.index') }}">Veja os imóveis</a>.
        </div>
    </div>
</div>
@endif
@endsection

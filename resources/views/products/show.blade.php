@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 mb-3">
        @php
            $productImage = $product->image ? asset('storage/'.$product->image) : asset('storage/semfoto.png');
        @endphp
        <img src="{{ $productImage }}" class="img-fluid rounded shadow-sm" alt="{{ $product->name }}">
    </div>
    <div class="col-md-6">
        <h1>{{ $product->name }}</h1>
        <p class="text-muted">{{ $product->description }}</p>

        @if($product->category)
            <p><strong>Categoria:</strong> {{ $product->category->name }}</p>
        @endif

        <p class="fs-4 fw-bold text-primary mb-4">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
        <form action="{{ route('cart.addProduct', $product) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-success">Adicionar ao carrinho</button>
        </form>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Voltar para a lista</a>
    </div>
</div>
@endsection

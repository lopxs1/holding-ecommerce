@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0">Produtos</h1>
            <small class="text-muted">Catálogo de produtos disponíveis</small>
        </div>
    </div>
</div>

<div class="row">
    @forelse($products as $product)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
            @php
                $productImage = $product->image ? asset('storage/'.$product->image) : asset('storage/semfoto.png');
            @endphp
            <img src="{{ $productImage }}" class="card-img-top" alt="{{ $product->name }}">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="card-title mb-0">{{ $product->name }}</h5>
                    @if($product->category)
                        <span class="badge bg-light text-dark border">{{ $product->category->name }}</span>
                    @endif
                </div>
                <p class="card-text text-muted mb-2">
                    {{ \Illuminate\Support\Str::limit($product->description, 120) }}
                </p>
                <p class="mb-0 fw-bold text-primary">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
            </div>
            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">Ver detalhes</a>
                <form action="{{ route('cart.addProduct', $product) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success">Comprar</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info">Nenhum produto encontrado.</div>
    </div>
    @endforelse
</div>

<div class="row">
    <div class="col-12">
        {{ $products->links() }}
    </div>
</div>
@endsection

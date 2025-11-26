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
            <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/400x300' }}" class="card-img-top" alt="{{ $product->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text text-muted mb-1">
                    {{ \Illuminate\Support\Str::limit($product->description, 120) }}
                </p>
                <p class="mb-1 fw-bold text-primary">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                @if($product->category)
                    <span class="badge bg-light text-dark border">{{ $product->category->name }}</span>
                @endif
            </div>
            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">Ver detalhes</a>
                <span class="text-muted small">#{{ $product->id }}</span>
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

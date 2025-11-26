@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="mb-0">Nossos imóveis</h1>
        <small class="text-muted">Encontre oportunidades no nosso portfólio</small>
    </div>
</div>

<div class="row">
    @foreach($holdings as $holding)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
            @php
                $holdingImage = $holding->photo ? asset('storage/'.$holding->photo) : asset('storage/semfoto.png');
            @endphp
            <img src="{{ $holdingImage }}" class="card-img-top" alt="{{ $holding->name }}">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="card-title mb-0">{{ $holding->name }}</h5>
                    @if($holding->category)
                        <span class="badge bg-light text-dark border">{{ $holding->category->name }}</span>
                    @endif
                </div>
                <p class="card-text text-muted mb-2">{{ \Illuminate\Support\Str::limit($holding->description, 100) }}</p>
                <p class="mb-1 small"><strong>Endereço:</strong> {{ $holding->address }}</p>
                <p class="mb-1 small"><strong>Proprietário:</strong> {{ $holding->owner }}</p>
                <p class="fw-bold text-primary mt-2">R$ {{ number_format($holding->price, 2, ',', '.') }}</p>
            </div>
            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                <a href="{{ route('holdings.show', $holding) }}" class="btn btn-sm btn-outline-primary">Ver detalhes</a>
                <form action="{{ route('cart.add', $holding) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success">Adicionar</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row">
    <div class="col-12">
        {{ $holdings->links() }}
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 mb-3">
        @php
            $holdingImage = $holding->photo ? asset('storage/'.$holding->photo) : asset('storage/semfoto.png');
        @endphp
        <img src="{{ $holdingImage }}" class="img-fluid rounded shadow-sm" alt="{{ $holding->name }}" style="width: 400px;">
    </div>
    <div class="col-md-6">
        <h1>{{ $holding->name }}</h1>
        <p class="text-muted">{{ $holding->description }}</p>
        <p class="mb-1"><strong>Endereco:</strong> {{ $holding->address }}</p>
        <p class="mb-3"><strong>Proprietario:</strong> {{ $holding->owner }}</p>

        @if($holding->category)
            <p><strong>Categoria:</strong> {{ $holding->category->name }}</p>
        @endif

        <p class="fs-4 fw-bold text-primary mb-4">R$ {{ number_format($holding->price, 2, ',', '.') }}</p>
        <form action="{{ route('cart.add', $holding) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-success">Adicionar ao carrinho</button>
        </form>
        <a href="{{ route('holdings.index') }}" class="btn btn-secondary">Voltar para a lista</a>
    </div>
</div>
@endsection

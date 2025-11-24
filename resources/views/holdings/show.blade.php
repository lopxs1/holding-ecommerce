@extends('layouts.app')

@section('content')
<div class="row">
    <img src="{{ $holding->photo ? asset('storage/'.$holding->photo) : 'https://via.placeholder.com/400x300' }}" class="img-fluid" alt="{{ $holding->name }}">
    <h1>{{ $holding->name }}</h1>
    <p class="mb-1"><strong>Endereço:</strong> {{ $holding->address }}</p>
    <p class="mb-1"><strong>Proprietário:</strong> {{ $holding->owner }}</p>
    <p class="mb-3">{{ $holding->description }}</p>
    @if($holding->category)
        <p>Categoria: {{ $holding->category->name }}</p>
    @endif
    <form action="{{ route('cart.add', $holding) }}" method="POST" class="mt-4">
        @csrf
        <button type="submit" class="btn btn-primary btn-lg">Adicionar ao carrinho</button>
    </form>
</div>
@endsection
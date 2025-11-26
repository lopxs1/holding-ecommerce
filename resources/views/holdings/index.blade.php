@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1>Nossos imoveis</h1>
    </div>
</div>

<div class="row">
    @foreach($holdings as $holding)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <img src="{{ $holding->photo ? asset('storage/'.$holding->photo) : 'https://via.placeholder.com/400x300' }}" class="card-img-top" alt="{{ $holding->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $holding->name }}</h5>
                <p class="card-text">{{ \Illuminate\Support\Str::limit($holding->description, 100) }}</p>
                <p class="mb-1"><strong>Endereco:</strong> {{ $holding->address }}</p>
                <p class="mb-1"><strong>Proprietario:</strong> {{ $holding->owner }}</p>
            </div>
            <div class="card-footer bg-white">
                <a href="{{ route('holdings.show', $holding) }}" class="btn btn-primary">Ver detalhes</a>
                <form action="{{ route('cart.add', $holding) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">Adicionar ao carrinho</button>
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

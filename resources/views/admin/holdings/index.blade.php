@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Imóveis</h1>
    <a href="{{ route('admin.holdings.create') }}" class="btn btn-primary">Novo imóvel</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if($holdings->count())
<table class="table table-striped align-middle">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Proprietário</th>
            <th>Preço</th>
            <th>Cadastro</th>
            <th class="text-end">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($holdings as $holding)
        <tr>
            <td>{{ $holding->id }}</td>
            <td>{{ $holding->name }}</td>
            <td>{{ $holding->category->name ?? '-' }}</td>
            <td>{{ $holding->owner }}</td>
            <td>R$ {{ number_format($holding->price, 2, ',', '.') }}</td>
            <td>{{ \Illuminate\Support\Carbon::parse($holding->regisdate)->format('d/m/Y') }}</td>
            <td class="text-end">
                <a href="{{ route('admin.holdings.edit', $holding) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                <form action="{{ route('admin.holdings.destroy', $holding) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover este imóvel?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $holdings->links() }}
@else
<div class="alert alert-info">Nenhum imóvel cadastrado.</div>
@endif
@endsection

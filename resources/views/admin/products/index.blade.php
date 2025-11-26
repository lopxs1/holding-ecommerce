@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Produtos</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Novo produto</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if($products->count())
<table class="table table-striped align-middle">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th class="text-end">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name ?? '-' }}</td>
            <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
            <td class="text-end">
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover produto?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $products->links() }}
@else
<div class="alert alert-info">Nenhum produto cadastrado.</div>
@endif
@endsection

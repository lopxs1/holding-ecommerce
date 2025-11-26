@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Imoveis</h1>
    <a href="{{ route('admin.holdings.create') }}" class="btn btn-primary">Novo imovel</a>
</div>

@if($holdings->count())
<table class="table table-striped align-middle">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Proprietario</th>
            <th>Cadastro</th>
            <th class="text-end">Acoes</th>
        </tr>
    </thead>
    <tbody>
        @foreach($holdings as $holding)
        <tr>
            <td>{{ $holding->name }}</td>
            <td>{{ $holding->category->name ?? '-' }}</td>
            <td>{{ $holding->owner }}</td>
            <td>{{ \Illuminate\Support\Carbon::parse($holding->regisdate)->format('d/m/Y') }}</td>
            <td class="text-end">
                <a href="{{ route('admin.holdings.edit', $holding) }}" class="btn btn-sm btn-secondary">Editar</a>
                <form action="{{ route('admin.holdings.destroy', $holding) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Remover este imovel?')">Remover</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $holdings->links() }}
@else
<div class="alert alert-info">Nenhum imovel cadastrado.</div>
@endif
@endsection

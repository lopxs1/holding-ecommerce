@extends('layouts.app')

@section('content')
<h1 class="mb-3">Editar imovel</h1>

<form action="{{ route('admin.holdings.update', $holding) }}" method="POST">
    @csrf
    @method('PUT')
    @include('admin.holdings.partials.form', ['holding' => $holding])
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="{{ route('admin.holdings.index') }}" class="btn btn-light">Cancelar</a>
</form>
@endsection

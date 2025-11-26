@extends('layouts.app')

@section('content')
<h1 class="mb-3">Novo imovel</h1>

<form action="{{ route('admin.holdings.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.holdings.partials.form', ['holding' => null])
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="{{ route('admin.holdings.index') }}" class="btn btn-light">Cancelar</a>
</form>
@endsection

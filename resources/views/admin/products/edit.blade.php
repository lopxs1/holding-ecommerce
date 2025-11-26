@extends('layouts.app')

@section('content')
<h1 class="mb-3">Editar produto</h1>

<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.products.partials.form', ['product' => $product])
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-light">Cancelar</a>
</form>
@endsection

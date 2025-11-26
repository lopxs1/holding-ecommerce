@extends('layouts.app')

@section('content')
<h1 class="mb-3">Novo produto</h1>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.products.partials.form', ['product' => null])
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-light">Cancelar</a>
</form>
@endsection

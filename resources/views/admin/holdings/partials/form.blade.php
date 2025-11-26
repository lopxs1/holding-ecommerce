<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label class="form-label">Nome</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $holding->name ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Proprietario</label>
        <input type="text" name="owner" class="form-control" value="{{ old('owner', $holding->owner ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Endereco</label>
        <input type="text" name="address" class="form-control" value="{{ old('address', $holding->address ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Data de registro</label>
        <input type="date" name="regisdate" class="form-control" value="{{ old('regisdate', isset($holding)? \Illuminate\Support\Carbon::parse($holding->regisdate)->format('Y-m-d') : '') }}" required>
    </div>
    <div class="col-12">
        <label class="form-label">Descricao</label>
        <input type="text" name="description" class="form-control" value="{{ old('description', $holding->description ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Categoria</label>
        <select name="category_id" class="form-select">
            <option value="">Selecione</option>
            @foreach($categories as $id => $name)
                <option value="{{ $id }}" @selected(old('category_id', $holding->category_id ?? null) == $id)>{{ $name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Foto</label>
        <input type="file" name="photo" class="form-control" accept="image/*" onchange="previewHolding(this)">
        <div class="mt-2">
            <img id="holding-preview" src="{{ !empty($holding?->photo) ? asset('storage/'.$holding->photo) : asset('storage/semfoto.png') }}" alt="Pré-visualização" class="img-thumbnail" style="max-height: 120px;">
        </div>
        @if(!empty($holding?->photo))
            <small class="text-muted d-block mt-1">Atual: <a href="{{ asset('storage/'.$holding->photo) }}" target="_blank">ver imagem</a></small>
        @endif
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@push('scripts')
<script>
    function previewHolding(input) {
        const preview = document.getElementById('holding-preview');
        if (!preview || !input.files || !input.files[0]) return;
        const reader = new FileReader();
        reader.onload = e => preview.src = e.target.result;
        reader.readAsDataURL(input.files[0]);
    }
</script>
@endpush

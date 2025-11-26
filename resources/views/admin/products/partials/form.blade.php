<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label class="form-label">Nome</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Categoria</label>
        <select name="category_id" class="form-select">
            <option value="">Selecione</option>
            @foreach($categories as $id => $name)
                <option value="{{ $id }}" @selected(old('category_id', $product->category_id ?? null) == $id)>{{ $name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">Descrição</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description ?? '') }}</textarea>
    </div>
    <div class="col-md-4">
        <label class="form-label">Preço</label>
        <input type="number" name="price" class="form-control" step="0.01" min="0" value="{{ old('price', $product->price ?? '') }}" required>
    </div>
    <div class="col-md-8">
        <label class="form-label">Imagem</label>
        <input type="file" name="image" class="form-control" accept="image/*" onchange="previewProduct(this)">
        <div class="mt-2">
            <img id="product-preview" src="{{ !empty($product?->image) ? asset('storage/'.$product->image) : asset('storage/semfoto.png') }}" alt="Pré-visualização" class="img-thumbnail" style="max-height: 120px;">
        </div>
        @if(!empty($product?->image))
            <small class="text-muted d-block mt-1">Atual: <a href="{{ asset('storage/'.$product->image) }}" target="_blank">ver imagem</a></small>
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
    function previewProduct(input) {
        const preview = document.getElementById('product-preview');
        if (!preview || !input.files || !input.files[0]) return;
        const reader = new FileReader();
        reader.onload = e => preview.src = e.target.result;
        reader.readAsDataURL(input.files[0]);
    }
</script>
@endpush

<div class="form-group">
    <label for="name">Nama Departemen</label>
    <input
        type="text"
        id="name"
        name="name"
        value="{{ old('name', $department->name ?? '') }}"
        class="form-control @error('name') is-invalid @enderror"
        placeholder="Contoh: Sumber Daya Manusia"
        required
        autofocus
    >
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<button type="submit" class="btn btn-primary">{{ $buttonLabel }}</button>
<a href="{{ route('departments.index') }}" class="btn btn-light">Batal</a>

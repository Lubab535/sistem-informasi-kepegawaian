<div class="form-group">
    <label for="name">Nama Pegawai</label>
    <input
        type="text"
        id="name"
        name="name"
        value="{{ old('name', $employee->name ?? '') }}"
        class="form-control @error('name') is-invalid @enderror"
        placeholder="Masukkan nama lengkap"
        required
        autofocus
    >
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="position">Posisi</label>
    <input
        type="text"
        id="position"
        name="position"
        value="{{ old('position', $employee->position ?? '') }}"
        class="form-control @error('position') is-invalid @enderror"
        placeholder="Contoh: Analis SDM"
        required
    >
    @error('position')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="department_id">Departemen</label>
    <select id="department_id" name="department_id" class="form-control @error('department_id') is-invalid @enderror" required>
        <option value="">Pilih departemen</option>
        @foreach ($departments as $department)
            <option value="{{ $department->id }}" @selected(old('department_id', $employee->department_id ?? '') == $department->id)>
                {{ $department->name }}
            </option>
        @endforeach
    </select>
    @error('department_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="salary">Gaji (Rp)</label>
    <input
        type="number"
        id="salary"
        name="salary"
        value="{{ old('salary', $employee->salary ?? '') }}"
        class="form-control @error('salary') is-invalid @enderror"
        min="0.01"
        step="0.01"
        placeholder="Contoh: 5000000"
        required
    >
    @error('salary')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="joined_at">Tanggal Bergabung</label>
    <input
        type="date"
        id="joined_at"
        name="joined_at"
        value="{{ old('joined_at', isset($employee) ? \Illuminate\Support\Carbon::parse($employee->joined_at)->format('Y-m-d') : '') }}"
        class="form-control @error('joined_at') is-invalid @enderror"
        required
    >
    @error('joined_at')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<button type="submit" class="btn btn-primary">{{ $buttonLabel }}</button>
<a href="{{ route('employees.index') }}" class="btn btn-light">Batal</a>

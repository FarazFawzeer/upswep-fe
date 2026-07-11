@extends('layouts.vertical', ['subtitle' => 'Edit Brand'])

@section('content')
    @include('layouts.partials.page-title', ['title' => 'Brands', 'subtitle' => 'Edit'])

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Edit Brand — {{ $brand->name }}</h5>
        </div>

        <div class="card-body">
            <div id="message"></div>

            <form id="brandForm" action="{{ route('admin.brands.update', $brand->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Brand Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ $brand->name }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order"
                            class="form-control" value="{{ $brand->sort_order }}" min="0">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="is_active"
                                name="is_active" value="1" {{ $brand->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="logo" class="form-label">Brand Logo</label>
                        <input type="file" id="logo" name="logo" class="form-control" accept="image/*">
                        <small class="text-muted">Leave empty to keep the current logo.</small>
                    </div>
                    <div class="col-md-6 mb-3 d-flex align-items-center gap-3">
                        @if ($brand->logo)
                            <div>
                                <p class="text-muted mb-1" style="font-size:11px;">Current logo</p>
                                <img src="{{ img_url($brand->logo) }}"
                                    alt="{{ $brand->name }}"
                                    style="max-height:60px;max-width:120px;object-fit:contain;border:1px solid #eee;border-radius:4px;padding:4px;">
                            </div>
                        @endif
                        <img id="logoPreview" src="" alt="New logo preview" class="d-none"
                            style="max-height:60px;max-width:120px;object-fit:contain;border:1px solid #eee;border-radius:4px;padding:4px;">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Brand</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('logo').addEventListener('change', function () {
            const preview = document.getElementById('logoPreview');
            if (this.files[0]) {
                preview.src = URL.createObjectURL(this.files[0]);
                preview.classList.remove('d-none');
            }
        });

        document.getElementById('brandForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const form = this;
            const btn = form.querySelector('[type=submit]');
            btn.disabled = true; btn.textContent = 'Saving...';

            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: { 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value }
            })
            .then(r => r.json())
            .then(data => {
                const box = document.getElementById('message');
                if (data.success) {
                    box.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                    setTimeout(() => box.innerHTML = '', 3000);
                } else {
                    const errors = Object.values(data.errors ?? {}).flat().join('<br>');
                    box.innerHTML = `<div class="alert alert-danger">${errors || data.message}</div>`;
                }
            })
            .catch(() => {
                document.getElementById('message').innerHTML =
                    `<div class="alert alert-danger">Something went wrong.</div>`;
            })
            .finally(() => { btn.disabled = false; btn.textContent = 'Update Brand'; });
        });
    </script>
@endsection
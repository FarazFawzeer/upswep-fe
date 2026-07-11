@extends('layouts.vertical', ['subtitle' => 'Add Category'])

@section('content')
    @include('layouts.partials.page-title', ['title' => 'Categories', 'subtitle' => 'Add New'])

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">New Category</h5>
        </div>

        <div class="card-body">
            <div id="message"></div>

            <form id="categoryForm" action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                            placeholder="e.g. Shirts" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order" class="form-control"
                            value="0" min="0">
                        <small class="text-muted">Lower number = shown first on homepage circles</small>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="is_active"
                                name="is_active" value="1" checked>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Category Image</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Shown as a circle on the homepage. Recommended: square image, min 200×200px.</small>
                    </div>
                    <div class="col-md-6 mb-3 d-flex align-items-center">
                        <img id="imagePreview" src="" alt="Preview"
                            class="rounded-circle d-none"
                            style="width:80px;height:80px;object-fit:cover;border:1px solid #e0e0e0;">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Category</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Live image preview
        document.getElementById('image').addEventListener('change', function () {
            const preview = document.getElementById('imagePreview');
            const file = this.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('d-none');
            }
        });

        // AJAX submit — same fetch() pattern as existing admin forms
        document.getElementById('categoryForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const form = this;
            const btn = form.querySelector('[type=submit]');
            btn.disabled = true;
            btn.textContent = 'Saving...';

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
                    form.reset();
                    document.getElementById('imagePreview').classList.add('d-none');
                    setTimeout(() => box.innerHTML = '', 3000);
                } else {
                    const errors = Object.values(data.errors ?? {}).flat().join('<br>');
                    box.innerHTML = `<div class="alert alert-danger">${errors || data.message}</div>`;
                }
            })
            .catch(() => {
                document.getElementById('message').innerHTML =
                    `<div class="alert alert-danger">Something went wrong. Please try again.</div>`;
            })
            .finally(() => { btn.disabled = false; btn.textContent = 'Save Category'; });
        });
    </script>
@endsection
@extends('layouts.vertical', ['subtitle' => 'Edit Category'])

@section('content')
    @include('layouts.partials.page-title', ['title' => 'Categories', 'subtitle' => 'Edit'])

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Edit Category — {{ $category->name }}</h5>
        </div>

        <div class="card-body">
            <div id="message"></div>

            <form id="categoryForm"
                action="{{ route('admin.categories.update', $category->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ $category->name }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order" class="form-control"
                            value="{{ $category->sort_order }}" min="0">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="is_active"
                                name="is_active" value="1" {{ $category->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Category Image</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Leave empty to keep the current image.</small>
                    </div>
                    <div class="col-md-6 mb-3 d-flex align-items-center gap-3">
                        {{-- Always show current image; preview replaces it on file pick --}}
                        @if ($category->image)
                            <div>
                                <p class="text-muted mb-1" style="font-size:11px;">Current image</p>
                                <img src="{{ img_url($category->image) }}"
                                    id="currentImage" alt="{{ $category->name }}"
                                    class="rounded-circle"
                                    style="width:80px;height:80px;object-fit:cover;border:1px solid #e0e0e0;">
                            </div>
                        @endif
                        <img id="imagePreview" src="" alt="New image preview"
                            class="rounded-circle d-none"
                            style="width:80px;height:80px;object-fit:cover;border:1px solid #e0e0e0;">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function () {
            const preview = document.getElementById('imagePreview');
            if (this.files[0]) {
                preview.src = URL.createObjectURL(this.files[0]);
                preview.classList.remove('d-none');
            }
        });

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
            .finally(() => { btn.disabled = false; btn.textContent = 'Update Category'; });
        });
    </script>
@endsection
@extends('layouts.vertical', ['subtitle' => 'Add Product'])

@section('content')
    @include('layouts.partials.page-title', ['title' => 'Products', 'subtitle' => 'Add New'])

    <div id="message"></div>

    <form id="productForm" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">

            {{-- ---- Left column: core product info ---- --}}
            <div class="col-lg-8">

                {{-- Basic info --}}
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="e.g. White Slim Fit Cotton Shirt" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="sku" class="form-label">SKU</label>
                                <input type="text" id="sku" name="sku" class="form-control"
                                    placeholder="e.g. UPS-SH-0001">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Price (LKR)</label>
                                <input type="number" id="price" name="price" class="form-control"
                                    placeholder="e.g. 28.00" step="0.01" min="0">
                                <small class="text-muted">Leave empty for "Contact for price"</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="4"
                                placeholder="Brief product description shown on the product detail page..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="details" class="form-label">Product Details</label>
                            <textarea id="details" name="details" class="form-control" rows="5"
                                placeholder="One bullet point per line:&#10;Regular fit&#10;Cotton-linen blend&#10;Button-down collar&#10;Machine washable"></textarea>
                            <small class="text-muted">Enter one detail per line — each line becomes a bullet point on the product page.</small>
                        </div>
                    </div>
                </div>

                {{-- Images --}}
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Images</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="main_image" class="form-label">Main Image <span class="text-danger">*</span></label>
                                <input type="file" id="main_image" name="main_image"
                                    class="form-control" accept="image/*">
                                <small class="text-muted">
                                    Shown in the product grid card and as the first gallery image.
                                    Recommended: portrait ratio (3:4), min 600×800px.
                                </small>
                                <div class="mt-2">
                                    <img id="mainImagePreview" src="" alt="Main image preview" class="d-none rounded"
                                        style="max-height:120px;object-fit:cover;border:1px solid #eee;">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sub_images" class="form-label">Gallery Images</label>
                                <input type="file" id="sub_images" name="sub_images[]"
                                    class="form-control" accept="image/*" multiple>
                                <small class="text-muted">Up to 6 additional images shown as thumbnails in the gallery. Hold Ctrl/Cmd to select multiple files.</small>
                                <div id="subImagePreviews" class="d-flex flex-wrap gap-2 mt-2"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ---- Right column: category, brand, flags ---- --}}
            <div class="col-lg-4">

                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Organisation</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                            <select id="category_id" name="category_id" class="form-select" required>
                                <option value="">Select a category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="brand_id" class="form-label">Brand</label>
                            <select id="brand_id" name="brand_id" class="form-select">
                                <option value="">No brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" id="sort_order" name="sort_order"
                                class="form-control" value="0" min="0">
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Display Options</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="is_active"
                                name="is_active" value="1" checked>
                            <label class="form-check-label" for="is_active">
                                <strong>Active</strong>
                                <small class="d-block text-muted">Visible on the public site</small>
                            </label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="is_featured"
                                name="is_featured" value="1">
                            <label class="form-check-label" for="is_featured">
                                <strong>Featured</strong>
                                <small class="d-block text-muted">Show in the FEATURED section on the homepage</small>
                            </label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_trending"
                                name="is_trending" value="1">
                            <label class="form-check-label" for="is_trending">
                                <strong>Trending</strong>
                                <small class="d-block text-muted">Show in TRENDING NOW on the homepage</small>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary" id="submitBtn">Save Product</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-light">Cancel</a>
                </div>

            </div>
        </div>
    </form>

    <script>
        // Main image preview
        document.getElementById('main_image').addEventListener('change', function () {
            const preview = document.getElementById('mainImagePreview');
            if (this.files[0]) {
                preview.src = URL.createObjectURL(this.files[0]);
                preview.classList.remove('d-none');
            }
        });

        // Sub images preview grid
        document.getElementById('sub_images').addEventListener('change', function () {
            const container = document.getElementById('subImagePreviews');
            container.innerHTML = '';
            Array.from(this.files).forEach(file => {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.style.cssText = 'width:64px;height:80px;object-fit:cover;border-radius:3px;border:1px solid #eee;';
                container.appendChild(img);
            });
        });

        // AJAX submit
        document.getElementById('productForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const form = this;
            const btn = document.getElementById('submitBtn');
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
                    form.reset();
                    document.getElementById('mainImagePreview').classList.add('d-none');
                    document.getElementById('subImagePreviews').innerHTML = '';
                    setTimeout(() => box.innerHTML = '', 3000);
                } else {
                    const errors = Object.values(data.errors ?? {}).flat().join('<br>');
                    box.innerHTML = `<div class="alert alert-danger">${errors || data.message}</div>`;
                    window.scrollTo(0, 0);
                }
            })
            .catch(() => {
                document.getElementById('message').innerHTML =
                    `<div class="alert alert-danger">Something went wrong. Please try again.</div>`;
            })
            .finally(() => { btn.disabled = false; btn.textContent = 'Save Product'; });
        });
    </script>
@endsection
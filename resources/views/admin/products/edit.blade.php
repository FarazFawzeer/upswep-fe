@extends('layouts.vertical', ['subtitle' => 'Edit Product'])

@section('content')
    @include('layouts.partials.page-title', ['title' => 'Products', 'subtitle' => 'Edit'])

    <div id="message"></div>

    <form id="productForm" action="{{ route('admin.products.update', $product->id) }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            {{-- ---- Left column ---- --}}
            <div class="col-lg-8">

                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ $product->name }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="sku" class="form-label">SKU</label>
                                <input type="text" id="sku" name="sku" class="form-control"
                                    value="{{ $product->sku }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Price (LKR)</label>
                                <input type="number" id="price" name="price" class="form-control"
                                    value="{{ $product->price }}" step="0.01" min="0">
                                <small class="text-muted">Leave empty for "Contact for price"</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="details" class="form-label">Product Details</label>
                            <textarea id="details" name="details" class="form-control" rows="5"
                                placeholder="One bullet point per line">{{ is_array($product->details) ? implode("\n", $product->details) : '' }}</textarea>
                            <small class="text-muted">One detail per line — each line becomes a bullet point on the product page.</small>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Images</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="main_image" class="form-label">Main Image</label>
                                <input type="file" id="main_image" name="main_image"
                                    class="form-control" accept="image/*">
                                <small class="text-muted">Leave empty to keep the current main image.</small>

                                <div class="mt-2 d-flex align-items-center gap-3">
                                    @if ($product->main_image)
                                        <div>
                                            <p class="text-muted mb-1" style="font-size:11px;">Current</p>
                                            <img src="{{ img_url($product->main_image) }}"
                                                alt="{{ $product->name }}"
                                                style="height:80px;object-fit:cover;border-radius:3px;border:1px solid #eee;">
                                        </div>
                                    @endif
                                    <img id="mainImagePreview" src="" alt="New main image" class="d-none rounded"
                                        style="height:80px;object-fit:cover;border:1px solid #eee;">
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="sub_images" class="form-label">Gallery Images</label>
                                <input type="file" id="sub_images" name="sub_images[]"
                                    class="form-control" accept="image/*" multiple>
                                <small class="text-muted">Uploading new gallery images replaces all existing ones.</small>

                                {{-- Current sub images --}}
                                @if ($product->sub_images && count($product->sub_images))
                                    <div class="mt-2">
                                        <p class="text-muted mb-1" style="font-size:11px;">Current gallery ({{ count($product->sub_images) }} images)</p>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach ($product->sub_images as $sub)
                                                <img src="{{ img_url($sub) }}" alt="Gallery image"
                                                    style="width:56px;height:70px;object-fit:cover;border-radius:3px;border:1px solid #eee;">
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div id="subImagePreviews" class="d-flex flex-wrap gap-2 mt-2"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ---- Right column ---- --}}
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
                                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="brand_id" class="form-label">Brand</label>
                            <select id="brand_id" name="brand_id" class="form-select">
                                <option value="">No brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" id="sort_order" name="sort_order"
                                class="form-control" value="{{ $product->sort_order }}" min="0">
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
                                name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                <strong>Active</strong>
                                <small class="d-block text-muted">Visible on the public site</small>
                            </label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="is_featured"
                                name="is_featured" value="1" {{ $product->is_featured ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                <strong>Featured</strong>
                                <small class="d-block text-muted">Show in FEATURED section on homepage</small>
                            </label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_trending"
                                name="is_trending" value="1" {{ $product->is_trending ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_trending">
                                <strong>Trending</strong>
                                <small class="d-block text-muted">Show in TRENDING NOW on homepage</small>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary" id="submitBtn">Update Product</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-light">Cancel</a>
                </div>

            </div>
        </div>
    </form>

    <script>
        document.getElementById('main_image').addEventListener('change', function () {
            const preview = document.getElementById('mainImagePreview');
            if (this.files[0]) {
                preview.src = URL.createObjectURL(this.files[0]);
                preview.classList.remove('d-none');
            }
        });

        document.getElementById('sub_images').addEventListener('change', function () {
            const container = document.getElementById('subImagePreviews');
            container.innerHTML = '';
            Array.from(this.files).forEach(file => {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.style.cssText = 'width:56px;height:70px;object-fit:cover;border-radius:3px;border:1px solid #eee;';
                container.appendChild(img);
            });
        });

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
                    setTimeout(() => box.innerHTML = '', 3000);
                    window.scrollTo(0, 0);
                } else {
                    const errors = Object.values(data.errors ?? {}).flat().join('<br>');
                    box.innerHTML = `<div class="alert alert-danger">${errors || data.message}</div>`;
                    window.scrollTo(0, 0);
                }
            })
            .catch(() => {
                document.getElementById('message').innerHTML =
                    `<div class="alert alert-danger">Something went wrong.</div>`;
            })
            .finally(() => { btn.disabled = false; btn.textContent = 'Update Product'; });
        });
    </script>
@endsection
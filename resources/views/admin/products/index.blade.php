@extends('layouts.vertical', ['subtitle' => 'Products'])

@section('content')
    @include('layouts.partials.page-title', ['title' => 'UPSWEP', 'subtitle' => 'Products'])

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">All Products</h5>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
                <i class="bx bx-plus me-1"></i> Add Product
            </a>
        </div>

        <div class="card-body">
            <div id="message"></div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="position-relative">
                        <input type="text" id="productSearchInput" class="form-control ps-4"
                            placeholder="Search by product name..." autocomplete="off">
                        <iconify-icon icon="solar:magnifer-outline"
                            class="position-absolute text-muted"
                            style="left:10px;top:50%;transform:translateY(-50%);"></iconify-icon>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-centered" id="productsTable">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Flags</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr id="product-{{ $product->id }}" class="product-row" data-name="{{ strtolower($product->name) }}">
                                <td>
                                    @if ($product->main_image)
                                        <img src="{{ img_url($product->main_image) }}"
                                            alt="{{ $product->name }}"
                                            style="width:48px;height:60px;object-fit:cover;border-radius:3px;border:1px solid #eee;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                            style="width:48px;height:60px;">
                                            <iconify-icon icon="solar:t-shirt-outline" class="text-muted fs-20"></iconify-icon>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <h6 class="mb-0" style="max-width:220px;white-space:normal;font-size:13px;">
                                            {{ $product->name }}
                                        </h6>
                                        @if($product->sku)
                                            <small class="text-muted">{{ $product->sku }}</small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-soft-primary">
                                        {{ $product->category?->name ?? '—' }}
                                    </span>
                                </td>
                                <td>{{ $product->brand?->name ?? '—' }}</td>
                                <td>
                                    @if ($product->price)
                                        <strong>LKR{{ number_format($product->price, 2) }}</strong>
                                    @else
                                        <span class="text-muted">On request</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-1 flex-wrap">
                                        @if ($product->is_featured)
                                            <span class="badge badge-soft-warning">Featured</span>
                                        @endif
                                        @if ($product->is_trending)
                                            <span class="badge badge-soft-info">Trending</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-soft-{{ $product->is_active ? 'success' : 'danger' }}">
                                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                            class="btn btn-sm btn-outline-secondary">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger delete-product"
                                            data-id="{{ $product->id }}">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    No products yet.
                                    <a href="{{ route('admin.products.create') }}">Add your first product</a>.
                                </td>
                            </tr>
                        @endforelse
                        <tr id="noResultsRow" class="d-none">
                            <td colspan="8" class="text-center text-muted py-4">
                                No products match your search.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-product').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                Swal.fire({
                    title: 'Delete this product?',
                    text: 'All product images will also be permanently deleted.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then(result => {
                    if (!result.isConfirmed) return;
                    fetch(`{{ url('admin/products') }}/${id}`, {
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('product-' + id).remove();
                            Swal.fire('Deleted!', data.message, 'success');
                        } else {
                            Swal.fire('Error!', data.message, 'error');
                        }
                    })
                    .catch(() => Swal.fire('Error!', 'Something went wrong.', 'error'));
                });
            });
        });

        // Live product name filter — filters as you type, no submit needed
        (function () {
            const searchInput = document.getElementById('productSearchInput');
            const rows = document.querySelectorAll('#productsTable .product-row');
            const noResultsRow = document.getElementById('noResultsRow');

            if (!searchInput) return;

            let debounceTimer;

            searchInput.addEventListener('input', function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => filterProducts(this.value), 150);
            });

            function filterProducts(query) {
                const term = query.trim().toLowerCase();
                let visibleCount = 0;

                rows.forEach(row => {
                    const name = row.dataset.name || '';
                    const matches = name.includes(term);
                    row.classList.toggle('d-none', !matches);
                    if (matches) visibleCount++;
                });

                noResultsRow.classList.toggle('d-none', visibleCount !== 0 || term === '');
            }
        })();
    </script>
@endsection
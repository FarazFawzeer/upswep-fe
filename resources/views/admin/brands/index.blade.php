@extends('layouts.vertical', ['subtitle' => 'Brands'])

@section('content')
    @include('layouts.partials.page-title', ['title' => 'Products', 'subtitle' => 'Brands'])

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">All Brands</h5>
            <a href="{{ route('admin.brands.create') }}" class="btn btn-primary btn-sm">
                <i class="bx bx-plus me-1"></i> Add Brand
            </a>
        </div>

        <div class="card-body">
            <div id="message"></div>

            <div class="table-responsive">
                <table class="table table-hover table-centered">
                    <thead class="table-light">
                        <tr>
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $brand)
                            <tr id="brand-{{ $brand->id }}">
                                <td>
                                    @if ($brand->logo)
                                        <img src="{{ img_url($brand->logo) }}"
                                            alt="{{ $brand->name }}"
                                            style="width:40px;height:40px;object-fit:contain;border:1px solid #eee;border-radius:4px;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                            style="width:40px;height:40px;">
                                            <iconify-icon icon="solar:shop-outline" class="text-muted fs-18"></iconify-icon>
                                        </div>
                                    @endif
                                </td>
                                <td><strong>{{ $brand->name }}</strong></td>
                                <td><code class="text-muted">{{ $brand->slug }}</code></td>
                                <td>{{ $brand->sort_order }}</td>
                                <td>
                                    <span class="badge badge-soft-{{ $brand->is_active ? 'success' : 'danger' }}">
                                        {{ $brand->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                            class="btn btn-sm btn-outline-secondary">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger delete-brand"
                                            data-id="{{ $brand->id }}">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No brands found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $brands->links() }}
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-brand').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                Swal.fire({
                    title: 'Delete this brand?',
                    text: 'Products linked to this brand will have their brand removed.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then(result => {
                    if (!result.isConfirmed) return;
                    fetch(`{{ url('admin/brands') }}/${id}`, {
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('brand-' + id).remove();
                            Swal.fire('Deleted!', data.message, 'success');
                        } else {
                            Swal.fire('Error!', data.message, 'error');
                        }
                    })
                    .catch(() => Swal.fire('Error!', 'Something went wrong.', 'error'));
                });
            });
        });
    </script>
@endsection
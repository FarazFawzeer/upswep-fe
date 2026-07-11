@extends('layouts.vertical', ['subtitle' => 'Categories'])

@section('content')
    @include('layouts.partials.page-title', ['title' => 'Products', 'subtitle' => 'Categories'])

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">All Categories</h5>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
                <i class="bx bx-plus me-1"></i> Add Category
            </a>
        </div>

        <div class="card-body">
            <div id="message"></div>

            <div class="table-responsive">
                <table class="table table-hover table-centered">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr id="category-{{ $category->id }}">
                                <td>
                                    @if ($category->image)
                                        <img src="{{ img_url($category->image) }}"
                                            alt="{{ $category->name }}"
                                            class="avatar-sm rounded-circle object-fit-cover"
                                            style="width:40px;height:40px;">
                                    @else
                                        <div class="avatar-sm rounded-circle bg-light d-flex align-items-center justify-content-center"
                                            style="width:40px;height:40px;">
                                            <iconify-icon icon="solar:tag-outline" class="text-muted fs-18"></iconify-icon>
                                        </div>
                                    @endif
                                </td>
                                <td><strong>{{ $category->name }}</strong></td>
                                <td><code class="text-muted">{{ $category->slug }}</code></td>
                                <td>{{ $category->sort_order }}</td>
                                <td>
                                    <span class="badge badge-soft-{{ $category->is_active ? 'success' : 'danger' }}">
                                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                            class="btn btn-sm btn-outline-secondary">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger delete-category"
                                            data-id="{{ $category->id }}">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $categories->links() }}
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-category').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                Swal.fire({
                    title: 'Delete this category?',
                    text: 'Products linked to this category will also be removed.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then(result => {
                    if (!result.isConfirmed) return;

                    fetch(`{{ url('admin/categories') }}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('category-' + id).remove();
                            Swal.fire('Deleted!', data.message, 'success');
                        } else {
                            Swal.fire('Error!', data.message || 'Something went wrong.', 'error');
                        }
                    })
                    .catch(() => Swal.fire('Error!', 'Something went wrong.', 'error'));
                });
            });
        });
    </script>
@endsection
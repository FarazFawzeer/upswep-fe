@extends('layouts.vertical', ['subtitle' => 'Enquiries'])

@section('content')
    @include('layouts.partials.page-title', ['title' => 'UPSWEP', 'subtitle' => 'Enquiries'])

    @if ($newCount > 0)
        <div class="alert alert-warning d-flex align-items-center gap-2">
            <iconify-icon icon="solar:bell-bing-outline" class="fs-20"></iconify-icon>
            <span>You have <strong>{{ $newCount }} new {{ Str::plural('enquiry', $newCount) }}</strong> waiting to be followed up.</span>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">All Enquiries</h5>
            <div class="d-flex gap-2 align-items-center">
                <span class="badge badge-soft-danger">{{ $newCount }} New</span>
            </div>
        </div>

        <div class="card-body">
            <div id="message"></div>

            <div class="table-responsive">
                <table class="table table-hover table-centered">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Contact</th>
                            <th>Product / Subject</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($enquiries as $enquiry)
                            <tr id="enquiry-{{ $enquiry->id }}"
                                class="{{ $enquiry->status === 'new' ? 'table-warning bg-opacity-25' : '' }}">
                                <td style="white-space:nowrap;">
                                    {{ $enquiry->created_at->format('d M Y') }}<br>
                                    <small class="text-muted">{{ $enquiry->created_at->format('h:i A') }}</small>
                                </td>
                                <td>
                                    <strong>{{ $enquiry->name }}</strong>
                                </td>
                                <td>
                                    <a href="tel:{{ $enquiry->phone }}">{{ $enquiry->phone }}</a>
                                    @if ($enquiry->email)
                                        <br><a href="mailto:{{ $enquiry->email }}" class="text-muted" style="font-size:12px;">
                                            {{ $enquiry->email }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @if ($enquiry->product)
                                        <span class="badge badge-soft-primary mb-1">Product</span><br>
                                        <small>{{ Str::limit($enquiry->product->name, 40) }}</small>
                                    @elseif ($enquiry->subject)
                                        <span class="badge badge-soft-secondary mb-1">Contact Form</span><br>
                                        <small>{{ $enquiry->subject }}</small>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td style="max-width:200px;">
                                    @if ($enquiry->message)
                                        <span style="font-size:12px;color:#555;">
                                            {{ Str::limit($enquiry->message, 80) }}
                                        </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- Inline status dropdown — updates via fetch() immediately --}}
                                    <select class="form-select form-select-sm status-select"
                                        data-id="{{ $enquiry->id }}"
                                        style="min-width:110px;">
                                        <option value="new"       {{ $enquiry->status === 'new'       ? 'selected' : '' }}>New</option>
                                        <option value="contacted" {{ $enquiry->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                                        <option value="closed"    {{ $enquiry->status === 'closed'    ? 'selected' : '' }}>Closed</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger delete-enquiry"
                                        data-id="{{ $enquiry->id }}">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No enquiries yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $enquiries->links() }}
            </div>
        </div>
    </div>

    <script>
        // ---- Inline status update ----
        document.querySelectorAll('.status-select').forEach(select => {
            select.addEventListener('change', function () {
                const id     = this.dataset.id;
                const status = this.value;
                const row    = document.getElementById('enquiry-' + id);
                const box    = document.getElementById('message');

                fetch(`{{ url('admin/enquiries') }}/${id}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ status })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        // Update row highlight to match new status
                        row.classList.remove('table-warning');
                        if (status === 'new') row.classList.add('table-warning');

                        box.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                        setTimeout(() => box.innerHTML = '', 2500);
                    } else {
                        box.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                    }
                })
                .catch(() => {
                    box.innerHTML = `<div class="alert alert-danger">Status update failed.</div>`;
                });
            });
        });

        // ---- Delete ----
        document.querySelectorAll('.delete-enquiry').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                Swal.fire({
                    title: 'Delete this enquiry?',
                    text: 'This cannot be undone.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then(result => {
                    if (!result.isConfirmed) return;
                    fetch(`{{ url('admin/enquiries') }}/${id}`, {
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('enquiry-' + id).remove();
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
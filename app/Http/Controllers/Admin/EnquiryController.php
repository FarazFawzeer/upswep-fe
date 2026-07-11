<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    /**
     * List all enquiries — newest first, with product relationship.
     * Shows both product enquiries and contact form submissions in one table.
     * Dealer can filter by status or type via query params if needed later.
     */
    public function index()
    {
        $enquiries = Enquiry::with('product')
            ->orderByRaw("FIELD(status, 'new', 'contacted', 'closed')")  // new ones always first
            ->orderByDesc('created_at')
            ->paginate(20);

        $newCount = Enquiry::pending()->count(); // for the badge in the sidebar

        return view('admin.enquiries.index', compact('enquiries', 'newCount'));
    }

    /**
     * Update enquiry status (new → contacted → closed).
     * Called via fetch() from the status dropdown in the table.
     * Returns JSON — matches your existing admin pattern.
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        $request->validate([
            'status' => 'required|in:new,contacted,closed',
        ]);

        $enquiry->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated to ' . ucfirst($request->status) . '.',
        ]);
    }

    /**
     * Delete enquiry.
     * Returns JSON — called via SweetAlert confirm + fetch() DELETE.
     */
    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();

        return response()->json([
            'success' => true,
            'message' => 'Enquiry deleted.',
        ]);
    }
}
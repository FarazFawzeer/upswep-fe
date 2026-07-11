<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryFEController extends Controller
{
    /**
     * Store a new enquiry from the product detail page form.
     * POST /enquiry
     *
     * Saves to the enquiries table with status = 'new'.
     * Dealer views and follows up from the admin panel.
     * Redirects back to the product page with a session flash message.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'name'       => 'required|string|max:100',
            'phone'      => 'required|string|max:30',
            'email'      => 'nullable|email|max:150',
            'message'    => 'nullable|string|max:1000',
        ]);

        Enquiry::create([
            'product_id' => $validated['product_id'],
            'name'       => $validated['name'],
            'phone'      => $validated['phone'],
            'email'      => $validated['email'] ?? null,
            'message'    => $validated['message'] ?? null,
            'subject'    => null,   // null = product enquiry (not a contact form submission)
            'status'     => 'new',
        ]);

        return redirect()
            ->back()
            ->with('enquiry_success', 'Thank you, ' . $validated['name'] . '! We\'ve received your enquiry and will be in touch shortly.');
    }
}
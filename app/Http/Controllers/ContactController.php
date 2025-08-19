<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;
use App\Mail\ContactFormMail;
use App\Mail\FeedbackMail;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::where('name', '!=', 'All Products')->get();
        return view('contact.index', compact('categories'));
    }

    public function send(Request $request)
    {
        // Check if this is a feedback form submission
        if ($request->has('is_client')) {
            return $this->sendFeedback($request);
        }

        // ✅ Validate contact form fields
        $validated = $request->validate([
            'reason'             => 'required|string',
            'is_under_warranty'  => 'nullable|in:0,1',
            'product_type'       => 'required|string',
            'product_model'      => 'required|string',
            'name'               => 'nullable|string|max:255',
            'phone'              => 'nullable|string|max:20',
            'email'              => 'nullable|email',
            'country'            => 'nullable|string',
            'address'            => 'nullable|string',
            'message'            => 'nullable|string',
            'support_type'       => 'nullable|string',
        ]);

        // ✅ Prepare data for email
        $data = [
            'reason'            => $request->reason,
            'is_under_warranty' => $request->is_under_warranty == '1' ? 'Yes' : 'No',
            'product_type'      => $request->product_type,
            'product_model'     => $request->product_model,
            'name'              => $request->name,
            'phone'             => $request->phone,
            'email'             => $request->email,
            'country'           => $request->country,
            'address'           => $request->address,
            'message'           => $request->message,
            'support_type'      => $request->support_type,
            'form_type'         => $request->reason, // Add form type for email identification
        ];

        // ✅ Send Email
       Mail::to('shoovisual@gmail.com')->send(new ContactFormMail($data));

        return back()->with('success', 'Your message has been sent successfully.');
    }

    public function sendFeedback(Request $request)
    {
        // ✅ Validate feedback form fields
        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'email'              => 'nullable|email',
            'is_client'          => 'required|in:Yes,No',
            'product_model'      => 'nullable|string',
            'message'            => 'nullable|string',
        ]);

        // ✅ Prepare data for feedback email
        $data = [
            'name'              => $request->name,
            'email'             => $request->email,
            'is_client'         => $request->is_client,
            'product_model'     => $request->product_model,
            'message'           => $request->message,
            'form_type'         => 'Feedback Form',
        ];

        // ✅ Send Feedback Email
        Mail::to('shoovisual@gmail.com')->send(new FeedbackMail($data));

        return back()->with('success', 'Your feedback has been sent successfully. Thank you for your input!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReturnReason;
use Illuminate\Http\Request;

class ReturnReasonController extends Controller
{
    public function index()
    {
        $reasons = ReturnReason::orderBy('sort_order')->orderBy('name')->paginate(20);
        return view('admin.return-reasons.index', compact('reasons'));
    }

    public function create()
    {
        return view('admin.return-reasons.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'active' => ['nullable','boolean'],
            'sort_order' => ['nullable','integer','min:0'],
        ]);
        ReturnReason::create([
            'name' => $data['name'],
            'active' => $data['active'] ?? true,
            'sort_order' => $data['sort_order'] ?? 0,
        ]);
        return redirect()->route('admin.return-reasons.index')->with('status','Reason created');
    }

    public function edit(ReturnReason $returnReason)
    {
        return view('admin.return-reasons.edit', ['reason' => $returnReason]);
    }

    public function update(Request $request, ReturnReason $returnReason)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'active' => ['nullable','boolean'],
            'sort_order' => ['nullable','integer','min:0'],
        ]);
        $returnReason->update([
            'name' => $data['name'],
            'active' => $data['active'] ?? true,
            'sort_order' => $data['sort_order'] ?? 0,
        ]);
        return redirect()->route('admin.return-reasons.index')->with('status','Reason updated');
    }

    public function destroy(ReturnReason $returnReason)
    {
        $returnReason->delete();
        return redirect()->route('admin.return-reasons.index')->with('status','Reason deleted');
    }
}
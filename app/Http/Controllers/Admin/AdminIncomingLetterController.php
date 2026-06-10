<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IncomingLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminIncomingLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = IncomingLetter::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('letter_number', 'like', "%{$search}%")
                  ->orWhere('sender', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('letter_type', $request->type);
        }

        $letters = $query->latest()->paginate(10)->withQueryString();

        return view('admin.incoming-letters.index', compact('letters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.incoming-letters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'letter_number' => 'required|string|max:50',
            'letter_date'   => 'required|date',
            'received_date' => 'required|date',
            'sender'        => 'required|string|max:100',
            'letter_type'   => 'required|in:invitation,announcement',
            'subject'       => 'required|string|max:255',
            'file_path'     => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('incoming-letters', 'public');
        }

        $validated['created_by'] = auth()->id();
        $validated['status'] = 'unassigned';

        IncomingLetter::create($validated);

        return redirect()->route('admin.incoming-letters.index')
                         ->with('success', 'Incoming letter created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $letter = IncomingLetter::with(['dispositions.assignedTo', 'createdBy'])->findOrFail($id);
        
        return view('admin.incoming-letters.show', compact('letter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $letter = IncomingLetter::findOrFail($id);
        return view('admin.incoming-letters.edit', compact('letter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $letter = IncomingLetter::findOrFail($id);

        $validated = $request->validate([
            'letter_number' => 'required|string|max:50',
            'letter_date'   => 'required|date',
            'received_date' => 'required|date',
            'sender'        => 'required|string|max:100',
            'letter_type'   => 'required|in:invitation,announcement',
            'subject'       => 'required|string|max:255',
            'file_path'     => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('file_path')) {
            // Optionally delete the old file
            if ($letter->file_path && Storage::disk('public')->exists($letter->file_path)) {
                Storage::disk('public')->delete($letter->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('incoming-letters', 'public');
        }

        $letter->update($validated);

        return redirect()->route('admin.incoming-letters.index')
                         ->with('success', 'Incoming letter updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $letter = IncomingLetter::findOrFail($id);
        
        if ($letter->file_path && Storage::disk('public')->exists($letter->file_path)) {
            Storage::disk('public')->delete($letter->file_path);
        }
        
        $letter->delete();

        return redirect()->route('admin.incoming-letters.index')
                         ->with('success', 'Incoming letter deleted successfully.');
    }

    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(Request $request, string $id)
    {
        $letter = IncomingLetter::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:unassigned,assigned,completed',
        ]);

        $letter->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'Status updated successfully.');
    }
}

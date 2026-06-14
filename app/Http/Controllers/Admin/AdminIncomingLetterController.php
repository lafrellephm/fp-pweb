<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LetterFormRequest;
use App\Http\Requests\UpdateIncomingLetterStatusRequest;
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

        $letters = $query->sortByUrgency()
                         ->orderBy('received_date', 'asc')
                         ->paginate(10)->withQueryString();

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
    public function store(LetterFormRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('incoming-letters', 'public');
        }

        $validated['created_by'] = auth()->id();
        $validated['status'] = 'unassigned';

        IncomingLetter::create($validated);

        return redirect()->route('admin.incoming-letters.index')
                         ->with('success', 'Surat masuk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $letter = IncomingLetter::with(['createdBy'])->findOrFail($id);
        
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
    public function update(LetterFormRequest $request, string $id)
    {
        $letter = IncomingLetter::findOrFail($id);

        $validated = $request->validated();

        if ($request->hasFile('file_path')) {
            // Optionally delete the old file
            if ($letter->file_path && Storage::disk('public')->exists($letter->file_path)) {
                Storage::disk('public')->delete($letter->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('incoming-letters', 'public');
        }

        $letter->update($validated);

        return redirect()->route('admin.incoming-letters.index')
                         ->with('success', 'Surat masuk berhasil diperbarui.');
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
                         ->with('success', 'Surat masuk berhasil dihapus.');
    }

    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(UpdateIncomingLetterStatusRequest $request, string $id)
    {
        $letter = IncomingLetter::findOrFail($id);

        $validated = $request->validated();

        $letter->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'Status surat masuk berhasil diperbarui.');
    }
}


<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LearningMaterial;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LearningMaterialController extends Controller
{
    public function index()
    {
        $materials = LearningMaterial::with('questions', 'attachments')
            ->when(request('type'), function ($query, $type) {
                return $query->byType($type);
            })
            ->when(request('search'), function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->ordered()
            ->paginate(10);

        return view('admin.learning-materials.index', compact('materials'));
    }

    public function create()
    {
        return view('admin.learning-materials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:pendahuluan,materi,latihan,evaluasi',
            'order' => 'required|integer',
            'content' => 'required|string',
            'description' => 'nullable|string',
            'math_symbols' => 'nullable|array',
            'references' => 'nullable|array',
            'is_published' => 'boolean',
            'min_score' => 'required|integer|min:0|max:100',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048'
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $material = LearningMaterial::create($validated);

        // Handle file uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('materials/' . $material->id, 'public');

                $material->attachments()->create([
                    'name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_type' => $this->getFileType($file->getMimeType()),
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType()
                ]);
            }
        }

        return redirect()->route('admin.learning-materials.index')
            ->with('success', 'Learning material created successfully.');
    }

    public function show(LearningMaterial $learningMaterial)
    {
        $learningMaterial->load(['questions.options', 'attachments']);
        return view('admin.learning-materials.show', [
            'material' => $learningMaterial,
        ]);
    }

    public function edit(LearningMaterial $learningMaterial)
    {
        $learningMaterial->load('attachments');
        return view('admin.learning-materials.edit', [
            'material' => $learningMaterial,
        ]);
    }

    public function update(Request $request, LearningMaterial $learningMaterial)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:pendahuluan,materi,latihan,evaluasi',
            'order' => 'required|integer',
            'content' => 'required|string',
            'description' => 'nullable|string',
            'math_symbols' => 'nullable|array',
            'references' => 'nullable|array',
            'is_published' => 'boolean',
            'min_score' => 'required|integer|min:0|max:100',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048'
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $learningMaterial->update($validated);

        // Handle new file uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('materials/' . $learningMaterial->id, 'public');

                $learningMaterial->attachments()->create([
                    'name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_type' => $this->getFileType($file->getMimeType()),
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType()
                ]);
            }
        }

        return redirect()->route('admin.learning-materials.index')
            ->with('success', 'Learning material updated successfully.');
    }

    public function destroy(LearningMaterial $learningMaterial)
    {
        // Delete associated files
        foreach ($learningMaterial->attachments as $attachment) {
            Storage::disk('public')->delete($attachment->file_path);
        }

        $learningMaterial->delete();

        return redirect()->route('admin.learning-materials.index')
            ->with('success', 'Learning material deleted successfully.');
    }

    public function deleteAttachment(Attachment $attachment)
    {
        Storage::disk('public')->delete($attachment->file_path);
        $attachment->delete();

        return back()->with('success', 'Attachment deleted successfully.');
    }

    private function getFileType($mimeType)
    {
        if (str_starts_with($mimeType, 'image/')) {
            return 'image';
        } elseif (in_array($mimeType, [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ])) {
            return 'document';
        }

        return 'other';
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = auth()->user()->assignments()->orderBy('due_date', 'asc')->get();

        $mapped = $assignments->map(function ($a) {
            return [
                'id' => $a->id,
                'subject' => $a->subject,
                'name' => $a->name,
                'dueDate' => $a->due_date,
                'priority' => $a->priority,
                'status' => $a->status,
                'notes' => $a->notes,
            ];
        });

        return response()->json($mapped);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'dueDate' => 'nullable|date',
            'priority' => 'required|string|in:High,Medium,Low',
            'status' => 'nullable|string|in:Pending,Completed',
            'notes' => 'nullable|string',
        ]);

        $assignment = auth()->user()->assignments()->create([
            'subject' => $validated['subject'],
            'name' => $validated['name'],
            'due_date' => $validated['dueDate'] ?? null,
            'priority' => $validated['priority'],
            'status' => $validated['status'] ?? 'Pending',
            'notes' => $validated['notes'] ?? '',
        ]);

        return response()->json([
            'id' => $assignment->id,
            'subject' => $assignment->subject,
            'name' => $assignment->name,
            'dueDate' => $assignment->due_date,
            'priority' => $assignment->priority,
            'status' => $assignment->status,
            'notes' => $assignment->notes,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $assignment = auth()->user()->assignments()->findOrFail($id);

        $validated = $request->validate([
            'subject' => 'sometimes|required|string|max:255',
            'name' => 'sometimes|required|string|max:255',
            'dueDate' => 'nullable|date',
            'priority' => 'sometimes|required|string|in:High,Medium,Low',
            'status' => 'sometimes|required|string|in:Pending,Completed',
            'notes' => 'nullable|string',
        ]);

        $data = [];
        if (isset($validated['subject'])) $data['subject'] = $validated['subject'];
        if (isset($validated['name'])) $data['name'] = $validated['name'];
        if (array_key_exists('dueDate', $validated)) $data['due_date'] = $validated['dueDate'];
        if (isset($validated['priority'])) $data['priority'] = $validated['priority'];
        if (isset($validated['status'])) $data['status'] = $validated['status'];
        if (array_key_exists('notes', $validated)) $data['notes'] = $validated['notes'];

        $assignment->update($data);

        return response()->json([
            'id' => $assignment->id,
            'subject' => $assignment->subject,
            'name' => $assignment->name,
            'dueDate' => $assignment->due_date,
            'priority' => $assignment->priority,
            'status' => $assignment->status,
            'notes' => $assignment->notes,
        ]);
    }

    public function destroy($id)
    {
        $assignment = auth()->user()->assignments()->findOrFail($id);
        $assignment->delete();

        return response()->json(['success' => true]);
    }

    public function clearAll()
    {
        auth()->user()->assignments()->delete();

        return response()->json(['success' => true]);
    }
}

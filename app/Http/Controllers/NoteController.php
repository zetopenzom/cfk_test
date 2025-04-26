<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user_id = $user->id;
        if ($user->role == 'Supervisor') {
            $notes = Note::where('user_id', $user_id)->paginate(5);
        } else {
            $notes = Note::paginate(5);
        }

        // dd($notes);
        return view('notes.index')->with('notes', $notes);
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:120',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $note = new Note([
            'user_id' => Auth::id(),
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]);

        $note->save();

        return to_route('notes.show', $note);
    }

    public function show(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403);
        }

        return view('notes.show', ['note' => $note]);
    }

    public function edit(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403);
        }

        return view('notes.edit', ['note' => $note]);
    }

    public function update(Request $request, Note $note)
    {
        if (Auth::user()->role == 'Supervisor') {
            if ($note->user_id !== Auth::id()) {
                abort(403);
            }

            $request->validate([
                'title' => 'required|max:120',
                'start_time' => 'required',
                'end_time' => 'required',
            ]);

            $note->update([
                'title' => $request->title,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time
            ]);

            return to_route('notes.index', $note)->with('success', 'Perubahan disimpan');
        } else {
            $d = date("Y-m-d H:i:s");

            $note->update([
                'status' => $request->status,
                'updated_at' => $d
            ]);

            if ($request->status == 1) {
                $alert = $note->title . ' disetujui';
            } else {
                $alert = $note->title . ' ditolak';
            }

            return to_route('notes.index', $note)->with('success', $alert);
        }
    }

    public function destroy(Note $note)
    {
        // dd($note);

        if ($note->user_id !== Auth::id()) {
            abort(403);
        }

        $note->delete();

        return to_route('notes.index')->with('success', 'Note deleted');
    }
}

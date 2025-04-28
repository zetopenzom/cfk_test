<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
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

        $unix = strtotime($request->end_time) - strtotime($request->start_time);

        if ($unix > 0) {
            $note->save();
            return to_route('notes.index', $note);
        } else {
            return to_route('notes.create')->with('fail', 'Waktu Akhir Lembur tidak boleh sama/kurang dari Mulai Waktu Lembur');
        }
    }

    public function show(Note $note)
    {
        $spv_id = $note->user_id;
        $spv = User::where('id', $spv_id)->get();
        $manajer_id = $note->approval_id;
        $manajer = User::where('id', $manajer_id)->get();

        if (count($manajer) == 0) {
            $manajer = "-";
        } else {
            $manajer = $manajer[0]->name;
        }

        if (count($spv) > 0) {
            $spv = $spv[0]->name;
            return view('notes.show', ['note' => $note, 'spv' => $spv, 'manajer' => $manajer]);
        } else {
            abort(403);
        }
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
            $date = date("Y-m-d H:i:s");
            $status = $request->status;
            $id = Auth::id();

            if ($status == 1) {
                $alert = $note->title . ' disetujui';
            } elseif ($status == 2) {
                $alert = $note->title . ' ditolak';
            } else {
                $alert = $note->title . ' dibatalkan persetujuannya';
                $id = 0;
            }

            $note->update([
                'status' => $status,
                'approval_id' => $id,
                'updated_at' => $date
            ]);

            return to_route('notes.index', $note)->with('success', $alert);
        }
    }

    public function destroy(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403);
        }

        $note->delete();

        return to_route('notes.index')->with('success', 'Note deleted');
    }

    public function print(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403);
        }

        return view('notes.edit', ['note' => $note]);
    }
}

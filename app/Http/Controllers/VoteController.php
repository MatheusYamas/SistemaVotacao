<?php

namespace App\Http\Controllers;
use App\Models\Poll;
use App\Models\Option;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(Request $request, Poll $poll)
    {
        if (!$poll->isRunning()) {
            return back()->with('error', 'Esta enquete está fora do período de votação.');
        }

        $validated = $request->validate([
            'option_id' => 'required|exists:options,id,poll_id,' . $poll->id,
        ]);

        $option = Option::findOrFail($validated['option_id']);
        $option->increment('votes');
        session()->put('voted_poll_' . $poll->id, true);

        return redirect()->route('polls.show', $poll)->with('success', 'Voto registrado com sucesso!');
    }
}

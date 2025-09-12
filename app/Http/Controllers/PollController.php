<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $polls = poll::latest()->get();
        return view('polls.index', compact('polls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('polls.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'options' => 'required|array|min:3',
            'options.*' => 'required|string|max:255',
            'data_inicio' => 'nullable|date',
            'data_termino' => 'nullable|date|after_or_equal:data_inicio',
        ]);

        $poll = Poll::create([
            'title' => $validated['title'],
            'data_inicio' => $validated['data_inicio'],
            'data_termino' => $validated['data_termino'],
        ]);

        foreach ($validated['options'] as $optionName){
            if (!empty($optionName)){
                $poll->options()->create(['name' => $optionName]);
            }
        }

        return redirect()->route('polls.index')->with('sucess', 'Enquete criada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Poll $poll)
    {
        $poll->load('options');
        return view('polls.show', compact('poll'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poll $poll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poll $poll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poll $poll)
    {
        //
    }
}

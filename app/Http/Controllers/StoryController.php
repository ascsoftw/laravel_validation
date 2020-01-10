<?php

namespace App\Http\Controllers;

use App\Story;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\StoryRequest;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $stories = Story::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('story.index', [
            'stories' => $stories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $story = new Story;
        return view('story.create', [
            'story' => $story,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store( StoryRequest $request)
    {
        //
        auth()->user()->stories()->create( $request->all() );

        return redirect()->route('stories.index')->with('status', 'Story created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        //
        $this->authorize('update', $story);
        return view('story.edit', [
            'story' => $story
        ]);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(StoryRequest $request, Story $story)
    {
        //
        $this->authorize('update', $story);
        $story->update( $request->all() );        
        return redirect()->route('stories.index')->with('status', 'Story updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        //
    }
}

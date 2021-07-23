<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Exception;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    //
    public function show(Story $story) {
        return response()->json($story,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $stories = Story::where('title','like',"%$request->key%")
            ->orWhere('author','like',"%$request->key%")->get();

        return response()->json($stories, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'string|required',
            'author' => 'string|required',
            'description' => 'string|required',
            'genre' => 'string|required',
            'acquired_on' => 'date|required',
        ]);

        try {
            $story = Story::create($request->all());
            return response()->json($story, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Story $story) {
        try {
            $story->update($request->all());
            return response()->json($story, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Story $story) {
        $story->delete();
        return response()->json(['message'=>'Story deleted.'],202);
    }

    public function index() {
        $stories = Story::orderBy('title')->get();
        return response()->json($stories, 200);
    }
}

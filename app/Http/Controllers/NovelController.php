<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use Exception;
use Illuminate\Http\Request;

class NovelController extends Controller
{
    //
    public function show(Novel $novel) {
        return response()->json($novel,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $novels = Novel::where('title','like',"%$request->key%")
            ->orWhere('author','like',"%$request->key%")->get();

        return response()->json($novels, 200);
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
            $novel = Novel::create($request->all());
            return response()->json($novel, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Novel $novel) {
        try {
            $novel->update($request->all());
            return response()->json($novel, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Novel $novel) {
        $novel->delete();
        return response()->json(['message'=>'Story deleted.'],202);
    }

    public function index() {
        $novels = Novel::orderBy('title')->get();
        return response()->json($novels, 200);
    }
}

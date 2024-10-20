<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Comic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $chapter = Chapter::create([
                'title' => $request->title,
                'book_id' => $request->book_id,
                'slug' => Str::slug($request->title),
                'image' => $request->image,
            ]);
            return response()->json([
                'message' => 'Chapter created successfully',
                'chapter' => $chapter,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create chapter',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comic $comic, Chapter $chapter)
    {

        $pages = $chapter->pages;
        return view('comic.chapter.show', compact('comic', 'chapter', 'pages'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chapter $chapter)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chapter $chapter)
    {
        try {
            $chapter->update([
                'title' => $request->title,
                'book_id' => $request->book_id,
                'slug' => Str::slug($request->title),
                'image' => $request->image
            ]);
            return response()->json([
                'message' => 'Chapter updated successfully',
                'chapter' => $chapter,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update chapter',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chapter $chapter)
    {
        try {
            $chapter->delete();
            return response()->json([
                'message' => 'Chapter deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete chapter',
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}

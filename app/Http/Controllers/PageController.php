<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Comic;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $page = Page::create([
                'chapter_id' => $request->chapter_id,
                'image' => $request->image,
                'number' => $request->number,
            ]);
            return response()->json([
                'message' => 'Page created successfully',
                'page' => $page,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create page',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        try {
            $page->update([
                'chapter_id' => $request->chapter_id,
                'image' => $request->image,
                'number' => $request->number,
            ]);
            return response()->json([
                'message' => 'Page updated successfully',
                'page' => $page,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update page',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        try {
            $page->delete();
            return response()->json([
                'message' => 'Page deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete page',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Set page image to local storage.
     */
    public function setImage(Comic $comic, Chapter $chapter, $page_id){
        try {

            $page = Page::find($page_id);
            //remove /n from image url
            $page->image = str_replace("\n", '', $page->image);
            $page->addMediaFromUrl($page->image)->toMediaCollection('pages');

            return response()->json([
                'message' => 'Image uploaded successfully',
                'page' => $page,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to upload image',
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}

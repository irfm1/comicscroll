<?php

namespace App\Http\Controllers;

use App\Models\Comic;

use Illuminate\Http\Request;

class ComicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return response()->json(Comic::all());

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
            Comic::create([
                'user_id' => $request->user_id,
                'title' => $request->title,
                'alt' => $request->alt,
                'description' => $request->description,
                'author' => "some author",
                'publisher' => "some publisher",
                'genre' => "implement later",
                'type' => $request->type,
                'status' => $request->status,
                'image' => $request->image,
                'url' => $request->url
            ]);


            return response()->json(['message' => 'Comic cadastrado com sucesso']);
        } catch (\Exception $e) {
            // response with code 500
            return response()->json(['message' => 'Erro ao cadastrar comic'])->setStatusCode(500);
        }



    }

    /**
     * Display the specified resource.
     */
    public function show(Comic $comic)
    {
        return view('comic.show', [
            'comic' => $comic
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comic $comic)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comic $comic)
    {
        try {
            $comic->update([
                'title' => $request->title,
                'author' => $request->author,
                'year' => $request->year,
                'review' => $request->review,
                'cover' => $request->cover
            ]);
            return redirect()->route('comics.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar comic');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comic $comic)
    {
        //delete on cascade
        try {
            $comic->delete();
            return redirect()->route('comics.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao deletar comic');
        }
    }
}

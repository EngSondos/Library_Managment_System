<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAuthorRequest;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
         $authors = Author::all();
         return response()->json($authors);
     }

    /**
     * Store a newly created resource in storage.
     */

     public function store(StoreAuthorRequest $request)
     {
     $author = Author::create($request->all());
     return response()->json($author, 201);
     }


    /**
     * Display the specified resource.
     */

     public function show($id)
     {
     $author = Author::find($id);
     if ($author) {
     return response()->json($author);
     } else {
     return response()->json(['message' => 'Author not found.'], 404);
     }
     }



    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */

}

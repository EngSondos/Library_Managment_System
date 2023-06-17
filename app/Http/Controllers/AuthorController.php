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



    /**
     * Display the specified resource.
     */



    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */

}

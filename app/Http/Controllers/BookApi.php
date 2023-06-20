<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Models\author;
use App\Models\book;
use App\Models\category;
use Illuminate\Support\Facades\Storage;

class BookApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $books=book::with(['author','category'])->get();

        return json_decode($books->sortByDesc('author'));

    }





    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        //
        $image= $request->file('image');
        $imageName=$image->getClientOriginalName();
         $image->storeAs('public/images',$imageName);

        $book=new book();
        $book->title=$request->name;
        $book->image=$imageName;
        $book->description=$request->description;
        $book->category_id=$request->category;
        $book->author_id=$request->author;
        $book->save();

        return json_decode($book);


    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        if(!isset($request->name)){

            $books=book::with(['author','category'])
            ->get();
            $books->sortBy(($request->order?:'title'));
            //order with request body
            return json_decode($books->sortBy(($request->order?:'title')));
        }
        else{

            switch ($request->select) {


                case 'author':
                    //dd($request->name);

                    $query=$request->name;
                    $books = book::query()
                    ->join('authors', 'books.author_id', '=', 'authors.id')
                    ->where('authors.name', 'LIKE', "%{$query}%")
                    //->get();
                    ->get(['books.*']);

                    return json_decode($books->sortBy(($request->order?:'title')));

                    break;

                case 'category':

                    $query=$request->name;
                    $books = book::query()
                    ->join('categories', 'books.category_id', '=', 'categories.id')
                    ->where('categories.name', 'LIKE', "%{$query}%")
                    ->get(['books.*']);

                    return json_decode($books->sortBy(($request->order?:'title')));

                    break;

                default:

                $books=book::where('title','LIKE',"%{$request->name}%")->get();

                  return json_decode($books->sortBy(($request->order?:'title')));


                    break;
            }
        }

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, Request $request)
    {
// dd($request->file('image'));
        $book = book::findOrFail($id);
        $oldBook = new book($request->all());




        if($request->file('image')){
            Storage::disk('public')->delete('images/'.$book->image);
            $image= $request->file('image');
            $imageName=$image->getClientOriginalName();
             $image->storeAs('public/images',$imageName);
             $book->image=$imageName;
        }



        $book->title=$request->name;

        $book->description=$request->description;
        $book->category_id=$request->category;
        $book->author_id=$request->author;
        $book->save();

        return json_decode($book);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $book=book::findOrFail($id);
        $book->delete();
        return 'data is deleted';

    }
}

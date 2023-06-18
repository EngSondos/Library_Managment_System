<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Models\author;
use App\Models\book;
use App\Models\category;


class BookApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $books=book::with(['author','category'])->get();

        return json_decode($books);

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
        $book->name=$request->name;
        $book->image=$imageName;
        $book->description=$request->description;
        $book->category=$request->category;
        $book->author=$request->author;
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

            $books=book::with(['author','category'])->get();

            return json_decode($books);
        }
        else{

            switch ($request->select) {

                case 'author':
                    $query=$request->name;
                    $books = book::query()
                    ->join('authors', 'books.author', '=', 'authors.id')
                    ->where('authors.name', 'LIKE', "%{$query}%")
                    ->get(['books.*']);
            
                    return json_decode($books);
                    
                    break;

                case 'category':

                    $query=$request->name;
                    $books = book::query()
                    ->join('categories', 'books.category', '=', 'categories.id')
                    ->where('categories.name', 'LIKE', "%{$query}%")
                    ->get(['books.*']);
            
                    return json_decode($books);

                    break;
                
                default:

                $books=book::where('name','LIKE',"%{$request->name}%")->get();

                  return json_decode($books);
             
                  
                    break;
            }
        }

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, string $id)
    {
        $book = book::findOrFail($id);

        $filePath = public_path('storage/images/'.$book->image);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $image= $request->file('image');
        $imageName=$image->getClientOriginalName();
         $image->storeAs('public/images',$imageName);

     
        $book->name=$request->name;
        $book->image=$imageName;
        $book->description=$request->description;
        $book->category=$request->category;
        $book->author=$request->author;
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

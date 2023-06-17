<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\author;
use App\Models\book;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $books=book::with(['author','category'])->get();

        return view('./Books/View',compact('books'));

    }


    // show books insude home page .....

    public function showbooks(){
        $books=book::with(['author','category'])->get();

        return view('home',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
            $authors=author::all();
            $category=category::all();
         return view('Books.Add',compact('authors','category'));
       
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

        return redirect()->route('ViewBooks');


    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        if(!isset($request->name)){
            return redirect()->route('ViewBooks');
        }
        else{

            switch ($request->select) {

                case 'author':
                    $query=$request->name;
                    $books = book::query()
                    ->join('authors', 'books.author', '=', 'authors.id')
                    ->where('authors.name', 'LIKE', "%{$query}%")
                    ->get(['books.*']);
            
                    return view('Books.View', compact('books'));
                    
                    break;

                case 'category':

                    $query=$request->name;
                    $books = book::query()
                    ->join('categories', 'books.category', '=', 'categories.id')
                    ->where('categories.name', 'LIKE', "%{$query}%")
                    ->get(['books.*']);
            
                    return view('Books.View', compact('books'));

                    break;
                
                default:

                $books=book::where('name','LIKE',"%{$request->name}%")->get();

                 return view('./Books/View',compact('books'));

                //  return redirect()->back()->compact('books');
                  
                    break;
            }
        }

    }


    // search for homepage .......................>

    public function showhome(Request $request){

        if(!isset($request->name)){
            return redirect()->route('main');
        }
        else{

            switch ($request->select) {

                case 'author':
                    $query=$request->name;
                    $books = book::query()
                    ->join('authors', 'books.author', '=', 'authors.id')
                    ->where('authors.name', 'LIKE', "%{$query}%")
                    ->get(['books.*']);
            
                    return view('home', compact('books'));
                    
                    break;

                case 'category':

                    $query=$request->name;
                    $books = book::query()
                    ->join('categories', 'books.category', '=', 'categories.id')
                    ->where('categories.name', 'LIKE', "%{$query}%")
                    ->get(['books.*']);
            
                    return view('home', compact('books'));

                    break;
                
                default:

                $books=book::where('name','LIKE',"%{$request->name}%")->get();

                 return view('home',compact('books'));

                //  return redirect()->back()->compact('books');
                  
                    break;
            }
        }

    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $authors=author::all();
        $category=category::all();
        $book=book::where('id',$id)->with(['author','category'])->get();

        return view('Books.Edit',compact('book','category','authors'));

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

        return redirect()->route('ViewBooks');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $book=book::findOrFail($id);
        $book->delete();
        return redirect()->back();

    }
}

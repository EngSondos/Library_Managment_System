<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
// list all categories
    public function index()
    {
        $data = [];
        $categories = Category::all();
        foreach ($categories as $category) {
            $num_books = $category->books()->count();
            $data[] = [
                'name' => $category->name,
                'description' => $category->description,

                'num_books' => $num_books
            ];
        }

        return response()->json($data);

    }

//save data in DB
    public function store(StoreCategoryRequest $request)
    {
        $validateData = $request->validate([
    ]);
        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        $num_books = $category->books()->count();
        return response()->json([
            'name' => $category->name,
            'description' => $category->description,
            'num_books' => $num_books
        ]);

    }

// show a specific category by ID
    public function show($id)
    {
        $category=Category::find($id);
        if ($category) {
            $num_books = $category->books()->count();

            return response()->json([
                'name' => $category->name,
                'description' => $category->description,
                'num_books' => $num_books
            ]);
        } else {
            return response()->json(['message' => 'categoey not found.'], 404);
        }

    }

// show update the specific category
    public function update(Request $request, $id)
    {
        $category=Category::find($id);
        $category->fill($request->post())->save();
        $num_books = $category->books()->count();
        return response()->json(
            [
            'name' => $category->name,
            'description' => $category->description,
            'num_books' => $num_books
        ]);
    }

// delete specific category
    public function destroy($id)
    {
        $category=Category::find($id);
        $category->delete();
        return response()->json("Deleted successfully");
    }


}

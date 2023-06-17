<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
// list all categories
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

//save data in DB
    public function store(Request $request)
    {
        $validateData = $request->validate([
        'name' => 'required|unique:categories|max:255',
        'description'=>'required|max:255'
    ]);
        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return response()->json($category);

    }

// show a specific category by ID
    public function show($id)
    {
        $category=Category::find($id);
        return response()->json($category);
    }

// show update the specific category
    public function update(Request $request, $id)
    {
        $category=Category::find($id);
        $category->fill($request->post())->save();
        return response()->json($category);
    }

// delete specific category
    public function destroy($id)
    {
        $category=Category::find($id);
        $category->delete();
        return response()->json("Deleted successfully");
    }


}

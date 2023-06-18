<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
// list all categories
    public function index()
    {
        $categories = Category::all();
        $categories->makeHidden('created_at');
        $categories->makeHidden('updated_at');
        $categories->makeHidden('deleted_at');
        $categories->makeHidden('id');
        return response()->json($categories);
    }

//save data in DB
    public function store(StoreCategoryRequest $request)
    {
        $validateData = $request->validate([
        // 'name' => 'required|unique:categories|max:255',
        // 'description'=>'required|max:255'
    ]);
        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        $category->makeHidden('created_at');
        $category->makeHidden('updated_at');
        $category->makeHidden('deleted_at');
        $category->makeHidden('id');
        return response()->json($category);

    }

// show a specific category by ID
    public function show($id)
    {
        $category=Category::find($id);
        $category->makeHidden('created_at');
        $category->makeHidden('updated_at');
        $category->makeHidden('deleted_at');
        $category->makeHidden('id');
        return response()->json($category);
    }

// show update the specific category
    public function update(Request $request, $id)
    {
        $category=Category::find($id);
        $category->fill($request->post())->save();
        $category->makeHidden('id');
        $category->makeHidden('created_at');
        $category->makeHidden('updated_at');
        $category->makeHidden('deleted_at');
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

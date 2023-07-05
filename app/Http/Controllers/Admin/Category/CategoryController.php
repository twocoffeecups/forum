<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Resources\Admin\CategoryResourse;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(){
        $categories = CategoryResourse::collection(Category::all());
        return response()->json(['categories' => $categories]);
    }

    public function store(CategoryRequest $request){
        $data = $request->validated();
        $category = Category::firstOrCreate($data);
        return response()->json(['message' => 'Category created!']);
    }

    public function show(Category $category){
        return response()->json(['category' => new CategoryResourse($category)]);
    }

    public function update(CategoryRequest $request, Category $category){
        $data = $request->validated();
        //dd($data);
        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->parentId = $data['parentId'];
        $category->save();
        return response()->json(['message' => 'Category Updated!']);
    }

    public function delete(Category $category){
        $category->delete();
        $category->save();
        return response()->json(['message' => 'Category deleted successfully!']);
    }
}

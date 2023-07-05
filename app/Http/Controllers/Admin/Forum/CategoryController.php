<?php

namespace App\Http\Controllers\Admin\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Resources\Admin\Forum\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(){
        $categories = CategoryResource::collection(Category::all());
        return response()->json(['categories' => $categories]);
    }

    public function store(CategoryRequest $request){
        $data = $request->validated();
        $category = Category::firstOrCreate($data);
        return response()->json(['message' => 'Category created!']);
    }

    public function show(Category $category){
        return response()->json(['category' => new CategoryResource($category)]);
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
        return response()->json(['message' => 'Category deleted successfully!']);
    }
}

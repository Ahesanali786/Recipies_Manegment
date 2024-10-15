<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function showCategory()
    {
        $categories = Category::all();
        return view('category-list', compact('categories'));
    }

    public function addcategory(Request $request)
    {
        $existcategory = Category::where('name', $request->name)->first();
        if ($existcategory) {
            return redirect('category-add')->with('error', 'Category already exists.');
        }

        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect('category-list')->with('success', 'Category added successfully.');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('category-edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $category = Category::find($id);
            $category->name = $request->name;
            $category->save();
            return redirect('category-list')->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            dd($e);
            return redirect('category-edit')->with('error', 'Failed to update category.');
        }
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('category-list')->with('success', 'Category deleted successfully.');
    }


}

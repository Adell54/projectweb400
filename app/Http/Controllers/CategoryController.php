<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        
        foreach ($categories as $category) {
            if ($category->image) {
                $category->image = base64_encode($category->image);
            }
        }
        
        return view('categories', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.addcategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image',
            'description' => 'nullable|string',
            'enabled' => 'required|boolean',
        ]);

        $category = new Category;
        $category->name = $request->name;
        if ($request->hasFile('image')) {
            $category->image = file_get_contents($request->file('image')->getRealPath());
        }
        $category->description = $request->description;
        $category->enabled = $request->enabled;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        if ($category->image) {
            $category->image = base64_encode($category->image);
        }

        return view('categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image',
            'description' => 'nullable|string',
            'enabled' => 'required|boolean',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        if ($request->hasFile('image')) {
            $category->image = file_get_contents($request->file('image')->getRealPath());
        }
        $category->description = $request->description;
        $category->enabled = $request->enabled;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}

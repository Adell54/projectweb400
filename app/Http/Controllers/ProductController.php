<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Product::query();

    // Handle search
    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Handle category filter
    if ($request->has('category')) {
        $query->where('category_id', $request->category);
    }

    // Paginate results
    $products = $query->paginate(9);
    $categories = Category::select('id', 'name')->get();
    $categoryMap = $categories->pluck('name', 'id');

    return view('products', [
        'products' => $products,
        'categoryMap' => $categoryMap,
        'categories' => $categories,
    ]);
}


public function adminview()
{
    $products = Product::paginate(10);
    $categories = Category::select('id', 'name')->get();
    $categoryMap = $categories->pluck('name', 'id');
     
    foreach ($products as $product) {
        if ($product->image) {
            $product->image = base64_encode($product->image);
        }
    }

    return view('admin.products', ['products' => $products, 'categoryMap' => $categoryMap, 'totalProducts' => Product::count()]);
}







    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id','name')->get();
        

        return view('admin.products.addproduct',['categories'=>$categories]);
    }

   







 /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'category' => 'required|integer|exists:categories,id',
            'description' => 'required|string',
            'enabled' => 'required|boolean',
        ]);
    
        $product = new Product();
    
        $product->name = $request->name;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $product->image = base64_encode(file_get_contents($image->getRealPath()));
        }
    
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->description = $request->description;
        $product->enabled = $request->enabled;
        $product->save();
    
        return redirect()->route('admin.products')->with('success', 'Product added successfully!');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

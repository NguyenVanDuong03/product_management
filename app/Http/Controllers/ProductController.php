<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderByDesc('id')->paginate(10);

        return view('dashboard', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'supplier_email' => 'required|email',
            'stock' => 'required|numeric',
        ],
        [
            'name.required' => 'The name field is required.',
            'price.required' => 'The price field is required.',
            'description.required' => 'The description field is required.',
            'supplier_email.required' => 'The supplier email field is required.',
            'stock.required' => 'The stock field is required.',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->supplier_email = $request->supplier_email;

        if($request->hasFile('image')) {
            $product->image = $request->file('image')->store('images', 'public');
        }

        $product->save();

        $notification = [
            'message' => 'Create successfully Done',
            'alert-type' => 'success'
        ];

        return redirect()->route('dashboard')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'supplier_email' => 'required|email',
            'stock' => 'required|numeric',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->supplier_email = $request->supplier_email;

        if($request->hasFile('image')) {
            $product->image = $request->file('image')->store('images', 'public');
        }

        $product->update();

        $notification = [
            'message' => 'Edit successfully Done',
            'alert-type' => 'success'
        ];

        return redirect()->route('dashboard')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        $notification = [
            'message' => 'Delete successfully Done',
            'alert-type' => 'success'
        ];

        return redirect()->route('dashboard')->with($notification);
    }
}

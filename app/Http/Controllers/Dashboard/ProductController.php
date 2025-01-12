<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(public ProductService $productService)
    {}
    public function index()
    {
        $data = $this->productService->index();
        return view('admin.product.index', compact('data'));
    }

    public function trash()
    {
        $data = $this->productService->trash();
        return view('admin.product.trash', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $this->productService->store($data);

        return redirect()->route('product.index')->with('success', 'Created Successelly');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->productService->show($id);
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->productService->show($id);
        $categories = $this->productService->index();

        return view('admin.product.update', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->productService->update($id, $data = $request->all());

        return redirect()->route('product.index')->with('success', 'Updated Successelly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productService->destroy($id);

        return redirect()->route('product.index')->with('success', 'Deleted Successelly');

    }

    public function restore(string $id)
    {
        $this->productService->restore($id);

        return redirect()->route('product.index')->with('success', 'Restore Successelly');

    }

    public function forceDelete(string $id)
    {
        $this->productService->forceDelete($id);
        return redirect()->route('product.index')->with('success', 'Force Deleted Successelly');

    }
}

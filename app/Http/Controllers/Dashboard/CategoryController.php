<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(public CategoryService $CategoryService)
    {}
    public function index()
    {
        $data = $this->CategoryService->index();
        return view('admin.category.index', compact('data'));
    }

    public function trash()
    {
        $data = $this->CategoryService->trash();
        return view('admin.category.trash', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->CategoryService->index();
        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name);

        $this->CategoryService->store($data);

        return redirect()->route('category.index')->with('success', 'Created Successelly');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = $this->CategoryService->show($id);
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->CategoryService->show($id);
        $categories = $this->CategoryService->index();

        return view('admin.category.update', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $this->CategoryService->update($id, $request->validated());

        return redirect()->route('category.index')->with('success', 'Updated Successelly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->CategoryService->destroy($id);

        return redirect()->route('category.index')->with('success', 'Deleted Successelly');

    }

    public function restore(string $id)
    {
        $this->CategoryService->restore($id);

        return redirect()->route('category.index')->with('success', 'Restore Successelly');

    }

    public function forceDelete(string $id)
    {
        $this->CategoryService->forceDelete($id);
        return redirect()->route('category.index')->with('success', 'Force Deleted Successelly');

    }
}

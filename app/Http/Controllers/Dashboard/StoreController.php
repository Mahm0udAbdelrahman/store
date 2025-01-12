<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\StoreService;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(public StoreService $storeService)
    {}
    public function index()
    {
        $data = $this->storeService->index();
        return view('admin.store.index', compact('data'));
    }
 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->storeService->index();
        return view('admin.store.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $this->storeService->store($data);

        return redirect()->route('store.index')->with('success', 'Created Successelly');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $store = $this->storeService->show($id);
        return view('admin.store.show', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $store = $this->storeService->show($id);
        $categories = $this->storeService->index();

        return view('admin.store.update', compact('store', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->storeService->update($id, $request->all());

        return redirect()->route('store.index')->with('success', 'Updated Successelly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->storeService->destroy($id);

        return redirect()->route('store.index')->with('success', 'Deleted Successelly');

    }


}

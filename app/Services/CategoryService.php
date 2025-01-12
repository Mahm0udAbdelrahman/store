<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    public function __construct(public Category $category)
    {}
    public function index()
    {
        // $query = $this->category->query()
        //     ->when(request('name'), fn($q, $name) => $q->where('name', 'LIKE', "%{$name}%"))
        //     ->when(request('status'), fn($q, $status) => $q->where('status', $status));

        // return $query->paginate(1);

        if (request()->has('with_trashed')) {
             return $this->category->withTrashed();
        }
        return $this->category->filter(request()->query())->paginate();
    }
    public function trash()
    {
        return $this->category->onlyTrashed()->filter(request()->query())->paginate();
    }

    public function store(array $data)
    {
        if (isset($data['image'])) {
            $path = $data['image']->store('uploads\categories', 'public');
            $data['image'] = $path;
        }

        return $this->category->create($data);
    }

    public function show(string $id)
    {
        return $this->category->findOrFail($id);
    }

    public function update(string $id, array $data)
    {

        $category = $this->show($id);

        if (isset($data['image'])) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $path = $data['image']->store('uploads\categories', 'public');
            $data['image'] = $path;
        }

        return $category->update($data);
    }

    public function destroy($id)
    {

        $category = $this->show($id);
        $category->delete();
    }

    public function restore($id)
    {

        $category = $this->category->withTrashed()->findOrFail($id);
        $category->restore();
    }

    public function forceDelete($id)
    {

        $category = $this->category->withTrashed()->findOrFail($id);
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->forceDelete();
    }

}

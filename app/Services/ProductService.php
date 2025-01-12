<?php

namespace App\Services;


use App\Models\Tag;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function __construct(public Product $product)
    {}
    public function index()
    {
        if (request()->has('with_trashed')) {
             return $this->product->withTrashed();
        }
        return $this->product->filter(request()->query())->paginate();
    }
    public function trash()
    {
        return $this->product->onlyTrashed()->filter(request()->query())->paginate();
    }

    public function store(array $data)
{
    if (isset($data['image'])) {
        $path = $data['image']->store('uploads/categories', 'public');
        $data['image'] = $path;
    }

    $product = $this->product->create($data);

    if (isset($data['tags'])) {
        $tagsData = json_decode($data['tags'], true);
        $tagIds = [];

        foreach ($tagsData as $tagData) {

            $tag = Tag::updateOrCreate(
                ['name' => $tagData['value']],
                ['slug' => Str::slug($tagData['value'])]
            );
            $tagIds[] = $tag->id;
        }

        $product->tags()->sync($tagIds);
    }

    return $product;
}



    public function show(string $id)
    {
        return $this->product->findOrFail($id);
    }

    public function update(string $id, array $data)
    {

        $product = $this->show($id);

        if (isset($data['image'])) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $path = $data['image']->store('uploads\categories', 'public');
            $data['image'] = $path;
        }
        $product->update($data);

        if (isset($data['tags'])) {
            $tagsData = json_decode($data['tags'], true);
            $tagIds = [];

            foreach ($tagsData as $tagData) {

                $tag = Tag::updateOrCreate(
                    ['name' => $tagData['value']],
                    ['slug' => Str::slug($tagData['value'])]
                );
                $tagIds[] = $tag->id;
            }

            $product->tags()->sync($tagIds);
        }

        return $product;
    }

    public function destroy($id)
    {

        $product = $this->show($id);
        $product->delete();
    }

    public function restore($id)
    {

        $product = $this->product->withTrashed()->findOrFail($id);
        $product->restore();
    }

    public function forceDelete($id)
    {

        $product = $this->product->withTrashed()->findOrFail($id);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->forceDelete();
    }

}

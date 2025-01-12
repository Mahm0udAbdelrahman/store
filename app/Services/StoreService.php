<?php

namespace App\Services;


use App\Models\Store;
use Illuminate\Support\Facades\Storage;

class StoreService
{
    public function __construct(public Store $store)
    {}
    public function index()
    {

        return $this->store->paginate();
    }


    public function store(array $data)
    {
        if (isset($data['logo_image'])) {
            $path = $data['logo_image']->store('uploads\stores', 'public');
            $data['logo_image'] = $path;
        }

        return $this->store->create($data);
    }

    public function show(string $id)
    {
        return $this->store->findOrFail($id);
    }

    public function update(string $id, array $data)
    {

        $store = $this->show($id);

        if (isset($data['logo_image'])) {
            if ($store->logo_image) {
                Storage::disk('public')->delete($store->logo_image);
            }

            $path = $data['logo_image']->store('uploads\stores', 'public');
            $data['logo_image'] = $path;
        }

        return $store->update($data);
    }

    public function destroy($id)
    {

        $store = $this->show($id);
        $store->delete();
    }

    public function restore($id)
    {

        $store = $this->store->withTrashed()->findOrFail($id);
        $store->restore();
    }

    public function forceDelete($id)
    {

        $store = $this->store->withTrashed()->findOrFail($id);
        if ($store->image) {
            Storage::disk('public')->delete($store->image);
        }
        $store->forceDelete();
    }

}

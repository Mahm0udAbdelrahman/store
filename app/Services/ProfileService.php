<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class ProfileService
{

    public function edit()
    {
        return Auth::user()->profile;
    }
    public function update(array $data)
    {
        $user = $this->edit();
       return  $user->fill($data)->save();
    }
}

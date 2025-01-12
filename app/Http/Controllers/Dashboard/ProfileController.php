<?php

namespace App\Http\Controllers\Dashboard;

use App\Services\ProfileService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct(public ProfileService $profileService)
    {}
    public function edit()
    {
        $user = $this->profileService->edit();
      
        $countries = Countries::getNames();
        $languages = Languages::getNames();

        return view('admin.Profile.update', compact('user','languages' ,'countries'));
    }

    public function update(Request $request)
    {
        $this->profileService->update($request->all());

        return back();
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeviceTokensController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'token' => ['required', 'string'],
            'device' => ['required', 'string'],
        ]);

        $deviceToken = auth()->user()->deviceTokens()->create($request->only('token', 'device'));

        return response()->json($deviceToken);
    }


    // ======================or ======================

    public function store(Request $request)
    {
        $request->validate([
            'token' => ['required', 'string'],
            'device' => ['required', 'string'],
        ]);

        $deviceToken = auth()->user()->deviceTokens()->create([
            'token' => $request->token,
            'device' => $request->device,
        ]);

        return response()->json($deviceToken);
    }


     // ======================or ======================
    public function store(Request $request)
    {
        // ======================Youtube======================
        $request->validate([
            'token' => ['required', 'string'],
            'device' => ['required', 'string'],
        ]);
        $user = Auth::guard('sanctum')->user();
        $exists = $user->deviceTokens()->where('token', $request->token)->exists();
        if (!$exists) {
            // $user->deviceTokens()->create($request->only('token', 'device'));
            $user->deviceTokens()->create([
                'token' => $request->token,
                'device' => $request->device,
            ]);
            }
    }


      // ======================or ======================
}

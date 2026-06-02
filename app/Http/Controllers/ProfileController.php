<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $data = $request->validate([
            'age' => 'required|numeric',
            'gender' => 'required',
            'height_cm' => 'required|numeric',
            'weight_kg' => 'required|numeric',
            'activity_level' => 'required',
            'weight_goal' => 'required',
        ]);

        $user->update($data);

        // Also update/create weight log for today
        \App\Models\WeightLog::updateOrCreate(
            ['user_id' => $user->id, 'date' => date('Y-m-d')],
            ['weight_kg' => $request->weight_kg]
        );

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }
}

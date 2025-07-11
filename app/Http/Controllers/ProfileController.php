<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function show(Request $request): Response
    {
        $user = $request->user();
        // For now, pass empty arrays for farms, favorites, orders
        $userData = [
            'id' => $user->id,
            'name' => $user->name,
            'avatar' => $user->avatar ?? null,
            'location' => $user->location ?? null,
            'farms' => [],
            'favorites' => [],
            'orders' => [],
        ];
        return Inertia::render('Profile', [
            'user' => $userData,
        ]);
    }
} 
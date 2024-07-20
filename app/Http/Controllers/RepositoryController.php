<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    /**
     * Store a new repository
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
           'url' => 'required|string|max:100',
           'description' => 'required|string|max:500',
        ]);

        $request->user()->repositories()->create($request->all());


        return redirect()->route('repositories.index');
    }
}

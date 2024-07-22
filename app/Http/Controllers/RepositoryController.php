<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRepositoryRequest;
use App\Models\Repository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepositoryController extends Controller
{
    /**
     * Store a new repository
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
           'url' => 'required|string|max:100',
           'description' => 'required|string|max:500',
        ]);

        $request->user()->repositories()->create($request->all());


        return redirect()->route('repositories.index');
    }

    /**
     * @param Repository              $repository
     * @param UpdateRepositoryRequest $request
     *
     * @return RedirectResponse
     */
    public function update(Repository $repository, UpdateRepositoryRequest $request): RedirectResponse
    {

        $repository->update($request->all());

        return redirect()->route('repositories.edit', $repository->id);
    }

    /**
     * Delete a specific repo
     * @param Repository $repository
     *
     * @return RedirectResponse
     */
    public function destroy(Repository $repository): RedirectResponse
    {
        if(Auth::user()->id !== $repository->user_id){
            abort(403);
        }

        $repository->delete();

        return redirect()->route('repositories.index');
    }
}

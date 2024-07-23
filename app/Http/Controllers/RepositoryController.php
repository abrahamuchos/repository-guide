<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRepositoryRequest;
use App\Models\Repository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepositoryController extends Controller
{
    use AuthorizesRequests;

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(): Factory|View|\Illuminate\Foundation\Application|Application
    {
        $user = Auth::user();
        $repositories = Repository::where('user_id', $user->id)->get();

        return view('repositories.index', [
           'repositories' => $repositories
        ]);
    }

    /**
     * @param Repository $repository
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     * @throws AuthorizationException
     */
    public function show(Repository $repository): Factory|View|\Illuminate\Foundation\Application|Application
    {
        $this->authorize('pass', $repository);

        return view('repositories.show', [
            'repository' => $repository
        ]);
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): Factory|View|\Illuminate\Foundation\Application|Application
    {
        return view('repositories.create');
    }


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
     * @param Repository $repository
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     * @throws AuthorizationException
     */
    public function edit(Repository $repository): Factory|View|\Illuminate\Foundation\Application|Application
    {
        $this->authorize('pass', $repository);

        return view('repositories.edit', [
            'repository' => $repository
        ]);
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
     *
     * @param Repository $repository
     *
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Repository $repository): RedirectResponse
    {
        $this->authorize('pass', $repository);

        $repository->delete();

        return redirect()->route('repositories.index');
    }
}

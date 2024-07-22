<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function home(): Factory|View|\Illuminate\Foundation\Application|Application
    {
        return view('welcome', [
           'repositories' => Repository::latest()->get()
        ]);
    }


}

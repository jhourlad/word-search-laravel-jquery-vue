<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing previous searches
     *
     * @return \Illuminate\Http\Response
     */
    public function previous()
    {
        return view('search.previous');
    }
}

<?php namespace App\Http\Controllers\Api;

use App\Events\SearchSucceeded;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\PreviousSearch;
use App\Services\Search\WordsApi;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $model;

    function __construct(PreviousSearch $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->model->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SearchRequest $request)
    {
        $api = new WordsApi();
        $response = $api->search($request->input('query'));
        event(new SearchSucceeded($response));
        return response($response);
    }
}

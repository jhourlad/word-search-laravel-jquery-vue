<?php namespace App\Events;

class SearchSucceeded
{
    public $search;

    /**
     * Create a new event instance.
     *
     * @param $search
     * @return void
     */

    public function __construct($search)
    {
        $this->search = $search;
    }
}

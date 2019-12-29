<?php

namespace App\Listeners;

use App\Events\SearchSucceeded;
use App\Models\PreviousSearch;

class SaveSearch
{
    /**
     * Save or updates a word search
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SearchSucceeded $event)
    {
        $result = $event->search;
        $search = PreviousSearch::firstOrNew(['word' => $result['word']]);
        $search->word = $result['word'];
        $search->definition = $result['results'][0]['definition'];
        $search->part_of_speech = $result['results'][0]['partOfSpeech'];
        $search->hits = $search->hits + 1;
        $search->save();
    }
}

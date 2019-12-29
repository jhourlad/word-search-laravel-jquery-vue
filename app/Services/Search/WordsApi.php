<?php namespace App\Services\Search;

use \GuzzleHttp\Client as GuzzleClient;

class WordsApi implements SearchInterface
{
    protected $apiKey, $apiHost, $apiUrl;
    protected $query;
    protected $client;
    protected $result;

    function __construct()
    {
        $this->apiKey = env('RAPIDAPI_APP_KEY');
        $this->apiHost = env('RAPID_API_HOST');
        $this->apiUrl = env('RAPID_API_URL');
        $this->client = $this->_setHeaders();
    }

    public function search($query)
    {
        $url = $this->apiUrl . $query;
        $request = $this->client->get($url);
        $response = json_decode($response = $request->getBody(), true);

        foreach ($response['results'] as $i => $res) {
            $response['results'][$i]['definition'] = ucfirst($res['definition']) . '.';

            if (!empty($res['examples'])) {
                foreach ($res['examples'] as $x => $ex) {
                    $response['results'][$i]['examples'][$x] = ucfirst($ex) . '.';
                };
            }
        }

        return $response;
    }

    private function _setHeaders(): object
    {
        return new GuzzleClient(['headers' => [
            'x-rapidapi-host' => $this->apiHost,
            'x-rapidapi-key' => $this->apiKey,
        ]]);
    }
}

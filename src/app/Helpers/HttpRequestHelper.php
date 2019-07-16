<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class HttpRequestHelper
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param string $url
     * @param array|null $queryData
     * @param array|null $headerData
     * @return mixed|null
     */
    public function sendGetRequest(string $url, array $queryData = null, array $headerData = null)
    {
        try {
            $response = $this->client->get($url, ['query' => $queryData, 'headers' => $headerData]);

            if ($response->getStatusCode() == 200) {
                $queryData = json_decode($response->getBody()->getContents(), true);

                if (!empty($queryData)) {
                    return $queryData;
                }
            }
        } catch (RequestException $exception) {
            $errorMessage = "Unable to fetch data from " . $url;
            Log::error($errorMessage . " - " . $exception->getMessage());
        }

        return null;
    }

    /**
     * @param string $url
     * @param array|null $data
     * @return mixed|null
     */
    public function sendPostRequest(string $url, array $data = null)
    {
        try {
            $requestOptions = [
                'json' => $data,
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ];
            $response = $this->client->post($url, $requestOptions);

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody()->getContents());

                if (!empty($data)) {
                    return $data;
                }
            }
        } catch (RequestException $exception) {
            $errorMessage = "Unable to fetch data from " . $url;
            Log::error($errorMessage . " - " . $exception->getMessage());
        }

        return null;
    }
}

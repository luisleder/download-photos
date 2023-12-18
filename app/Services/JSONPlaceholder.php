<?php

namespace App\Services;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class JSONPlaceholder{

    /** 
     *  valida data response format
     * @param array
    */
    private static function validateResponse(Array $response)
    {
        $rules = [
            '*.albumId' => 'required|integer',
            '*.id' => 'required|integer',
            '*.title' => 'required|string',
            '*.url' => 'required|url',
            '*.thumbnailUrl' => 'required|url'
        ];
        $message = [
            'required' => 'El campo :attribute es obligatorio.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
            'url' => 'El campo :attribute debe ser una URL válida.'
        ];

        try {
            
            $validador = Validator::make($response, $rules, $message);
            if ($validador->fails()) {
                echo "Format not valid";
                return false;
            }

        } catch (ValidationException) {
            echo "Validation Error";
            return false;
        }
    }

    public static function getData()
    {
        $client = new Client([
            'base_uri' => 'https://jsonplaceholder.typicode.com',
            'timeout' => 2.0,
            'retry_on_status' => [500, 502, 503, 504],
            'retries' => 3,
        ]);

        try {

            $response = $client->request('HEAD', '/');
            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                echo "API is online and available for requests.";
            } else {
                echo "API is not available.";
                return false;
            }

            $response = $client->request('GET', '/photos');
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);
            self::validateResponse($data);

            return $data;

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $statusCode = $response->getStatusCode();
                $body = $response->getBody()->getContents();
                $data = json_decode($body, true);
            } else {
                $statusCode = 0;
                $data = null;
            }
        }

    }
}
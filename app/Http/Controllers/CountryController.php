<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;

class CountryController extends Controller
{
    public function getCountries()
    {
        // Inicializa o cliente GuzzleHttp
        $client = new Client();

        try {
            // Faz a requisição GET à API de países
            $response = $client->get('https://restcountries.com/v3.1/all');

            // Decodifica a resposta JSON em formato de array associativo
            $countriesData = json_decode($response->getBody(), true);

            // Filtra os dados para obter apenas as informações necessárias (nome e callingCodes)
            $countries = collect($countriesData)->map(function ($country) {
                return [
                    'name' => $country['name']['common'],
                    'callingCode' => isset($country['callingCodes'][0]) ? $country['callingCodes'][0] : null,
                ];
            });

            return response()->json($countries);

        } catch (\Exception $e) {
            // Em caso de erro na requisição à API, retorna uma resposta de erro
            return response()->json(['error' => 'Erro ao obter os países da API'], 500);
        }
    }
}

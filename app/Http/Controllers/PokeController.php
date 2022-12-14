<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokeController extends Controller
{
    public function index () {
        $response = Http::get('https://pokeapi.co/api/v2/pokemon?limit=30&offset=0');
        $pokemons = $response->json();

        $allPokemon = [];
        foreach($pokemons['results'] as $pokemon) {
            $call = Http::get($pokemon['url']);
            $allPokemon[$pokemon['name']] = $call->json();
        }

        return view('welcome', compact('allPokemon'));
        }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        # Inicializamos variable tipo array para almacenar la informacion
        # unificada de dos apis random user y newsapi
        $data = $this->getNotice();
        $articles = new Paginator($data, 10);
        return view('blog', compact('articles'));
    }

    public function getName()
    {
        $responseUser = Http::get("https://randomuser.me/api/");
        $resultUser = $responseUser->json();
        # organizamos el nombre en una variable
        $name = $resultUser['results'][0]['name'];
        $autor = $name['title'] . '. ' . $name['first'] . ' ' . $name['last'];

        return $autor;
    }

    public function getNotice()
    {
        $data = [];
        # consultados las noticias
        $responseNews = Http::get("https://newsapi.org/v2/everything?q=international&apiKey=874c023bb23041499997ae83931a8410");
        $result = $responseNews->json();

        # procesamos las noticias para mostrar
        foreach($result['articles'] as $item)
        {
            $article = [
                'title'         => $item['title'],
                'description'   => $item['description'],
                'image'         => $item['urlToImage'],
                'autor'         => $this->getName(),
            ];

            array_push($data, $article);
        }

        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

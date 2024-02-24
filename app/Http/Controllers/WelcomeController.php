<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        # validamos la categoria
        if (!$request->categoria) {
            $categoria = 'international';
        }else{
            $categoria = $request->categoria;
        }
        # validamos los datos del rango de fecha
        if (!$request->dateInit) {
            $dateInit = '';
        }else{
            $dateInit = $request->dateInit;
        }

        if (!$request->dateFin) {
            $dateFin = '';
        }else{
            $dateFin = $request->dateFin;
        }

        $data = $this->getPagination($categoria, $dateInit, $dateFin);

        return view('blog', [
            'articles' => $data['currentPageData'],
            'categoria' => request()->categoria,
            'pages' => $data['pages'],
            'currentPage' => $data['currentPage']
        ]);
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

    public function getNotice($categoria, $dateInit, $dateFin)
    {
        $data = [];
        $autor = $this->getName();
        # consultados las noticias
        $responseNews = Http::get("https://newsapi.org/v2/everything?q=".$categoria."&from=".$dateInit."&to=".$dateFin."&apiKey=874c023bb23041499997ae83931a8410");
        $result = $responseNews->json();

        # procesamos las noticias para mostrar
        foreach($result['articles'] as $item)
        {
            $fecha = Carbon::parse($item['publishedAt']);
            $article = [
                'title'         => $item['title'],
                'description'   => $item['description'],
                'image'         => $item['urlToImage'],
                'autor'         => $autor,
                'date_published' => $fecha->format('d-m-Y')
            ];

            array_push($data, $article);
        }

        return $data;
    }

    public function getPagination($categoria, $dateInit, $dateFin)
    {
        $data = collect($this->getNotice($categoria, $dateInit, $dateFin));
        $currentPage = request()->get('page', 1);
        $perPage = 10;
        $totalPages = ceil($data->count() / $perPage);
        $offset = ($currentPage - 1) * $perPage;

        $currentPageData = $data->slice($offset, $perPage);

        return [
            'currentPageData' => $currentPageData,
            'pages' => range(1, $totalPages),
            'currentPage' => $currentPage,];
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

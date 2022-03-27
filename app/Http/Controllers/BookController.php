<?php

namespace App\Http\Controllers;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;



class BookController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct() {}

    /**
     * @param Request $request
     * @return array|false|Response|string
     * @throws RequestException
     */
    public function index(Request $request )
    {
//        Check if there are any route parameters to filter our response(by name,release date,pagination results etc)
        if ($request->all()) {
                $filteredBooks =  Http::get('https://anapioficeandfire.com/api/books/',$request->all());
                if ($filteredBooks->successful()) {
                    $sorted_by_date = $this->sortResponse($filteredBooks->json());
                    return $this->getValidItems($sorted_by_date);
                }
                if ($filteredBooks->throw()) {
                    return $filteredBooks->throw()->json();
                }
        }
//        Else return all the books
        $allBooks = Http::get('https://anapioficeandfire.com/api/books');
        if ($allBooks->successful()) {
            $sorted_by_date = $this->sortResponse($allBooks->json());
            return $this->getValidItems($sorted_by_date);
        }
        if ($allBooks->throw()) {
            return $allBooks->throw()->json();
        }
        return $this->getValidItems($this->sortResponse($allBooks->json()));
    }

    /**
     * @param $id
     * @throws RequestException
     */
    public function show($id)
    {
        $aBook =  Http::get('https://anapioficeandfire.com/api/books/'.$id);
             if ($aBook->successful()) {
                 return $this->getBookValues($aBook->json());
             }
        if ($aBook->throw()) {
            return $aBook->throw()->json();
        }
        return $this->getBookValues($aBook->json());
    }

    public function getValidItems($items): array
    {
        $books = [];
        foreach ($items as $key => $item) {
            $books[] = [
                'name' => $item['name'],
                'authors' => $item['authors'],
                'comments_count' => $this->getCommentCount((int) filter_var($item['url'], FILTER_SANITIZE_NUMBER_INT))
            ];
        }
        return $books;
    }

    public function getBookValues($aBook): array
    {
        return [
            'name' => $aBook['name'],
            'authors' => $aBook['authors'],
            'comments_count' => $this->getCommentCount((int) filter_var($aBook['url'], FILTER_SANITIZE_NUMBER_INT))
        ];
    }

    public function getCommentCount($book_id): int
    {
        return DB::table('comments')
         ->where('book_id', $book_id)
         ->count();
    }

    public function sortResponse($responseObject){

        $sort_by = array_column($responseObject, 'released');

//        use the array_multisort() to sort our responseObject
        array_multisort($sort_by, SORT_ASC, $responseObject);

        //return a sorted Response
        return $responseObject;
    }


}

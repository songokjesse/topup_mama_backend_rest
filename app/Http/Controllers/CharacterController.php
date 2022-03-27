<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CharacterController extends Controller
{
    private $external_url = 'https://www.anapioficeandfire.com/api/characters';

    public function index(Request $request): array
    {
        $characters =  Http::get($this->external_url,$request->all());
        //get the sort value and sort order
        $sort_by = $request->input('sort_by');
        $sort_order = $request->input('order');
//        if $request have sorting then return sorted response
        if($sort_by && $sort_order){
//            get sorted response
          $sorted_response = $this->sortResponse($characters->json(),$sort_by,$sort_order);
//          return transform the response and return to the client
            return $this->transformResponse($sorted_response);
        }
        return $this->transformResponse($characters->json());
    }

    public function  transformResponse($responseObject): array
    {
        // Transform response to return it with meta-data (total number of characters in the response object and total age)
       return [
           'character_data' => $responseObject,
           'character_totals' => count($responseObject)
       ] ;
    }

    public function sortResponse($responseObject, $sortKey, $sortOption){
//        endpoint = characters?sort_by=name&order=asc
        if ($sortOption == 'asc'){
            $sort_order = SORT_ASC;
        }
        if ($sortOption == 'desc'){
            $sort_order = SORT_DESC;
        }
//        get the column from array to be sorted
        $sort_by = array_column($responseObject, $sortKey);

//        use the array_multisort() to sort our responseObject
        array_multisort($sort_by, $sort_order, $responseObject);

        //return a sorted Response
        return $responseObject;
    }

}

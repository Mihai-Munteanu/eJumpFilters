<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FilterController extends Controller
{
    public function index(Request $request) {

        // get list of items
        $listItems = Http::get('https://radupintilie.dev.ascensys.ro/code_tests/testData.txt')->body();

        $listItems = str_split($listItems);

        $newListItems = [];

        foreach($listItems as $item) {

           if($item !== "\r" && $item !== "\n") {
                array_push($newListItems, $item);
           } elseIf($item === "\r" && $item !== "\n") {
                array_push($newListItems, ',');
           }
        }

        $newListItems = implode('', $newListItems);
        $newListItems = explode(',', $newListItems);
        $newListItems = array_chunk($newListItems, '3');


        // filter the array
        $length = count($newListItems);

        for($i = 0; $i < $length; $i ++) {

            if(collect($request)->has('filterA') && $request['filterA'] !== Null && $request['filterA'] !==  $newListItems[$i][0]) {
                unset($newListItems[$i]);
            }

            if(array_key_exists($i, $newListItems) && collect($request)->has('filterB') && $request['filterB'] !== Null && $request['filterB'] !==  $newListItems[$i][1]) {
                unset($newListItems[$i]);
            }

            if(array_key_exists($i, $newListItems) && collect($request)->has('filterC') && $request['filterC'] !== Null && $request['filterC'] !==  $newListItems[$i][2]) {
                unset($newListItems[$i]);
            }
        }

        // get the filters input
        $filterA = [];
        $filterB = [];
        $filterC = [];

        foreach($newListItems as $items) {
            array_push($filterA, $items[0]);
            array_push($filterB, $items[1]);
            array_push($filterC, $items[2]);
        }

       $filterA = array_unique($filterA);
       $filterB = array_unique($filterB);
       $filterC = array_unique($filterC);


       return view('welcome', [
           'newListItems' => $newListItems,
           'filterA' => $filterA,
           'filterB' => $filterB,
           'filterC' => $filterC,
       ]);

    }
}

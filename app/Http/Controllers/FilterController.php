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
        $listItems = explode("\r\n", $listItems);


        // find the number of elements on a row
        $firstRow = explode(",", $listItems[0]);
        $rowElementsCount = count($firstRow);

        // convert the list into an array of arrays
        $listItems = implode(",", $listItems);
        $listItems = explode(",", $listItems);
        $listItems = array_chunk($listItems, $rowElementsCount);

        // filter the array
        $length = count($listItems);

        // array_filter($listItems, function($value) use ($key, $keyValue) {
        //     return $value[$key] == $keyValue;
        //  });

        for($i = 0; $i < $length; $i ++) {

            if(collect($request)->has('filterA') && $request['filterA'] !== Null && $request['filterA'] !==  $listItems[$i][0]) {
                unset($listItems[$i]);
            }

            if(array_key_exists($i, $listItems) && collect($request)->has('filterB') && $request['filterB'] !== Null && $request['filterB'] !==  $listItems[$i][1]) {
                unset($listItems[$i]);
            }

            if(array_key_exists($i, $listItems) && collect($request)->has('filterC') && $request['filterC'] !== Null && $request['filterC'] !==  $listItems[$i][2]) {
                unset($listItems[$i]);
            }
        }


        // get each filter inputs;
        $filterA = [];
        $filterB = [];
        $filterC = [];

        foreach($listItems as $items) {
            array_push($filterA, $items[0]);
            array_push($filterB, $items[1]);
            array_push($filterC, $items[2]);
        }

       $filterA = array_unique($filterA);
       $filterB = array_unique($filterB);
       $filterC = array_unique($filterC);

       return view('welcome', [
           'listItems' => $listItems,
           'filterA' => $filterA,
           'filterB' => $filterB,
           'filterC' => $filterC,
       ]);

    }
}

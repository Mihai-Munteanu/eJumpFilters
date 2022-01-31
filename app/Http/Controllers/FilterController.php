<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FilterController extends Controller
{
    public function index() {

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


        $aList = [];
        $bList = [];
        $cList = [];

        foreach($newListItems as $items) {
            array_push($aList, $items[0]);
            array_push($bList, $items[1]);
            array_push($cList, $items[2]);
        }


       $aList = array_unique($aList);
       $bList = array_unique($bList);
       $cList = array_unique($cList);


       return view('welcome', [
           'newListItems' => $newListItems,
           'aList' => $aList,
           'bList' => $bList,
           'cList' => $cList,
       ]);

    }
}

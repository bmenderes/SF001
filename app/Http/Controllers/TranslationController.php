<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $translate = Translation::paginate(15);

        return view('translate.list')->with(['translate' => $translate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function show(Translation $translation)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function edit(Translation $translation)
    {
        return view('translate.edit')->with(['translate' => $translation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Translation $translation)
    {
        $translation->result = $request->result;
        $translation->save();
        Cache::forget("translation:" . $translation->target . ":" . $translation->string);

        return redirect()->route('translations.index')->with('message', 'Updeted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Translation $translation)
    {
        //
    }

    public function deneme()
    {
        $teams = [
            ['Fenerbahce',80], 
            ['Besiktas',75], 
            ['Galatasaray',70],
            ['Trabzon',67],
            ['Bursa',67],
            ['Sivas',67],
        ];
        
        $teams1 = $teams;

        $arr = [];
        $fixture = [];
        $temp = $teams;
        for ($k = 0; $k < count($teams); $k++) :
            for ($j = 0; $j < count($teams) - 1; $j++) :
                for ($i = 0; $i < 2; $i++) :                    
                    array_push($arr, $temp[$i]);
                endfor;               
                array_push($arr,$j+1); // week number
                unset($temp[1]);
                $temp = array_values($temp);
                array_push($fixture, $arr);
                $arr = [];
            endfor;
            unset($teams[0]);
            $teams = array_values($teams);
            $temp = $teams;
            if(count($temp)==2){
                
                array_push($temp, count($teams1) - 1); // week number for last match
                array_push($fixture, $temp);
            }
        endfor;
        shuffle($fixture);
        
        


        return view('translate.deneme')->with(['fixture' => $fixture, 'teams'=> $teams1]);
    }
}

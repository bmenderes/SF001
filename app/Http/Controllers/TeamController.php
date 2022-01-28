<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use App\Models\Result;
use App\Models\Team;
use Error;
use Exception;
use Illuminate\Http\Request;
use Mockery\Generator\StringManipulation\Pass\Pass;
use PhpParser\Node\Stmt\TryCatch;

class TeamController extends Controller
{
    //
    public function team_post()
    {


        $teams = Team::all()->toArray();
        $totalTeam = count($teams);
        $gamePerWeek = ($totalTeam / 2);
        $n = ($totalTeam) - 1;
        $week = ($totalTeam) - 1;

        for ($j = 0; $j < $week; $j++) :
            for ($i = 0; $i < $gamePerWeek; $i++) :
                $fixture = new Fixture;
                $fixture->home_id = $teams[$i]['id'];
                $fixture->away_id = $teams[$n]['id'];
                $fixture->week = $j + 1;
                $fixture->save();

                $fixture = new Fixture;
                $fixture->home_id = $teams[$n]['id'];
                $fixture->away_id = $teams[$i]['id'];
                $fixture->week = $j + 1 + $week;
                $fixture->save();
                $n = $n - 1;
            endfor;
            $n = ($totalTeam) - 1;
            //array shift operation
            //shift once with keeping the last
            //dd($teams1);
            $last = array_pop($teams);
            $last_sec = array_pop($teams);
            array_unshift($teams, $last_sec);
            array_push($teams, $last);
        endfor;

        $fixture = Fixture::orderBy('week', 'ASC')->get();
        $fixtureTable = Fixture::with('home', 'away')->orderBy('week', 'ASC')->get();
        return view('translate.team', compact('fixture', 'teams', 'fixtureTable'));
    }

    public function team()
    {
        $teams = Team::all()->toArray();
        $fixtureTable = Fixture::with('home', 'away')->orderBy('week', 'ASC')->get();

        return view('translate.team', compact('teams', 'fixtureTable'));
    }

    public function score()
    {
        $teams = Team::all()->toArray();
        $weekNum = count($teams)*2;
    
        $homeTeamScore = 0;
        $awayTeamScore = 0;


        for ($i = 1; $i < $weekNum; $i++) :
            $matchArray = Fixture::with('home', 'away')->where('week', $i)->get()->toArray();
            foreach ($matchArray as $match) {
              
                if ($match['home']['strenght'] <= 60) {
                    $homeTeamScore = rand(0, 1);
                } elseif ($match['home']['strenght'] <= 65) {
                    $homeTeamScore = rand(0, 2);
                } elseif ($match['home']['strenght'] <= 70) {
                    $homeTeamScore = rand(0, 3);
                } elseif ($match['home']['strenght'] <= 75) {
                    $homeTeamScore = rand(0, 4);
                } elseif ($match['home']['strenght'] <= 85) {
                    $homeTeamScore = rand(0, 5);
                }

                
                if ($match['away']['strenght'] <= 60) {
                    $awayTeamScore = rand(0, 1);
                } elseif ($match['away']['strenght'] <= 65) {
                    $awayTeamScore = rand(0, 2);
                } elseif ($match['away']['strenght'] <= 70) {
                    $awayTeamScore = rand(0, 3);
                } elseif ($match['away']['strenght'] <= 75) {
                    $awayTeamScore = rand(0, 4);
                } elseif ($match['away']['strenght'] <= 85) {
                    $awayTeamScore = rand(0, 5);
                }

                $score = new Result;
                $score->team_id = $match['home_id'];
                $score->week = $match['week'];
                $score->win = ($homeTeamScore > $awayTeamScore) ? 1 : 0;
                $score->draw = ($homeTeamScore === $awayTeamScore) ? 1 : 0;
                $score->lost = ($homeTeamScore < $awayTeamScore) ? 1 : 0;
                $score->point = ($homeTeamScore > $awayTeamScore) ? 3 : (($homeTeamScore === $awayTeamScore) ? 1 : 0);
                $score->average = $homeTeamScore - $awayTeamScore;
                $score->save();

                $score = new Result;
                $score->team_id = $match['away_id'];
                $score->week = $match['week'];
                $score->win = ($homeTeamScore < $awayTeamScore) ? 1 : 0;
                $score->draw = ($homeTeamScore === $awayTeamScore) ? 1 : 0;
                $score->lost = ($homeTeamScore > $awayTeamScore) ? 1 : 0;
                $score->point = ($homeTeamScore < $awayTeamScore) ? 3 : (($homeTeamScore === $awayTeamScore) ? 1 : 0);
                $score->average = $awayTeamScore - $homeTeamScore;
                $score->save();
            }
        endfor;

        $result = Result::with('tk')->where('week', '1')->get()->toArray();     

        return view('translate.result', compact('teams', 'result'));
    }

    public function show($week){
        $teams = Team::all()->toArray();
        $result = Result::with('tk')->where('week', $week)->get()->toArray();     

        return view('translate.result', compact('teams', 'result'));
    }





    public function deneme()
    {
        $teams = Team::all();
        $teams1 = Team::all();
        $temp = Team::all();
        $arr = [];
        $fixture = [];
        $z = 0;
        $n = 0; //weeknumber
        $x = 1;
        $week = [];

        $turn1 = count($temp);
        $totalWeek = (count($teams1) - 1) * 2;
        $weekGameNum = count($teams1) / 2;


        for ($k = $turn1; $k > 2; $k--) :
            for ($j = $turn1; $j >= 2; $j--) :
                $deneme = new Fixture;
                for ($i = 0; $i < 2; $i++) :
                    array_push($arr, $temp[$i]);
                    if ($i === 0) {
                        $deneme->home_id = $temp[$i]->id;
                    } elseif ($i === 1) {
                        $deneme->away_id = $temp[$i]->id;
                    }
                endfor;
                $deneme->week = $x;
                $deneme->save();
                $n = $n + 1;
                if ($n >= $weekGameNum) {
                    $x = $x + 1;
                    $n = 0;
                }
                shuffle($arr);
                array_push($week, $x);
                array_push($fixture, $arr);
                unset($temp[1]); //her seferinde ikinci indisteki takimi düşürerek ilk takımın tüm takımlarla maç yapmasi organize edilir.
                $temp = $temp->except(['name', "a"]);
                $temp->all();
                $arr = [];
            endfor;
            $temp = $teams;
            for ($m = 0; $m <= $z; $m++) :
                unset($temp[0]); //ilk takım düşürülerek bir sonraki takımın sırayla maç yapması sağlanır.
                $temp = $temp->except(['name', "a"]); //array indexini tekrar oluşturmak için (0'dan başlaması için) oluşturuldu.
                $temp->all();
            endfor;
            $turn1 = $turn1 - 1;
            $z += 1;
            if ($turn1 === 2) { //son iki takım kaldığında aralarında maç yapmaları için bu koşul eklendi.
                array_push($fixture, [$temp[0], $temp[1]]);
                $deneme = new Fixture;
                $deneme->home_id = $temp[0]->id;
                $deneme->away_id = $temp[1]->id;
                $deneme->week = $x;
                $deneme->save();
            }
        endfor;
        shuffle($fixture);
        return view('translate.team', compact('teams1', 'fixture', 'totalWeek', 'weekGameNum', 'week'));
    }
}

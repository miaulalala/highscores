<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Highscore;

class HighscoreController extends Controller
{
    
    public function __construct()
    {
    }
    
    public function index()
    {
        return Highscore::all()->where('approved', '1')->load('difficulty');
    }
    
    public function notApproved()
    {
        return Highscore::all()->load('difficulty');
    }
    
    public function show(Highscore $highscore)
    {
        return $highscore;
    }
    
    public function store(Request $request)
    {
        $highscore = Highscore::create($request->all());
        return response()->json([
                'data' => $highscore->toArray()], 201);
    }

    public function update(Request $request, Highscore $highscore)
    {
        $highscore->update($request->all());
        return response()->json($highscore, 200);
    }

    public function delete(Highscore $highscore)
    {
        $highscore->delete();
        return response()->json(null, 204);
    }
}

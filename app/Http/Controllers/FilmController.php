<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Film;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $films = Film::all();
        return $films;
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->only('title', 'language_id', 'replacement_cost', 'rental_duration', 'rental_rate');
        $film = new Film();
        $film->fill($data);
        $film->save();
        return response('{success}',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $film = Film::where('film_id', $id)->get();
        if (!empty($film)) {
            return $film;
        } else {
            return '{Empty}';
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        if ($request->has('title') && $request->has('language_id')) {
            $title = $request->input('title');
            $language_id = $request->input('language_id');
            if (is_numeric($language_id)) {
                Film::where('film_id', $id)->update(['title' => $title, 'language_id' => $language_id]);
            } else {
                return '{language_id is\'nt a numberic}';
            }
            return '{patched}';
        }
        return '{failed}';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Film::where('film_id', $id)->delete();
        return response($id, 200);
    }

    public function getActor($id)
    {
        $film = Film::where('film_id', $id)->first();
        $actor = $film->actor;
        return response($actor, 200);
    }

    public function getFilm($id)
    {
        $actor = Actor::find($id);
        $film = $actor->film;
        return response($film, 200);
    }

    public function getFilmText($id)
    {
        $film = Film::select('film_id', 'title')->where('film_id', $id)->first();
        $filmText = $film->filmText;
        return response($filmText, 200);
    }

    public function getInventory($id)
    {
        $film = Film::select('film_id', 'title')->where('film_id', $id)->first();
        $inventory = $film->inventory;
        return response($inventory, 200);
    }
}

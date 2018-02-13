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
        if ($request->has('title') && $request->has('language_id')
            && $request->has('replacement_cost')
            && $request->has('rental_duration')
            && $request->has('rental_rate')
        ) {
            $film = new Film();
            $film->title = $request->input('title');
            $film->language_id = $request->input('language_id');
            $film->rental_duration = $request->input('rental_duration');
            $film->rental_rate = $request->input('rental_rate');
            $film->replacement_cost = $request->input('replacement_cost');
            $film->save();
            return '{saved}';
        } else {
            return '{Request not containt enough params}';
        }
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
        return '{deleted item ' . $id . '}';
    }

    public function getActor($id)
    {
        $film = Film::where('film_id', $id)->first();
        $actor = $film->actor;
        return $actor;
    }

    public function getFilm($id)
    {
        $actor = Actor::find($id);
        $film = $actor->film;
        return $film;
    }

    public function getFilmText($id)
    {
        $film = Film::select('film_id', 'title')->where('film_id', $id)->first();
        $filmText = $film->filmText;
        return $filmText;
    }

    public function getInventory($id)
    {
        $film = Film::select('film_id', 'title')->where('film_id', $id)->first();
        $inventory = $film->inventory;
        return $inventory;
    }
}

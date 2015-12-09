<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Anime;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view( 'anime.index' )->withAnimes(Anime::all());

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $anime = Anime::findOrFail($id);
        $user = Auth::user();
        $data = json_decode( $anime->genre, true );
        return view( 'anime.show' )->with( 'data', $data )->withAnime( $anime )->withUser( $user );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function watch($id)
    {

        $anime = Anime::findOrFail($id);
        return view( 'anime.watch' )->withAnime( $anime );

    }

    /**
     * Method that saves the currently logged in user as a follower of the specified anime
     * The return value is the number of followers of the specified anime.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function followUsers( $id )
    {

        $user = Auth::user();
        $followingAnime = Anime::find( $id );
        if( !$followingAnime->userFollowers->contains( $user ) )
        {

            $followingAnime->userFollowers()->attach( $user );

        }

        return response()->json( [ 'followers' => $followingAnime->followers->count() ], 220 );

    }

    /**
     * Method that deletes the currently logged in user as a follower of the specified anime
     * The return value is the number of followers of the specified anime.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unfollowAnimes( $id )
    {

        $user = Auth::user();
        $followingAnime = Anime::find( $id );
        if( $user->followingAnime->contains( $followingAnime ) )
        {

            $user->followingAnime()->detach( $followingAnime );

        }

        return response()->json( [ 'followers' => $followingAnime->followers->count() ], 220 );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

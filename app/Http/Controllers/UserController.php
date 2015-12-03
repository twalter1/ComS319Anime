<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Illuminate\Http\RedirectResponse;
use App\Http\Requests;
use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserEditRequest;
use App\User;
use Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view( 'user.index' )->withUsers(User::all());

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
    public function store( Request $request )
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {

        $user = User::findOrFail($id);
        return view( 'user.show' )->withUser( $user );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {

        $user = auth()->user();

        if ( $user )
        {

            if ( $user->id == $id )
            {

                return view( 'user.edit' )->withUser(User::findOrFail($id));

            }
            else
            {

                return redirect()->back()->withErrors( 'Must have permission to edit this profile.' );

            }

        }
        else
        {

            return redirect()->back()->withErrors( 'Must be logged in to edit your profile.' );

        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword( $id )
    {
        $user = auth()->user();

        if( $user )
        {

            if( $user->id == $id )
            {

                return view( 'user.changePassword' )->withUser( User::findOrFail( $id ) );

            }
            else
            {

                return redirect()->back()->withErrors( 'Must have permission to edit this profile.' );

            }

        }
        else
        {

            return redirect()->back()->withErrors( 'Must be logged in to edit your profile.' );

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param  UserChangePasswordRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword( $id, UserChangePasswordRequest $request )
    {
        $user = User::find( $id );
        if( Hash::check( $request->get( 'password' ), $user->password ) )
        {

            $user->password = bcrypt( $request->get( 'new_password' ) );
            $user->save();

            return redirect()->route( 'user.show', $id )->withSuccess( 'Successfully changed ' . $user->name . "'s password " );

        }
        else
        {

            return redirect()->back()->withErrors( 'You did not match the current password please try again.' );

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserEditRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( UserEditRequest $request, $id )
    {

        $user = User::find( $id );
        $user->name = $request->get( 'name' );
        $user->email = $request->get( 'email' );
        $user->description = $request->get( 'description' );
        //dd( $request->file('photo') );
        /*if ( $request->hasFile('photo') ) {
            foreach ($request->file('photo') as $file) {
                if ($user->photos->count() == 0) {

                    Photo::fromUpload($user, $file);

                } else {

                    $photo = $user->photos->first();
                    $photo->replaceImage($file);

                }
            }
        }*/
        $user->save();

        return redirect()->route( 'user.show', $id )->withSuccess( 'Successfully edited ' . $user->name . "'s profile " );

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
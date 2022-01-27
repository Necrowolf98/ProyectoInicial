<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('profile/index');
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
        //
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
    public function update(User $user,  Request $request)
    {
        if(!$request == null){
            if($request->password == null){
                $data = $this->validate($request, [
                    'name' => 'required|string|max:255',
                    'lastname' => 'required|string|max:255',
                    'direction' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email,'.$user->id,
                    'phone' => 'required|string|max:255'
                ]);
                $user->update($data);    
            }else{
                $data = $this->validate($request, [
                    'name' => 'required|string|max:255',
                    'lastname' => 'required|string|max:255',
                    'direction' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email,'.$this->user,
                    'phone' => 'required|string|max:255',
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);
                $user->update([
                    'name' => $request->name,
                    'lastname' => $request->lastname,
                    'direction' => $request->direction,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                ]);    
            }

            return redirect()->back()->with('message', [
                'type' => 'success',
                'text' => 'Success edit profile!',
            ]);
        }

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

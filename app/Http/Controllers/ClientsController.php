<?php

namespace App\Http\Controllers;

use App\Clients;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients = Clients::get();
        return view('admin/clients/list')->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin/clients/form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        //
        $client = array(
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'timezone' => $request->timezone,
            'website' => $request->website,
            'about' => $request->about,
        );
        Clients::create($client);
        return redirect(url('clients'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function show(clients $clients)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $client = Clients::where('id', $id)->first();
        return view('admin/clients/form')->with('update', true)->with('client', $client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $client = array(
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'timezone' => $request->timezone,
            'website' => $request->website,
            'about' => $request->about,
        );
        Clients::where('id', $id)->update($client);
        $request->session()->flash('success', 'Data updated successfuly');
        return redirect(url('clients/'.$id.'/edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Clients::where('id',$id)->delete();
        return redirect(url('clients'));
    }
}

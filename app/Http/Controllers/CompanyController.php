<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $companies = Company::get();
        return view('admin/company/list')->with('companies', $companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin/company/form');
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
        $company = array(
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'lead_person' => $request->lead_person,
            'website' => $request->website
        );
        Company::create($company);
        return redirect(url('company'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $company = Company::where('id', $id)->first();
        return view('admin/company/form')->with('update', true)->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $company = array(
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'lead_person' => $request->lead_person,
            'website' => $request->website
            );
        Company::where('id', $id)->update($company);
        $request->session()->flash('success', 'Data updated successfuly');
        return redirect(url('company/'.$id.'/edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Company::where('id',$id)->delete();
        return redirect(url('company'));
    }
}

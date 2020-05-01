<?php

namespace App\Http\Controllers;

use App\Project;
use App\Clients;
use App\Company;
use App\Project_Client_Relation;
use App\Project_Company_Relation;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $projects = Project::get();
        return view('admin/projects/list')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $clients = Clients::get();
        $companies = Company::get();
        return view('admin/projects/form')->with('clients', $clients)->with('companies', $companies);
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

        if ($request->hasFile('rel_doc')) {
            $time = time();
            $filename = $time . '.' . $request->rel_doc->extension();
            // $basename = $request->rel_doc->getClientOriginalName();
            // $type = $request->rel_doc->getMimeType();
            $dup = 0;
            while (file_exists(public_path() . '/file/upload/' . $filename)) {
                $dup++;
                $filename = $time . '_' . $dup . '.' . $request->rel_doc->extension();
            }
            $request->rel_doc->move(public_path('file\upload'), $filename);
            $file = asset('file/upload/') . "/" . $filename;
        }

        $project = array(
            'name' => $request->name,
            'live_url' => $request->live_url,
            'staging_url' => $request->staging_url,
            'git' => $request->git,
            'description' => $request->description,
            'document' => $file
        );
        $project_id = Project::create($project)->id;

        if ($request->owner == 'client') {
            $project_client = array(
                'client_id' => $request->client,
                'project_id' => $project_id
            );
            Project_Client_Relation::create($project_client);
        } else if ($request->owner == 'company') {
            $project_company = array(
                'company_id' => $request->company,
                'project_id' => $project_id
            );
            Project_Company_Relation::create($project_company);
        }
        return redirect(url('projects'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $clients = Clients::get();
        $companies = Company::get();
        $project = Project::where('id', $id)->first();
        $client = Project_Client_Relation::where('project_id', $id)->first();
        $company = Project_Company_Relation::where('project_id', $id)->first();
        return view('admin/projects/form')
            ->with('clients', $clients)
            ->with('companies', $companies)
            ->with('project', $project)
            ->with('update', true)
            ->with('client', $client)
            ->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $project = array(
            'name' => $request->name,
            'live_url' => $request->live_url,
            'staging_url' => $request->staging_url,
            'git' => $request->git,
            'description' => $request->description,

        );
        if ($request->hasFile('rel_doc')) {
            $time = time();
            $filename = $time . '.' . $request->rel_doc->extension();
            // $basename = $request->rel_doc->getClientOriginalName();
            // $type = $request->rel_doc->getMimeType();
            $dup = 0;
            while (file_exists(public_path() . '/file/upload/' . $filename)) {
                $dup++;
                $filename = $time . '_' . $dup . '.' . $request->rel_doc->extension();
            }
            $request->rel_doc->move(public_path('file\upload'), $filename);
            $file = asset('file/upload/') . "/" . $filename;
            $project['document'] = $file;
        }


        Project::where('id', $id)->update($project);
        Project_Client_Relation::where('project_id', $id)->delete();
        Project_Company_Relation::where('project_id', $id)->delete();
        if ($request->owner == 'client') {

            $project_client = array(
                'client_id' => $request->client,
                'project_id' => $id
            );
            Project_Client_Relation::create($project_client);
        } else if ($request->owner == 'company') {
            $project_company = array(
                'company_id' => $request->company,
                'project_id' => $id
            );
            Project_Company_Relation::create($project_company);
        }
        $request->session()->flash('success', 'Data updated successfuly');
        return redirect(url('projects/' . $id . '/edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Project::where('id',$id)->delete();
        Project_Client_Relation::where('project_id', $id)->delete();
        Project_Company_Relation::where('project_id', $id)->delete();
        return redirect(url('projects'));
    }
}

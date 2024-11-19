<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    //

    public function index(){
        $jobs = Job::with('company')->get();
        return response()->json($jobs,200);

    }
    
    
    public function store(Request $request){

     
        
        $company = Company::create([
            'name' => $request->company['name'],
            'description' => $request->company['description'],
            'contactEmail' => $request->company['contactEmail'],
            'contactPhone' => $request->company['contactPhone'],

        ]);

        if(!$company){
            return response()->json(['message' => 'please enter company info'],400);
        }
        //return response()->json([$company],201);

        $job = Job::create([
            'title'=> $request->title,
            'type'=> $request->type,
            'location'=> $request->location,
            'description'=> $request->description,
            'salary'=> $request->salary,
            'company_id'=> $company->id,
            

        ]);

        return response()->json(['message' => 'jobs added successfully'],201);
        

    }

    public function show_job($id){
        $job = Job::with('company')->find($id);
        return response()->json($job,200);
    }

    public function update(Request $request,$id){
        $job = Job::with('company')->find($id);
        $job->title = $request->title;
        $job->description = $request->description;
        $job->salary = $request->salary;
        $job->type = $request->type;
        $job->location = $request->location;
        //$company = Company::find($job->company_id);
        $company = $job->company;
        $company->name = $request->company['name'];
        $company->description = $request->company['description'];
        $company->contactEmail = $request->company['contactEmail'];
        $company->contactPhone = $request->company['contactPhone'];
        $job->save();
        $company->save();

        return response()->json($job,201);
    }

    public function destroy($id){
        $job = Job::with('company')->find($id);
        Company::where('id', $job->company_id)->delete();
        return response()->json(204);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Job;

class JobController extends Controller
{
    public function index()
    {
        return Job::all();
    }

    public function show(Job $job)
    {
        $job->setHidden(['updated_at']);
        return $job;
    }

    public function store(Request $request)
    {
        $job = Job::create($request->all());

        return response()->json($job, 201);
    }

    public function update(Request $request, Job $job)
    {
        $job->update($request->all());
        $job->setHidden(['created_at']);
        return response()->json($job, 200);
    }

    public function delete(Job $job)
    {
        try{
            if($job->delete()){
                return response()->json(['message'=> 'Record successfully deleted'], 200);
            }
        }catch (\Exception $e){
            //notify engineer
        }

        return response()->json(['message'=> 'Ooopps, we are having a few problems deleting your record, An engineer has been notified'], 500);

    }
}

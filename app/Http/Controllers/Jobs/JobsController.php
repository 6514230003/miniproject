<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job\Job;
use App\Models\Category\Category;
use App\Models\Job\JobSaved;
use Illuminate\Support\Facades\Auth;
use App\Models\Job\Application;


class JobsController extends Controller
{
    

    public function single($id) {

        $job = Job::find($id);

               
        //getting related jobs

   $relatedJobs = Job::where('category', $job->category)
        ->where('id', '!=', $id)
        ->take(5)
        ->get();       

    $relatedJobsCount = Job::where('category', $job->category)
        ->where('id', '!=', $id)
        ->take(5)
        ->count();


        //save job

   $savedJob = JobSaved::where('job_id', $id)
        ->where('user_id', Auth::user()->id)
        ->count();


   //verifining if user applied to job

    $appliedJob = Application::where('user_id', Auth::user()->id)
        ->where('job_id', $id)
        ->count();


    //category 
$categories = Category::all();



return view('jobs.single', compact('job', 'relatedJobs', 'relatedJobsCount', 'savedJob', 'appliedJob', 'categories'));

    }

public function saveJob(Request $request) {

 $saveJob = JobSaved::create([
'job_id' => $request->job_id,
'user_id' => $request->user_id,
'job_image' => $request->job_image,
'job_title' => $request->job_title,
'job_region' => $request->job_region,
'job_type' => $request->job_type,
'company' => $request->company,
]);
if($saveJob) {
    return redirect('/jobs/single/'.$request->job_id.'')->with('save', 'job saved success');
}
}






public function jobApply(Request $request) {
    if ($request->cv == 'No cv') {
        return redirect('/jobs/single/' .$request->job_id. ' ')
            ->with('apply', 'Upload your CV first in the profile page');
    } else {

   

        // Code to execute if the condition is false
        $applyJob = Application::create([
            'cv' => Auth::user()->cv,
            'job_id' => $request->job_id,
           'user_id' => Auth::user()->id,
            'job_image' => $request->job_image,
            'job_title' => $request->job_title,
            'job_region' => $request->job_region,
            'job_type' => $request->job_type,
            'company' => $request->company,
            
        ]);
        

        if ($applyJob) {
            return redirect('/jobs/single/'.$request->job_id.'')->with('applied', 'ผู้จัดการได้อนุมัติเพื่อให้ดำเนินการสัมภาษณ์พนักงานท่านนี้เรียบร้อยแล้ว โปรดดำเนินการ');
        }
    }
}
}

  






    
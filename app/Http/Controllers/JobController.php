<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function create(Request $request){
        try {
            $user = auth()->user();

            if($user->company == 0){
                return response()->json(
                     [
                         'success'=> false,
                         'message' => 'You can not create a job offer with this user'
                     ],
                    400
                );
            }

            $newTitle = $request->input('title');
            $newDescription = $request->input('description');
                        
            $validator = Validator::make($request->all(),
                [
                    'title' => 'required|string|max:25',
                    'description' => 'string|max:255'                
                ]);

            if($validator->fails()){
                return response()->json(
                    [
                        'success'=> false,
                        'message' => $validator->errors()
                    ],
                   400
                );
            }

            $newJob = new Job();
            $newJob->title = $newTitle;
            $newJob->description = $newDescription;
            $newJob->user_id= auth()->user()->id;
            $newJob->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Job created successfully',
                    'data' => $newJob
                ],
               200
            );
            
        } catch (\Exception $exception) {
            Log::error('Error to create job'. $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to create a job'
                ],
               400
            ); 
        }
    }

    public function getAll($id){
        try {
            $jobs = Job::query()->where('user_id', $id)->get();
            
            if(!$jobs && count($jobs)>0){
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'jobs not found'
                    ],
                   400
                );
            }

            return response()->json(
                [
                    'success' => true,
                    'message' => 'View all jobs from this reclutier',
                    'data' => $jobs
                ],
               200
            );

        } catch (\Exception $exception) {
            Log::error('Error to see all jobs from this user' . $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to see all jobs from this user'
                ],
               400
            );    
        }
    }

    public function get($jobId){
        try {
            $job = Job::query()->find($jobId);

            if(!$job){
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'No jobs found'
                    ],
                    404
                );
            }

            return response()->json(
                [
                    'success' => true,
                    'job' => $job
                ],
                200
            );

        } catch (\Exception $exception) {
            Log::error('Error to view this job by ID' . $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to view this job by ID'
                ],
                400
            );
        }
    }

    public function update(Request $request, $jobId){
        try {
            $job = Job::query()->find($jobId);
            $user = auth()->user();

            if($user->company== 0){
                return response()->json(
                    [
                        'success'=> false,
                        'message' => 'You can not update a job offer with this user'
                    ],
                   400
                );
            }

            switch(true){
                case $request->has('title'): 
                    $job->title = $request->input('title');

                case $request->has('description'):
                    $job->description = $request->input('description');
                    
                default:
                    break;
            }
            $job->save();

            return response()->json(
                [
                    'success' => true,
                    'job' => $job
                ],
               200
            );                    
        
        } catch (\Exception $exception) {
            Log::error('Error to update this job by ID' . $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to update this job by ID'
                ],
               400
            );
        }                        
    }

    public function delete($jobId){
        try {
            $job = Job::query()->find($jobId);
            $user = auth()->user();
            
            if($user->company== 0){
                return response()->json(
                    [
                        'success'=> false,
                        'message' => 'You can not update a job offer with this user'
                    ],
                   400
                );
            }

            $jobName = $job->title;
            $job->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Job offer was deleted',
                    'title' => $jobName
                ],
               200
            );

        } catch (\Exception $exception){
            Log::error('Error to delete this project'. $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to delete this job offer',
                    'id' => $jobId                    
                ],
               404
            );
        };
    }

    public function getAllJobs(){
        try {
            $jobs = Job::query()->get();
            
            return response()->json(
                [
                    'success' => true,
                    'message' => 'View all jobs',
                    'data' => $jobs
                ],
               200
            );

        } catch (\Exception $exception) {
            Log::error('Error to see all jobs' . $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to see all jobs'
                ],
               400
            );    
        }
    }
    
}

<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    public function create(Request $request){    
        try {
            $user = auth()->user();

            if($user->company == 1){
               return response()->json(
                    [
                        'success'=> false,
                        'message' => 'You can not create projects with user company'
                    ],
                   400
                );
            }

            $newTitle = $request->input('title');
            $newDescription = $request->input('description');
            $newImages = $request->input('images');
            $newFiles = $request->input('files');
            $newTags = $request->input('tags');

            $validator = Validator::make($request->all(),
                [
                    'title' => 'required|string|max:25',
                    'description' => 'string|max:255',
                    'images' => 'required|array',
                    'files' => 'array',
                    'tags' => 'array'
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

            $newProject = new Project();
            $newProject->title = $newTitle;
            $newProject->description = $newDescription;
            $newProject->images = $newImages;
            $newProject->files = $newFiles;
            $newProject->tags = $newTags;
            $newProject->user_id= auth()->user()->id;
            $newProject->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Project created successfully',
                    'data' => $newProject
                ],
                200
            );
        } catch (\Exception $exception) {
            Log::error('Error to create a new project'. $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to create a new project'                    
                ],
               404
            );
        };
    }

    public function getAll($id){
        try {            
            $projects = Project::query()->where('user_id', $id)->get();

            if(!$projects && count($projects)>0){
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Projects not found'
                    ],
                   400
                );
            }

            return response()->json(
                [
                    'success' => true,
                    'message' => 'View all projects from this user',
                    'data' => $projects
                ],
               200
            );
           
        } catch (\Exception $exception){
            Log::error('Error to views all projects'. $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error you cant see all projects'                    
                ],
               404
            );
        };
    }

    public function get($projectId){
        try {            
            $project = Project::query()->find($projectId);

            if(!$project){
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Project not found'
                    ],
                   400
                );
            }

            return response()->json(
                [
                    'success' => true,
                    'message' => 'View project by ID',
                    'data' => $project
                ],
               200
            );
           
        } catch (\Exception $exception){
            Log::error('Error to view this project'. $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to view this project'                    
                ],
               404
            );
        };
    }

    public function update(Request $request, $projectId){
        try {
            $project = Project::query()->find($projectId);

            switch(true){
                case $request->has('title'): 
                    $project->title = $request->input('title');

                case $request->has('description'):
                    $project->description = $request->input('description');

                case $request->has('images'):
                    $project->images = $request->input('images');

                case $request->has('files'):
                    $project->files = $request->input('files');

                case $request->has('tags'):
                    $project->tags = $request->input('tags');
                    
                default:
                    break;
            }

            $project->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'project updated successfully',
                    'data' => $project
                ],
               200
            );      

        }catch (\Exception $exception) {
            Log::error('Error to update this project'. $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to update this project'
                ],
               400
            );
        };
                       
    }

    public function delete($projectId){
        try {
            $project = Project::query()->find($projectId);
            Log::info('que contiene project' . $project);
            $projectName = $project->title;
            $project->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Project deleted',
                    'title' => $projectName
                ],
               200
            );

        } catch (\Exception $exception){
            Log::error('Error to delete this project'. $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to delete this project',
                    'id' => $projectId                    
                ],
               404
            );
        };
    }

    public function like($projectId){
        try {
            $user = auth()->user();
            $likeExist = Like::query()->where('user_id', $user->id)->where('project_id', $projectId)->get();
           
            if(count($likeExist) > 0){
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'User has already liked this project'
                    ],
                    400
                );
            }
            $project = Project::find($projectId);
            $project->likes = $project->likes + 1;
            $project->save();
                        
            $like = new Like();
            $like->user_id = $user->id;
            $like->project_id = $projectId;
            $like->save();

            
            return response()->json(
                [
                    'success' => true,
                    'message' => 'User has liked this project'
                ],
                200
            );

        } catch (\Exception $exception){
            Log::error('Error to put like this project'. $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to put a like in this project'                             
                ],
               404
            );
        }
    }

    public function getLikes($projectId){
        try {
            $likes = Like::query()->where('project_id', $projectId)->get();
            $numberLikes = count($likes);
            
            return response()->json(
                [
                    'success' => true,
                    'message' => 'All likes from this project',
                    'count' => $numberLikes,
                ],
                200
            );

        } catch (\Exception $exception){
            Log::error('Error to get likes'. $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to get likes'                             
                ],
               404
            );
        }
    }

    public function deleteLike($projectId){
        try {
            $user = auth()->user();
            $likeExist = Like::query()->where('user_id', $user->id)->where('project_id', $projectId)->get();

            if(count($likeExist) == 0){
               return response()->json(
                    [
                        'success' => false,
                        'message' => 'No likes found'
                    ],
                    404
                );
            }

            $likeId = $likeExist[0]->id;
            Like::query()->find($likeId)->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'like deleted'
                ],
                200
            );
            
        }catch (\Exception $exception){
            Log::error('Error to remove like'. $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to remove like'                             
                ],
               404
            );
        }

    }

    public function getByNum($num){
        try {
            $project = Project::all()->take($num);
        
        return response()->json(
            [
                'success' => true,
                'message' => 'you can get your number of projects',
                'data' => $project
            ],
            200
        );

        }catch (\Exception $exception){
            Log::error('Error get projects'. $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to get projects by num'                             
                ],
               404
            );
        }
    }

    public function getbylikes($projectId,$num){
        try {
            $likes = Like::all()->where('project_id',$projectId)->take($num);

        return response()->json(
            [
                'success' => true,
                'message' => 'you can get your number of likes',
                'data' => $likes
            ],
            200
        );

        }catch (\Exception $exception){
            Log::error('Error getting likes'. $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to get likes by num'                             
                ],
               404
            );
        }
    }    

    public function addView($projectId){
        $project = Project::find($projectId);
        $project->views = $project->views + 1;
        $project->save();
    }

    public function getByName($title){
        try {
            $projects = Project::query()->where('title',$title)->get();

            if(!$projects && count($projects)>0){
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Projects not found'
                    ],
                   400
                );
            }

            return response()->json(
                [
                    'success' => true,
                    'message' => 'View all projects from this user',
                    'data' => $projects
                ],
               200
            );
        }catch (\Exception $exception){
            Log::error('Error getting projects'. $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to getting projects'                             
                ],
               404
            );
        }
    }
}
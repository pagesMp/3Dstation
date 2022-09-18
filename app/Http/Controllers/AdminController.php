<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function deleteProject($projectId){        
        try {
            $project = Project::query()->find($projectId);
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
        } catch (\Exception $exception) {
            Log::error('Error to delete this project'. $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to delete this project',
                    'id' => $projectId                    
                ],
               404
            );
        }
    }

    public function deleteUser($userId){
        try {
            $user = User::query()->find($userId);            
            $user->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'User deleted',
                    'user' => $user
                ],
               200
            );

        } catch (\Exception $exception) {
            Log::error('Error to delete this user'. $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to delete this user',
                    'id' => $userId                   
                ],
               404
            );
        }
    }
}

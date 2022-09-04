<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function create(Request $request, $id){
        try {
            $user = auth()->user();
            $text = $request->input('text');

            $message = new Message();
            $message->sender_id = $user->id;
            $message->target_id = intval($id);
            $message->text = $text;
            $message->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'message created',
                    'message' => $message,
                ],
                200
            );                        

        } catch (\Exception $exception) {
            Log::error('Error cant create this message ' . $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'You cant create a message',
                ],
                400
            );
        }        
    }

    public function getAll($id){
        try {
            $user = auth()->user();
            $messages = Message::query()->where('sender_id', $user->id)->where('target_id', $id)->orderBy('id', 'ASC')->get(['text', 'created_at']);

            return response()->json(
                [
                    'success' => true,
                    'messages' => $messages,
                ], 
               200
            );

        } catch (\Exception $exception) {
            Log::error('Error cant view this message ' . $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'You cant get this messages',
                ],
                400
            );
        }
    }
}

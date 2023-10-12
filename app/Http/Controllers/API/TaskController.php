<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index($user_id)
    {
        return Task::where('user_id',$user_id)->get();
    }
    public function store(TaskRequest $request)
    {
        $user = Task::create([
            'task_title' => $request->task_title,
            'task_description' => $request->task_description,
            'is_don' => $request->is_don,
            'user_id' => $request->user_id,
        ]);


        $response = [
            'success' => true,
            'message' => 'Task Registred Successfully'
        ];

        return response()->json($response);


    }
    public function update(Request $request, $id)
    {
        $exist = Task::find($id);

        if ($exist) {
            $exist->is_done = $request->is_done ? 0 : 1;
            $exist->save();
            return $exist;
        }
        return 'item not found';
    }
    public function destroy($id)
    {
        $exist = Task::find($id);
        if ($exist) {
            $exist->delete();
            return "item successfully deleted";
        } else {
            return 'item not found';
        }
    }
}

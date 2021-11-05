<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Resources\Todos as TodosResource;
use App\Http\Resources\Todo as TodoResource;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $todos = Todo::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();

        return new TodosResource($todos);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function todo($request, $user) {
        $todo = Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $user->id
        ]);
        \App\Events\LogProcessed::dispatch($todo, 'POST');
        return $todo;
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        $user = \Auth::user();
        $todos = Todo::where('user_id','=', $user->id)->get();

        $status = "error";
        $message = "";
        $data = null;
        $code = 400;
        if($validator->fails()) {
            $errors = $validator->errors();
            $message = $errors;
        } else {
            if($user->type === 'FREE') {
                if(count($todos) <= 4) {
                    $new_todo = $this->todo($request, $user);
                    if($new_todo) {
                        $status = 'success';
                        $message = 'Create successfull';
                        $data = $new_todo->toArray();
                        $code = 201;
                    } else {
                        $message = 'Failed to created';
                    }
                } else {
                    $message = 'You have reached the limit';
                    $code = 401;
                }
                return response()->json([
                    'status' => $status,
                    'code' => $code,
                    'message' => $message,
                    'data' => $data
                ],$code);
            } else {
                $new_todo = $this->todo($request, $user);
                if($new_todo) {
                    $status = 'success';
                    $message = 'Create successfull';
                    $data = $new_todo->toArray();
                    $code = 201;
                } else {
                    $message = 'Failed to created';
                }
                return response()->json([
                    'status' => $status,
                    'code' => $code,
                    'message' => $message,
                    'data' => $data
                ],$code);
            }
        }
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ],$code);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \Auth::user();
        $todo = Todo::where('id', $id)->where('user_id', $user->id)->first();

        return new TodoResource($todo);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = \Auth::user();
        $todo = Todo::where('user_id', $user->id)->where('id', $id)->firstOrFail();
        
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required'
        ]);

        $status = "error";
        $message = "";
        $data = null;
        $code = 400;

        if($validator->fails()) {
            $errors = $validator->errors();
            $message = $errors;
        } else {
            $todo->title = $request->title;
            $todo->description = $request->description;
            $todo->save();
            \App\Events\LogProcessed::dispatch($todo, 'UPDATE');
            $status = 'success';
            $message = 'update successfull';
            $data = $todo;
            $code = 201;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        \App\Events\LogProcessed::dispatch($todo, 'DELETE');
        $todo->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'success deleted',
            'data' => $todo
        ]);
    }

    public function getLogs() {

        $logs = \DB::table('todo_history as history')
        ->leftJoin('users', function($join) {
            $join->on('history.user_id', '=', 'users.id');
        })
        ->leftJoin('todos', function($join) {
            $join->on('history.todo_id', '=', 'todos.id');
        })
        ->select('history.*', 'todos.title','todos.description', 'users.name as userName')
        ->get();
        return response()->json([
            'status' => 'success',
            'message' => 'success',
            'data' => $logs 
        ], 200);
    }

    public function setReminder(Request $request, $id) {
        $user = \Auth::user();
        $todo = Todo::where('user_id', $user->id)->where('id', $id)->firstOrFail();

        $status = "error";
        $message = "";
        $data = null;
        $code = 400;
        
        $todo->reminder = ($request->reminder);
        $todo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'success',
            'data' => $todo->reminder
        ], 200);
    }
}

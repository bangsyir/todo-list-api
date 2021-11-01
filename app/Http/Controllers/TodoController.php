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
        $todos = Todo::where('user_id', $user->id)->get();

        return new TodosResource($todos);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function todo($request, $user) {
        return Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $user->id
        ]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'user_id' => 'required'
        ]);

        $user = \Auth::user();
        $todos = Todo::where('user_id','=', $user->id)->get();

        $status = "error";
        $message = "";
        $data = null;
        $code = 401;
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
                    $code = 200;
                }
                return response()->json([
                    'status' => $status,
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
                    'message' => $message,
                    'data' => $data
                ],$code);
            }
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ],200);
        
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
        $todo->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'success deleted',
            'data' => $todo
        ]);
    }
}

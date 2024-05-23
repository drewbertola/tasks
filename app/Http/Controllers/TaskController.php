<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Mauricius\LaravelHtmx\Http\HtmxRequest;

class TaskController extends Controller
{
    public function index(HtmxRequest $request, $hideCompleted = 'show')
    {
        $tasks = [];

        if (! empty(Auth::user())) {
            if ($hideCompleted === 'hide') {
                $tasks = Task::whereIn('status', ['new', 'started'])->get();
            } else {
                $tasks = Task::all();
            }
        }

        return view('index', [
            'isHtmxRequest' => $request->isHtmxRequest(),
            'tasks' => $tasks,
            'hideCompleted' => $hideCompleted,
        ]);

    }

    public function form(HtmxRequest $request, $taskId = 0)
    {
        // handle requests from timed out logins
        if (empty(Auth::user())) {
            return redirect('/');
        }

        if (empty($taskId)) {
            $task = [
                'id' => 0,
                'userId' => 0,
                'task' => '',
                'status' => 'new',
            ];
        } else {
            $task = Task::find($taskId);
        }

        $users = User::orderBy('name')->get();

        return view('taskForm', [
            'isHtmxRequest' => $request->isHtmxRequest(),
            'task' => $task,
            'users' => $users,
        ]);
    }

    public function save(HtmxRequest $request, $taskId = 0)
    {
        // handle requests from timed out logins
        if (empty(Auth::user())) {
            return redirect('/');
        }

        if (empty($request->input('task'))) {
            return view('saveResult', [
                'isHtmxRequest' => $request->isHtmxRequest(),
                'message' => 'The task field is required.',
            ]);
        }

        $data = [
            'userId' => $request->input('userId'),
            'task' => $request->input('task'),
            'status' => $request->input('status'),
        ];

        if (empty($taskId)) {
            Task::create($data);
        } else {
            $task = Task::find($taskId);
            $task->update($data);
        }

        return response(
            view('saveResult', [
                'message' => 'success'
            ]), 200, ['HX-Redirect' => '/']
        );


    }

    public function delete(HtmxRequest $request, $taskId)
    {
        // handle requests from timed out logins
        if (empty(Auth::user())) {
            return redirect('/');
        }

        Task::destroy($taskId);

        return response(
            view('result', [
                'message' => 'success'
            ]), 200, ['HX-Redirect' => '/']
        );

    }
}

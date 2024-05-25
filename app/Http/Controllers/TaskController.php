<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Mauricius\LaravelHtmx\Http\HtmxRequest;

class TaskController extends Controller
{
    public function list(HtmxRequest $request, $by = '', $dir = '')
    {
        $tasks = [];

        if (! empty(Auth::user())) {
            $query = Task::where([
                ['id', '>', 0],
            ]);

            if (! empty($by)) {
                if ($dir === 'desc') {
                    $query->orderByDesc($by);
                } else {
                    $query->orderBy($by);
                }
            }

            $tasks = $query->get();
        }

        $tasks = $query->get();

        return view('taskList', [
            'isHtmxRequest' => $request->isHtmxRequest(),
            'tasks' => $tasks,
            'route' => '/',
            'by' => $by,
            'dir' => $dir,
        ]);
    }

    public function wrote(HtmxRequest $request, $by = '', $dir = '')
    {
        $tasks = [];

        if (! empty(Auth::user())) {
            $query = Task::where([
                ['authorId', '=', Auth::id()],
            ]);

            if (! empty($by)) {
                if ($dir === 'desc') {
                    $query->orderByDesc($by);
                } else {
                    $query->orderBy($by);
                }
            }

            $tasks = $query->get();
        }

        return view('taskList', [
            'isHtmxRequest' => $request->isHtmxRequest(),
            'tasks' => $tasks,
            'route' => '/wrote/',
            'by' => $by,
            'dir' => $dir,
        ]);
    }

    public function own(HtmxRequest $request, $by = '', $dir = '')
    {
        $tasks = [];

        if (! empty(Auth::user())) {
            $query = Task::where([
                ['ownerId', '=', Auth::id()],
            ]);

            if (! empty($by)) {
                if ($dir === 'desc') {
                    $query->orderByDesc($by);
                } else {
                    $query->orderBy($by);
                }
            }

            $tasks = $query->get();
        }

        return view('taskList', [
            'isHtmxRequest' => $request->isHtmxRequest(),
            'tasks' => $tasks,
            'route' => '/own/',
            'by' => $by,
            'dir' => $dir,
        ]);
    }

    public function view(HtmxRequest $request, $taskId)
    {
        // handle requests from timed out logins
        if (empty(Auth::user())) {
            return redirect('/');
        }

        $task = Task::find($taskId);

        return view('taskView', [
            'isHtmxRequest' => $request->isHtmxRequest(),
            'task' => $task,
        ]);
    }

    public function form(HtmxRequest $request, $taskId = 0)
    {
        if (empty($_SERVER['HTTP_REFERER'])) {
            $referrer = '/';
        } else {
            $referrer = parse_url($_SERVER['HTTP_REFERER'])['path'];
        }

        // handle requests from timed out logins
        if (empty(Auth::user())) {
            return redirect('/');
        }

        if (empty($taskId)) {
            $task = [
                'id' => 0,
                'authorId' => Auth::id(),
                'ownerId' => 0,
                'task' => '',
                'status' => '1',
                'priority' => '3',
            ];
        } else {
            $task = Task::find($taskId);
        }

        $users = User::orderBy('name')->get();

        return view('taskForm', [
            'isHtmxRequest' => $request->isHtmxRequest(),
            'task' => $task,
            'users' => $users,
            'referrer' => $referrer,
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
            'authorId' => Auth::id(),
            'ownerId' => $request->input('ownerId'),
            'task' => strip_tags(trim($request->input('task'))),
            'status' => strip_tags(trim($request->input('status'))),
            'priority' => strip_tags(trim($request->input('priority'))),
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
            ]), 200, ['HX-Redirect' => $request->input('referrer')]
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
            ]), 200, ['HX-Refresh' => 'true']
        );

    }
}

<x-layout :isHtmxRequest=$isHtmxRequest>
    <div>
        @guest
            <x-login />
        @endguest

        @auth
            @if (empty($task['id']))
                <p>Create a Task</p>
            @else
                <p>Update a Task</p>
            @endif
            <p id="saveResult" class="text-danger text-center"></p>
            <form class="clearfix col-md-8 mx-auto">
                @csrf
                <div class="mx-auto mb-4">
                    <label class="form-label" for="task-task">Task</label>
                    <input class="form-control mb-2"
                        type="text"
                        id="task-task"
                        name="task"
                        placeholder="Describe the task..."
                        value="{{ $task['task'] }}" />
                </div>
                <label for="parent">Owner</label>
                <select class="form-control form-select mb-4" name="ownerId" id="owner">
                    @foreach ($users as $user)
                        <option value="{{ $user['id'] }}"
                            @if ($task['ownerId'] === $user['id'])
                                selected
                            @endif
                        >{{ $user['name'] }}</option>
                    @endforeach
                </select>
                <label for="status">Status</label>
                <select class="form-control form-select mb-4" name="status" id="status">
                    <option value="new"
                        @if($task['status'] === 'new')
                            selected
                        @endif
                    >New</option>
                    <option value="started"
                        @if($task['id'] === 0)
                            disabled
                        @endif
                        @if($task['status'] === 'started')
                            selected
                        @endif
                    >Started</option>
                    <option value="completed"
                        @if($task['id'] === 0)
                            disabled
                        @endif
                        @if($task['status'] === 'completed')
                            selected
                        @endif
                    >Completed</option>
                </select>

                <div class="mx-auto">
                    <button class="btn btn-primary float-end"
                        hx-post="/save/{{ $task['id'] }}"
                        hx-target="#saveResult"
                    >Save</button>
                </div>
            </form>
        @endauth
    </div>
</x-layout>

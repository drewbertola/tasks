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
            <form id="taskForm" class="clearfix col-md-8 mx-auto">
                @csrf
                <input id="referrer" type="hidden" name="referrer" value="{{ $referrer }}" />
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
                <label for="priority">Priority</label>
                <select class="form-control form-select mb-4" name='priority' id='priority'>
                    <option value="1"
                        @if($task['priority'] === '1')
                            selected
                        @endif
                    >Urgent</option>
                    <option value="2"
                        @if($task['priority'] === '2')
                            selected
                        @endif
                    >High</option>
                    <option value="3"
                        @if($task['priority'] === '3')
                            selected
                        @endif
                    >Normal</option>
                    <option value="4"
                        @if($task['priority'] === '4')
                            selected
                        @endif
                    >Low</option>
                </select>
                <label for="status">Status</label>
                <select class="form-control form-select mb-4" name="status" id="status">
                    <option value="1"
                        @if($task['status'] === '1')
                            selected
                        @endif
                    >New</option>
                    <option value="2"
                        @if($task['id'] === 0)
                            disabled
                        @endif
                        @if($task['status'] === '2')
                            selected
                        @endif
                    >Started</option>
                    <option value="3"
                        @if($task['id'] === 0)
                            disabled
                        @endif
                        @if($task['status'] === '3')
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

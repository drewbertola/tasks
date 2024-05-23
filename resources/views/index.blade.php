@section("title", "Admin")

<x-layout :isHtmxRequest=$isHtmxRequest>
    @guest
        <x-login />
    @endguest

    @auth
        <div class="mx-auto mt-4">
            <div class="clearfix">
                <p class="float-start me-4">Tasks</p>
                <div class="form-check form-check-inline form-switch ml-5">
                    <input class="form-check-input mr-3"
                        id="hideCompleted"
                        type="checkbox"
                        hx-trigger="click"
                        hx-get="/{{ $hideCompleted === 'hide' ? 'show' : 'hide' }}"
                        hx-target="#content"
                        @if ($hideCompleted === 'hide')
                            checked
                        @endif
                    />
                    <label class="form-check-label" for="hideCompleted">Hide Completed</label>
                </div>

                <a href="" class="float-end"
                    hx-get="/view/0"
                    hx-target="#content"
                    hx-push-url="true"
                    title="Add Task"
                ><span class="bi bi-file-earmark-plus-fill"></span></a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mx-auto sortableParent" id="menuTable">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Owner</th>
                            <th class="text-center">Task</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @empty($tasks)
                            <tr>
                                <td class="text-center" colspan="5">No tasks yet!</td>
                            </tr>
                        @endempty
                        @foreach($tasks as $task)
                            <x-taskRow :task=$task />
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endauth
</x-layout>
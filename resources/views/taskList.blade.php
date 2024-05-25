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
                        id="showCompleted"
                        type="checkbox"
                        onclick="task.toggleShowCompleted()"
                    />
                    <label class="form-check-label" for="showCompleted">Show Completed</label>
                </div>

                <a href="" class="float-end"
                    hx-get="/edit/0"
                    hx-target="#content"
                    hx-push-url="true"
                    title="Add Task"
                ><span class="bi bi-file-earmark-plus-fill fs-4"></span></a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mx-auto mb-5" id="taskTable">
                    <thead>
                        <tr>
                            <th>Owner</th>
                            <th class="text-center nowrap"
                                hx-trigger="click"
                                hx-target="#content"
                                @if ($dir === 'asc')
                                    hx-get="{{ $route }}priority/desc"
                                @else
                                    hx-get="{{ $route }}priority/asc"
                                @endif
                            >Priority <span class="bi bi-arrow-down-up fs-6"></span></th>
                            <th class="nowrap"
                                hx-trigger="click"
                                hx-target="#content"
                                @if ($dir === 'asc')
                                    hx-get="{{ $route }}task/desc"
                                @else
                                    hx-get="{{ $route }}task/asc"
                                @endif
                            >Task <span class="bi bi-arrow-down-up fs-6"></span></th>
                            <th class="nowrap"
                                hx-trigger="click"
                                hx-target="#content"
                                @if ($dir === 'asc')
                                    hx-get="{{ $route }}status/desc"
                                @else
                                    hx-get="{{ $route }}status/asc"
                                @endif
                            >Status <span class="bi bi-arrow-down-up fs-6"></span></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @empty($tasks)
                            <tr>
                                <td class="text-center" colspan="5">No tasks found!</td>
                            </tr>
                        @endempty
                        @foreach($tasks as $task)
                            <x-taskRow :task=$task />
                        @endforeach
                    </tbody>
                    <tfooter>
                        <tr>
                            <th class="fw-normal text-center" colspan="5">Priority Key:
                                <span class="bi bi-circle-fill text-danger ms-3"></span>&nbsp;Urgent
                                <span class="bi bi-circle-fill text-success ms-3"></span>&nbsp;High
                                <span class="bi bi-circle-fill text-primary ms-3"></span>&nbsp;Normal
                                <span class="bi bi-circle-fill text-secondary ms-3"></span>&nbsp;Low
                            </th>
                        </tr>
                    </tfooter>
                </table>
            </div>
        </div>
    @endauth
</x-layout>
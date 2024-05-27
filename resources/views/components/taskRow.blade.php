<tr @class(['dataRow', 'd-none' => $task['status'] === '3'])>
    <td>{{ $task->owner->name }}</td>
    <td class="text-center">
        <span @class([
            'bi',
            'bi-circle-fill',
            'fs-6',
            'text-danger' => $task['priority'] === '1',
            'text-success' => $task['priority'] === '2',
            'text-primary' => $task['priority'] === '3',
            'text-secondary' => $task['priority'] === '4',
            ])</span>
    <td class="fw-bold">
        <a href="" class="text-dark"
            hx-get="/view/{{ $task['id'] }}"
            hx-target="#content"
            hx-push-url="true"
        >{{ $task->task }}</a>
    </td>
    @php
        switch ($task['status']) {
            case '1': $status = 'New'; break;
            case '2': $status = 'Started'; break;
            case '3': $status = 'Completed'; break;
            default: $status = '???';
        };
    @endphp
    <td @class([
        'status',
        'text-capitalize',
        'fw-bold',
        'text-danger' => $task['status'] === '1',
        'text-primary' => $task['status'] === '2',
        'text-success' => $task['status'] === '3',
    ])>{{ $status }}</td>
    <td class="text-center pt-0">
        <div class="dropdown">
            <a href="#" class="fw-bold text-dark link-underline-light fs-4 pb-2" role="button" data-bs-toggle="dropdown">
                <span class="bi bi-three-dots-vertical fs-6"></span>
            </a>
            <ul class="dropdown-menu">
                <a href="" class="link-underline-light"
                    hx-get="/edit/{{ $task['id'] }}"
                    hx-target="#content"
                    hx-push-url="true">
                    <li class="dropdown-item text-primary">Edit Task</li>
                </a>
                    <a href="" class="link-underline-light"
                        hx-get="/delete/{{ $task['id'] }}"
                        hx-trigger='confirmed'
                        onClick="
                            event.preventDefault();
                            Swal.fire({
                                title: 'Really, delete?',
                                text: 'Are you sure you want to delete this task?',
                                showDenyButton: true,
                                confirmButtonText: 'Yes',
                                denyButtonText: 'No',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    htmx.trigger(this, 'confirmed');
                                    Swal.fire('Task deleted!', '', 'success')
                                } else if (result.isDenied) {
                                    Swal.fire('Task not deleted!', '', 'info')
                                }
                            });">
                        <li class="dropdown-item text-danger">Delete Task</li>
                    </a>
                </li>
            </ul>
        </div>
    </td>
</tr>
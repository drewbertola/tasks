
<tr>
    <td>{{ $task->owner->name }}</td>
    <td class="fw-bold">
        <a href="" class="text-dark"
            hx-get="/view/{{ $task['id'] }}"
            hx-target="#content"
            hx-push-url="true"
        >{{ $task->task }}</a>
    </td>
    <td @class([
        'text-capitalize',
        'fw-bold',
        'text-danger' => $task['status'] === 'new',
        'text-primary' => $task['status'] === 'started',
        'text-success' => $task['status'] === 'completed',
    ])>{{ $task->status }}</td>
    <td class="text-center">
        <div class="dropdown">
            <a href="#" class="dropxdown-toggle fw-bold fs-6 link-underline-light" role="button" data-bs-toggle="dropdown">
                &hellip;
            </a>
            <ul class="dropdown-menu">
                <a href="" class="text-dark link-underline-light"
                    hx-get="/edit/{{ $task['id'] }}"
                    hx-target="#content"
                    hx-push-url="true">
                    <li class="dropdown-item">Edit Task</li>
                </a>
                    <a href="" class="text-dark link-underline-light"
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
                        <li class="dropdown-item">Delete Task</li>
                    </a>
                </li>
            </ul>
        </div>
    </td>
</tr>
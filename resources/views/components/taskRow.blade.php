
<tr>
    <td class="text-right">#{{ $task->id }}</td>
    <td class="fw-bold">{{ $task->task }}</td>
    <td @class([
        'text-center',
        'text-capitalize',
        'fw-bold',
        'text-primary' => $task['status'] === 'new',
        'text-warning' => $task['status'] === 'started',
        'text-secondary' => $task['status'] === 'completed',
    ])>{{ $task->status }}</td>
    <td class="text-center">
        <a href=""
            hx-get="/view/{{ $task['id'] }}"
            hx-target="#content"
            hx-push-url="true"
            title="Edit Task"
        >
            <span class="bi bi-pencil-fill text-success"></span>
        </a>
    </td>
    <td class="text-center">
        <a href=""
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
                });
            "
            title="Delete Task"
        >
            <span class="bi bi-trash-fill text-danger"></span>
        </a>
    </td>
</tr>
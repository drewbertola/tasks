<x-layout :isHtmxRequest=$isHtmxRequest>
    <div>
        @guest
            <x-login />
        @endguest

        @auth
            <p>View Task</p>
            <div class="col-md-8 mx-auto mt-4">
                <p class="font-light fst-italic mb-0">Task</p>
                <p class="fw-bold fs-5">{{ $task->task }}</p>
                <p class="font-light fst-italic mb-0">Owner</p>
                <p class="fs-5">{{ $task->owner->name }}</p>
                <p class="font-light fst-italic mb-0">Author</p>
                <p class="fs-5">{{ $task->author->name }}</p>
                <p class="font-light fst-italic mb-0">Status</p>
                <p @class([
                    'fs-5',
                    'fw-bold',
                    'text-capitalize',
                    'text-danger' => $task->status === 'new',
                    'text-primary' => $task->status === 'started',
                    'text-success' => $task->status === 'completed',
                    ])>{{ $task->status }}</p>
                <p class="font-light fst-italic mb-0">Created</p>
                <p class="fs-5">{{ $task->created_at }}</p>
            </div>
        @endauth
    </div>
</x-layout>

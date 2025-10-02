@props(['state', 'title' => 'Website Redesign Project', 'url' => '#', 'taskId' => null])

<a href="{{ $url }}" data-task-url="{{ $url }}" data-task-id="{{ $taskId }}"
    class="task-item block border-b border-gray-100 hover:bg-gray-50 transition-colors cursor-pointer">
    <div class="flex items-center gap-3 px-6 py-4">
        <!-- Status Icon -->
        <div class="flex-shrink-0">
            @if ($state === 'done')
                <div class="w-4 h-4 bg-green-500 rounded-full flex items-center justify-center">
                    <svg class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            @elseif ($state === 'in_progress')
                <div class="w-4 h-4 bg-yellow-500 rounded-full flex items-center justify-center">
                    <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                </div>
            @else
                <div class="w-4 h-4 bg-red-500 rounded-full"></div>
            @endif
        </div>

        <!-- Task Info -->
        <div class="flex-1 min-w-0">
            <p
                class="text-lg truncate {{ $state === 'done' ? 'text-gray-600 line-through' : 'text-gray-800 font-medium' }}">
                {{ $title }}
            </p>
            <p
                class="text-sm font-medium {{ $state === 'done' ? 'text-green-600' : ($state === 'in_progress' ? 'text-yellow-600' : 'text-red-600') }}">
                {{ $state === 'in_progress' ? 'In Progress' : ucfirst($state) }}
            </p>
        </div>
    </div>
</a>

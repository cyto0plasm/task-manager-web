@props(['state', 'title' => 'no title', 'url' => '#', 'taskId' => null])

<li
    {{ $attributes->merge([
        'data-id' => $taskId,
        'data-task-url' => $url,
        'class' => 'task-item block border-b border-gray-100 hover:bg-gray-50 transition-colors cursor-move',
    ]) }}>
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
                <x-svg.pending></x-svg.pending>
            @else
                <x-svg.pending></x-svg.pending>
            @endif
        </div>

        <!-- Task Info -->
        <div class="flex-1 min-w-0">
            <p class="text-lg truncate {{ $state === 'done' ? 'text-gray-600' : 'text-gray-800 font-medium' }}">
                {{ $title }}
            </p>
            <p
                class="text-sm font-medium {{ $state === 'done' ? 'text-green-600' : ($state === 'in_progress' ? 'text-yellow-600' : 'text-red-600') }}">
                {{ $state === 'in_progress' ? 'In Progress' : ucfirst($state) }}
            </p>
        </div>

        <div class=" shadow-sm p-2 bg-transparent ">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22">
                <defs>
                    <linearGradient id="grayGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#6B7280" />
                        <stop offset="50%" stop-color="#9CA3AF" />
                        <stop offset="100%" stop-color="#D1D5DB" />
                    </linearGradient>
                </defs>
                <!-- Main X -->
                <path d="M18 6L6 18M6 6L18 18" fill="none" stroke="#9CA3AF" stroke-width="2"
                    stroke-linecap="round" />
            </svg>
        </div>
    </div>

</li>

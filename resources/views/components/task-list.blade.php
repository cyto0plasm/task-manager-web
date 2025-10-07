    @props(['tasks' => collect(), 'taskStatusDoneCount', 'taskStatusProgressCount', 'taskStatusPendingCount'])
    {{-- @dd($tasks) --}}
    <!-- Tasks List Panel -->
    <div id="tasksList"
        class="w-full lg:min-w-[320px] lg:w-[28rem] lg:max-w-[32rem] bg-white rounded-lg shadow-md lg:ml-[5rem]">

        <!-- Header -->
        <div class="border-b border-gray-200 px-4 sm:px-6 py-3 sm:py-4">
            <h2 class="text-center text-xl sm:text-2xl font-bold text-gray-800">Tasks List</h2>

            <!-- Status Counters -->
            <div class="flex justify-center flex-wrap gap-3 sm:gap-5 mt-3 text-xs sm:text-sm text-gray-500">
                <span class="flex items-center gap-1.5">
                    <x-svg.check-mark></x-svg.check-mark> <span
                        class="text-green-500 font-bold">{{ $taskStatusDoneCount }}</span>
                    <span class="hidden md:inline">Done</span>
                    <span class="inline md:hidden"></span>
                </span>
                <span class="flex items-center gap-1.5 whitespace-nowrap">
                    <x-svg.progress class="w-2"></x-svg.progress>
                    <span class="text-yellow-500 font-bold">{{ $taskStatusProgressCount }}</span>
                    <span class="hidden md:inline">In Progress</span>
                    <span class="inline md:hidden"><x-svg.progress></x-svg.progress></span>
                </span>
                <span class="flex items-center gap-1.5">
                    <x-svg.pending></x-svg.pending> <span class="hidden md:inline">Pending</span>
                    <span class="inline md:hidden">P</span>
                </span>
            </div>
        </div>

        <!-- Tasks List -->
        <ul id="sortable-list" data-url="{{ route('tasks.reorder') }}" data-csrf="{{ csrf_token() }}"
            class="p-0 max-h-[50vh] sm:max-h-[60vh] lg:max-h-[70vh] overflow-y-auto">

            @forelse ($tasks as $task)
                <x-task-button :state="$task->status" :title="$task->title" :task-id="$task->id" :url="route('tasks.show', $task->id)" />
            @empty
                <li class="p-6 text-center text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                    <p class="text-sm sm:text-base">No tasks yet</p>
                </li>
            @endforelse
        </ul>
    </div>

    <style>
        /* Custom Scrollbar */
        #sortable-list::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        #sortable-list::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        #sortable-list::-webkit-scrollbar-thumb {
            background-color: #9ca3af;
            border-radius: 10px;
            border: 2px solid #f1f1f1;
        }

        #sortable-list::-webkit-scrollbar-thumb:hover {
            background-color: #4b5563;
        }

        /* Mobile optimizations */
        @media (max-width: 640px) {
            #sortable-list::-webkit-scrollbar {
                width: 4px;
            }
        }

        /* Smooth scroll on mobile */
        #sortable-list {
            -webkit-overflow-scrolling: touch;
            scroll-behavior: smooth;
        }
    </style>
    <style>
        .task-item.active {
            background-color: #eef2ff;
            /* soft indigo background */
            border-left: 4px solid #10B981;
            /* Tailwind indigo-500 */
        }
    </style>
    <script src="{{ asset('js/tasks/switchTask.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script src="{{ asset('js/tasks/sortableTasks.js') }}"></script>

<!-- Task Detail Panel -->

<div class="flex-1 bg-white rounded-lg shadow-md p-6 h-fit min-h-[24rem]">
    <div id="taskDetail">
        <!-- Default state showing the "In Progress" task -->
        <div class="flex items-center gap-3 mb-4">
            <div class="w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center">
                <div class="w-3 h-3 bg-white rounded-full animate-pulse"></div>
            </div>
            <span class="task-state px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-medium rounded-full">In
                Progress</span>
        </div>

        <h1 class="task-title text-3xl font-bold text-gray-800 mb-4">API Integration Development</h1>

        <div class="prose max-w-none">
            <p class="task-description text-gray-600 text-lg leading-relaxed mb-6">
                Integrate third-party payment API into the e-commerce platform. Need to handle authentication,
                error handling, and implement proper security measures.
            </p>

            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Task Details</h3>
                <ul class="space-y-2 text-gray-600">
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                        Priority:<span class="task-priority">High</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                        Estimated time:<span class="task-time">3-4 days</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                        Assigned to:<span class="task-assigned">Development Team</span>
                    </li>
                </ul>
            </div>

            <div class="flex gap-3">
                <button
                    class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-200">
                    Mark Complete
                </button>
                <button
                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                    Edit Task
                </button>
            </div>
        </div>
    </div>
</div>

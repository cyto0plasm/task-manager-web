{{-- resources/views/components/create-modal.blade.php --}}

@props([
    'taskAction' => route('tasks.store'),
    'projectAction' => route('projects.store'),
])

<div x-data="{
    taskOpen: false,
    projectOpen: false,
    menuOpen: false
}" @keydown.escape.window="taskOpen = false; projectOpen = false; menuOpen = false">

    {{-- Floating Action Button --}}
    <div class="fixed bottom-8 right-8 z-50">
        {{-- Options Menu --}}
        <div x-show="menuOpen" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-2"
            class="absolute bottom-20 right-0 flex flex-col gap-3 mb-2">
            <button @click="projectOpen = true; menuOpen = false"
                class="flex items-center gap-3 bg-white text-gray-700 px-5 py-3 rounded-full shadow-lg hover:shadow-xl hover:bg-gray-50 transition-all whitespace-nowrap font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#6b3eea]" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                </svg>
                New Project
            </button>

            <button @click="taskOpen = true; menuOpen = false"
                class="flex items-center gap-3 bg-white text-gray-700 px-5 py-3 rounded-full shadow-lg hover:shadow-xl hover:bg-gray-50 transition-all whitespace-nowrap font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#6b3eea]" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                New Task
            </button>
        </div>

        {{-- Main FAB Button --}}
        <button @click="menuOpen = !menuOpen" :class="menuOpen ? 'rotate-45' : ''"
            class="bg-[#6b3eea] text-white p-4 rounded-full shadow-xl hover:bg-[#6935f7] hover:shadow-2xl active:bg-[#6335e0] transition-all duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </button>
    </div>

    {{-- Task Modal --}}
    <div x-show="taskOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="display: none;">
        {{-- Overlay --}}
        <div x-show="taskOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="taskOpen = false"
            class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

        {{-- Modal Content --}}
        <div x-show="taskOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full max-h-[85vh] overflow-hidden" @click.stop>
            {{-- Header --}}
            <div
                class="sticky top-0 bg-gradient-to-r from-[#6b3eea] to-[#8b5cf6] text-white px-6 py-5 flex items-center justify-between">
                <h2 class="text-2xl font-bold">Create New Task</h2>
                <button @click="taskOpen = false"
                    class="text-white/80 hover:text-white hover:bg-white/20 rounded-lg p-1.5 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Form --}}
            <div class="overflow-y-auto max-h-[calc(85vh-80px)]">
                <form action="{{ $taskAction }}" method="POST" class="p-6 space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Task Title</label>
                        <input type="text" name="title" placeholder="Enter task title"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#6b3eea] focus:border-transparent transition-all"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                        <textarea name="description" placeholder="Task description" rows="3"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#6b3eea] focus:border-transparent transition-all resize-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Due Date</label>
                        <input type="date" name="due_date"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#6b3eea] focus:border-transparent transition-all">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Priority</label>
                            <select name="priority"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#6b3eea] focus:border-transparent transition-all">
                                <option value="">Select</option>
                                <option value="low">🟢 Low</option>
                                <option value="medium">🟡 Medium</option>
                                <option value="high">🔴 High</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                            <select name="state"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#6b3eea] focus:border-transparent transition-all">
                                <option value="">Select</option>
                                <option value="todo">📋 To Do</option>
                                <option value="in_progress">⚡ In Progress</option>
                                <option value="done">✅ Done</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Project</label>
                        <select name="project"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#6b3eea] focus:border-transparent transition-all">
                            <option value="">Select Project</option>
                            {{-- Add your projects dynamically --}}
                        </select>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="button" @click="taskOpen = false"
                            class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all">
                            Cancel
                        </button>
                        <button type="submit"
                            class="flex-1 bg-[#6b3eea] text-white font-semibold px-6 py-3 rounded-xl hover:bg-[#6935f7] active:bg-[#6335e0] shadow-md hover:shadow-lg transition-all">
                            Create Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Project Modal --}}
    <div x-show="projectOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="display: none;">
        {{-- Overlay --}}
        <div x-show="projectOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="projectOpen = false"
            class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

        {{-- Modal Content --}}
        <div x-show="projectOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full" @click.stop>
            {{-- Header --}}
            <div
                class="bg-gradient-to-r from-[#6b3eea] to-[#8b5cf6] text-white px-6 py-5 flex items-center justify-between rounded-t-2xl">
                <h2 class="text-2xl font-bold">Create New Project</h2>
                <button @click="projectOpen = false"
                    class="text-white/80 hover:text-white hover:bg-white/20 rounded-lg p-1.5 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Form --}}
            <form action="{{ $projectAction }}" method="POST" class="p-6 space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Project Name</label>
                    <input type="text" name="name" placeholder="Enter project name"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#6b3eea] focus:border-transparent transition-all"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                    <textarea name="description" placeholder="Project description" rows="4"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#6b3eea] focus:border-transparent transition-all resize-none"></textarea>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" @click="projectOpen = false"
                        class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 bg-[#6b3eea] text-white font-semibold px-6 py-3 rounded-xl hover:bg-[#6935f7] active:bg-[#6335e0] shadow-md hover:shadow-lg transition-all">
                        Create Project
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

{{--
USAGE:
1. Add to your layout: <x-create-modal />
2. Make sure Alpine.js is installed
3. Click the floating button to see options!
--}}

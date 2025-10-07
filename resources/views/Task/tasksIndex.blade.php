@extends('layout')
@section('page-name', 'Tasks')

@section('main')
    <section id="mainSection"
        class="relative flex flex-col lg:flex-row lg:justify-start lg:items-start gap-4  md:gap-6 min-h-screen p-3 sm:p-4 md:p-6">

        <!-- Flash Message -->
        <div id="flash-message"
            class="hidden fixed top-4 left-1/2 -translate-x-1/2 px-4 py-3 rounded-lg shadow-lg text-white opacity-0 transition-opacity duration-500 z-50 max-w-[90vw] sm:max-w-md">
        </div>

        <!-- Task List Component -->
        <div class="w-full lg:w-auto lg:sticky lg:top-6">
            <x-task-list :tasks="$tasks" :taskStatusDoneCount="$taskStatusDoneCount" :taskStatusPendingCount="$taskStatusPendingCount" :taskStatusProgressCount="$taskStatusProgressCount">
            </x-task-list>
        </div>

        <!-- Task Details Component -->
        <div class="w-full lg:flex-1 lg:max-w-4xl">
            <x-task-details :tasks="$tasks" :firstTask="$firstTask" :projects="$projects">
            </x-task-details>
        </div>

        <!-- Task Modal -->
        <x-task-model :projects="$projects" />
        <x-edit-task :projects="$projects" :tasks="$tasks"></x-edit-task>
    </section>

    <style>
        /* Ensure smooth scrolling on mobile */
        @media (max-width: 1023px) {
            #mainSection {
                scroll-behavior: smooth;
            }
        }

        /* Sticky positioning for desktop */
        @media (min-width: 1024px) {
            #tasksList {
                max-height: calc(100vh - 3rem);
                overflow-y: auto;
            }
        }
    </style>
@endsection

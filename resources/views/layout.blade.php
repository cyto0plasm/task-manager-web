<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('page-name')</title>
</head>

<body
    class="bg-gray-50 font-sans text-slate-700 w-[90%] mx-auto h-screen border-l-1 border-gray-400 relative after:content[''] after:absolute after:top-[50%] after:left-0 after:w-[2px] after:h-[30px] after:bg-gradient-to-r after:from-violet-600 after:to-indigo-600">

    <!-- Gray Overlay for Mobile Search -->
    <div id="searchOverlay" class="hidden fixed inset-0 bg-black/30 z-10 transition-opacity duration-300  opacity-0">
    </div>

    <nav class="px-[20px] py-[1rem] flex items-center justify-between gap-[2rem] relative z-30">
        <!-- Mobile: Search + Burger on left -->
        <div class="flex lg:hidden items-center gap-3">
            <button id="mobileSearchBtn" class="p-2 text-gray-700 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-search" viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg>
            </button>
            <button id="mobileNavBtn" class="p-2 text-gray-700 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Logo (left on desktop, center on mobile) -->
        <a href="{{ route('dashboard') }}"
            class="absolute left-1/2 transform -translate-x-1/2 lg:relative lg:left-auto lg:transform-none">
            <img src="{{ asset('images/toDoList.png') }}" alt="To DO Logo" class="min-w-[100px] h-[40px]">
        </a>

        <!-- Desktop Search (hidden on mobile) -->
        <form id="searchContainer" method="GET"
            class="hidden lg:flex items-center w-[650px] min-w-[300px] h-[38px] rounded-sm cursor-pointer bg-gray-50 hover:bg-gradient-to-t hover:from-[#ffffff] hover:to-[#f1f1f1] transition-all duration-400 border border-gray-300 hover:border-[#e8e6e6]">
            <img src="{{ asset('images/search.svg') }}" alt="search icon"
                class="w-[38px] h-[38px] ml-2 justify-start opacity-70">
            <input type="text" id="desktopSearchBtn" name="search" placeholder="Search"
                class="w-full pl-2 bg-transparent outline-none focus:outline-none border-none focus:ring-0 font-semibold text-gray-600 placeholder-gray-600 hover:text-gray-800 transition-colors duration-200">
        </form>

        <!-- Gray Overlay for Mobile Search -->
        <div id="searchOverlay" class="hidden fixed inset-0 bg-black/30 z-10 transition-opacity duration-300 opacity-0">
        </div>
        <style>
            #mobileSearchContainer.search-open {
                opacity: 1;
                transform: translate(-50%, 0);
            }

            #searchOverlay.overlay-open {
                opacity: 1;
            }
        </style>
        <!-- Mobile search (hidden by default and on Desktop) -->
        <div id="mobileSearchContainer"
            class="hidden fixed  top-[70px] left-1/2 transform -translate-x-1/2 w-[90%] items-center rounded-lg bg-white shadow-lg border border-gray-200 z-20 lg:!hidden transition-all duration-300 opacity-0 translate-y-[-10px]">
            <div class="relative w-full">
                <!-- Search Icon -->
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>

                <!-- Search Input -->
                <input type="text" id="mobileSearchInput" name="search" placeholder="Search projects, tasks..."
                    class="w-full h-[48px] pl-10 pr-10 outline-none text-gray-700 placeholder-gray-400 bg-white rounded-lg focus:ring-2 focus:ring-[#6B3EEA]/20 focus:border-[#6B3EEA] transition-all duration-200">

                <!-- Clear Button -->
                <button id="clearSearchBtn"
                    class="hidden absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu (hidden by default) -->
        <ul id="mobileMenu"
            class="hidden lg:hidden absolute top-[65px] left-[20px] bg-white border border-gray-200 shadow-lg rounded-md py-2 px-4 z-20 w-[250px]">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="block py-2 px-3 text-[1rem] font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded {{ request()->routeIs('dashboard') ? 'text-[#FC4F3A] bg-gray-100' : '' }}">
                    Home
                </a>
            </li>

            <!-- Projects with Dropdown -->
            <li class="relative">
                <button onclick="toggleMobileDropdown('projectsDropdown')"
                    class="w-full flex items-center justify-between py-2 px-3 text-[1rem] font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded {{ request()->routeIs('projects.*') ? 'text-[#FC4F3A] bg-gray-100' : '' }}">
                    <span>Projects</span>
                    <svg class="w-4 h-4 transition-transform duration-200" id="projectsDropdownIcon" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <ul id="projectsDropdown" class="hidden pl-4 mt-1 space-y-1">
                    <li>
                        <a href="{{ route('projects.index') }}"
                            class="block py-2 px-3 text-[0.9rem] text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded {{ request()->routeIs('projects.index') ? 'text-[#FC4F3A] bg-gray-50' : '' }}">
                            View All
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('projects.create') }}"
                            class="block py-2 px-3 text-[0.9rem] text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded {{ request()->routeIs('projects.create') ? 'text-[#FC4F3A] bg-gray-50' : '' }}">
                            Create Project
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('projects.view') }}"
                            class="block py-2 px-3 text-[0.9rem] text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded {{ request()->routeIs('projects.view') ? 'text-[#FC4F3A] bg-gray-50' : '' }}">
                            Project View
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Tasks with Dropdown -->
            <li class="relative">
                <button onclick="toggleMobileDropdown('tasksDropdown')"
                    class="w-full flex items-center justify-between py-2 px-3 text-[1rem] font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded {{ request()->routeIs('tasks.*') ? 'text-[#FC4F3A] bg-gray-100' : '' }}">
                    <span>Tasks</span>
                    <svg class="w-4 h-4 transition-transform duration-200" id="tasksDropdownIcon" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>
                <ul id="tasksDropdown" class="hidden pl-4 mt-1 space-y-1">
                    <li>
                        <a href="{{ route('tasks.index') }}"
                            class="block py-2 px-3 text-[0.9rem] text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded {{ request()->routeIs('tasks.index') ? 'text-[#FC4F3A] bg-gray-50' : '' }}">
                            View All
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tasks.create') }}"
                            class="block py-2 px-3 text-[0.9rem] text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded {{ request()->routeIs('tasks.create') ? 'text-[#FC4F3A] bg-gray-50' : '' }}">
                            Create Task
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tasks.view') }}"
                            class="block py-2 px-3 text-[0.9rem] text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded {{ request()->routeIs('tasks.View') ? 'text-[#FC4F3A] bg-gray-50' : '' }}">
                            Task View
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Desktop Navigation Links -->
        <ul class="hidden lg:flex gap-6 items-center relative">
            <li>
                <x-nav-link-styled title="Dashboard" route="dashboard" />
            </li>

            <!-- Projects Dropdown -->
            <li class="relative group">
                <x-nav-link-styled title="Projects" route="projects.index" />
                <ul
                    class="absolute top-full left-0 mt-2 w-48 bg-white rounded-md shadow-lg border border-gray-200 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                    <li class="px-2">
                        <x-nav-link-styled title="Create A Project" route="projects.create" text-size="20" />
                    </li>
                    <li class="px-2">
                        <x-nav-link-styled title="Project View" route="projects.view" text-size="20" />
                    </li>
                </ul>
            </li>

            <!-- Tasks Dropdown -->
            <li class="relative group">
                <x-nav-link-styled title="Tasks" route="tasks.index" />
                <ul
                    class="absolute top-full left-0 mt-2 w-48 bg-white rounded-md shadow-lg border border-gray-200 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                    <li class="px-2">
                        <x-nav-link-styled title="Create A Task" route="tasks.create" text-size="20" />
                    </li>
                    <li class="px-2">
                        <x-nav-link-styled title="Task View" route="tasks.view" text-size="20" />
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Profile Dropdown -->
        <div class="relative flex items-center gap-2 cursor-pointer" id="profileDropdown">
            <img src="{{ asset('images/profile.png') }}" alt="profile image"
                class="max-w-[40px] h-[40px] rounded-full border-2 border-gray-300 cursor-pointer hover:border-[#FC4F3A] transition-colors duration-300">
            <svg id="arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>

            <ul id="dropdownMenu"
                class="absolute top-[120%] right-0 z-10 w-40 bg-white rounded-md shadow-lg border border-gray-200 py-2 px-4 transition-all duration-300 flex flex-col gap-1 opacity-0 invisible">
                <a href="{{ route('profile.index') }}"
                    class="flex items-center gap-2 pl-2 py-2 hover:bg-[#e2e2e2] rounded-lg transition-all duration-200 {{ request()->routeIs('profile.index') ? 'bg-[#e2e2e2] text-[#6B3EEA] font-bold' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                    </svg>
                    <span>profile</span>
                </a>
                <a href="#"
                    class="flex items-center gap-2 pl-2 py-2 hover:bg-[#e2e2e2] rounded-lg transition-all duration-200 {{ request()->routeIs('settings.index') ? 'bg-[#e2e2e2] text-[#6B3EEA] font-bold ' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-gear-fill" viewBox="0 0 16 16">
                        <path
                            d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                    </svg>
                    <span>Settings</span>
                </a>
                <li
                    class="flex items-center gap-2 pl-2 py-2 mt-2 hover:underline bg-[#ffffff] text-[#f23333] font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                        <path fill-rule="evenodd"
                            d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                    </svg>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">Log Out</a>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    @yield('main')

    <footer class="w-full bg-white border-t border-gray-100 mt-12">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div class="space-y-4">
                    <h3 class="text-xl font-bold text-gray-900">Task Manager</h3>
                    <p class="text-gray-600 text-sm leading-relaxed max-w-xs">Streamline your workflow and boost
                        productivity with our intuitive task management solution.</p>
                </div>
                <div class="space-y-4">
                    <h4 class="font-semibold text-gray-900 text-sm uppercase tracking-wide">Quick Links</h4>
                    <nav class="space-y-2">
                        <a href="#"
                            class="block text-gray-600 hover:text-gray-900 text-sm transition-colors duration-200">Dashboard</a>
                        <a href="#"
                            class="block text-gray-600 hover:text-gray-900 text-sm transition-colors duration-200">My
                            Tasks</a>
                        <a href="#"
                            class="block text-gray-600 hover:text-gray-900 text-sm transition-colors duration-200">Projects</a>
                        <a href="#"
                            class="block text-gray-600 hover:text-gray-900 text-sm transition-colors duration-200">Help
                            Center</a>
                    </nav>
                </div>
                <div class="space-y-4">
                    <h4 class="font-semibold text-gray-900 text-sm uppercase tracking-wide">Let's Connect</h4>
                    <div class="space-y-3">
                        <p class="text-gray-600 text-sm">Follow my work, connect with me</p>
                        <div class="flex gap-3">
                            <a href="https://github.com/cyto0plasm" target="_blank" rel="noopener noreferrer"
                                class="group flex items-center gap-2 px-3 py-2 bg-gray-50 hover:bg-[#24282e] text-[#24282e] hover:text-white rounded-lg transition-all duration-300"
                                aria-label="Visit GitHub profile">
                                <img src="{{ asset('images/github.svg') }}" alt="github account"
                                    class="w-4 h-4 opacity-70 group-hover:opacity-100 group-hover:brightness-0 group-hover:invert transition duration-300">
                                <span class="text-xs font-medium">GitHub</span>
                            </a>
                            <a href="https://www.linkedin.com/in/youssef-zakiz" target="_blank"
                                rel="noopener noreferrer"
                                class="group flex items-center gap-2 px-3 py-2 bg-blue-50 hover:bg-[#2e75b0] text-[#2e75b0] hover:text-white rounded-lg transition-all duration-300"
                                aria-label="Connect on LinkedIn">
                                <img src="{{ asset('images/linkedIn.svg') }}" alt="linked in account"
                                    class="w-4 h-4 opacity-70 group-hover:opacity-100 group-hover:brightness-0 group-hover:invert transition duration-300">
                                <span class="text-xs font-medium">LinkedIn</span>
                            </a>
                        </div>
                        <div class="pt-2 text-xs text-gray-500 space-y-1">
                            <p>Built with passion by <span class="font-medium text-gray-700">Yousif Zaki</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-100 pt-4">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="text-xs text-gray-500">&copy; {{ date('Y') }} Task Manager. All rights reserved.
                    </div>
                    <div class="text-xs text-gray-400 font-mono">v1.0.0</div>
                </div>
            </div>
        </div>
    </footer>


    <script src="{{ asset('js/nav_Helper.js') }}"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


</body>

</html>

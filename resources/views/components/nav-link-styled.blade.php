 <a href="{{ route($route) }}" style="font-size: {{ $textSize }}px;"
     class="inline-block px-1  font-medium text-gray-700 hover:text-gray-900 transition-colors duration-300 relative after:content-[''] after:absolute after:bottom-[-2px] after:left-0 after:w-0 after:h-[3px] after:bg-gradient-to-r after:from-violet-600 after:to-indigo-600 after:transition-all after:duration-300 after:rounded-full hover:after:w-full focus:after:w-full {{ request()->routeIs($route) ? 'after:w-full text-[#FC4F3A]' : 'after:w-0 hover:after:w-full focus:after:w-full' }}">{{ $title }}
 </a>

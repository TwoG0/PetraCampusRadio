<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-20 w-64 h-screen pt-10 transition-transform -translate-x-full bg-white dark:bg-gray-800 dark:border-gray-700"
    style="background-color: #FFBC64;" aria-label="Sidebar">
    <div class="flex flex-col  h-full px-3 pb-4 overflow-y-auto bg-white divide-y-2 divide-solid divide-slate-800 dark:bg-gray-800"
        style="background-color: #FFBC64;">
        <ul class="space-y-2 font-medium">
            <li class="text-wrap text-center text-3xl text-[#804800] font-extrabold mb-8"><span>Jerry</span> <br> <span
                    class="text-xl">Asisten-lab</span></li>
            <li>
                <a href="/" @class([
                    'flex items-center p-2 text-[#804800] rounded-lg hover:bg-gray-700 hover:text-white group',
                    ' flex items-center p-2 rounded-lg bg-gray-700 text-white' => request()->Is(
                        '/'),
                ])>
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="currentColor" @class([
                            'w-6 h-6 text-[#804800] transition duration-75 group-hover:text-white',
                            'w-6 h-6 text-white' => request()->Is('/'),
                        ]) viewBox="0 0 24 24" style="">
                        <path fill-rule="evenodd"
                            d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="ms-3">Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('song') }}" @class([
                    'flex items-center p-2 text-[#804800] rounded-lg hover:bg-gray-700 hover:text-white group',
                    ' flex items-center p-2 rounded-lg bg-gray-700 text-white' => request()->Is(
                        'song'),
                ])>
                    <svg @class([
                        'w-6 h-6 text-[#804800] transition duration-75 group-hover:text-white',
                        'w-6 h-6 text-white' => request()->Is('song'),
                    ]) aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm2.318.052h-.002A1 1 0 0 0 12 8v5.293A4.033 4.033 0 0 0 10.5 13C8.787 13 7 14.146 7 16s1.787 3 3.5 3 3.5-1.146 3.5-3c0-.107-.006-.211-.017-.313A1.04 1.04 0 0 0 14 15.5V9.766c.538.493 1 1.204 1 2.234a1 1 0 1 0 2 0c0-1.881-.956-3.14-1.86-3.893a6.4 6.4 0 0 0-1.636-.985 4.009 4.009 0 0 0-.165-.063l-.014-.005-.005-.001-.002-.001ZM9 16c0-.356.452-1 1.5-1s1.5.644 1.5 1-.452 1-1.5 1S9 16.356 9 16Z"
                            clip-rule="evenodd" />
                    </svg>


                    <span class="flex-1 ms-3 whitespace-nowrap">Song</span>
                </a>
            </li>
            <li>
                <a href="{{ route('playlistPages') }}" @class([
                    'flex items-center p-2 text-[#804800] rounded-lg hover:bg-gray-700 hover:text-white group',
                    ' flex items-center p-2 rounded-lg bg-gray-700 text-white' => request()->Is(
                        'playlist'),
                ])>
                    <svg @class([
                        'w-6 h-6 text-[#804800] transition duration-75 group-hover:text-white',
                        'w-6 h-6 text-white' => request()->Is('playlist'),
                    ]) aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M17.316 4.052a.99.99 0 0 0-.9.14c-.262.19-.416.495-.416.82v8.566a4.573 4.573 0 0 0-2-.464c-1.99 0-4 1.342-4 3.443 0 2.1 2.01 3.443 4 3.443 1.99 0 4-1.342 4-3.443V6.801c.538.5 1 1.219 1 2.262 0 .56.448 1.013 1 1.013s1-.453 1-1.013c0-1.905-.956-3.18-1.86-3.942a6.391 6.391 0 0 0-1.636-.998 4 4 0 0 0-.166-.063l-.013-.005-.005-.002h-.002l-.002-.001ZM4 5.012c-.552 0-1 .454-1 1.013 0 .56.448 1.013 1 1.013h9c.552 0 1-.453 1-1.013 0-.559-.448-1.012-1-1.012H4Zm0 4.051c-.552 0-1 .454-1 1.013 0 .56.448 1.013 1 1.013h9c.552 0 1-.454 1-1.013 0-.56-.448-1.013-1-1.013H4Zm0 4.05c-.552 0-1 .454-1 1.014 0 .559.448 1.012 1 1.012h4c.552 0 1-.453 1-1.012 0-.56-.448-1.013-1-1.013H4Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="flex-1 ms-3 whitespace-nowrap">Playlist</span>
                </a>
            </li>
            <li>
                <a href="{{ route('scriptPages') }}" @class([
                    'flex items-center p-2 text-[#804800] rounded-lg hover:bg-gray-700 hover:text-white group',
                    ' flex items-center p-2 rounded-lg bg-gray-700 text-white' => request()->Is(
                        'script'),
                ])>
                    <svg @class([
                        'w-6 h-6 text-[#804800] transition duration-75 group-hover:text-white',
                        'w-6 h-6 text-white' => request()->Is('script'),
                    ]) aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7ZM8 16a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm1-5a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Script</span>
                </a>
            </li>

        </ul>

        <ul class="space-y-2 mt-auto font-medium">
            <li class="mt-2">
                <a href="{{ route('logoutPost') }}"
                    class="flex items-center p-2 text-[#804800] hover:text-white rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-6 h-6 text-[#804800] transition duration-75 group-hover:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        transform="scale(-1 1)" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                </a>
            </li>
            <li class="flex justify-center">
                <img src="{{ url('images\logo petra campus radio.png') }}" class="max-w-none size-20" alt="">
            </li>
        </ul>
    </div>
</aside>

<nav class="fixed top-0 z-10 w-full bg-white border border-gray-200">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center">
            <div id="drawer-toggle-content" class="flex items-center justify-start transition-all">
                <button id="drawer-toggle-button" data-drawer-target="logo-sidebar" data-drawer-backdrop="false"
                    data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>

            </div>

            @if (request()->routeIs('song'))
                <div class="relative shrink-0 w-40 me-4 sm:w-96">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <label for="search" class="hidden">Search from 521 icons...:</label>
                    <input id="search" type="text"
                        class="bg-white border border-gray-300 text-gray-900 text-start text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 py-2.5"
                        placeholder="Search from song..." value="">
                </div>

                <button data-modal-target="default-modal" data-modal-toggle="default-modal" type="button"
                    class="font-medium me-auto rounded-lg">
                    <svg class="w-[30px] h-[30px] text-[#804800] hover:text-[#D77900]" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-7 7V5" />
                    </svg>
                </button>
            @endif



            {{-- <div class="flex shrink-0 items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full"
                                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    Neil Sims
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    neil.sims@flowbite.com
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Dashboard</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Settings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Earnings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Sign out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
        </div>
    </div>
</nav>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const drawerToggle = document.getElementById('drawer-toggle-button');
        const content = document.getElementById('drawer-toggle-content');

        drawerToggle.addEventListener('click', function() {
            // Check if the drawer is open
            if (content.classList.contains('ms-64')) {
                content.classList.remove('ms-64');
                content.classList.add('ms-0');
            } else {
                content.classList.remove('ms-0');
                content.classList.add('ms-64');
            }
        });

    });
</script>

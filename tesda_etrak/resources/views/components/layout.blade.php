<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: false, showLogin: false }" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-TRAK')</title>
    @yield('vite')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
@php
    $authViews = ['view.login', 'view.signup'];
    $noHeader = ['admin.dashboard', 'admin.home', 'dashboard', 'home', 'view.login', 'view.signup'];
@endphp
<body>
    <header class="bg-blue-400 fixed left-0 shadow-md top-0 w-full z-20">
        <!-- Mobile NAV -->
        <nav class="sm:hidden container mx-auto p-4">
            <div class="flex items-center justify-between relative">
                @if (!in_array(Route::currentRouteName(), $authViews))
                    <!-- Hamburger Menu Icon -->
                    <button class="text-white hover:bg-blue-500 p-2 rounded-md" @click="sidebarOpen = !sidebarOpen">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                @else
                    <!-- Login Icon -->
                    <button @click="showLogin = true" class="bg-blue-100 text-blue-500 border-white border p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.0" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                        </svg>
                    </button>
                    <div id="mobileLogin">
                        <!-- Background Overlay -->
                        <div class="fixed inset-0 bg-black/50 z-40 pointer-events-auto"
                            x-show="showLogin"
                            @click="showLogin = false"
                            x-transition.opacity>
                        </div>
                        <!-- Floating Login Panel -->
                        <div class="bg-white border-gray-400 border fixed top-1/2 left-1/2 w-80 -translate-x-1/2 -translate-y-1/2 shadow-xl rounded-xl p-6 z-50"
                            x-show="showLogin"
                            x-transition>
                            <h2 class="text-2xl font-semibold mb-4 text-center">Sign In</h2>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="my-4">
                                    <input type="email" name="email" 
                                    class="w-full px-4 py-2 bg-gray-100 text-gray-800 border border-gray-500 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                                    placeholder="E-mail" autofocus />
                                </div>
                                <div class="my-4">
                                    <input type="password" name="password" 
                                    class="w-full px-4 py-2 text-gray-800 bg-gray-100 border border-gray-500 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                                    placeholder="Password" />
                                </div>
                                <div class="mt-7">
                                    <input type="submit" name="login" value="Log In" 
                                    class="w-full px-4 py-2 cursor-pointer font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500" />
                                </div>
                                <div class="mt-3">
                                    <button type="button" class="text-gray-600 text-sm border-gray-400 border cursor-pointer py-2 rounded-md w-full hover:bg-gray-400 hover:text-white hover:font-semibold"
                                        @click="showLogin = false">
                                        <span>Close</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
                <div class="text-white absolute font-[FremontBold,Verdana] font-bold left-1/2 text-3xl transform -translate-x-1/2">
                    @alladmin
                        <a href="{{ route('admin.home') }}">E-TRAK</a>
                    @endadmin
                    @user
                        <a href="{{ route('home') }}">E-TRAK</a>
                    @enduser
                    @guest
                        <span>E-TRAK</span>
                    @endguest
                </div>
            </div>
        </nav>
        <!-- Desktop NAV -->
        <nav class="hidden lg:flex container mx-auto p-4 justify-between items-center">
            <div class="flex items-center space-x-4">
                <div class="font-[FremontBold,Verdana] font-bold text-3xl text-white">
                    @alladmin
                        <a href="{{ route('admin.home') }}">E-TRAK</a>
                    @endalladmin
                    @user
                        <a href="{{ route('home') }}">E-TRAK</a>
                    @enduser
                    @guest
                        <span>E-TRAK</span>
                    @endguest
                </div>
            </div>
            <div class="flex items-center space-x-4">
                @if (!in_array(Route::currentRouteName(), $authViews))
                    @guest
                        <div class="flex flex-row-reverse">
                            <div>
                                <!-- Toggle Button -->
                                <button @click="showLogin = true" 
                                    class="hidden btn btn-secondary bg-blue-100 hover:bg-blue-200 text-blue-700 ml-5">
                                    <span>Log In</span>
                                </button>
                            </div>
                            <a href="{{ route('view.login') }}" class="btn btn-secondary bg-indigo-500 hover:bg-indigo-400">Log In</a>
                            <a href="{{ route('view.signup') }}" class="btn btn-secondary bg-indigo-500 hover:bg-indigo-400">Sign Up</a>
                        </div>
                    @endguest
                    @auth
                        @superadmin
                            <span class="text-white border-r-2 pr-2 text-lg">
                                [Super Admin] <b>{{ Auth::user()->name }}</b>
                            </span>
                        @endsuperadmin
                        @admin
                            <span class="text-white border-r-2 pr-2 text-lg">
                                [Admin] <b>{{ Auth::user()->name }}</b>
                            </span>
                        @endadmin
                        @user
                            <span class="text-white font-semibold border-r-2 pr-2 text-lg">{{ Auth::user()->name }}</span>
                        @enduser
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <input type="submit" class="btn btn-secondary bg-blue-100 hover:bg-blue-200 text-blue-700" role="button" name="logout" value="Log Out" />
                        </form>
                    @endauth
                @endif
            </div>
        </nav>
    </header>
    <div class="flex flex-1 pt-16">
        @if (!in_array(Route::currentRouteName(), $authViews))
            <!-- Sidebar Overlay -->
            <div class="fixed inset-0 z-30 md:hidden" 
                x-show="sidebarOpen" 
                @click="sidebarOpen = false" 
                x-transition.opacity>
            </div>
            <!-- Sidebar -->
            <aside class="bg-gray-100 fixed flex flex-col h-full left-0 p-6 shadow-md top-0 w-64 z-40 transform transition-transform ease-in-out duration-300" 
                x-show="sidebarOpen" 
                x-transition:enter="translate-x-0" 
                x-transition:leave="-translate-x-full" 
                :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
                <!-- Close Button -->
                <div class="flex items-center justify-end mb-4">
                    <button class="bg-blue-400 text-white hover:bg-blue-500 border p-2 rounded-md" @click="sidebarOpen = false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <!-- Links -->
                <ul class="flex-1 overflow-y-auto space-y-4 pr-4 py-4">
                    @alladmin
                        <li>
                            <a href="{{ route('admin.home') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                <!-- Label -->
                                <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                                </svg>
                                <!-- Label -->
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.table-of-graduates') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                </svg>
                                <!-- Label -->
                                <span>List of Graduates</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.job-vacancies') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                                </svg>
                                <!-- Label -->
                                <span>Job Vacancies</span>
                            </a>
                        </li>
                    @endalladmin
                    @superadmin
                        <li>
                            <a href="{{ route('via-google-sheets') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                <!-- Label -->
                                <span>Via Google Sheets</span>
                            </a>
                        </li>
                    @endsuperadmin
                    @user
                        <li>
                            <a href="{{ route('home') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                <!-- Label -->
                                <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                                </svg>
                                <!-- Label -->
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('table-of-graduates') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                </svg>
                                <!-- Label -->
                                <span>List of Graduates</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('job-vacancies') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                                </svg>
                                <!-- Label -->
                                <span>Job Vacancies</span>
                            </a>
                        </li>
                    @enduser
                    @guest
                        <li>
                            <a href="{{ route('home') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                <!-- Label -->
                                <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                                </svg>
                                <!-- Label -->
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('table-of-graduates') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                </svg>
                                <!-- Label -->
                                <span>List of Graduates</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('job-vacancies') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                                </svg>
                                <!-- Label -->
                                <span>Job Vacancies</span>
                            </a>
                        </li>
                    @endguest
                    <li>
                        <a href="http://www.tesda.gov.ph" target="_blank" rel="noopener noreferrer" class="sidebar-link-mobile">
                            <!-- Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                            </svg>
                            <!-- Label -->
                            <span>Visit <b>TESDA</b> website</span>
                        </a>
                    </li>
                </ul>
                <!-- Bottom Section -->
                <div class="border-t border-blue-500 flex flex-col pt-3 text-center space-y-2" x-data="{ showLogin: false }">
                    @auth
                        @superadmin
                            <span class="bg-blue-500 text-white font-semibold py-2 rounded-md">[Super Admin] {{ Auth::user()->name }}</span>
                        @endsuperadmin
                        @admin
                            <span class="bg-blue-500 text-white font-semibold py-2 rounded-md">[Admin] {{ Auth::user()->name }}</span>
                        @endadmin
                        @user
                            <span class="bg-blue-500 text-white font-semibold py-2 rounded-md">{{ Auth::user()->name }}</span>
                        @enduser
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <input type="submit" class="btn btn-secondary bg-blue-100 hover:bg-blue-200 text-blue-700 w-full" role="button" name="logout" value="Log Out" />
                        </form>
                    @endauth
                    @guest
                        <!-- Toggle Button -->
                        <button @click="showLogin = true" id="sidebarLogin"
                            class="btn btn-secondary bg-blue-100 hover:bg-blue-200 text-blue-700">
                            <span>Log In</span>
                        </button>
                        <a href="{{ route('view.signup') }}" class="btn btn-secondary bg-indigo-500 hover:bg-indigo-400">Sign Up</a>
                    @endguest
                </div>
            </aside>
            <!-- Sidebar (Desktop) -->
            @auth
                <aside class="bg-gray-100 border-r border-gray-300 hover:w-64 lg:flex fixed flex-col group h-[calc(100vh-4rem)] hidden left-0 shadow-md top-[4rem] w-20 z-10 transition-all duration-300">
                    <ul class="space-y-4 pt-10 pb-4 px-4">
                        @alladmin
                            <li>
                                <a href="{{ route('admin.home') }}" class="sidebar-link">
                                    <!-- Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>
                                    <!-- Label -->
                                    <span class="hidden group-hover:inline-block transition-opacity duration-200">Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                                    <!-- Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                                    </svg>
                                    <!-- Label -->
                                    <span class="hidden group-hover:inline-block transition-opacity duration-200">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.table-of-graduates') }}" class="sidebar-link">
                                    <!-- Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                    </svg>
                                    <!-- Label -->
                                    <span class="hidden group-hover:inline-block transition-opacity duration-200">List of Graduates</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.job-vacancies') }}" class="sidebar-link">
                                    <!-- Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                                    </svg>
                                    <!-- Label -->
                                    <span class="hidden group-hover:inline-block transition-opacity duration-200">Job Vacancies</span>
                                </a>
                            </li>
                        @endalladmin
                        @superadmin
                            <li>
                                <a href="{{ route('via-google-sheets') }}" class="sidebar-link">
                                    <!-- Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                    <!-- Label -->
                                    <span class="hidden group-hover:inline-block transition-opacity duration-200">Via Google Sheets</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="sidebar-link">
                                    <!-- Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                    </svg>
                                    <!-- Label -->
                                    <span class="hidden group-hover:inline-block transition-opacity duration-200">Admin Manager</span>
                                </a>
                            </li>
                        @endsuperadmin
                        @user
                            <li>
                                <a href="{{ route('home') }}" class="sidebar-link">
                                    <!-- Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>
                                    <!-- Label -->
                                    <span class="hidden group-hover:inline-block transition-opacity duration-200">Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dashboard') }}" class="sidebar-link">
                                    <!-- Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                                    </svg>
                                    <!-- Label -->
                                    <span class="hidden group-hover:inline-block transition-opacity duration-200">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('table-of-graduates') }}" class="sidebar-link">
                                    <!-- Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                    </svg>
                                    <!-- Label -->
                                    <span class="hidden group-hover:inline-block transition-opacity duration-200">List of Graduates</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('job-vacancies') }}" class="sidebar-link">
                                    <!-- Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                                    </svg>
                                    <!-- Label -->
                                    <span class="hidden group-hover:inline-block transition-opacity duration-200">Job Vacancies</span>
                                </a>
                            </li>
                        @enduser
                        @guest
                            <li>
                                <a href="{{ route('home') }}" class="sidebar-link">
                                    <!-- Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>
                                    <!-- Label -->
                                    <span class="hidden group-hover:inline-block transition-opacity duration-200">Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dashboard') }}" class="sidebar-link">
                                    <!-- Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                                    </svg>
                                    <!-- Label -->
                                    <span class="hidden group-hover:inline-block transition-opacity duration-200">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('table-of-graduates') }}" class="sidebar-link">
                                    <!-- Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                    </svg>
                                    <!-- Label -->
                                    <span class="hidden group-hover:inline-block transition-opacity duration-200">List of Graduates</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('job-vacancies') }}" class="sidebar-link">
                                    <!-- Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                                    </svg>
                                    <!-- Label -->
                                    <span class="hidden group-hover:inline-block transition-opacity duration-200">Job Vacancies</span>
                                </a>
                            </li>
                        @endguest
                        <li>
                            <a href="http://www.tesda.gov.ph" target="_blank" rel="noopener noreferrer" class="sidebar-link">
                                <!-- Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">
                                    Visit <b class="font-[Fremont,Verdana]">TESDA</b> website
                                </span>
                            </a>
                        </li>
                    </ul>
                </aside>
            @endauth
        @endif
        <!-- Main -->
        @if (in_array(Route::currentRouteName(), $noHeader))
            <main class="flex-1 overflow-y-auto px-6 sm:ml-20 transition-all duration-300">
                {{ $slot }}
            </main>
        @else
            <main class="flex-1 overflow-y-auto p-6 sm:ml-20 transition-all duration-300">
                <header class="mb-8">
                    @if (session('success'))
                        <div class="bg-green-200 text-green-600 border drop-shadow font-semibold p-3 mb-3 rounded text-center text-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h1 class="text-gray-600 text-5xl sm:hidden">@yield('main')</h1>
                    <h1 class="text-gray-600 sm:block hidden">@yield('main')</h1>
                </header> 
                {{ $slot }}
            </main>
        @endif
    </div>
</body>
</html>
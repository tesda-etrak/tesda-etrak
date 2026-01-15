<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: false, showLogin: false }" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-TRAK - Create an account</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-blue-100">
    <header class="bg-blue-400 fixed shadow-md top-0 left-0 w-full z-20">
        <!-- Mobile NAV -->
        <nav class="sm:hidden container mx-auto p-4">
            <div class="flex items-center justify-between relative">
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
        <nav class="hidden sm:flex items-center justify-center container mx-auto p-4">
            <a href="{{ route('view.login') }}">
                <h1 class="font-[FremontBold,Verdana] text-white">E-TRAK</h1>
            </a>
        </nav>
    </header>
    <!-- Main -->
    <main class="overflow-y-auto transition-all duration-300">
        <div class="flex items-baseline justify-center mt-32">
            <div class="bg-gray-100 border-gray-400 border fixed flex items-baseline justify-center rounded-2xl shadow-lg">
                <div class="w-lg p-8 space-y-6">
                    <div class="border-b p-2">
                        <h2 class="text-black text-2xl text-center font-medium">Create an account</h2>
                    </div>
                    @if ($errors->any())
                        <ul class="px-3 py-2 bg-red-400 rounded-md">
                            @foreach ($errors->all() as $error)
                                <li class="text-md text-white">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form action="{{ route('signup') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <input type="text" name="name" 
                            class="w-full px-4 py-2 mt-1 text-gray-800 bg-gray-100 border border-gray-400 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Username" required autofocus />
                        </div>
                        <div>
                            <input type="email" name="email" 
                            class="w-full px-4 py-2 mt-1 text-gray-800 bg-gray-100 border border-gray-400 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="E-mail" required />
                        </div>
                        <div>
                            <input type="password" name="password" 
                            class="w-full px-4 py-2 mt-1 text-gray-800 bg-gray-100 border border-gray-400 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Password" required />
                        </div>
                        <div>
                            <input type="password" name="password_confirmation" 
                            class="w-full px-4 py-2 mt-1 text-gray-800 bg-gray-100 border border-gray-400 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Confirm Password" required />
                        </div>
                        <div class="mt-10">
                            <input type="submit" name="signup" value="Sign Up" 
                            class="w-full px-4 py-2 font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500" />
                        </div>
                    </form>
                    <div>
                        <p class="text-sm text-center text-gray-700">
                            Return to <a href="{{ route('view.login') }}" class="text-blue-700 hover:underline">login</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
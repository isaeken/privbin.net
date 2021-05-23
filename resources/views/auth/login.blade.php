<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900 dark:text-gray-200">
        <div class="text-2xl">
            <a href="{{ route("home") }}">
                {{ config("app.name") }}
            </a>
        </div>

        <div class="mt-6 text-center">
            <div class="text-4xl font-bold mb-3">{{ __("Sign In") }}</div>
            @if (\Illuminate\Support\Facades\Route::has("register"))
                <div class="text-sm text-gray-800">{{ __("or") }} <a href="{{ route("register") }}" class="text-blue-800">{{ __("Sign up") }}</a></div>
            @endif
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden sm:rounded-lg">
            @foreach($errors->all() as $error)
                <x-alert-box type="error" class="w-full mb-4">{{ $error }}</x-alert-box>
            @endforeach
            @if (session('status'))
                <x-alert-box type="info" class="w-full mb-4">{{ session('status') }}</x-alert-box>
            @endif

            <form action="{{ route("login") }}" method="post">
                @csrf

                <div class="rounded-md shadow-sm -space-y-px mb-3">
                    <div>
                        <label for="username" class="sr-only">{{ __("Username or E-Mail Address") }}</label>
                        <input value="{{ old("username") }}" type="text" id="username" name="username" autocomplete="username" required placeholder="{{ __("Username or E-Mail Address") }}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-700 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>
                    <div>
                        <label for="password" class="sr-only">{{ __("Password") }}</label>
                        <input type="password" id="password" name="password" autocomplete="current-password" required placeholder="{{ __("Password") }}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-700 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>
                </div>

                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:bg-gray-800 dark:border-gray-700 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                            {{ __("Remember me") }}
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                {{ __("Forgot your password?") }}
                            </a>
                        </div>
                    @endif
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __("Sign in") }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

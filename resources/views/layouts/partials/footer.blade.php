<footer class="bg-gray-800">
    <div class="mx-auto container px-4 sm:px-6 lg:px-8 py-10">
        <div class="pt-6">
            <div class="flex flex-wrap">

                <div class="w-full sm:w-1/2 lg:w-3/12">
                    <div class="text-xs uppercase text-gray-400 font-medium mb-6">
                        {{ __("Getting Started") }}
                    </div>

                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        What Is This
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Installation
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Release Notes
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Upgrade Guide
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Optimizing for Production
                    </a>
                </div>

                <div class="w-full sm:w-1/2 lg:w-3/12">
                    <div class="text-xs uppercase text-gray-400 font-medium mb-6">
                        {{ __("Core") }}
                    </div>

                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Filesystem
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Language
                    </a>
                </div>

                <div class="w-full sm:w-1/2 lg:w-3/12">
                    <div class="text-xs uppercase text-gray-400 font-medium mb-6">
                        {{ __("Customization") }}
                    </div>

                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Configuration
                    </a>
                    <a href="#" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        Theme Configuration
                    </a>
                </div>

                <div class="w-full sm:w-1/2 lg:w-3/12">
                    <div class="text-xs uppercase text-gray-400 font-medium mb-6">
                        {{ __("Community") }}
                    </div>

                    <a href="https://www.github.com/privbin/privbin" target="_blank" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                        GitHub
                    </a>
                </div>

            </div>
        </div>
        <div class="py-6">
            <div class="flex">
                <a href="{{ route('home') }}" class="text-gray-500 text-sm">
                    &copy; {{ config("app.name") }} {{ date("Y") }}
                </a>
            </div>
        </div>
    </div>
    <div class="bg-gray-900">
        <div class="mx-auto container px-4 sm:px-6 lg:px-8 py-4 text-gray-400 text-xs flex w-full">
            <div>
                {{ __("This page took :time seconds to render.", ["time" => number_format(microtime(true) - LARAVEL_START, 2, ".", "")]) }}
            </div>
            <div class="ml-auto">
                Developed by <a href="https://www.isaeken.com.tr" target="_blank" class="font-semibold ml-auto text-indigo-300">İsa Eken</a>
            </div>
        </div>
    </div>
</footer>

<a onclick="event.preventDefault(); window.scrollToTop();" href="#" class="fixed right-8 bottom-8 z-50 rounded-full bg-white text-gray-900 hover:bg-indigo-900 hover:text-gray-200 shadow-xl p-2 ring-indigo-500 focus:ring transition-all">
    <x-go-arrow-up-24 class="w-8 h-8 animate-bounce mt-1 -mb-1" />
</a>

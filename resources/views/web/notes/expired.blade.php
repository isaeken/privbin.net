<x-blank-layout>
    <main>
        <div class="md:flex min-h-screen w-full">
            <div class="w-full md:w-1/2 bg-gray-800 flex items-center justify-center">
                <div class="max-w-sm m-8">
                    <div class="text-gray-100 text-5xl md:text-15xl font-black">{{ __('Oh no') }}</div>
                    <div class="text-gray-100 text-3xl md:text-12xl font-semibold mt-2">{{ __('Note is expired.') }}</div>

                    <div class="w-16 h-1 bg-purple-light my-3 md:my-6"></div>

                    <p class="text-grey-darker text-2xl md:text-3xl font-light mb-8 leading-normal">
                        @yield('message')
                    </p>

                    <a href="{{ app('router')->has('home') ? route('home') : url('/') }}">
                        <button class="bg-transparent text-grey-darkest font-bold uppercase tracking-wide py-3 px-6 border-2 border-grey-light hover:border-grey rounded-lg">
                            {{ __('Go Home') }}
                        </button>
                    </a>
                </div>
            </div>

            <div class="relative pb-full md:flex md:pb-0 md:min-h-screen w-full md:w-1/2">
                @yield('image')
            </div>
        </div>
    </main>
</x-blank-layout>

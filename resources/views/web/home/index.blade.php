<x-app-layout>
    <div class="flex space-x-4">
        <div class="w-9/12">
            <x-make-note-form />
        </div>
        <div class="w-3/12">
            <div class="py-2 px-3 bg-gray-800 border border-gray-700 rounded-lg">
                @auth
                @else
                    <img src="{{ asset("/images/welcome.svg") }}" alt="{{ __("Welcome") }}" class="w-full mx-auto">
                    <div class="">
                        <div class="text-lg">{{ __("Hi there!") }}</div>
                        <div class="mt-2 mb-4">
{!! __(
"Please <a href=':login'>login</a> or <a href=':register'>register</a> to save your notes and unlock more features.",
[
    'login' => route('login'),
    'register' => route('register'),
]
) !!}
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>

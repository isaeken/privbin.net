<x-app-layout>
    <div class="w-full my-14 mx-auto max-w-4xl">
        <div class="mb-4 text-2xl">{{ __('Authorize Required') }}</div>
        <div class="bg-gray-800 rounded-lg py-3 px-4 border border-gray-700">
            <form action="{{ route('notes.auth', ['note' => $note]) }}" method="post">
                @csrf
                @method('POST')
                <div>
                    <label for="password">{{ __("Password") }}</label>
                    <input type="password" id="password" name="password" placeholder="{{ __("Password") }}" class="block w-full bg-gray-900 border border-gray-600 rounded-lg">
                </div>
                <div class="flex w-full space-x-3 mt-4">
                    <button type="submit" class="ml-auto text-sm py-2 px-4 bg-indigo-800 hover:bg-indigo-700 transition rounded-lg border border-indigo-700">
                        {{ __("Submit") }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

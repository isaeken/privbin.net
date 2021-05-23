<div {{ $attributes->merge(["block w-full"]) }}>
    <div class="w-full block border border-gray-700 bg-gray-800 rounded-lg">
        <form action="{{ route('notes.store') }}" method="post" class="has-editor">
            @csrf
            <div class="py-2 px-3 border-b border-gray-700 bg-gray-700 rounded-t-lg text-sm bg-opacity-50">
                {{ __("Create new note") }}
            </div>
            <div class="py-3 px-3 space-y-4 text-sm">
                <div>
                    <label for="title">{{ __("Title") }}</label>
                    <input type="text" id="title" name="title" placeholder="{{ __("Title") }}" class="block w-full bg-gray-900 border border-gray-600 rounded-lg">
                </div>
                <div>
                    <label for="password">{{ __("Password") }}</label>
                    <input type="password" id="password" name="password" placeholder="{{ __("Password") }}" class="block w-full bg-gray-900 border border-gray-600 rounded-lg">
                </div>
                <div>
                    <label for="language">{{ __("Language") }}</label>
                    <select editor-language-selector name="language" id="language" class="block w-full bg-gray-900 border border-gray-600 rounded-lg">
                        @foreach(\App\Enums\Language::asArray() as $key => $value)
                            <option value="{{ $value }}" {{ $loop->first ? "selected" : null }}>
                                {{ \Illuminate\Support\Str::of($key)->snake(" ")->title() }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="expire">{{ __("Expires") }}</label>
                    <select name="expire" id="expire" class="block w-full bg-gray-900 border border-gray-600 rounded-lg">
                        @foreach(\App\Enums\Expire::asArray() as $key => $value)
                            <option value="{{ $value }}" {{ $loop->first ? "selected" : null }}>
                                {{ \Illuminate\Support\Str::of($key)->snake(" ")->title() }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>{{ __("Content") }}</label>
                    <x-editor style="height: 450px;" id="editor" />
                </div>
                <div class="flex w-full space-x-3">
                    <button type="submit" class="ml-auto py-2 px-4 bg-indigo-800 hover:bg-indigo-700 transition rounded-lg border border-indigo-700">
                        {{ __("Submit") }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

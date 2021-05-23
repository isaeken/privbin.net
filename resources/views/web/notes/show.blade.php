<x-app-layout>
    <div class="flex space-x-4">
        <div class="w-9/12">
            <div class="mb-4 flex">
                @if ($note->title != null)
                    <div class="mb-1 text-2xl">{{ $note->title }}</div>
                @endif
                <div class="ml-auto flex space-x-2">
                    <div x-data="{open: false}"
                         x-on:close.stop="open = false"
                         x-on:keydown.escape.window="open = false">

                        <div role="dialog"
                             aria-labelledby="embed_modal_label"
                             aria-modal="true"
                             tabindex="0"
                             x-show="open"
                             @click="open = false; $refs.embed_modal_button.focus()"
                             @click.away="open = false; $refs.embed_modal_button.focus()"
                             style="display: none;"
                             class="fixed top-0 left-0 w-full h-screen flex justify-center items-center z-50">

                            <div x-show="open"
                                 class="fixed inset-0 transform transition-all"
                                 x-on:click="open = false"
                                 x-transition:enter="ease-out duration-300"
                                 x-transition:enter-start="opacity-0"
                                 x-transition:enter-end="opacity-100"
                                 x-transition:leave="ease-in duration-200"
                                 x-transition:leave-start="opacity-100"
                                 x-transition:leave-end="opacity-0">
                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>

                            <div @click.stop=""
                                 x-show="open"
                                 class="mb-6 bg-white text-gray-900 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-2xl sm:mx-auto"
                                 x-transition:enter="ease-out duration-300"
                                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                 x-transition:leave="ease-in duration-200"
                                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                                <a href="#" class="ml-auto right-1 top-1 absolute m-1 p-1 rounded transition text-gray-400 hover:bg-gray-200" @click="open = false">
                                    <x-gmdi-close class="w-6 h-6" />
                                </a>

                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex">
                                    {{ __('Make Embed') }}
                                </div>
                                <div class="bg-white px-4 py-5 sm:p-6 overflow-y-auto" style="max-height: 80vh;">
                                    <div class="mb-4">
                                        <label for="theme" class="block w-full mb-1">{{ __('Theme') }}</label>
                                        <select name="theme" id="theme" class="block w-full rounded-lg">
                                            <option value="vs-dark" selected>Default</option>
                                            <option value="vs">Visual Studio</option>
                                            <option value="vs-dark">Visual Studio Dark</option>
                                            <option value="hc-dark">HC Dark</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="lines" class="block w-full mb-1">
                                            <div>{{ __('Highlighted line or lines') }}</div>
                                            <div class="text-gray-400 text-xs">{{ __('To select multiple lines, separate the line numbers with commas.') }}</div>
                                        </label>
                                        <input type="text" name="lines" id="lines" value="" placeholder="{{ __('1, 2, 3') }}" class="block w-full rounded-lg">
                                    </div>
                                    <div class="mb-4 hidden" id="embed_link">
                                        <pre id="embed_link_url" class="py-2 px-3 mb-1.5 rounded-lg select-all cursor-pointer bg-gray-900 text-gray-100 break-all whitespace-pre-wrap"></pre>
                                        <pre id="embed_link_script_url" class="py-2 px-3 mb-1.5 rounded-lg select-all cursor-pointer bg-gray-900 text-gray-100 break-all whitespace-pre-wrap"></pre>
                                        <pre id="embed_link_tag" class="py-2 px-3 rounded-lg select-all cursor-pointer bg-gray-900 text-gray-100 break-all whitespace-pre-wrap"></pre>
                                    </div>
                                    <div>
                                        <a onclick="event.preventDefault();
                                        $.post('{{ route('api.make-embed-url', $note) }}', {
                                            theme: $('#theme').val(),
                                                lines: $('#lines').val()
                                        }).done(function (response) {
                                            $('#embed_link').removeClass('hidden');
                                            $('#embed_link #embed_link_url').text(response.url);
                                            $('#embed_link #embed_link_script_url').text(response.script_url);
                                            $('#embed_link #embed_link_tag').text(response.embed_tag);
                                        });" class="cursor-pointer text-center w-full block py-2 px-3 bg-indigo-900 border border-indigo-800 hover:bg-indigo-800 rounded-lg text-indigo-100">
                                            {{ __('Generate') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button x-ref="embed_modal_button" x-on:click="open = ! open" class="relative inline-block px-3 py-1.5 transition text-sm rounded-lg border border-indigo-900 bg-gray-800 text-indigo-100 hover:bg-gray-700 hover:text-indigo-200">
                            {{ __('Make Embed') }}
                        </button>
                    </div>
                    <a href="{{ route('notes.show.raw', $note) }}" target="_blank" class="relative inline-block px-3 py-1.5 transition text-sm rounded-lg border border-indigo-900 bg-gray-800 text-indigo-100 hover:bg-gray-700 hover:text-indigo-200">{{ __('Raw') }}</a>
                </div>
            </div>
            <div>
                <x-editor readonly="true" :language="$note->language" :content="$note->content" style="height: min-content;" />
            </div>
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

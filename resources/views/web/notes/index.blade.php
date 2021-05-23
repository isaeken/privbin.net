<x-app-layout>
    <div class="w-full my-14 mx-auto max-w-4xl">
        <div class="mb-4 text-2xl">{{ __('Your Notes') }}</div>
        <div class="space-y-4">
            @forelse($notes as $note)
                <div class="bg-gray-800 rounded-lg py-3 px-4 border border-gray-700 text-gray-300 flex">
                    <div>
                        <a href="{{ route('notes.show', $note) }}">
                            {{ sprintf('%s (%s)', ($note->title ?? $note->uuid), $note->created_at) }}
                        </a>
                    </div>
                    @if ($note->isExpired())
                        <div class="ml-auto text-red-500 font-semibold tracking-widest">
                            {{ __("EXPIRED") }}
                        </div>
                    @else
                        <div class="ml-auto font-semibold tracking-widest space-x-1">
                            <a href="{{ route('notes.show', $note) }}" class="text-indigo-300">{{ __("Show") }}</a>
                            <a href="{{ route('notes.destroy', $note) }}" class="text-red-500">{{ __("Delete") }}</a>
                        </div>
                    @endif
                </div>
            @empty
                <div class="bg-gray-800 rounded-lg py-3 px-4 border border-gray-700 text-gray-300">
                    {{ __('No any notes exists.') }}
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>

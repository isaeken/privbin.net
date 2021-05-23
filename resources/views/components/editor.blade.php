<div
    {{ $attributes->merge(['class' => 'relative']) }}
    x-data="{open: false}" privbin-editor="{{ $id = "privbin_editor_" . rand(0, 100000) }}"
    :class="{ 'fixed inset-0 z-90': open }"
    :class="{ 'relative': !open }"
    @click="if (open) { window.fullScreen = true; $el.classList.remove('relative'); } else { window.fullScreen = false; $el.classList.add('relative'); } window.updateEditorSizes();">
    <div class="absolute right-2 top-2 z-10 flex">
        <a href="#" x-on:click="open = ! open" class="ml-auto py-2 px-2 rounded-lg bg-indigo-900 border border-indigo-800 transition hover:bg-indigo-800">
            <x-bi-fullscreen x-show="!open" />
            <x-bi-fullscreen-exit x-show="open" style="display: none;" />
        </a>
    </div>
    <div style="display: none;" id="{{ $id }}">{{ base64_encode(htmlspecialchars_decode(strlen($content) ? $content : $slot, ENT_QUOTES)) }}</div>
    <div id="{{ $id }}_editor" privbin-editor-language="{{ $language }}" style="width: 100%; height: 100%;"></div>
</div>

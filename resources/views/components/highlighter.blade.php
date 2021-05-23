<pre {{ $attributes }} privbin-highlighter data-lang="{{ $language }}">{{ strlen($content) ? $content : $slot, ENT_QUOTES }}</pre>

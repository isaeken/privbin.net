@switch($type)
    @case(\App\Enums\AlertType::Error())
    <div {{ $attributes->merge(["role" => "alert", "class" => "border-2 border-red-100 bg-red-500 text-red-100 px-6 py-4 shadow-sm overflow-hidden sm:rounded-lg"]) }}>
        <x-heroicon-o-x-circle class="h-5 w-5 inline-block -mt-1 mr-2" />
        {{ $slot }}
    </div>
    @break

    @case(\App\Enums\AlertType::Warning())
    <div {{ $attributes->merge(["role" => "alert", "class" => "border-2 border-yellow-100 bg-yellow-400 text-yellow-100 px-6 py-4 shadow-sm overflow-hidden sm:rounded-lg"]) }}>
        <x-heroicon-o-exclamation-circle class="h-5 w-5 inline-block -mt-1 mr-2" />
        {{ $slot }}
    </div>
    @break

    @case(\App\Enums\AlertType::Success())
    <div {{ $attributes->merge(["role" => "alert", "class" => "border-2 border-green-100 bg-green-500 text-green-100 px-6 py-4 shadow-sm overflow-hidden sm:rounded-lg"]) }}>
        <x-heroicon-o-check-circle class="h-5 w-5 inline-block -mt-1 mr-2" />
        {{ $slot }}
    </div>
    @break

    @case(\App\Enums\AlertType::Info())
    <div {{ $attributes->merge(["role" => "alert", "class" => "border-2 border-blue-100 bg-blue-400 text-blue-100 px-6 py-4 shadow-sm overflow-hidden sm:rounded-lg"]) }}>
        {{ $slot }}
    </div>
    @break

    @case(\App\Enums\AlertType::Alert())
    @default
    <div {{ $attributes->merge(["role" => "alert", "class" => "border-2 border-indigo-100 bg-indigo-400 text-indigo-100 px-6 py-4 shadow-sm overflow-hidden sm:rounded-lg"]) }}>
        {{ $slot }}
    </div>
    @break
@endswitch

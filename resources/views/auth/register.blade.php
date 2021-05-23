<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="text-2xl">
            <a href="{{ route("home") }}">
                {{ config("app.name") }}
            </a>
        </div>

        <div class="mt-6 text-center">
            <div class="text-4xl font-bold mb-3">{{ __("Sign Up") }}</div>
            <div class="text-sm text-gray-800">{{ __("or") }} <a href="{{ route("login") }}" class="text-blue-800">{{ __("Sign in to your account") }}</a></div>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden sm:rounded-lg">
            @foreach($errors->all() as $error)
                <x-alert-box type="error" class="w-full mb-4">{{ $error }}</x-alert-box>
            @endforeach
            @if (session('status'))
                <x-alert-box type="info" class="w-full mb-4">{{ session('status') }}</x-alert-box>
            @endif

            <form action="{{ route("register") }}" method="post">
                @csrf

                <div class="rounded-md shadow-sm -space-y-px mb-3">
                    <div>
                        <label for="first_name" class="sr-only">{{ __("First Name") }}</label>
                        <input type="text" id="first_name" name="first_name" autocomplete="first_name" required placeholder="{{ __("First Name") }}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>
                    <div>
                        <label for="last_name" class="sr-only">{{ __("Last Name") }}</label>
                        <input type="text" id="last_name" name="last_name" autocomplete="last_name" required placeholder="{{ __("Last Name") }}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>
                </div>

                <div class="rounded-md shadow-sm -space-y-px mb-3">
                    <div>
                        <label for="username" class="sr-only">{{ __("Username") }}</label>
                        <input type="text" id="username" name="username" autocomplete="username" required placeholder="{{ __("Username") }}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>
                    <div>
                        <label for="email" class="sr-only">{{ __("E-Mail Address") }}</label>
                        <input type="email" id="email" name="email" autocomplete="email" required placeholder="{{ __("E-Mail Address") }}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>
                </div>

                <div class="rounded-md shadow-sm -space-y-px mb-3">
                    <div>
                        <label for="password" class="sr-only">{{ __("Password") }}</label>
                        <input type="password" id="password" name="password" autocomplete="new-password" required placeholder="{{ __("Password") }}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>
                    <div>
                        <label for="password_confirmation" class="sr-only">{{ __("Confirm Password") }}</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" required placeholder="{{ __("Confirm Password") }}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="terms" class="ml-2 block text-sm text-gray-900">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </label>
                        </div>
                    </div>
                @endif

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __("Sign in") }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.$(document).ready(function () {
            let input = $("#reference_id");
            let results = $("#autocomplete-results");

            input.on("input", function () {
                results.addClass("hidden");
                if (input.val().length > 2) {
                    $.get("/api/user/q/" + input.val(), function (response) {
                        if (response.length > 0) {
                            results.removeClass("hidden").html("");
                            $.each(response, function (index, user) {
                                console.log(user);

                                let user_link = $(`<a href="#" class="block w-full px-3 py-2 hover:bg-gray-100 rounded-md transition-all"></a>`);
                                let user_flex = $(`<div class="flex w-full"></div>`);
                                let user_image = $(`<img src="" alt="" class="w-8 h-8 rounded-full shadow-sm mr-2"/>`);
                                let user_name = $(`<span class="leading-8"></span>`);

                                user_name.append(user.name);
                                user_image.attr("src", user.profile_photo_url);
                                user_image.attr("alt", user.name);

                                user_flex.append(user_image);
                                user_flex.append(user_name);
                                user_link.append(user_flex);

                                user_link.click(function () {
                                    $("#autocomplete-selected").removeClass("hidden");
                                    $("#autocomplete-selected img").attr("src", user.profile_photo_url);
                                    $("#autocomplete-selected img").attr("alt", user.name);
                                    $("#autocomplete-selected .user_name").text(user.name);
                                    $("#autocomplete-selected input").val(user.id);
                                    $("#autocomplete-selected .close").click(function () {
                                        $("#autocomplete-selected img").attr("src", "");
                                        $("#autocomplete-selected img").attr("alt", "");
                                        $("#autocomplete-selected .user_name").text("");
                                        $("#autocomplete-selected input").val("");
                                        $("#autocomplete-selected").addClass("hidden");
                                    });
                                    input.val("");
                                    results.addClass("hidden").html("");
                                });

                                results.append(user_link);
                            });
                        }
                    });
                }
            });
        });
        function autocomplete() {

            {{--<a href="#" class="block w-full px-3 py-2 hover:bg-gray-100 rounded-md transition-all">--}}
            {{--    <div class="flex w-full">--}}
            {{--        <img src="{{ \App\Models\User::first()->profile_photo_url }}" alt="asd" class="w-8 h-8 rounded-full shadow-sm mr-2">--}}
            {{--            <span class="leading-8">asdasd</span>--}}
            {{--    </div>--}}
            {{--</a>--}}
        }
    </script>
</x-guest-layout>

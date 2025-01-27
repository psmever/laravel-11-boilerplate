<footer class="bg-white m-4">
    <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
                    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 psmever. All Rights
                        Reserved.
                    </span>

        <ul
                class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">

            @if (env('APP_ENV')!='Production')
                <li>
                    <a href="javascript:" class="hover:underline">Laravel
                        v{{ Illuminate\Foundation\Application::VERSION }}
                        (PHP v{{ PHP_VERSION }}) Environment:
                        {{ env("APP_ENV") }}</a>
                </li>
            @endif
        </ul>
    </div>
</footer>

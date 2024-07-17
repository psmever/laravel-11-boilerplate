@include('includes.head')
<main class="flex p-0 h-full items-center">
    <div class="flex h-full w-full flex-col items-center justify-center rounded-lg border border-gray-200 p-8">

        @yield('content')

    </div>
</main>
@include('includes.tail')

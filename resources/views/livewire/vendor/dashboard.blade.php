<!DOCTYPE html>
<html>
    <head>
        <title>Vendor Dashboard</title>
        @livewireStyles
        <script src="//unpkg.com/alpinejs" defer></script>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100">
        <nav class="bg-blue-600 text-white p-4">
            <div class="container mx-auto flex justify-between">
                <span class="font-bold">Vendor Dashboard</span>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </nav>

        <main class="container mx-auto p-4">
            {{-- {{ $slot }} --}}
        </main>

        @livewireScripts
    </body>
</html>

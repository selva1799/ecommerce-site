<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center py-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-6">Welcome to Our E-commerce Site</h1>

            @auth
                <p class="text-xl text-gray-600">Hello, {{ auth()->user()->name }}!</p>
                @if(auth()->user()->role_id === '1')
                    <p class="mt-4">You have admin privileges.</p>
                @elseif(auth()->user()->role_id === '2')
                    <p class="mt-4">You are a vendor.</p>
                    @elseif(auth()->user()->role_id === '3')
                    <p class="mt-4">You are a buyer.</p>
                @endif
            @else
                <p class="text-xl text-gray-600">Please login or register to continue.</p>
            @endauth
        </div>
    </div>
</x-app-layout>

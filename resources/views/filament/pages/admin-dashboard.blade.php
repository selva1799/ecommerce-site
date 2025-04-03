<x-app-layout>
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-xl font-bold mb-4">User Roles Distribution</h2>
            <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="font-medium">Test</span>
                            <span class="font-bold">2</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="h-2.5 rounded-full"
                                 style="width: {{ (2)*100 }}%"></div>
                        </div>
                    </div>
            </div>
        </div>
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
            <div class="grid grid-cols-2 gap-4">
                <x-filament::button
                    icon="heroicon-o-plus"
                    wire:click="$dispatch('openModal', { component: 'create-user-modal' })"
                    class="w-full">
                    Add User
                </x-filament::button>

                <x-filament::button
                    icon="heroicon-o-adjustments-vertical"
                    {{-- href="{{ route('filament.admin.resources.users.index') }}" --}}
                    class="w-full">
                    Manage Users
                </x-filament::button>

                <x-filament::button
                    icon="heroicon-o-shield-check"
                    {{-- href="{{ route('filament.admin.resources.roles.index') }}" --}}
                    class="w-full">
                    Manage Roles
                </x-filament::button>

                <x-filament::button
                    icon="heroicon-o-chart-bar"
                    {{-- href="{{ route('filament.admin.resources.analytics.index') }}" --}}
                    class="w-full">
                    View Analytics
                </x-filament::button>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="mt-8 bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold mb-4">Recent Activity</h2>
        <div class="space-y-4">
            <!-- Sample activity items - replace with real data -->
            <div class="flex items-start space-x-3">
                <div class="bg-primary-100 p-2 rounded-full">
                    <x-heroicon-o-user-plus class="h-5 w-5 text-primary-600"/>
                </div>
                <div>
                    <p class="font-medium">New user registered</p>
                    <p class="text-sm text-gray-500">John Doe (Buyer) - 2 hours ago</p>
                </div>
            </div>
            <!-- Add more activity items here -->
        </div>
    </div>
</x-app-layout>



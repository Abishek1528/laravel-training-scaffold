<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Welcome, Admin!</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <x-card-summary-statistics :totalTasks="$totalTasks" :totalUsers="$totalUsers"/>
                    </div>

                    <div>
                        <x-card-recent-activty :recentTasks="$recentTasks" :recentUsers="$recentUsers"/>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-card-quick-links/>
                    </div>

                    <div>
                        <div class="border rounded-lg shadow-sm">
                            <div class="bg-gray-50 px-4 py-3 border-b font-bold text-gray-700">Actionable Items</div>
                            <div class="p-4">
                                <ul class="space-y-2">
                                    <li>
                                        <span class="text-sm text-gray-600">To Do tasks:</span> 
                                        <span class="font-bold text-blue-600">{{ $pendingTasksCount ?? 0 }}</span>
                                    </li>
                                    <li>
                                        <span class="text-sm text-gray-600">Completed tasks:</span> 
                                        <span class="font-bold text-green-600">{{ $completedTasksCount ?? 0 }}</span>
                                    </li>
                                    <li>
                                        <span class="text-sm text-gray-600">Users awaiting verification:</span> 
                                        <span class="font-bold text-yellow-600">{{ $pendingUsersCount ?? 0 }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

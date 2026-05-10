@props(['totalTasks', 'totalUsers'])

<div class="border rounded-lg shadow-sm">
    <div class="bg-gray-50 px-4 py-3 border-b font-bold text-gray-700">Statistics</div>
    <div class="p-4 grid grid-cols-2 gap-4">
        <div class="text-center">
            <div class="text-2xl font-bold text-indigo-600">{{ $totalTasks }}</div>
            <div class="text-xs text-gray-500 uppercase">Total Tasks</div>
        </div>
        <div class="text-center">
            <div class="text-2xl font-bold text-green-600">{{ $totalUsers }}</div>
            <div class="text-xs text-gray-500 uppercase">Total Users</div>
        </div>
    </div>
</div>

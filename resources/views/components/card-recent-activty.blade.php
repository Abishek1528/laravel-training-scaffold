@props(['recentTasks', 'recentUsers'])

<div class="border rounded-lg shadow-sm">
    <div class="bg-gray-50 px-4 py-3 border-b font-bold text-gray-700">Recent Activity</div>
    <div class="p-4 space-y-3">
        @if($recentTasks)
            <div class="text-sm">
                <span class="text-gray-500">Latest Task:</span>
                <span class="font-medium">{{ $recentTasks->title ?? 'Untitled' }}</span>
            </div>
        @endif
        @if($recentUsers)
            <div class="text-sm">
                <span class="text-gray-500">Latest User:</span>
                <span class="font-medium">{{ $recentUsers->name ?? 'Unknown' }}</span>
            </div>
        @endif
        @if(!$recentTasks && !$recentUsers)
            <div class="text-sm text-gray-500 italic">No recent activity.</div>
        @endif
    </div>
</div>

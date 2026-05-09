<div class="border rounded-lg shadow-sm">
    <div class="bg-gray-50 px-4 py-3 border-b font-bold text-gray-700">Quick Links</div>
    <div class="p-4">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('projects.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                    View All Projects
                </a>
            </li>
            @if(auth()->user()->role == 'admin')
                <li>
                    <span class="text-sm text-gray-500">Admin features coming soon...</span>
                </li>
            @endif
        </ul>
    </div>
</div>

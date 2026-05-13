<x-mail::message>
# Task Assigned

Hello, you have been assigned a new task!

**Task Title:** {{ $task->title }}  
**Description:** {{ $task->description ?? 'No description provided' }}  
**Due Date:** {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No due date' }}

<x-mail::button :url="route('tasks.show', [$task->project, $task])">
View Task
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

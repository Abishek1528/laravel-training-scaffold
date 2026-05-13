<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_project_belongs_to_user(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $project->user);
        $this->assertEquals($user->id, $project->user->id);
    }

    public function test_project_has_many_tasks(): void
    {
        $project = Project::factory()->create();
        Task::factory()->count(3)->create(['project_id' => $project->id]);

        $this->assertCount(3, $project->tasks);
        $this->assertInstanceOf(Task::class, $project->tasks->first());
    }

    public function test_project_belongs_to_many_users(): void
    {
        $project = Project::factory()->create();
        $users = User::factory()->count(2)->create();
        $project->members()->attach($users);

        $this->assertCount(2, $project->members);
        $this->assertInstanceOf(User::class, $project->members->first());
    }

    public function test_task_belongs_to_project(): void
    {
        $project = Project::factory()->create();
        $task = Task::factory()->create(['project_id' => $project->id]);

        $this->assertInstanceOf(Project::class, $task->project);
        $this->assertEquals($project->id, $task->project->id);
    }

    public function test_task_belongs_to_assignee(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['assigned_to_id' => $user->id]);

        $this->assertInstanceOf(User::class, $task->assignee);
        $this->assertEquals($user->id, $task->assignee->id);
    }

    public function test_task_has_many_comments(): void
    {
        $task = Task::factory()->create();
        Comment::factory()->count(3)->create(['task_id' => $task->id]);

        $this->assertCount(3, $task->comments);
        $this->assertInstanceOf(Comment::class, $task->comments->first());
    }

    public function test_comment_belongs_to_task(): void
    {
        $task = Task::factory()->create();
        $comment = Comment::factory()->create(['task_id' => $task->id]);

        $this->assertInstanceOf(Task::class, $comment->task);
        $this->assertEquals($task->id, $comment->task->id);
    }

    public function test_comment_belongs_to_user(): void
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $comment->user);
        $this->assertEquals($user->id, $comment->user->id);
    }

    public function test_user_has_many_projects(): void
    {
        $user = User::factory()->create();
        $projects = Project::factory()->count(3)->create();
        $user->projects()->attach($projects);

        $this->assertCount(3, $user->projects);
        $this->assertInstanceOf(Project::class, $user->projects->first());
    }

    public function test_user_has_many_owned_projects(): void
    {
        $user = User::factory()->create();
        Project::factory()->count(3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->ownedProjects);
        $this->assertInstanceOf(Project::class, $user->ownedProjects->first());
    }
}

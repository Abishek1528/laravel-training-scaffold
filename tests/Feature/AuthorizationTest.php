<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_project_owner_can_edit_project(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $owner->id]);

        $this->actingAs($otherUser);
        $response = $this->get(route('projects.edit', $project));
        $response->assertForbidden();

        $this->actingAs($owner);
        $response = $this->get(route('projects.edit', $project));
        $response->assertStatus(200);
    }

    public function test_only_project_owner_can_delete_project(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $owner->id]);

        $this->actingAs($otherUser);
        $response = $this->delete(route('projects.destroy', $project));
        $response->assertForbidden();
        $this->assertDatabaseHas('projects', ['id' => $project->id]);

        $this->actingAs($owner);
        $response = $this->delete(route('projects.destroy', $project));
        $response->assertRedirect();
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function test_only_project_owner_can_edit_task(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $owner->id]);
        $task = Task::factory()->create(['project_id' => $project->id]);

        $this->actingAs($otherUser);
        $response = $this->get(route('tasks.edit', [$project, $task]));
        $response->assertForbidden();

        $this->actingAs($owner);
        $response = $this->get(route('tasks.edit', [$project, $task]));
        $response->assertStatus(200);
    }

    public function test_only_project_owner_can_delete_task(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $owner->id]);
        $task = Task::factory()->create(['project_id' => $project->id]);

        $this->actingAs($otherUser);
        $response = $this->delete(route('tasks.destroy', [$project, $task]));
        $response->assertForbidden();
        $this->assertDatabaseHas('tasks', ['id' => $task->id]);

        $this->actingAs($owner);
        $response = $this->delete(route('tasks.destroy', [$project, $task]));
        $response->assertRedirect();
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}

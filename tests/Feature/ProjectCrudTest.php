<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_displays_projects(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Project::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->get(route('projects.index'));

        $response->assertStatus(200);
    }

    public function test_create_project(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $projectData = [
            'name' => 'Test Project',
            'description' => 'Test Description',
            'status' => 'active',
        ];

        $response = $this->post(route('projects.store'), $projectData);

        $response->assertRedirect(route('projects.index'));
        $this->assertDatabaseHas('projects', $projectData);
    }

    public function test_show_project(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $project = Project::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('projects.show', $project));

        $response->assertStatus(200);
        $response->assertSee($project->name);
    }

    public function test_edit_project(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $project = Project::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('projects.edit', $project));

        $response->assertStatus(200);
    }

    public function test_update_project(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $project = Project::factory()->create(['user_id' => $user->id]);

        $updatedData = [
            'name' => 'Updated Project',
            'description' => 'Updated Description',
            'status' => 'completed',
        ];

        $response = $this->put(route('projects.update', $project), $updatedData);

        $response->assertRedirect(route('projects.index'));
        $this->assertDatabaseHas('projects', $updatedData);
    }

    public function test_delete_project(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $project = Project::factory()->create(['user_id' => $user->id]);

        $response = $this->delete(route('projects.destroy', $project));

        $response->assertRedirect(route('projects.index'));
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }
}

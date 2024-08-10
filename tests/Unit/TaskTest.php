<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;


class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The function `test_task_create` creates a test task with specific details and asserts that the
     * task is stored in the database correctly.
     */
    public function test_task_create(): void
    {
        $users = User::factory()->create();

        $task = Task::create([
            'title' => 'Test Task',
            'description' => 'Test description',
            'due_date' => now()->addDays(7),
            'category' => 'Test',
            'user_id' => $users->id,
            'status' => 'pending',
        ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'description' => 'Test description',
            'category' => 'Test',
            'user_id' => $users->id,
            'status' => 'pending',
        ]);
    }

    /**
     * The test_task_update function tests updating a task's details in a PHP application.
     */
    public function test_task_update(): void
    {
        $user = User::factory()->create();

        $task = Task::create([
            'title' => 'Old Title',
            'description' => 'Old Description',
            'due_date' => now()->addDays(7),
            'category' => 'Old Category',
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        $task->update([
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'category' => 'Updated Category',
            'status' => 'completed',
        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'category' => 'Updated Category',
            'status' => 'completed',
        ]);

        $this->assertDatabaseMissing('tasks', [
            'title' => 'Old Title',
            'description' => 'Old Description',
            'category' => 'Old Category',
            'status' => 'pending',
        ]);
    }

    /**
     * The function `test_task_deletion` creates a task, deletes it, and then asserts that the task is
     * no longer present in the database.
     */
    public function test_task_deletion(): void
    {
        $user = User::factory()->create();

        $task = Task::create([
            'title' => 'Task to be Deleted',
            'description' => 'Description of task to be deleted',
            'due_date' => now()->addDays(7),
            'category' => 'Category',
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        // Delete the task
        $task->delete();

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
            'title' => 'Task to be Deleted',
            'description' => 'Description of task to be deleted',
            'category' => 'Category',
            'status' => 'pending',
        ]);
    }

    /**
     * The function tests if the task title is required when creating a new task.
     */
    public function test_task_title_required(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Make a POST request with an empty title
        $response = $this->post(route('task.store'), [
            'title' => '', // Empty title should trigger validation error
            'description' => 'Test description',
            'due_date' => now()->addDays(7),
            'category' => 'Test',
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('title');
        $errors = session('errors');
        $this->assertTrue($errors->has('title'));
    }
}

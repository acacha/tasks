<?php

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function user_can_have_tasks()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task1 = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();
        $task3 = factory(Task::class)->create();
        $user->addTask($task1);
        $user->addTask($task2);
        $user->addTask($task3);

        // 2 executar
        $tasks = $user->tasks;

        // 3 comprovar
        $this->assertTrue($tasks[0]->is($task1));
        $this->assertTrue($tasks[1]->is($task2));
        $this->assertTrue($tasks[2]->is($task3));
    }

    /**
     * @test
     */
    public function user_tasks_returns_null_when_no_tasks()
    {
        // 1 Preparar
        $user = factory(User::class)->create();

        // 2 executar
        $tasks = $user->tasks;

        // 3 comprovar
        $this->assertEmpty($tasks);
    }

    /**
     * @test
     */
    public function can_add_task_to_user()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();

        $user->addTask($task);

        // 2 executar
        $tasks = $user->tasks;

        // 3 comprovar
        $this->assertTrue($tasks[0]->is($task));
    }

    /**
     * @test
     */
    public function can_add_tasks_to_user()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task1 = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();
        $task3 = factory(Task::class)->create();
//        $tasks = [$task1, $task2, $task3];
        $tasks = [];
        array_push($tasks, $task1);
        array_push($tasks, $task2);
        array_push($tasks, $task3);

        // 2 executar
        $user->addTasks($tasks);

        // 3 comprovar
        $tasks = $user->tasks;
        $this->assertTrue($tasks[0]->is($task1));
        $this->assertTrue($tasks[1]->is($task2));
        $this->assertTrue($tasks[2]->is($task3));
    }

    /**
     * @test
     */
    public function haveTask()
    {
        // 2 Execute
//        $user->haveTask();
    }

    // https://laravel.com/docs/5.7/eloquent-relationships#inserting-and-updating-related-models

    /**
     * @test
     */
    public function removeTask()
    {
        // 2 Execute
//        $user->removeTask();
    }

    /**
     * @test
     */
    public function isSuperAdmin()
    {
        $user = factory(User::class)->create();
        $this->assertFalse($user->isSuperAdmin());
        $user->admin = true;
        $user->save();
        $this->assertTrue($user->isSuperAdmin());
    }
}

<?php

namespace Tests\Feature;

use App\Incident;
use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class homeViewTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function Unloggin_Users_Can_Not_See_The_Dashboard()
    {
        $this->get('/home')
            ->assertRedirect('/login');
    }

    /** @test */
    public function Unloggin_Users_Can_See_The_Welcome_Menu()
    {
        $this->get('/')
            ->assertSee('Bienvenido');
    }

    /** @test */
    public function Displays_the_Dashboard_To_Login_Users()
    {
        $user = factory(User::class)->create();

        $this->withoutExceptionHandling();

        $this->actingAs($user);

        $this->get(route('report'))
            ->assertStatus(200)
            ->assertSee('Registrar incidencia');

    }

    /** @test */
    public function admins_can_access_to_users_list()
    {
        $user = factory(User::class)->create(['role' => 0]);
        $this->withoutExceptionHandling();

        $this->actingAs($user);

        $this->get(route('supportUser.create'))
            ->assertSee('Bienvendio Administrador, el sitio esta bajo construccion');

    }

    /** @test */
    public function Only_admins_can_access_to_users_list()
    {
        $client = factory(User::class)->create(['role' => 1]);
        $support = factory(User::class)->create(['role' => 2]);

        $this->withoutExceptionHandling();

        $this->actingAs($client);
        $this->get(route('supportUser.create'))
            ->assertRedirect('home');

        $this->actingAs($support);
        $this->get(route('supportUser.create'))
            ->assertRedirect('home');

    }

    /** @test */
    public function it_creates_a_new_incident()
    {
        $user = factory(User::class)->create();
        $this->withoutExceptionHandling();
        $this->actingAs($user);
        $this->post('/reportar', [
            'category_id' => null,
            'severity' => 'M',
            'title' => 'Test',
            'description' => 'This is a test',
            'level_id' => null,
            'support_id' => null,
            'client_id' => $user->id,
        ])->assertRedirect(route('supportUser.create'));

        $this->assertDatabaseHas('incidents', [
            'category_id' => null,
            'severity' => 'M',
            'title' => 'Test',
            'description' => 'This is a test',
            'level_id' => null,
            'support_id' => null,
            'client_id' => $user->id,
        ]);
    }

    /** @test */
    public function validates_the_empty_fields_when_creating_an_incident()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->from(route('supportUser.create'))
            ->post('/reportar',
                [
                    'category_id' => '',
                    'severity' => '',
                    'title' => '',
                    'description' => '',
                ])
            ->assertRedirect(route('supportUser.create'))
            ->assertSessionHasErrors(
                [
                    'category_id' => 'Debes seleccionar una categoria',
                    'severity' => 'Debes seleccionar la severidad',
                    'title' => 'Debes colocar un título',
                    'description' => 'Debes colocar una descripción',
                ]);

        $this->assertEquals(0, Incident::count());
    }

    /** @test */
    public function validates_the_min_char_fields_when_creating_an_incident()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->from(route('supportUser.create'))
            ->post('/reportar',
                [
                    'category_id' => '1',
                    'severity' => 'Bad',
                    'title' => 'Test',
                    'description' => 'Test Data',
                ])
            ->assertRedirect(route('supportUser.create'))
            ->assertSessionHasErrors(
                [
                    'title' => 'El titulo no puede ser tan corto',
                    'description' => 'La descripción no puede ser tan corta',
                    'severity' => 'La severidad debe ser Menor, Normal o Alta',
                ]);

        $this->assertEquals(0, Incident::count());
    }

    /** @test */
    public function restoreTest()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $project = factory(Project::class)->create();
        $this->withoutExceptionHandling();
        $this->get(route('project.restore', $project))
            ->assertStatus(200);

    }
}

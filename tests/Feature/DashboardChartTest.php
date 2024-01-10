<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\DashboardChart;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardChartTest extends TestCase
{
    use  RefreshDatabase;

    protected string $endpoint = '/api/dashboardCharts';
    protected string $tableName = 'dashboardCharts';

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateDashboardChart(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $payload = DashboardChart::factory()->make([])->toArray();

        $this->json('POST', $this->endpoint, $payload)
             ->assertStatus(201)
             ->assertSee($payload['name']);

        $this->assertDatabaseHas($this->tableName, ['id' => 1]);
    }

    public function testViewAllDummiesSuccessfully(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        DashboardChart::factory(5)->create();

        $this->json('GET', $this->endpoint)
             ->assertStatus(200)
             ->assertJsonCount(5, 'data')
             ->assertSee(DashboardChart::first(rand(1, 5))->name);
    }

    public function testViewAllDummiesByFooFilter(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        DashboardChart::factory(5)->create();

        $this->json('GET', $this->endpoint.'?foo=1')
             ->assertStatus(200)
             ->assertSee('foo')
             ->assertDontSee('foo');
    }

    public function testsCreateDashboardChartValidation(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $data = [
        ];

        $this->json('post', $this->endpoint, $data)
             ->assertStatus(422);
    }

    public function testViewDashboardChartData(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        DashboardChart::factory()->create();

        $this->json('GET', $this->endpoint.'/1')
             ->assertSee(DashboardChart::first()->name)
             ->assertStatus(200);
    }

    public function testUpdateDashboardChart(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        DashboardChart::factory()->create();

        $payload = [
            'name' => 'Random'
        ];

        $this->json('PUT', $this->endpoint.'/1', $payload)
             ->assertStatus(200)
             ->assertSee($payload['name']);
    }

    public function testDeleteDashboardChart(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        DashboardChart::factory()->create();

        $this->json('DELETE', $this->endpoint.'/1')
             ->assertStatus(204);

        $this->assertEquals(0, DashboardChart::count());
    }
    
}

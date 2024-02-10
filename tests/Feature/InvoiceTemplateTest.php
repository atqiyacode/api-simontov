<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\InvoiceTemplate;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvoiceTemplateTest extends TestCase
{
    use  RefreshDatabase;

    protected string $endpoint = '/api/invoiceTemplates';
    protected string $tableName = 'invoiceTemplates';

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateInvoiceTemplate(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $payload = InvoiceTemplate::factory()->make([])->toArray();

        $this->json('POST', $this->endpoint, $payload)
             ->assertStatus(201)
             ->assertSee($payload['name']);

        $this->assertDatabaseHas($this->tableName, ['id' => 1]);
    }

    public function testViewAllInvoiceTemplatesSuccessfully(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        InvoiceTemplate::factory(5)->create();

        $this->json('GET', $this->endpoint)
             ->assertStatus(200)
             ->assertJsonCount(5, 'data')
             ->assertSee(InvoiceTemplate::first(rand(1, 5))->name);
    }

    public function testViewAllInvoiceTemplatesByFooFilter(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        InvoiceTemplate::factory(5)->create();

        $this->json('GET', $this->endpoint.'?foo=1')
             ->assertStatus(200)
             ->assertSee('foo')
             ->assertDontSee('foo');
    }

    public function testsCreateInvoiceTemplateValidation(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $data = [
        ];

        $this->json('post', $this->endpoint, $data)
             ->assertStatus(422);
    }

    public function testViewInvoiceTemplateData(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        InvoiceTemplate::factory()->create();

        $this->json('GET', $this->endpoint.'/1')
             ->assertSee(InvoiceTemplate::first()->name)
             ->assertStatus(200);
    }

    public function testUpdateInvoiceTemplate(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        InvoiceTemplate::factory()->create();

        $payload = [
            'name' => 'Random'
        ];

        $this->json('PUT', $this->endpoint.'/1', $payload)
             ->assertStatus(200)
             ->assertSee($payload['name']);
    }

    public function testDeleteInvoiceTemplate(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        InvoiceTemplate::factory()->create();

        $this->json('DELETE', $this->endpoint.'/1')
             ->assertStatus(204);

        $this->assertEquals(0, InvoiceTemplate::count());
    }
    
}

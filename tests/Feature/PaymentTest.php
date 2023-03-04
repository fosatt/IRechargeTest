<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class PaymentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_charge_customer()
    {
        $customer = Customer::factory()->create();

        $response = $this->postJson('/api/customers/'.$customer->id.'/payments', [
            "amount" => 2000,
            "transaction_id" => Str::random(16),
            "card_number"  => 5531886652142950,
            "cvv"  => 564,
            "expiry_month" => "09",
            "expiry_year" => "32"
        ]);
        
        $this->assertEquals(true, strtolower($response['status']));

        $response->assertStatus(201);

    }
}

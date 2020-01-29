<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EndpointsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test GET '/api/customers' endpoint.
     *
     * @return void
     */
    public function testCustomersList()
    {
        $response = $this->get('/api/customers');

        $response->assertStatus(200);
    }

    /**
     * Test GET '/api/orders' endpoint.
     *
     * @return void
     */
    public function testOrdersList()
    {
        $response = $this->get('/api/orders');

        $response->assertStatus(200);
    }

    /**
     * Test GET '/api/subscriptions' endpoint.
     *
     * @return void
     */
    public function testSubscriptionsList()
    {
        $response = $this->get('/api/subscriptions');

        $response->assertStatus(200);
    }
}

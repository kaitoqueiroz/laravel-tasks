<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EndpointsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test GET '/api/unexisting-endpoint-url' endpoint not found.
     *
     * @return void
     */
    public function test404Endpoint()
    {
        $response = $this->get('/api/unexisting-endpoint-url');

        $response->assertStatus(404);
    }

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

    /**
     * Test GET '/api/customers/set-iteration-frequency' endpoint method not allowed.
     *
     * @return void
     */
    public function testSetIterationFrequencyMethodNotAllowed()
    {
        $response = $this->get('/api/subscriptions/set-iteration-frequency');

        $response->assertStatus(405);
    }
}

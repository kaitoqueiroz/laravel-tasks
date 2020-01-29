<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TasksTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test GET '/api/customers/last-paid-order' endpoint.
     *
     * @return void
     */
    public function testLastPaidOrder()
    {
        $response = $this->get('/api/customers/last-paid-order');

        $response->assertStatus(200);
    }

    /**
     * Test GET '/api/customers/more-than-one-paid-order' endpoint.
     *
     * @return void
     */
    public function testMoreThanOnePaidOrder()
    {
        $response = $this->get('/api/customers/more-than-one-paid-order');

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Customer;
use App\Models\Subscription;

class TasksTest extends TestCase
{
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

    /**
     * Test PUT '/api/customers/set-iteration-frequency' endpoint successfully.
     *
     * @return void
     */
    public function testSetIterationFrequencySuccessfully()
    {
        $dayIteration = 20;
        $customer = factory(Customer::class)->create();
        $subscription = factory(Subscription::class)->create([
            'customer_id' => $customer->id,
            'day_iteration' => 50,
        ]);

        $payload = [ 'customer_id' => $customer->id, 'frequency' => $dayIteration ];

        $response = $this->json('PUT', '/api/subscriptions/set-iteration-frequency', $payload);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Iteration frequency updated successfully.',
            ]);
    }

    /**
     * Test PUT '/api/customers/set-iteration-frequency' endpoint without customer_id.
     *
     * @return void
     */
    public function testSetIterationFrequencyWithoutCustomerId()
    {
        $dayIteration = 20;
        $customer = factory(Customer::class)->create();
        $subscription = factory(Subscription::class)->create([
            'customer_id' => $customer->id,
            'day_iteration' => 50,
        ]);

        $payload = [ 'frequency' => $dayIteration ];

        $response = $this->json('PUT', '/api/subscriptions/set-iteration-frequency', $payload);

        $response->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'customer_id' => [
                        'The customer id field is required.'
                    ]
                ]
            ]);
    }

    /**
     * Test PUT '/api/customers/set-iteration-frequency' endpoint without frequency.
     *
     * @return void
     */
    public function testSetIterationFrequencyWithoutFrequency()
    {
        $dayIteration = 20;
        $customer = factory(Customer::class)->create();
        $subscription = factory(Subscription::class)->create([
            'customer_id' => $customer->id,
            'day_iteration' => 50,
        ]);

        $payload = [ 'customer_id' => $customer->id ];

        $response = $this->json('PUT', '/api/subscriptions/set-iteration-frequency', $payload);

        $response->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'frequency' => [
                        'The frequency field is required.'
                    ]
                ]
            ]);
    }

    /**
     * Test PUT '/api/customers/set-iteration-frequency' endpoint invalid customer id.
     *
     * @return void
     */
    public function testSetIterationFrequencyWithoutCustomerNotFound()
    {
        $dayIteration = 20;
        $customer = factory(Customer::class)->create();
        $subscription = factory(Subscription::class)->create([
            'customer_id' => $customer->id,
            'day_iteration' => 50,
        ]);

        $payload = [ 'customer_id' => 99999999, 'frequency' => $dayIteration ];

        $response = $this->json('PUT', '/api/subscriptions/set-iteration-frequency', $payload);

        $response->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'customer_id' => [
                        'The selected customer id is invalid.'
                    ]
                ]
            ]);
    }
}

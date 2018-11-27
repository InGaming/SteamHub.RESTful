<?php

namespace Tests\Unit;

use phpDocumentor\Reflection\Types\{Boolean, Integer, String_};
use Tests\TestCase;

class GamePriceTest extends TestCase
{
    /**
     * A basic test param length.
     *
     * @var Integer $length => min:1|max:100
     * @return void
     */
    public function testParamLength()
    {
        // Param verification failed
        $verification_failed_response =
            $this->json('get', '/api/v3/game/price', [
                'length' => 101,
            ]);

        $verification_failed_response
            ->assertStatus(422);

        $response = $this->json('get', '/api/v3/game/price', [
            'length' => 10
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonCount(10, 'data')
            ->assertJson([
                'meta' => [
                    'per_page' => 10,
                ],
            ]);
    }

    /**
     * A basic test param simple paginate.
     *
     * @var Boolean $simple_paginate
     * @return void
     */
    public function testParamSimplePaginate()
    {
        // Param verification failed
        $verification_failed_response =
            $this->json('get', '/api/v3/game/price', [
                'simple_paginate' => 2,
            ]);

        $verification_failed_response
            ->assertStatus(422);

        $response = $this->json('get', '/api/v3/game/price', [
            'simple_paginate' => 1
        ]);

        $response
            ->assertStatus(200)
            ->assertDontSeeText('total');
    }

    /**
     * A basic test param order
     *
     * @var String_ $order => asc|desc
     * @var String_ $order_field => metacritic_score|steam_user_score|released_at|created_at|updated_at
     * @return void
     */

    public function testParamOrder()
    {
        // Param verification failed
        $verification_failed_response =
            $this->json('get', '/api/v3/game/price', [
                'order' => 'desc',
            ]);

        $verification_failed_response
            ->assertStatus(422);

        // A param for final
        $final_response_success =
            $this->json('get', '/api/v3/game/price', [
                'order' => 'desc',
                'order_field' => 'final'
            ]);

        $final_response_success
            ->assertStatus(200)
            ->assertSeeTextInOrder([
                'final'
            ]);

        // A param for initial
        $initial_response =
            $this->json('get', '/api/v3/game/price', [
                'order' => 'desc',
                'order_field' => 'initial'
            ]);

        $initial_response
            ->assertStatus(200)
            ->assertSeeTextInOrder([
                'initial'
            ]);

        // A param for discount
        $discount_response =
            $this->json('get', '/api/v3/game/price', [
                'order' => 'desc',
                'order_field' => 'discount'
            ]);

        $discount_response
            ->assertStatus(200)
            ->assertSeeTextInOrder([
                'discount'
            ]);

        // A param for created at
        $created_at_response =
            $this->json('get', '/api/v3/game/price', [
                'order' => 'desc',
                'order_field' => 'created_at'
            ]);

        $created_at_response
            ->assertStatus(200);

        // A param for updated at
        $updated_at_response =
            $this->json('get', '/api/v3/game/price', [
                'order' => 'desc',
                'order_field' => 'updated_at'
            ]);

        $updated_at_response
            ->assertStatus(200);
    }

    /**
     * A basic test param free
     *
     * @var String_ $country
     * @return void
     */
    public function testParamCountry()
    {
        // Param verification failed
        $verification_failed_response =
            $this->json('get', '/api/v3/game/price', [
                'country' => 'us',
            ]);

        $verification_failed_response
            ->assertStatus(422);

        // A param for country
        $country_response =
            $this->json('get', '/api/v3/game/price', [
                'country' => 'china',
            ]);

        $country_response
            ->assertStatus(200)
            ->assertSeeInOrder([
                'country' => 'china'
            ]);
    }

    /**
     * A basic test param final
     *
     * @var Integer $final
     */
    public function testFinalParam()
    {
        // Param verification failed
        $verification_failed_response =
            $this->json('get', '/api/v3/game/price', [
                'final' => 'a',
            ]);

        $verification_failed_response
            ->assertStatus(422);

        // A param for final
        $final_response =
            $this->json('get', '/api/v3/game/price', [
                'final' => 100
            ]);

        $final_response
            ->assertStatus(200);
    }

    /**
     * A basic test param appids
     *
     * @var Integer $initial
     */
    public function testInitialParam()
    {
        // Param verification failed
        $verification_failed_response =
            $this->json('get', '/api/v3/game/price', [
                'initial' => 'a',
            ]);

        $verification_failed_response
            ->assertStatus(422);

        // A param for appids
        $initial_response =
            $this->json('get', '/api/v3/game/price', [
                'initial' => 100,
            ]);

        $initial_response
            ->assertStatus(200);
    }

    /**
     * A basic test param discount
     *
     * @var Integer $discount
     */
    public function testDiscountGames()
    {
        // Param verification failed
        $verification_failed_response =
            $this->json('get', '/api/v3/game/price', [
                'discount' => 'a',
            ]);

        $verification_failed_response
            ->assertStatus(422);

        // A param for appids
        $discount_response =
            $this->json('get', '/api/v3/game/price', [
                'discount' => 100,
            ]);

        $discount_response
            ->assertStatus(200);
    }
}

<?php

namespace Tests\Unit;

use phpDocumentor\Reflection\Types\{Boolean, Integer, String_};
use Tests\TestCase;

class GameListTest extends TestCase
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
            $this->json('get', '/api/v3/game/list', [
                'length' => 101,
            ]);

        $verification_failed_response
            ->assertStatus(422);

        $response = $this->json('get', '/api/v3/game/list', [
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
            $this->json('get', '/api/v3/game/list', [
                'simple_paginate' => 2,
            ]);

        $verification_failed_response
            ->assertStatus(422);

        $response = $this->json('get', '/api/v3/game/list', [
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
            $this->json('get', '/api/v3/game/list', [
                'order' => 'desc',
            ]);

        $verification_failed_response
            ->assertStatus(422);

        // A param for metacritic score
        $metacritic_score_response_success =
            $this->json('get', '/api/v3/game/list', [
                'order' => 'desc',
                'order_field' => 'metacritic_score'
            ]);

        $metacritic_score_response_success
            ->assertStatus(200)
            ->assertSeeTextInOrder([
                'metacritic_score'
            ]);

        // A param for steam user score
        $steam_user_score_response =
            $this->json('get', '/api/v3/game/list', [
                'order' => 'desc',
                'order_field' => 'steam_user_score'
            ]);

        $steam_user_score_response
            ->assertStatus(200)
            ->assertSeeTextInOrder([
                'steam_user_score'
            ]);

        // A param for released at
        $released_at_response =
            $this->json('get', '/api/v3/game/list', [
                'order' => 'desc',
                'order_field' => 'released_at'
            ]);

        $released_at_response
            ->assertStatus(200)
            ->assertSeeTextInOrder([
                'steam_user_score'
            ]);

        // A param for created at
        $created_at_response =
            $this->json('get', '/api/v3/game/list', [
                'order' => 'desc',
                'order_field' => 'created_at'
            ]);

        $created_at_response
            ->assertStatus(200);

        // A param for updated at
        $updated_at_response =
            $this->json('get', '/api/v3/game/list', [
                'order' => 'desc',
                'order_field' => 'updated_at'
            ]);

        $updated_at_response
            ->assertStatus(200);
    }

    /**
     * A basic test param free
     *
     * @var Boolean $free
     * @return void
     */
    public function testParamFree()
    {
        // Param verification failed
        $verification_failed_response =
            $this->json('get', '/api/v3/game/list', [
                'free' => 2,
            ]);

        $verification_failed_response
            ->assertStatus(422);

        // A param for free
        $free_response =
            $this->json('get', '/api/v3/game/list', [
                'free' => 0,
            ]);

        $free_response
            ->assertStatus(200)
            ->assertSeeInOrder([
                'free' => 0
            ]);
    }

    /**
     * A basic test param q
     *
     * @var String_ $q
     */
    public function testQueryParam()
    {
        // Param verification failed
        $verification_failed_response =
            $this->json('get', '/api/v3/game/list', [
                'q' => null,
            ]);

        $verification_failed_response
            ->assertStatus(422);

        // A param for q
        $q_response =
            $this->json('get', '/api/v3/game/list', [
                'q' => 'a',
            ]);

        $q_response
            ->assertStatus(200);
    }

    /**
     * A basic test param appids
     *
     * @var String_ $appids
     */
    public function testAppidsParam()
    {
        // Param verification failed
        $verification_failed_response =
            $this->json('get', '/api/v3/game/list', [
                'appids' => null,
            ]);

        $verification_failed_response
            ->assertStatus(422);

        // A param for appids
        $appids_response =
            $this->json('get', '/api/v3/game/list', [
                'appids' => '1,2',
            ]);

        $appids_response
            ->assertStatus(200);
    }

    /**
     * A basic test action show
     *
     */
    public function testShowGames()
    {
        $show_response =
            $this->json('get', '/api/v3/game/list/1,2');

        $show_response
            ->assertStatus(200);
    }
}

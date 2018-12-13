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
            ->assertDontSeeText('meta.total');
    }

    /**
     * A basic test param order
     *
     * @var String_ $order => asc|desc
     * @var String_ $order_field => metacritic_review_score|steam_user_review_score|released_at|created_at|updated_at
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

        // A param for age
        $agd_response_success =
            $this->json('get', '/api/v3/game/list', [
                'order' => 'desc',
                'order_field' => 'age'
            ]);

        $agd_response_success
            ->assertStatus(200)
            ->assertSeeTextInOrder([
                'age'
            ]);

        // A param for metacritic score
        $metacritic_review_score_response_success =
            $this->json('get', '/api/v3/game/list', [
                'order' => 'desc',
                'order_field' => 'metacritic_review_score'
            ]);

        $metacritic_review_score_response_success
            ->assertStatus(200)
            ->assertSeeTextInOrder([
                'metacritic_review_score'
            ]);

        // A param for steam_user_review_score
        $steam_user_review_score_response =
            $this->json('get', '/api/v3/game/list', [
                'order' => 'desc',
                'order_field' => 'steam_user_review_score'
            ]);

        $steam_user_review_score_response
            ->assertStatus(200)
            ->assertSeeTextInOrder([
                'steam_user_review_score'
            ]);

        // A param for steam_user_review_count
        $steam_user_review_count_response =
            $this->json('get', '/api/v3/game/list', [
                'order' => 'desc',
                'order_field' => 'steam_user_review_count'
            ]);

        $steam_user_review_count_response
            ->assertStatus(200)
            ->assertSeeTextInOrder([
                'steam_user_review_count'
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
                'steam_user_review_score'
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
     * A basic test param age
     *
     * @var Boolean $age
     * @return void
     */
    public function testParamAge()
    {
        // Param verification failed
        $verification_failed_response =
            $this->json('get', '/api/v3/game/list', [
                'age' => 101,
            ]);

        $verification_failed_response
            ->assertStatus(422);

        // A param for age
        $age_response =
            $this->json('get', '/api/v3/game/list', [
                'age' => 0,
            ]);

        $age_response
            ->assertStatus(200);
    }

    /**
     * A basic test param type
     *
     * @var Boolean $type
     * @return void
     */
    public function testParamType()
    {
        // Param verification failed
        $verification_failed_response =
            $this->json('get', '/api/v3/game/list', [
                'type' => null,
            ]);

        $verification_failed_response
            ->assertStatus(422);

        // A param for type
        $type_response =
            $this->json('get', '/api/v3/game/list', [
                'type' => 'a',
            ]);

        $type_response
            ->assertStatus(200);
    }

    /**
     * A basic test param metacritic_review_link
     *
     * @var Boolean $metacritic_review_link
     * @return void
     */
    public function testParamMetacriticReviewLink()
    {
        // Param verification failed
        $verification_failed_response =
            $this->json('get', '/api/v3/game/list', [
                'metacritic_review_link' => 'abc.com',
            ]);

        $verification_failed_response
            ->assertStatus(422);

        // A param for metacritic_review_link
        $metacritic_review_link_response =
            $this->json('get', '/api/v3/game/list', [
                'metacritic_review_link' => 'https://abc.com',
            ]);

        $metacritic_review_link_response
            ->assertStatus(200);
    }

    /**
     * A basic test param steam_user_review_summary
     *
     * @var Boolean $steam_user_review_summary
     * @return void
     */
    public function testParamSteamUserReviewSummary()
    {
        // Param verification failed
        $verification_failed_response =
            $this->json('get', '/api/v3/game/list', [
                'steam_user_review_summary' => null,
            ]);

        $verification_failed_response
            ->assertStatus(422);

        // A param for steam_user_review_summary
        $steam_user_review_summary_response =
            $this->json('get', '/api/v3/game/list', [
                'steam_user_review_summary' => 'a',
            ]);

        $steam_user_review_summary_response
            ->assertStatus(200);
    }

    /**
     * A basic test param language
     *
     * @var Boolean $language
     * @return void
     */
    public function testParamLanguage()
    {
        // Param verification failed
        $verification_failed_response =
            $this->json('get', '/api/v3/game/list', [
                'language' => null,
            ]);

        $verification_failed_response
            ->assertStatus(422);

        // A param for language
        $language_response =
            $this->json('get', '/api/v3/game/list', [
                'language' => 'a',
            ]);

        $language_response
            ->assertStatus(200);
    }

    /**
     * A basic test param platform
     *
     * @var Boolean $platform
     * @return void
     */
    public function testParamPlatform()
    {
        // Param verification failed
        $verification_failed_response =
            $this->json('get', '/api/v3/game/list', [
                'platform' => 'steam_os',
            ]);

        $verification_failed_response
            ->assertStatus(422);

        // A param for platform
        $platform_response =
            $this->json('get', '/api/v3/game/list', [
                'platform' => 'windows',
            ]);

        $platform_response
            ->assertStatus(200);
    }

    /**
     * A basic test param developer
     *
     * @var Boolean $developer
     * @return void
     */
    public function testParamDeveloper()
    {
        // Param verification failed
        $verification_failed_response =
            $this->json('get', '/api/v3/game/list', [
                'developer' => null,
            ]);

        $verification_failed_response
            ->assertStatus(422);

        // A param for developer
        $developer_response =
            $this->json('get', '/api/v3/game/list', [
                'developer' => 'valve',
            ]);

        $developer_response
            ->assertStatus(200);
    }

    /**
     * A basic test param publisher
     *
     * @var Boolean $publisher
     * @return void
     */
    public function testParamPublisher()
    {
        // Param verification failed
        $verification_failed_response =
            $this->json('get', '/api/v3/game/list', [
                'publisher' => null,
            ]);

        $verification_failed_response
            ->assertStatus(422);

        // A param for publisher
        $publisher_response =
            $this->json('get', '/api/v3/game/list', [
                'publisher' => 'valve',
            ]);

        $publisher_response
            ->assertStatus(200);
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

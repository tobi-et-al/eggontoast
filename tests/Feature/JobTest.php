<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobTest extends TestCase
{

    public function testsJobsAreCreatedCorrectly()
    {
        $user = factory(\App\Model\User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'title' => 'Test title',
            'category' => 'Test category',
            'description' => 'Test description',
            'location' => 'Test location',
        ];

        $this->json('POST', '/api/job', $payload, $headers)
            ->assertStatus(201)
            ->assertJsonFragment(['title' => 'Test title',
                                  'category' => 'Test category',
                                  'description' => 'Test description',
                                  'location' => 'Test location']);
    }

    public function testsJobsAreUpdatedCorrectly()
    {
        $user = factory(\App\Model\User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $job = factory(\App\Model\Job::class)->create([
            'title' => 'Test title',
            'category' => 'Test category',
            'description' => 'Test description',
            'location' => 'Test location'
        ]);

        $payload = [
            'title' => 'Test title2',
            'category' => 'Test category2'
        ];

        $response = $this->json('PUT', '/api/job/' . $job->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => 1,
                'title' => 'Test title2',
                'category' => 'Test category2'
            ]);
    }

        public function testsJobsAreDeletedCorrectly()
    {
        $user = factory(\App\Model\User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $job = factory(\App\Model\Job::class)->create([
            'title' => 'Test title',
            'category' => 'Test category',
            'description' => 'Test description',
            'location' => 'Test location'
        ]);

        $this->json('DELETE', '/api/job/' . $job->id, [], $headers)
            ->assertStatus(200);
        //should be 204 - for deleted resources
    }

        public function testJobsAreListedCorrectly()
    {
        factory(\App\Model\Job::class)->create([

            'category' => 'First category',
            'description'=>'First description',
            'location'=>'First description',
            'title' => 'First title'
        ]);

        factory(\App\Model\Job::class)->create([
            'category' => 'Second category',
            'description'=>'Second description',
            'location'=>'Second description',
            'title' => 'Second title',
        ]);

        $user = factory(\App\Model\User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/job', [], $headers)
            ->assertStatus(200)
            ->assertJsonFragment(
                [ 'title' => 'First title', 'category' => 'First category' ],
                [ 'title' => 'Second title', 'category' => 'Second category' ]
            );
    }
}

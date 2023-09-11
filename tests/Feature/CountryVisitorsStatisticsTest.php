<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class CountryVisitorsStatisticsTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        $mockPredis = Mockery::mock(\Redis::class);
        $this->app->instance('redis', $mockPredis);
        $this->redis = $mockPredis;
    }


    protected function tearDown(): void
    {
        Mockery::close();
    }

    /**
     * A basic feature test example.
     */
    public function testGetCountriesVisitors(): void
    {
        $this->redis->shouldReceive('hgetall')->andReturnValues([['cy' => 1]])->once();

        $response = $this->get('/api/countries/visitors/get');
        $response->assertStatus(200);
        $content = $response->getOriginalContent();
        self::assertEquals('cy', $content['data']->countries[0]->code);
        self::assertEquals(1, $content['data']->countries[0]->visitorsCount);

        $this->redis->shouldReceive('hgetall');

        $response = $this->get('/api/countries/visitors/get');
        $response->assertStatus(200);
    }

    public function testUpdateVisitorsStatistics(): void
    {
        $this->redis->shouldReceive('hincrby')->with('test');

        $response = $this->postJson('/api/countries/visitors/update', ['countryCode' => 'test']);
        $response->assertStatus(400);
        self::assertStringContainsString('Country test is not allowed to increment', $response['data']);

        $this->redis->shouldReceive('hincrby');
        $response = $this->postJson('/api/countries/visitors/update', ['countryCode' => 'it']);
        $response->assertStatus(200);

        $this->redis->shouldReceive('hincrby');
        $response = $this->postJson('/api/countries/visitors/update', []);
        $response->assertStatus(400);
        self::assertStringContainsString('Country  is not allowed to increment', $response['data']);
    }
}

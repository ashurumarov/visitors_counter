<?php

namespace Tests\Unit;

use App\Exceptions\NotAllowedCountryException;
use App\Services\CountryVisitorsStatisticsService;
use Illuminate\Support\Facades\Redis;
use PHPUnit\Framework\TestCase;

class CountryVisitorsStatisticsTest extends TestCase
{

    /**
     * A basic unit test example.
     */
    public function testGetCountriesVisitors(): void
    {
        $service = new CountryVisitorsStatisticsService();
        Redis::shouldReceive('hgetall')->andReturnValues([['cy' => 1]])->once();
        $result = $service->getCountriesVisitors();

        self::assertEquals('cy', $result->countries[0]->code);
        self::assertEquals(1, $result->countries[0]->visitorsCount);
    }

    public function testUpdateVisitorsStatistics(): void
    {
        $service = new CountryVisitorsStatisticsService();
        Redis::shouldReceive('hincrby')->andReturns([1]);
        try {
            $result = $service->updateVisitorsStatistics('cy');
        } catch (NotAllowedCountryException $e) {
            self::assertEquals('Country cy is not allowed to increment', $e->getMessage());
        }

        self::assertTrue($result);


        try {
            $result = $service->updateVisitorsStatistics('test');
        } catch (NotAllowedCountryException $e) {
            self::assertEquals('Country test is not allowed to increment', $e->getMessage());
        }
    }
}

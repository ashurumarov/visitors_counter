<?php
declare(strict_types=1);

namespace App\Services;


use App\DTO\CountriesDTO;
use App\DTO\CountryVisitorsDTO;
use App\Exceptions\NotAllowedCountryException;
use Illuminate\Support\Facades\Redis;

class CountryVisitorsStatisticsService
{
    private const REDIS_KEY = 'countries';
    private const INCREMENT_STEP = 1;
    private const ALLOWED_COUNTRIES = ['us', 'ru', 'it', 'hr', 'cy',];

    /**
     * @param string|null $country
     * @return bool
     * @throws NotAllowedCountryException
     */
    public function updateVisitorsStatistics(?string $country): bool
    {
        if (!in_array($country, self::ALLOWED_COUNTRIES)) {
            throw new NotAllowedCountryException($country);
        }

        $result = Redis::hincrby(self::REDIS_KEY, $country, self::INCREMENT_STEP);
        return $result > 0;
    }

    /**
     * @return CountriesDTO
     */
    public function getCountriesVisitors(): CountriesDTO
    {
        $countriesDTO = new CountriesDTO();
        $countries = Redis::hgetall(self::REDIS_KEY);

        if (!$countries) {
            return $countriesDTO;
        }

        foreach ($countries as $countryCode => $countryCount) {
            $countryVisitorsDTO = new CountryVisitorsDTO();
            $countryVisitorsDTO->code = $countryCode;
            $countryVisitorsDTO->visitorsCount = (int)$countryCount;
            $countriesDTO->countries[] = $countryVisitorsDTO;
        }
        return $countriesDTO;
    }

}

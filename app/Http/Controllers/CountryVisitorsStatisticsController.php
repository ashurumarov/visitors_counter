<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\NotAllowedCountryException;
use App\Http\Requests\CountryVisitorsStatisticsRequest;
use App\Http\Response\CountryVisitorsStatisticsResponse;
use App\Services\CountryVisitorsStatisticsService;
use Exception;
use Illuminate\Http\Response;

class CountryVisitorsStatisticsController
{
    private CountryVisitorsStatisticsService $countryVisitorsStatisticsService;

    public function __construct(CountryVisitorsStatisticsService $countryVisitorsStatisticsService)
    {
        $this->countryVisitorsStatisticsService = $countryVisitorsStatisticsService;
    }

    /**
     * @param CountryVisitorsStatisticsRequest $request
     * @return CountryVisitorsStatisticsResponse
     */
    public function updateCountryVisitors(CountryVisitorsStatisticsRequest $request): CountryVisitorsStatisticsResponse
    {
        try {
            $result = $this->countryVisitorsStatisticsService->updateVisitorsStatistics($request->countryCode);
        } catch (NotAllowedCountryException $e) {
            return new CountryVisitorsStatisticsResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
            return new CountryVisitorsStatisticsResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new CountryVisitorsStatisticsResponse($result, Response::HTTP_OK);
    }

    /**
     * @return CountryVisitorsStatisticsResponse
     */
    public function getCountriesVisitors(): CountryVisitorsStatisticsResponse
    {
        try {
            $result = $this->countryVisitorsStatisticsService->getCountriesVisitors();
        } catch (Exception $e) {
            return new CountryVisitorsStatisticsResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new CountryVisitorsStatisticsResponse($result, Response::HTTP_OK);
    }
}

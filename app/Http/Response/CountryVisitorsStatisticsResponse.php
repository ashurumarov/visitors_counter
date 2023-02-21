<?php
declare(strict_types=1);

namespace App\Http\Response;


class CountryVisitorsStatisticsResponse extends BaseResponse
{
    public function __construct($data = null, $status = 200, $headers = [], $options = 0, $json = false)
    {
        parent::__construct($this->response($data, $status), $status, $headers, $options, $json);
    }
}

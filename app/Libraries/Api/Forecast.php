<?php
namespace App\Libraries\Api;

class Forecast
{
    const BASE_URL = 'https://www.jma.go.jp';
    const OVERVIEW_PATH = '/bosai/forecast/data/overview_forecast/';
    const CODE_TOKYO = 130000;

    /**
     * 天気予報の概要を取得します
     *
     * @param code: string
     * @return string
     */
    public function loadOverviewText($code = self::CODE_TOKYO)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request(
            'GET',
            $this->makeOverviewUrl($code)
        );
        if ($response->getStatusCode() != 200) return '';
        $jsonObj = json_decode($response->getBody()->getContents(), true);
        return $jsonObj['text'];
    }

    /**
     * overviewのurlを生成します。
     *
     * @param code: string
     * @return string
     */
    public function makeOverviewUrl($code)
    {
        return self::BASE_URL . self::OVERVIEW_PATH . "${code}.json";
    }
}

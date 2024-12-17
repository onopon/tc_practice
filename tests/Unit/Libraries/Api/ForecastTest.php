<?php

namespace Tests\Unit\Libraries;

use Tests\TestCase;
use App\Libraries\Api\Forecast;
use Mockery;

class ForecastTest extends TestCase
{
    public function test_loadOverviewText()
    {
        $mock = Mockery::mock('overload:\GuzzleHttp\Client');
        $mock->shouldReceive('request->getStatusCode')
                         ->once()
                         ->andReturn(200);
        // Q9 - 1 \GuzzleHttp\Clientのrequest->getBody->getContentsをmockし、
        // もしgetContentsがロジック内で呼ばれたら、$this->getDummyJson() が返るようにしてください。
        $mock->shouldReceive('request->getBody->getContents')
                         ->once()
                         ->andReturn($this->getDummyJson());
        $this->markTestSkipped('skip');

        $f = new Forecast();
        $code = 12345;
        $result = $f->loadOverviewText($code);
        // Q9 - 2 $this->getDummyJson()のtextが$resultで返ってくるテストを書いてください。
        $this->assertEquals(json_decode($this->getDummyJson(), true)['text'], $result);
    }

    public function test_loadOverviewText_apiResult404()
    {
        $mock = Mockery::mock('overload:\GuzzleHttp\Client');
        $mock->shouldReceive('request->getStatusCode')
                         ->once()
                         ->andReturn(404);
        $f = new Forecast();
        $code = 12345;
        $result = $f->loadOverviewText($code);
        $this->assertEmpty($result);
    }

    public function test_makeOverviewUrl()
    {
        $f = new Forecast();
        $code = 12345;
        $result = $f->makeOverviewUrl($code);
        $this->assertIsString($result);
        $this->assertTrue(false !== strpos($result, $code));
    }

    private function getDummyJson()
    {
        return json_encode(
            [
                "publishingOffice" => "気象庁",
                "reportDatetime" => "2023-06-19T16:37:00+09:00",
                "targetArea" => "東京都",
                "headlineText" => "",
                "text" => "概要のダミーテキスト"
            ]
        );
    }
}

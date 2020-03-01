<?php

use PHPUnit\Framework\TestCase;

require_once 'helpers/BananaTrackerHelper.php';

class BananaTrackerHelperTest extends TestCase
{
    private $helper;

    public function setUp(): void
    {
        $this->helper = new BananaTrackerHelper();
        parent::setUp();
    }

    /**
     * @dataProvider providerForTestConvertFromJsonThrowsException
     * @param string $json
     * @throws Exception
     */
    public function testConvertFromJsonThrowsException(string $json): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Json is invalid');
        $this->helper->getSortedRoute($json);
    }

    public function providerForTestConvertFromJsonThrowsException(): array
    {
        return [
            [''],
            ['[{"from": "Adolfo Suárez Madrid–Barajas Airport, Spain", "to": "London Heathrow, UK"},']
        ];
    }

    /**
     * @dataProvider provideForTestGetFirstStopInRouteIndexThrowsExceptionIfInvalid
     * @param string $json
     * @throws Exception
     */
    public function testGetFirstStopInRouteIndexThrowsExceptionIfInvalid(string $json): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid route');
        $this->helper->getSortedRoute($json);
    }

    public function provideForTestGetFirstStopInRouteIndexThrowsExceptionIfInvalid(): array
    {
        // Route without a starting point
        $routeA = [
            ['from' => 'a', 'to' => 'b'],
            ['from' => 'b', 'to' => 'c'],
            ['from' => 'c', 'to' => 'd'],
            ['from' => 'd', 'to' => 'a'],
        ];

        // Route with 2 starting points
        $routeB = [
            ['from' => 'a', 'to' => 'b'],
            ['from' => 'z', 'to' => 'b'],
            ['from' => 'b', 'to' => 'c'],
            ['from' => 'c', 'to' => 'd'],
        ];

        return [
            [json_encode($routeA)],
            [json_encode($routeB)]
        ];
    }

    public function testGetSortedRouteReturnSortedRoute(): void
    {
        $route = [
            ['from' => 'c', 'to' => 'd'],
            ['from' => 'a', 'to' => 'b'],
            ['from' => 'd', 'to' => 'e'],
            ['from' => 'e', 'to' => 'f'],
            ['from' => 'b', 'to' => 'c'],
            ['from' => 'f', 'to' => 'g'],
        ];

        $sortedRoute = $this->helper->getSortedRoute(json_encode($route));

        $this->assertCount(7, $sortedRoute);
        $this->assertEquals('a', $sortedRoute[0]);
        $this->assertEquals('b', $sortedRoute[1]);
        $this->assertEquals('c', $sortedRoute[2]);
        $this->assertEquals('d', $sortedRoute[3]);
        $this->assertEquals('e', $sortedRoute[4]);
        $this->assertEquals('f', $sortedRoute[5]);
        $this->assertEquals('g', $sortedRoute[6]);
    }
}

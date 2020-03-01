<?php

class BananaTrackerHelper
{
    /**
     * @param string $routeJson
     * @return array
     * @throws Exception
     */
    public function getSortedRoute(string $routeJson): array
    {
        $route = $this->convertRouteFromJson($routeJson);
        $fromList = array_column($route, 'from');
        $toList = array_column($route, 'to');

        $index = $this->getFirstStopInRouteIndex($fromList, $toList);
        $sortedList = [];
        $sortedList[] = $fromList[$index];

        while (count($sortedList) < count($route) + 1) {
            $currentStop = $toList[$index];
            $sortedList[] = $currentStop;
            $index = array_search($currentStop, $fromList);
        }

        return $sortedList;
    }

    /**
     * @param string $route
     * @return array
     * @throws Exception
     */
    private function convertRouteFromJson(string $route): array
    {
        $decodedRoute = json_decode($route, true);

        if ($decodedRoute === null || json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('json is invalid');
        }

        return $decodedRoute;
    }

    /**
     * @param array $fromList
     * @param array $toList
     * @return int
     * @throws Exception
     */
    private function getFirstStopInRouteIndex(array $fromList, array $toList): int
    {
        $uniqueStops = array_diff($fromList, $toList);

        if (count($uniqueStops) !== 1) {
            throw new Exception('Invalid route');
        }

        return array_keys($uniqueStops)[0];
    }
}

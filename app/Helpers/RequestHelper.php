<?php

namespace App\Helpers;

class RequestHelper
{
    public static function doesQueryParamsHasValue($queryString, $parameterValue)
    {
        if (!$queryString) {
            return false;
        }

        foreach (explode(',', $queryString) as $value) {
            return $value == $parameterValue ? true : false;
        }

        return false;
    }
}

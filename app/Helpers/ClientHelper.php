<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class ClientHelper
{
    public static function checkFileByID($fileID)
    {
        try {
            $url = env("URL_SERVICE_MEDIA") . "/media/" . $fileID;
            $response = Http::timeout(5)->get($url);

            return $response->status() === 200 ? true : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function checkUser($userID, $role = null)
    {
        try {
            $url = env("URL_SERVICE_USER") . "/users/" . $userID;
            $response = Http::timeout(5)->get($url);

            if ($response->status() === 200) {
                $data = $response->json();

                if ($role) {
                    return $data['data']['role'] === $role ? true : false;
                }

                return true;
            }

            return false;
        } catch (\Throwable $th) {
            return false;
        }
    }
}

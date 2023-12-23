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

    public static function getFileUrlByID($fileID)
    {
        try {
            $url = env("URL_SERVICE_MEDIA") . "/media/" . $fileID;
            $response = Http::timeout(5)->get($url);

            $data = $response->json();
            $fileUrl = $data['data']['url'];

            return $fileUrl;
        } catch (\Throwable $th) {
            return null;
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

    public static function getUserByID($userID)
    {
        try {
            $url = env("URL_SERVICE_USER") . "/users/" . $userID;
            $response = Http::timeout(5)->get($url);

            if ($response->status() === 200) {
                return $response->json();
            }

            return null;
        } catch (\Throwable $th) {
            return null;
        }
    }
}

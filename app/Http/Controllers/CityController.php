<?php

namespace App\Http\Controllers;

use App\Models\CityModel;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    /**
     * GET /city/get-by-name/{cityName}
     * Obtener una ciudad por nombre
     */
    public function get_getCityByName($cityName)
    {
        $cityModel = new CityModel();

        $citites = DB::table('ws_cities')
            ->join('ws_dapart', 'ws_dapart.dp_id', '=', 'ws_cities.ct_estado')
            ->where('ct_name', 'like', '%' . $cityName . '%')->limit(10)->get();

        return response()->json(array(
            'error' => false,
            'code' => 1,
            'message' => 'Cities found',
            'data' => array(
                'cities' => $citites,
            ),
        ));
    }
}

<?php

namespace App\Http\Controllers\source;

use App\Http\Controllers\Controller;
use App\Models\CityModel;
use DateTime;
use GuzzleHttp\Client;

class SolidariaController extends Controller
{
    protected $header_token, $header;
    protected $docu, $gene, $rce;
    public function __construct()
    {
        $this->header_token = array(
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json; charset=utf-8',
        );
        $this->header = array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->getToken()['access_token'],
        );
        $this->docu = array(
            1 => 'CC', 2 => 'CE', 3 => 'N', 5 => 'PA', 4 => 'TI',
        );
        $this->rce = array(
            4 => 10000000, 5 => 20000000, 6 => 30000000, 21 => 100000000,
        );
    }
    public function getToken()
    {
        $client = new Client(['headers' => $this->header]);

        $url = env('URL_SOLIDARIA') . "token";
        $data = array(
            "grant_type" => "password",
            "username" => env('USR_SOLIDARIA'),
            "password" => env('PAS_SOLIDARIA'),
            "scope" => env('PAS_SOLIDARIA'),
        );
        $request = $client->post($url, ['form_params' => $data]);
        //dd($request->getBody()->getContents());
        return json_decode($request->getBody()->getContents(), true);
    }

    public function getCotizacionRequest($datos)
    {
        $nom = calculada_nombre($datos->form_person_name);
        $nombre = $nom['nombre'];
        $apellido = $nom['apellido'];
        $cumple = new DateTime($datos->form_person_birth);
        $ciudades = new CityModel();
        $ciudad = $ciudades->where('ct_id', '=', $datos->form_vehi_city)->first();

        //$this->get_user($datos->form_person_docnumber);

        $data = array(
            "cod_sucursal" => env('SUC_SOLIDARIA'),
            "cod_per" => 3,
            "cod_tipo_agente" => 3,
            "cod_agente" => env('USR_SOLIDARIA'),
            "cod_pto_vta" => env('PUN_SOLIDARIA'),
            "personas" => [
                "primerApellido" => $apellido,
                "nombre" => $nombre,
                "documento" => [
                    "tipo" => array_search($datos->form_person_doctype, $this->docu, false),
                    "numero" => $datos->form_person_docnumber,
                ],
                "genero" => $datos->form_person_gender == "" ? "M" : $datos->form_person_gender,
                "fechaNacimiento" => $cumple->format('Y/m/d'),
                "vehiculo" => [
                    "modelo" => $datos->form_vehi_model,
                    "fasecolda" => $datos->form_vehi_code,
                    "es0Km" => $datos->form_vehi_used == "Usado" ? false : true,
                    "placa" => strtoupper($datos->form_vehi_placa),
                    "ciudad" => $ciudad->ct_equidad,
                    "valorAsegurable" => strval($datos->form_vehi_valorasegurado),
                    "uso" => "2",
                    "tseguro" => "1",
                    "valorAcc" => 22000,
                ],
            ],
        );
        $client = new Client(['headers' => $this->header]);
        $url = env('URL_SOLIDARIA') . "api/Proceso/Cotizar";
        try {
            $request = $client->request('POST', $url, ['json' => $data]);
            //dd($request->getBody());
            return json_decode($request->getBody()->getContents(), true);
        } catch (\Exception $ex) {
            //dd($ex);
            return json_decode(null, true);
        }

        //dd(json_decode($request->getBody()->getContents(), true));
        //$var = json_decode($request->getBody()->getContents(), true);
    }

}

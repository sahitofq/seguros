<?php

namespace App\Http\Controllers\source;

use App\Http\Controllers\Controller;
use App\Models\CityModel;
use DateTime;
use GuzzleHttp\Client;

class BolivarController extends Controller
{
    protected $header;
    protected $docu, $gene, $rce;
    public function __construct()
    {
        $this->header = array(
            'Content-Type' => 'application/json; charset=utf-8',
            'Accept' => 'application/json; charset=utf-8',
            'x-api-key' => env('PAS_BOLIVAR'),
        );
        $this->docu = array(
            6 => 'CD', 1 => 'CC', 3 => 'CE', 2 => 'N', 5 => 'PA', 9 => 'RC', 4 => 'TI',
        );
        $this->gene = array(
            2 => 'F', 1 => 'M',
        );
        $this->rce = array(
            4 => 10000000, 5 => 20000000, 6 => 30000000, 21 => 100000000,
        );
    }

    public function getCotizacionRequest($datos)
    {

        $cumple = new DateTime($datos->form_person_birth);
        $ciudades = new CityModel();
        $ciudad = $ciudades->where('ct_id', '=', $datos->form_vehi_city)->first();
        //$this->get_user($datos->form_person_docnumber);
        $nom = calculada_nombre($datos->form_person_name);
        $nombre = $nom['nombre'];
        $apellido = $nom['apellido'];

        $data = array(
            "placaVehiculo" => strtoupper($datos->form_vehi_placa),
            "tipoDocumentoTomador" => $datos->form_person_doctype,
            "numeroDocumentoTomador" => $datos->form_person_docnumber,
            "nombresTomador" => $nombre,
            "apellidosTomador" => $apellido,
            "fechaNacimientoTomador" => $cumple->format('Y-m-d'),
            "generoConductor" => $datos->form_person_gender,
            "marcaVehiculo" => $datos->form_vehi_code,
            "modeloVehiculo" => $datos->form_vehi_model,
            "claveAsesor" => env('USR_BOLIVAR'),
            "sumaAccesorios" => 0,
            "ciudadMovilizacion" => $ciudad->ct_bolivar,
            "ceroKm" => $datos->form_vehi_used == "Nuevo" ? "true" : "false",
            "periodoFact" => 12,
            "opcionPA" => "S",
        );

        $client = new Client(['headers' => $this->header]);
        $url = env('URL_BOLIVAR') . "seguro-autos/liquidacion";
        $i = 0;

        do {
            try {
                $request = $client->request('POST', $url, ['json' => $data]);
                //dd($request->getBody()->getContents());
                // if (isset(json_decode($request->getBody()->getContents(), true)["errorMessage"]) || $request->getBody()->getContents() == "") {
                $info = $request->getBody()->getContents();
                if ($info == null) {
                    $request = null;
                    $i++;
                    //dd("ok 1");
                }
            } catch (\Exception $ex) {
                //dd("ok 2");
                $request = null;
                $i++;
            }
            //sleep(120);
        } while ($request == null && $i <= 4);

        //dd($info);
        try {
            return json_decode($info, true);
        } catch (\Exception $ex) {
            return json_decode(null, true);
        }

        //$request = $client->request('POST', $url, ['json' => $data]);
        //dd(json_decode($request->getBody()->getContents(), true));
        //$var = json_decode($request->getBody()->getContents(), true);
        //return json_decode($request->getBody()->getContents(), true);
    }
}

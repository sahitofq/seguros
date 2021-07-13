<?php

namespace App\Http\Controllers\source;

use App\Http\Controllers\Controller;
use App\Models\CityModel;
use DateTime;
use GuzzleHttp\Client;

class PrevisoraController extends Controller
{
    protected $header_token, $header;
    protected $docu, $gene, $rce;
    public function __construct()
    {
        $this->header_token = array(
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        );
        $this->header = array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . str_replace(array('\'', '"'), '', $this->getToken()),
        );
        $this->docu = array(
            1 => 'CC', 3 => 'CE', 2 => 'N', 5 => 'PA', 4 => 'TI', 4 => 'RC',
        );
    }
    public function getToken()
    {
        $client = new Client(['headers' => $this->header_token]);

        $url = env('URL_PREVISORA') . "api/Authetication/RequestToken";
        $data = array(
            "Username" => base64_encode(env('USR_PREVISORA')),
            "Password" => base64_encode(env('PAS_PREVISORA')),
        );
        try {
            $request = $client->post($url, ['json' => $data]);
            return json_decode($request->getBody()->getContents(), true);
        } catch (\Exception $ex) {
            $request = null;
            return json_decode(null, true);
        }
    }

    public function getCotizacionRequest($datos)
    {

        $nom = calculada_nombre($datos->form_person_name);
        $nombre = $nom['nombre'];
        $apellido = $nom['apellido'];
        $cumple = new DateTime($datos->form_person_birth);
        $ciudades = new CityModel();
        $ciudad = $ciudades->where('ct_id', '=', $datos->form_vehi_city)->first();
        $documento = explode("-", $datos->form_person_docnumber);

        //$this->get_user($datos->form_person_docnumber);
        $insure = array();
        if ($datos->form_person_gender == null) {
            $insure = array("LegalPerson" => array(
                "DocumentTypeCode" => array_search($datos->form_person_doctype, $this->docu, false),
                "DocumentNumber" => $documento[0],
                "TradeName" => $nombre,
            ),
            );
        } else {
            $insure = array("NaturalPerson" => array(
                "BirthDate" => (new DateTime($datos->form_person_birth))->format('Y-m-d'),
                "DocumentTypeCode" => array_search($datos->form_person_doctype, $this->docu, false),
                "DocumentNumber" => $documento[0],
                "Name" => $nombre,
                "SecondSurname" => $apellido,
                "Gender" => $datos->form_person_gender,
            ),
            );
        }
        $data = array(
            "LicensePlate" => $datos->form_vehi_placa,
            "FasecoldaCode" => $datos->form_vehi_code,
            "VehicleYear" => (int) $datos->form_vehi_model,
            "IsNew" => $datos->form_vehi_used == "Nuevo" ? true : false,
            "VehiclePrice" => $datos->form_vehi_valorasegurado,
            "RiskQuotation" => array(
                "RatingZoneCode" =>  $ciudad->ct_previsora,
                "Questions" => array(array(

                    "QuestionId" => 190,
                    "Response" => 1,
                ), array(

                    "QuestionId" => 195,
                    "Response" => 2,
                ), array(

                    "QuestionId" => 194,
                    "Response" => 0,
                ),
                ),
                "InsuredQuotation" => $insure,
                "PolicyQuotation" => array(
                    "SourceCode" => (int) env('SUC_PREVISORA'),
                    "BusinessId" => 11,
                    "BranchCode" => 33,
                    "AgentCode" => (int) env('AGE_PREVISORA'),
                ),
            ),
        );
        //dd($data);
        $client = new Client(['headers' => $this->header]);
        $url = env('URL_PREVISORA') . "api/Quote/VehiclePolicy";
       
        try {
            $request = $client->request('POST', $url, ['json' => $data]);
            //dd($request->getBody()->getContents());
            return json_decode($request->getBody()->getContents(), true);
        } catch (\Exception $ex) {
            //dd($ex);
            return json_decode(null, true);
        }

        //dd(json_decode($request->getBody()->getContents(), true));
        //$var = json_decode($request->getBody()->getContents(), true);
    }

}

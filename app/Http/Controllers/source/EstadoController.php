<?php

namespace App\Http\Controllers\source;

use App\Http\Controllers\Controller;
use App\Models\CityModel;
use DateTime;
use GuzzleHttp\Client;

class EstadoController extends Controller
{
    protected $header;
    protected $docu, $gene, $rce;
    public function __construct()
    {
        $this->header = array(
            'Content-Type' => 'application/json; charset=utf-8',
            'Accept' => 'application/json; charset=utf-8',
            'USERNAME' => env('USR_ESTADO'),
            'Authorization' => env('PAS_ESTADO'),
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

    public function getSegurosRequest($placa)
    {
        //composer require symfony/psr-http-message-bridge
        //composer require guzzlehttp/guzzle
        //composer require zendframework/zend-diactoros

        $client = new Client(['headers' => $this->header]);

        // $url = "https://www.iseguros.transfiriendo.com/MassiveInsuranceSE.Api/api/Contacts/Mup";
        // $data = array(
        //     "DocumentTypeId" => "1",
        //     "DocumentNumber" => "80100886",
        //     "Ramo" => "48",
        //     "Rol" => "1"
        // );
        // $request = $client->post($url, ['form_params' => $data]);
        // return dd(json_decode($request->getBody()->getContents()));

        $this->get_user("80100886");

        $url = env('URL_ESTADO') . "fasecolda/infovehiculo";
        $data = array(
            "Placa" => $placa,
        );

        $request = $client->post($url, ['form_params' => $data]);
        return json_decode($request->getBody()->getContents(), true);

        // return array(
        //     'Success' => true,
        //     'Data' => array(
        //         'CodigoFasecolda' => '00601006'
        //     )
        // );
    }

    public function getCotizacionRequest($datos)
    {

        $cumple = new DateTime($datos->form_person_birth);

        //$this->get_user($datos->form_person_docnumber);
        $nom = calculada_nombre($datos->form_person_name);
        $nombre = $nom['nombre'];
        $apellido = $nom['apellido'];
        $ciudades = new CityModel();
        $ciudad = $ciudades->where('ct_id', '=', $datos->form_vehi_city)->first();
        $data = array(
            "values" => [],
            "results" => [],
            "ButtonId" => 1,
            "DocDefId" => 1,
            "IsDetail" => false,
            "UserProfile" => "INTERMEDIARIOS",
            "DocClassDef" => "COTIZADOR",
            "ParentAttributeId" => 0,
            "DocumentId" => 0,
            "hdDTEStatusId" => 1,
            "DocumentStateId" => 1,
            "EntityId" => env('ENT_ESTADO'),
            "DocumentNumber" => "",
            "ContactId" => 0,
            "DocumentsRevisionId" => 0,
            "DocDefAppendantId" => 0,
            "DocDefPrintId" => 0,
            "DocumentsDetailId" => 0,
            "OpenMode" => "",
            "Attributes" => [
                [
                    "Details" => null,
                    "Nombre" => "TOMADOR_DocumentType",
                    "Descripcion" => "Tipo de Identificación",
                    "Valor" => array_search($datos->form_person_doctype, $this->docu, false),
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "TOMADOR_FirstName",
                    "Descripcion" => "Nombre",
                    "Valor" => $nombre,
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "TOMADOR_LastName",
                    "Descripcion" => " ",
                    "Valor" => $apellido,
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "TOMADOR_MaritalStatus",
                    "Descripcion" => "Estado Civil",
                    "Valor" => "1",
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "TOMADOR_WorkPhone",
                    "Descripcion" => "telefono",
                    "Valor" => $datos->form_person_phone,
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "TOMADOR_Address",
                    "Descripcion" => "Direccion",
                    "Valor" => "",
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "PRODUCTO",
                    "Descripcion" => "Producto",
                    "Valor" => "3",
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "ZONA",
                    "Descripcion" => "Zona Circulación",
                    "Valor" => $ciudad->ct_estado,
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "PLACA",
                    "Descripcion" => "Placa",
                    "Valor" => $datos->form_vehi_placa,
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "TOMADOR_Email",
                    "Descripcion" => "E-Mail",
                    "Valor" => $datos->form_person_email,
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "BRAND",
                    "Descripcion" => "Marca",
                    "Valor" => strval($datos->form_vehi_brand),
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "BRANDLINE",
                    "Descripcion" => "Línea",
                    "Valor" => strval($datos->form_vehi_brandline),
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "CLASE",
                    "Descripcion" => "Clase",
                    "Valor" => strval($datos->form_vehi_classid),
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "CODIGOFASECOLDA",
                    "Descripcion" => "Código Fasecolda",
                    "Valor" => $datos->form_vehi_code,
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "MODELO",
                    "Descripcion" => "Modelo",
                    "Valor" => $datos->form_vehi_model,
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "VALORASEGURADO",
                    "Descripcion" => "Valor Asegurado",
                    "Valor" => strval($datos->form_vehi_valorasegurado),
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "TIPO_COBERTURA",
                    "Descripcion" => "Tipo de Cobertura",
                    "Valor" => "1",
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "LIMITE_RC",
                    "Descripcion" => "LIMITE DE RCE (Millones $)",
                    "Valor" => "4",
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "mayor_cuantia_deducible_0",
                    "Descripcion" => "mayor_cuantia_deducible_0",
                    "Valor" => "3",
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "ASISTENCIA_VIAJES",
                    "Descripcion" => "Asistencia en Viajes",
                    "Valor" => "1",
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "LLANTAS_ESTALLADAS",
                    "Descripcion" => "VALOR LLANTAS ESTALLADAS",
                    "Valor" => "1",
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
                [
                    "Details" => null,
                    "Nombre" => "VEHICULO_REEMPLAZO",
                    "Descripcion" => "VEHICULO_REEMPLAZO",
                    "Valor" => "1",
                    "ParentAttributeId" => null,
                    "DetailId" => null,
                    "DocumentsDetailId" => null,
                ],
            ]
        );

        if ($datos->form_person_doctype == "N") {

            $nit = explode("-", $datos->form_person_docnumber);
            array_push($data['Attributes'], array(
                "Details" => null,
                "Nombre" => "TOMADOR_DocumentNumber",
                "Descripcion" => "Identificación",
                "Valor" => $nit[0],
                "ParentAttributeId" => null,
                "DetailId" => null,
                "DocumentsDetailId" => null,
            ));
            array_push($data['Attributes'], array(
                "Details" => null,
                "Nombre" => "TOMADOR_DigitoVerificador",
                "Descripcion" => "TOMADOR_DigitoVerificador",
                "Valor" => $nit[1],
                "ParentAttributeId" => null,
                "DetailId" => null,
                "DocumentsDetailId" => null,
            ));
        } else {
            array_push($data['Attributes'], array(
                "Details" => null,
                "Nombre" => "TOMADOR_DocumentNumber",
                "Descripcion" => "Identificación",
                "Valor" => $datos->form_person_docnumber,
                "ParentAttributeId" => null,
                "DetailId" => null,
                "DocumentsDetailId" => null,
            ));
            array_push($data['Attributes'], array(
                "Details" => null,
                "Nombre" => "TOMADOR_BirthDate",
                "Descripcion" => "Fecha Nacimiento",
                "Valor" => $cumple->format('d/m/Y'),
                "ParentAttributeId" => null,
                "DetailId" => null,
                "DocumentsDetailId" => null,
            ));
            array_push($data['Attributes'], array(
                "Details" => null,
                "Nombre" => "TOMADOR_Gender",
                "Descripcion" => " ",
                "Valor" => array_search($datos->form_person_gender, $this->gene, false),
                "ParentAttributeId" => null,
                "DetailId" => null,
                "DocumentsDetailId" => null,
            ));
        }

        $client = new Client(['headers' => $this->header]);
        $url = env('URL_ESTADO') . "Documents/calculate";

        try {
            $request = $client->request('POST', $url, ['json' => $data]);
            return json_decode($request->getBody()->getContents(), true);
        } catch (\Exception $ex) {
            return json_decode(null, true);
        }
        //$request = $client->request('POST', $url, ['json' => $data]);
        //dd(json_decode($request->getBody()->getContents(), true));
        //$var = json_decode($request->getBody()->getContents(), true);
        //return json_decode($request->getBody()->getContents(), true);
    }

    public function getPdfRequest($docI)
    {
        $client = new Client(['headers' => $this->header]);
        $url = env('URL_ESTADO') . "Documents/print";
        $data = array(
            "DocumentId" => $docI,
            "DocDefPrintId" => "1",
        );
        $request = $client->post($url, ['form_params' => $data]);
        return json_decode($request->getBody()->getContents(), true);
    }

    public function get_user($cc)
    {
        $client = new Client(['headers' => $this->header]);
        $url = env('URL_ESTADO') . "Contacts/Mup";
        $data = array(
            "DocumentTypeId" => "1",
            "DocumentNumber" => $cc,
            "Ramo" => "48",
            "Rol" => "1",
        );
        $request = $client->post($url, ['form_params' => $data]);
        return json_decode($request->getBody()->getContents(), true);

    }
}

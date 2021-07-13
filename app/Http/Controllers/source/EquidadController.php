<?php

namespace App\Http\Controllers\source;

use App\Classes\DB as MeekroDB;
use App\Http\Controllers\Controller;
use App\Models\CityModel;
use App\Models\MarkFasecModel;
use Carbon\Carbon;
use DateTime;
use nusoap_client;
use SoapClient;

class EquidadController extends Controller
{
    /**
     * Obtener todas los datos importantes de "Seguros la equidad"
     */
    protected $client;
    protected $token;
    protected $tipo_clase;
    public function __construct()
    {
        $url = env('URL_EQUIDAD') . "TokenServiceTest?wsdl";
        $endp = env('URL_EQUIDAD') . "TokenServiceTest";
        $this->nusoap_wsdl($url);
        $this->client->setEndpoint($endp);
        $data = array("usuario" => env('USR_EQUIDAD'), "clave" => env('PAS_EQUIDAD'));
        $result = $this->client->call('getToken', array($data));
        $this->token = $result["token"];
        $this->tipo_clase = array(
            1 => '01', 2 => '06', 3 => '20', 4 => '02',
        );
    }

    private function nusoap_wsdl($var)
    {
        $this->client = new nusoap_client($var, true);
    }

    public function soap_wsdl($url, $post)
    {
        $url = 'https://servicios.laequidadseguros.coop/TokenServiceTest?wsdl';
        $options = array(
            "POST" => 'https://servicios.laequidadseguros.coop/TokenServiceTest',
            "style" => SOAP_RPC,
            "use" => SOAP_ENCODED,
            "soap_version" => SOAP_1_1,
            "cache_wsdl" => WSDL_CACHE_BOTH,
            "trace" => false,
            "encoding" => "UTF-8",
            "exceptions" => false,

        );
        $client = new soapClient($url, $options);
        //dd($client->__getFunctions());
        //dd($result);
        //dd($this->client->__getFunctions());
        //dd($this->client->__getTypes());
    }
    public function getCotizacionRequest($datos)
    {
        $url = env('URL_EQUIDAD') . "SrvPolizaQA?wsdl&token=" . $this->token;
        $endp = env('URL_EQUIDAD') . "SrvPolizaQA?token=" . $this->token;
        $this->nusoap_wsdl($url);
        $this->client->setEndpoint($endp);
        //$this->eje1();
        //dd($this->client->__getFunctions());
        $documento = explode("-", $datos->form_person_docnumber);
        $ciudades = new CityModel();
        $ciudad = $ciudades->where('ct_id', '=', $datos->form_vehi_city)->first();
        //$fecn = $fec->format('Y-m-d');
        $hoy = date("Y-m-d");
        for ($i = 0; $i < 4; $i++) {
            $fecn = (new DateTime($datos->form_person_birth))->format('Y-m-d');
            if ($i == 3) {
                $cc = 900844967;
                $nom = "SEGUROS PUMA LTDA";
                $gen = "M";
                //$fecn = "1983-03-19";
            } else {
                $cc = $documento[0];
                $nom = $datos->form_person_name;
                $gen = $datos->form_person_gender == null ? "PJ" : $datos->form_person_gender;
            }
            $tercero[] = array(
                "vinculacion" => 1,
                "codVinculacion" => $i,
                "codigo" => $cc,
                "parentesco" => 1,
                "nombre" => $nom,
                "sexo" => $gen,
                "tipoPersona" => $i + 1,
                "fechaNacimiento" => $fecn,
            );
        }

        $detalle[] = array(
            "coddet" => "00000060", //-Ciudad de Circulación Predominante
            "valdate" => $hoy,
            "valnumber" => 1,
            "valstring" => $ciudad->ct_equidad,
        );
        $detalle[] = array(
            "coddet" => "CONVE002", //Este detalle define el convenio de producción si se tiene, si no se tiene convenio de producción se debe enviar el valor por default en el request de ejemplo
            "valdate" => $hoy,
            "valnumber" => 1,
            "valstring" => "000001",
        );
        $detalle[] = array(
            "coddet" => "01010005", //Marca/Tipo (Código Fasecolda)
            "valdate" => $hoy,
            "valnumber" => 0.3,
            "valstring" => $datos->form_vehi_code,
        );
        /* $detalle[] = array(
        "coddet" => "01010052", //-Clase del vehículo
        "valdate" => $hoy,
        "valnumber" => 1,
        "valstring" => $this->tipo_clase[$datos->form_vehi_classid],
        );*/
        $detalle[] = array(
            "coddet" => "01010053", //-Modelo del Vehículo
            "valdate" => $hoy,
            "valnumber" => 0.5,
            "valstring" => substr($datos->form_vehi_model, 2, 2),
        );
        $detalle[] = array(
            "coddet" => "01020097", //Limite de RCE (solo existe un solo limite y es el del ejemplo enviado)
            "valdate" => $hoy,
            "valnumber" => 1,
            "valstring" => "100400",
        );
        $detalle[] = array(
            "coddet" => "01010120", //Placa Única
            "valdate" => $hoy,
            "valnumber" => 1,
            "valstring" => $datos->form_vehi_placa,
        );
        $detalle[] = array(
            "coddet" => "00000120", //Edad del Asegurado
            "valdate" => $hoy,
            "valnumber" => 1,
            "valstring" => $datos->form_person_birth != null ? calculada_edad($datos->form_person_birth) : "00",
        );
        $detalle[] = array(
            "coddet" => "GENERO01", //-Genero
            "valdate" => $hoy,
            "valnumber" => 1,
            "valstring" => $datos->form_person_gender == null ? "PJ" : $datos->form_person_gender,
        );
        $detalle[] = array(
            "coddet" => "00000109", //Ocupacion
            "valdate" => $hoy,
            "valnumber" => 1,
            "valstring" => 1,
        );
        $detalle[] = array(
            "coddet" => "01010107", //Asistencia Extendida
            "valdate" => $hoy,
            "valnumber" => 1,
            "valstring" => "SI",
        );
        $detalle[] = array(
            "coddet" => "DEDUC001", //Deducibles Pérdidas Totales
            "valdate" => $hoy,
            "valnumber" => 1,
            "valstring" => "0000",
        );
        $detalle[] = array(
            "coddet" => "DEDUC002", //Deducible Pérdidas Parciales
            "valdate" => $hoy,
            "valnumber" => 1,
            "valstring" => "P00095",
        );
        $detalle[] = array(
            "coddet" => "AUTOMAK", //Servicio de Inspección se debe enviar el valor por default.
            "valdate" => $hoy,
            "valnumber" => 0,
            "valstring" => "04",
        );
        $detalle[] = array(
            "coddet" => "20010161", //Fecha nacimineto asegurtad
            "valdate" => $fecn,
            "valnumber" => 1,
            "valstring" => 1,
        );
        $detalle[] = array(
            "coddet" => "VALASE01", //Valor asegurado
            "valdate" => $hoy,
            "valnumber" => $datos->form_vehi_valorasegurado,
            "valstring" => 1,
        );
        $miArray = array(
            "comp" => 1,
            "sucur" => "1100100",
            "fecini" => $hoy,
            "fecter" => date("Y-m-d", strtotime($hoy . "+ 1 year")),
            "comision" => 0,
            "vaseg" => 0,
            "producto" => array(
                "codpla" => "011720",
                "nemotec" => "Auto Plus Full",
            ),
            "parametroCotizacion" => array(
                "usuario" => env('USR_EQUIDAD'),
                "tipoObjeto" => env('PAS_EQUIDAD'),
            ),
            "tercero" => $tercero,
            "detalle" => $detalle,
        );

        if ($datos->form_vehi_used == "Nuevo") {
            $detalle[] = array(
                "coddet" => "TMODVEH1", //Vehiculo nuevo
                "valdate" => $hoy,
                "valnumber" => 0,
                "valstring" => 2,
            );
        }
        //$xml = simplexml_load_string('<xml></xml');
        //dd($miArray);
        //$result = $this->client->call("crearCotizacion", array($miArray));
        //dd($this->client->request);
        //dd($this->client->response);
        //dd($result);
        //return $result;

        try {
            $result = $this->client->call("crearCotizacion", array($miArray));
            return $result;
        } catch (\Exception $ex) {
            return null;
        }
    }
    public function getSegurosRequest($var)
    {

    }

    public function getLaEquidadImportantDetails()
    {

        $url = env('URL_EQUIDAD') . "ServicioEstructuraQA?wsdl";
        $endp = env('URL_EQUIDAD') . "ServicioEstructuraQA?token=" . $this->token;
        $this->nusoap_wsdl($endp);
        $this->client->setEndpoint($url);
        $miArray = array("codPla" => "011701");
        $result = $this->client->call("getProducto", array($miArray));
        $cities = $result['estructura']['detalles'][0]['valores'];
        $codeFasecolda = $result['estructura']['detalles'][3]['valores'];

        return array(
            'data' => $result,
            "cities" => $cities,
            "codeFasecolda" => $codeFasecolda,
        );
    }

    public function get_showImportantDetails()
    {
        printcode($this->getLaEquidadImportantDetails()['data']);
    }

    /**
     * Sincronizar los datos del backend con nuestra base de datos.
     */
    public function get_syncDatabaseTables()
    {
        CityModel::truncate();
        MarkFasecModel::truncate();

        $details = $this->getLaEquidadImportantDetails();
        $citites = $details["cities"];
        $codeFasecolda = $details["codeFasecolda"];

        $_cities = array();
        foreach ($citites as $ck => $cv) {
            $_cities[] = array(
                "ct_name" => $cv["nombre"],
                "ct_code" => $cv["codigo"],
                "ct_created" => Carbon::now("America/Bogota")->toDateTimeString(),
                "ct_updated" => Carbon::now("America/Bogota")->toDateTimeString(),
            );
        }

        $_codesF = array();
        foreach ($codeFasecolda as $cfk => $cfv) {
            $_codesF[] = array(
                "mf_name" => $cfv["nombre"],
                "mf_code" => $cfv["codigo"],
                "mf_created" => Carbon::now("America/Bogota")->toDateTimeString(),
                "mf_updated" => Carbon::now("America/Bogota")->toDateTimeString(),
            );
        }

        $_codesF = array_chunk($_codesF, 980);

        MeekroDB::insert("ws_cities", $_cities);
        foreach ($_codesF as $c) {
            MeekroDB::insert("ws_markfasec", $c);
        }
    }
}

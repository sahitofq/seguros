<?php

namespace App\Http\Controllers;

use App\Http\Controllers\source\EquidadController;
use App\Http\Controllers\source\EstadoController;
use App\Http\Controllers\source\PrevisoraController;
use App\Http\Controllers\source\SolidariaController;
use App\Mail\MailAsesor;
use App\Models\AsesorFormModel;
use App\Models\AsesorModel;
use App\Models\FormModel;
use App\Models\ResumenModel;
use App\Models\SeguroModel;
use DateTime;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    protected $usuario_vehiculo, $usuario_seguro;
    protected $amparos, $users;
    public function __construct()
    {
        $this->usuario_vehiculo = new FormModel();
        $this->usuario_seguro = new SeguroModel();
    }

    public function post_showRegistroHTML(Request $request, $id)
    {
        if ($id) {
            return view('todo-riesgo-list', array(
                'id' => $id,
                'salida' => $this->get_list_seguro($id),
            ));
        }
        return redirect('/');
    }

    public function post_createNewForm(Request $request)
    {
        $data = array(
            "form_person_name" => $request['form_person_name'],
            "form_person_doctype" => $request['form_person_doctype'],
            "form_person_docnumber" => $request['form_person_docnumber'],
            "form_person_email" => $request['form_person_email'],
            "form_person_phone" => $request['form_person_phone'],
            "form_vehi_placa" => $request['form_vehi_placa'],
            "form_vehi_marca" => $request['form_vehi_marca'],
            "form_vehi_model" => $request['form_vehi_model'],
            "form_vehi_code" => $request['form_vehi_code'],
            "form_vehi_used" => $request['form_vehi_used'],
            "form_vehi_city" => $request['form_vehi_city'],
            "form_vehi_brand" => $request['form_vehi_brand'],
            "form_vehi_brandline" => $request['form_vehi_brandline'],
            "form_vehi_classid" => $request['form_vehi_classid'],
            "form_vehi_valorasegurado" => $request['form_vehi_valorasegurado'],
        );
        if ($request['form_person_doctype'] != "N") {
            $data["form_person_gender"] = $request['form_person_gender'];
            $data["form_person_birth"] = new DateTime($request['form_person_birth']);
        }

        //dd($this->usuario_vehiculo::create($data));
        $id = $this->usuario_vehiculo::create($data)->form_id;
        //session()->forget('idpersona');
        //session(['idpersona' => $id]);
        //Session::put('idpersona', $id);
        //$nueva_cookie = cookie('idpersona', $id, 5);
        //$request->session()->forget('idpersona');
        //$request->session()->put('idpersona', $id);
        //$this->list_get_seguros();

        $salida = array();
        if ($id) {
            $salida = $this->get_list_seguro($id);
            //dd($salida);
            //$nueva_cookie = cookie('idpersona', $id, 15);
            if (count($salida) > 0) {
                //return redirect('todo-riesgo-list')->with('salida', $salida);
                return response()->json(array(
                    "message" => "Succes",
                    "error" => false,
                    "ref" => "1",
                    "id" => $id,
                    'data_external' => $salida,
                ));
            } else {
                //return back();
                //return redirect()->route('home');
                return response()->json(array(
                    "message" => "Fail error contribution",
                    "error" => true,
                    "ref" => "2",
                    "id" => $id,
                    'data_external' => $salida,
                ));
            }
        }
        return response()->json(array(
            "message" => "Fail error user",
            "error" => true,
            "ref" => "3",
            'data_external' => $salida,
        ));

    }

    public function get_seguros($id_usu)
    {
        $seguros = $this->usuario_seguro->where('seguro_form_id', '=', $id_usu);
        $salida = array();
        foreach ($seguros->orderBy('seguro_real_seguro', 'ASC')->get() as $seguro) {
            $salida[$seguro->seguro_nombre] = array(
                "seguro_real_seguro" => $seguro->seguro_real_seguro,
                "seguro_entity_id" => $seguro->seguro_entity_id,
                "seguro_seguro" => $seguro->seguro_seguro,
                "seguro_tercero" => $seguro->seguro_tercero,
                "seguro_d_total" => $seguro->seguro_d_total,
                "seguro_h_total" => $seguro->seguro_h_total,
                "seguro_d_parcial" => $seguro->seguro_d_parcial,
                "seguro_h_parcial" => $seguro->seguro_h_parcial,
                "seguro_pdf" => $seguro->seguro_pdf,
                "seguro_nombre" => $seguro->seguro_nombre,
                "success" => true,
            );
        }
        return $salida;
    }

    public function get_list_seguro($idpersona)
    {
        set_time_limit(0);
        //dd(session('idpersona'));
        //session(['idpersona' => 12]);

        $salida = array();
        $salida = $this->get_seguros($idpersona);

        if (count($salida) < 1) {
            $this->usuario_seguro->where('seguro_form_id', '=', $idpersona)->delete();
            $usuario = $this->usuario_vehiculo->where('form_id', '=', $idpersona)->first();

            //dd($usuario);
            //$solidaria = $this->segSolidaria->getCotizacionRequest($usuario);
            //dd($solidaria);

            //****Seguro Bolivar */
            $tiempo_inicial = microtime(true);
            //$segBolivar = new BolivarController();
            //$bolivar = $segBolivar->getCotizacionRequest($usuario);
            $tiempo_final = microtime(true);

            //dd($bolivar);
            if (isset($bolivar["data"])) {
                foreach ($bolivar["data"] as $producto) {
                    foreach ($producto["responseData"]["coberturasCotizacion"] as $cobertura) {
                        if ($cobertura["descripcion"] == "Valor Riesgos Patrimoniales") {
                            $prima = $cobertura["valorPrima"];
                            break;
                        }
                    }
                    $data = array(
                        "seguro_entity_id" => $producto["responseData"]["numerodeliquidacion"],
                        "seguro_real_seguro" => $producto["responseData"]['totalPrima'],
                        "seguro_seguro" => "Bolivar",
                        "seguro_form_id" => $idpersona,
                        "seguro_tercero" => $prima,
                        "seguro_d_total" => 100,
                        "seguro_h_total" => 100,
                        "seguro_d_parcial" => $producto["responseData"]["deduciblePeridaParcial"],
                        "seguro_h_parcial" => $producto["responseData"]["deduciblePeridaParcial"],
                        "seguro_nombre" => "Bolivar " . ucwords(strtolower($producto["responseData"]["opcionAutosDescripcion"])),
                        "seguro_pdf" => "",
                        "seguro_tiempo" => $tiempo_final - $tiempo_inicial,
                        "success" => true,
                    );
                    //$salida['estado'] = $data;
                    //dd($data);
                    $this->usuario_seguro::create($data);
                }
            }

            //****Seguro Previsora */
            $tiempo_inicial = microtime(true);
            $segPrevisora = new PrevisoraController();
            $previsora = $segPrevisora->getCotizacionRequest($usuario);
            $tiempo_final = microtime(true);
            //dd($previsora);
            if (isset($previsora["SummaryQuote"])) {
                foreach ($previsora["DetailQuotations"] as $producto) {
                    if ($producto["BonusForNoClaim"] > 0) {

                        if (stristr($producto["DetailRisk"]["DetailPolicy"]["DetailProduct"]["Product"], 'Unico')) {
                            $nombre_seg = "Deducible Unico";
                        }
                        if (stristr($producto["DetailRisk"]["DetailPolicy"]["DetailProduct"]["Product"], 'Previ')) {
                            $nombre_seg = "Previ Livianos";
                        }
                        if (stristr($producto["DetailRisk"]["DetailPolicy"]["DetailProduct"]["Product"], 'Mia')) {
                            $nombre_seg = "Livianos Mia";
                        }

                        $data = array(
                            "seguro_entity_id" => $previsora["SummaryQuote"]["GroupQuoteId"],
                            "seguro_real_seguro" => $producto["DetailRisk"]['DetailPremium']['TotalPremiumAmount'],
                            "seguro_seguro" => "Previsora",
                            "seguro_form_id" => $idpersona,
                            "seguro_tercero" => $producto["DetailRisk"]["DetailInsuredObjects"][0]['Coverages'][0]['DeclaredAmount'] / 1000000,
                            "seguro_d_total" => $producto["DetailRisk"]["DetailInsuredObjects"][0]['Coverages'][6]['DeclaredAmount'] / $usuario->form_vehi_valorasegurado * 100,
                            "seguro_h_total" => $producto["DetailRisk"]["DetailInsuredObjects"][0]['Coverages'][3]['DeclaredAmount'] / $usuario->form_vehi_valorasegurado * 100,
                            "seguro_d_parcial" => $producto["DetailRisk"]["DetailInsuredObjects"][0]['Coverages'][2]['PremiumAmount'],
                            "seguro_h_parcial" => $producto["DetailRisk"]["DetailInsuredObjects"][0]['Coverages'][4]['PremiumAmount'],
                            "seguro_nombre" => $nombre_seg,
                            "seguro_pdf" => "",
                            "seguro_tiempo" => $tiempo_final - $tiempo_inicial,
                            "success" => true,
                        );
                        //dd($data);
                        //$salida['estado'] = $data;
                        $this->usuario_seguro::create($data);
                    }
                }
            }

            //****Seguro del estado cotizacion */
            $tiempo_inicial = microtime(true);
            $segEstado = new EstadoController();
            $estado = $segEstado->getCotizacionRequest($usuario);
            $tiempo_final = microtime(true);

            //dd($estado);
            if (isset($estado["Success"])) {
                if ($estado['Data']['Attributes'][2]['Valor'] > 0) {
                    //$pdf = $segEstado->getPdfRequest($estado['Data']['EntityId']);
                    $data = array(
                        "seguro_entity_id" => $estado['Data']['EntityId'],
                        "seguro_real_seguro" => $estado['Data']['Attributes'][2]['Valor'],
                        "seguro_seguro" => "Estado",
                        "seguro_form_id" => $idpersona,
                        "seguro_tercero" => 3000,
                        "seguro_d_total" => 100,
                        "seguro_h_total" => 100,
                        "seguro_d_parcial" => "10% min 1 SMMLV",
                        "seguro_h_parcial" => "10% min 1 SMMLV",
                        "seguro_nombre" => "Famiestado",
                        //"seguro_pdf" => $pdf['Data'],
                        "seguro_pdf" => "",
                        "seguro_tiempo" => $tiempo_final - $tiempo_inicial,
                        "success" => true,
                    );
                    //dd($data);
                    //$salida['estado'] = $data;
                    //dd($salida);
                    $this->usuario_seguro::create($data);
                }
            }

            //****Seguro del equidad cotizacion */
            $tiempo_inicial = microtime(true);
            $segEquidad = new EquidadController();
            $equidad = $segEquidad->getCotizacionRequest($usuario);
            $tiempo_final = microtime(true);
            //dd($equidad);
            if (isset($equidad["poliza"]["estado"])) {
                $data = array(
                    "seguro_entity_id" => $equidad['poliza']['certif'],
                    "seguro_real_seguro" => $equidad['poliza']['vprima'],
                    "seguro_seguro" => "Equidad",
                    "seguro_form_id" => $idpersona,
                    "seguro_tercero" => substr($equidad['poliza']['cobertura'][4]['vaseg'], 0, 4),
                    "seguro_d_total" => $equidad['poliza']['cobertura'][0]['vaseg'] / $usuario->form_vehi_valorasegurado * 100,
                    "seguro_h_total" => $equidad['poliza']['cobertura'][1]['vaseg'] / $usuario->form_vehi_valorasegurado * 100,
                    "seguro_d_parcial" => 950000,
                    "seguro_h_parcial" => 950000,
                    "seguro_nombre" => "Auto Plus Full",
                    "seguro_pdf" => "",
                    "seguro_tiempo" => $tiempo_final - $tiempo_inicial,
                    "success" => true,
                );
                //$salida['equidad'] = $data;
                $this->usuario_seguro::create($data);
            }
            //****Seguro Solidaria */
            $tiempo_inicial = microtime(true);
            $segSolidaria = new SolidariaController();
            $solidaria = $segSolidaria->getCotizacionRequest($usuario);
            $tiempo_final = microtime(true);
            //dd($solidaria);
            if (isset($solidaria[0]["Polizas"])) {
                foreach ($solidaria[0]['Polizas'][0]['Productos'] as $producto) {
                    $data = array(
                        "seguro_entity_id" => $solidaria[0]['Polizas'][0]['NumeroCotizacion'],
                        "seguro_real_seguro" => $producto['ValorPrimaTotal'],
                        "seguro_seguro" => "Solidaria",
                        "seguro_form_id" => $idpersona,
                        "seguro_tercero" => (int) $producto['ValorRC'] / 1000000,
                        "seguro_d_total" => 100 - ($producto['DatosAmparos'][1]['NombreCodigoDeducible'] != "" ? substr($producto['DatosAmparos'][1]['NombreCodigoDeducible'], 0, 2) : 0),
                        "seguro_h_total" => 100 - ($producto['DatosAmparos'][3]['NombreCodigoDeducible'] != "" ? substr($producto['DatosAmparos'][3]['NombreCodigoDeducible'], 0, 2) : 0),
                        "seguro_d_parcial" => $producto['DatosAmparos'][2]['NombreCodigoDeducible'] != "" ? substr($producto['DatosAmparos'][2]['NombreCodigoDeducible'], 0, 2) . "% min 1 SMMLV" : "0%",
                        "seguro_h_parcial" => $producto['DatosAmparos'][10]['NombreCodigoDeducible'] != "" ? substr($producto['DatosAmparos'][10]['NombreCodigoDeducible'], 0, 2) . "% min 1 SMMLV" : "0%",
                        "seguro_nombre" => str_replace("-", "", ucwords(strtolower($producto['NombrePlanCobertura']))),
                        "seguro_pdf" => "",
                        "seguro_tiempo" => $tiempo_final - $tiempo_inicial,
                        "success" => true,
                    );
                    //$salida['estado'] = $data;
                    //dd($salida);
                    $this->usuario_seguro::create($data);
                }
            }

            $salida = $this->get_seguros($idpersona);
        }
        //dd($salida);

        return $salida;
    }

    public function get_detalle(Request $request, $id, $segu)
    {
        $seguros = $this->usuario_seguro
            ->where('seguro_form_id', '=', $id)
            ->where('seguro_nombre', 'LIKE', "%$segu%")->first();
        $resumen = new ResumenModel();
        $resu = $resumen->where('resumen_seguro', 'LIKE', "%$segu%")->where('resumen_tipo', 'LIKE', "%Resumen%")->get();
        $afec = $resumen->where('resumen_seguro', 'LIKE', "%$segu%")->where('resumen_tipo', 'LIKE', "%Afectacion%")->get();
        $perd = $resumen->where('resumen_seguro', 'LIKE', "%$segu%")->where('resumen_tipo', 'LIKE', "%Perdidas%")->get();
        $cond = $resumen->where('resumen_seguro', 'LIKE', "%$segu%")->where('resumen_tipo', 'LIKE', "%Conducir%")->get();
        $last = $resumen->where('resumen_seguro', 'LIKE', "%$segu%")->where('resumen_tipo', 'LIKE', "%Lastimas%")->get();
        $otr = $resumen->where('resumen_seguro', 'LIKE', "%$segu%")->where('resumen_tipo', 'LIKE', "%Otros%")->get();
        return view('todo-riesgo-detalle')
            ->with('resumen', $resu)
            ->with('afectacion', $afec)
            ->with('perdida', $perd)
            ->with('conducir', $cond)
            ->with('lastimas', $last)
            ->with('seguro', $seguros)
            ->with('otros', $otr);
    }

    public function generarpdf($seguro, $id)
    {
        //dd($users);
        $this->datosuser($seguro, $id);
        $pdf = \PDF::loadView('export.pdf', ['amparos' => $this->amparos, 'users' => $this->users]);
        return $pdf->stream();
    }

    public function datosuser($seguro, $id)
    {
        set_time_limit(0);
        $this->amparos = DB::table('ws_cobertura')
            ->where('cobertura_aseguradora', 'LIKE', "%$seguro%")->get();

        //DB::enableQueryLog();
        $this->users = DB::table('ws_forms')
            ->select('ws_forms.*', 'ws_markfasec.*', 'ws_seguros.*', 'ws_clase.*', 'ws_aseguradoras.*')
            ->join('ws_markfasec', 'ws_forms.form_vehi_code', '=', 'ws_markfasec.mf_code')
            ->join('ws_seguros', 'ws_forms.form_id', '=', 'ws_seguros.seguro_form_id')
            ->join('ws_clase', 'ws_forms.form_vehi_classid', '=', 'ws_clase.clase_id')
            ->join('ws_aseguradoras', 'ws_seguros.seguro_nombre', '=', 'ws_aseguradoras.aseguradora_nombre')
            ->where('ws_forms.form_id', '=', $id)
            ->where('ws_seguros.seguro_nombre', 'LIKE', "%$seguro%")
            ->first();

        //dd(DB::getQueryLog());
    }

    public function asesor()
    {
        $aseroform = new AsesorFormModel();
        $aseror = new AsesorModel();

        $persona_asesor = $aseroform->where("asesorf_form", "=", $this->users->form_id)->first();
        if (isset($persona_asesor->asesorf_form)) {
            $asesor_correo = $aseror->where('asesor_id', '=', $persona_asesor->asesorf_asesor)->first();
        } else {
            $asesor_correo = $aseror->where('asesor_estado', '=', 1)->first();
            $data = array(
                "asesorf_form" => $this->users->form_id,
                "asesorf_asesor" => $asesor_correo->asesor_id,
            );
            $asesor_cre = $aseroform::create($data);
            $nuevo_asesor = $aseror::where('asesor_estado', "=", 0)
                ->where('asesor_activo', "=", 1)
                ->orderBy('asesor_id', 'ASc')->first();
            $aseror::where('asesor_estado', "=", 1)
                ->update(['asesor_estado' => 0]);
            $aseror::where('asesor_id', "=", $nuevo_asesor->asesor_id)
                ->update(['asesor_estado' => 1]);
        }
        return $asesor_correo;
    }
    public function exportpdf($seg, $id)
    {
        //return $pdf->download('Seguro.pdf');
        $this->datosuser($seg, $id);

        $this->envioemail();
        //$this->generarpdf($req['seguro'], session('idpersona'));
        $pdf = \PDF::loadView('export.pdf', ['amparos' => $this->amparos, 'users' => $this->users]);
        return $pdf->stream();
    }

    public function envioemail()
    {
        Mail::to($this->asesor()->asesor_correo)->send(new MailAsesor($this->users, 1, $this->asesor()));
        Mail::to($this->users->form_person_email)->send(new MailAsesor($this->users, 2, $this->asesor()));
    }

    public function error_cotizaHTML(Request $request, $id)
    {
        if ($id) {
            $this->users = DB::table('ws_forms')
                ->select('ws_forms.*')
                ->where('ws_forms.form_id', '=', $id)
                ->first();
            Mail::to($this->asesor()->asesor_correo)->send(new MailAsesor($this->users, 3, $this->asesor()));
            Mail::to($this->users->form_person_email)->send(new MailAsesor($this->users, 4, $this->asesor()));
        }
        return redirect('error-cotizacion');
    }
}

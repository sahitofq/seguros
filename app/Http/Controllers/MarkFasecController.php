<?php

namespace App\Http\Controllers;

use App\Http\Controllers\source\EstadoController;
use App\Models\MarkFasecModel;
use Illuminate\Http\Request;

class MarkFasecController extends Controller
{
    /**
     * POST (api) /api/mark-fasecol
     * Obtener los datos de un vehículo según la placa
     */
    public function post_getVehicleDataByPlaca(Request $request)
    {
        $segEstado = new EstadoController();
        $placa = $request->input("placa_request");
        $data = $segEstado->getSegurosRequest($placa);
        if ($data["Success"] === true) {
            $refCodeFasecolda = $data["Data"]["CodigoFasecolda"];
            $markModel = new MarkFasecModel();
            $rowFound = $markModel->where("mf_code", $refCodeFasecolda)->first();
            return response()->json(array(
                "message" => "Reference founded",
                "error" => false,
                "ref" => "row_founded",
                'data' => array_merge(
                    array(
                        'placa' => $placa,
                    ),
                    $rowFound->toArray()
                ),
                'data_external' => $data,
            ));
        } else {
            return response()->json(array(
                "message" => "Reference no found",
                "error" => true,
                "ref" => "reference_not_found",
                'data_external' => $data,
            ));
        }
    }

    /**
     * GET /mark-fasecolda/get-by-name/{refName}
     * Obtener una referencia de marca Fasecolda por nombre.
     *
     * @param [type] $refName
     * @return void
     */
    public function get_getMarkByName($refName)
    {

        $markModel = new MarkFasecModel();

        $references = $markModel->where('mf_name', 'like', "%{$refName}%")->limit(20)->get();
        return response()->json(array(
            'error' => false,
            'code' => 1,
            'message' => 'References found',
            'data' => array(
                'references' => $references,
            ),
        ));
    }

    public function post_showVehicleDataHTML(Request $request)
    {
        return view('todo-riesgo', array(
            'data' => $request->all(),
        ));
    }
}

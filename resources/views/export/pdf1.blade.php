<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>PDF Seguro</title>
</head>

<body>
    <table width="100%" height="162" cellpadding="2" cellspacing="1"
        style="border:1px solid black; border-collapse:collapse; padding:2px text-align:center; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'">
        <tbody>
            <tr>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr style="background-color: #000000">
                                <td><img src="{{ public_path('img/pdf/puma.jpg') }}" width="200" height="61" alt="" />
                                </td>
                                <td><img src="{{ public_path('img/pdf/info.jpg') }}" width="168" height="39" alt="" />
                                </td>
                                <td><img src="{{ public_path('img/pdf/tel.jpg') }}" width="159" height="39" alt="" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; padding: 10px; font-weight: bold; font-size: 18px; font-style: italic;">
                    PDF COTIZACIÓN SEGUROS PUMA</td>
            </tr>
            @if ($users)
                <tr>
                    <td style="font-size: 12px;">
                        <table width="100%" height="20" cellpadding="5" cellspacing="1"
                            style="padding:2px text-align:center;">
                            <tbody>
                                <tr>
                                    <td style="border: 1px solid black">
                                        <table width="100%" height="15" cellpadding="5" cellspacing="1"
                                            style="padding:2px text-align:center;">
                                            <tbody>
                                                <tr>
                                                    <td><img src="{{ public_path('img/seguros/' . strtolower($users->seguro_seguro) . '.jpg') }}"
                                                            width="100" height="70" alt="" /></td>
                                                    <td><span style="font-weight: bold">EQUIDAD SEGUROS</span><br>
                                                        {{ $users->aseguradorasco_nit }} </td>
                                                    <td><span style="font-weight: bold">Número cotización</span><br>
                                                        {{ $users->seguro_entity_id }} </td>
                                                    <td><span style="font-weight: bold">Fecha Expedición</span><br>
                                                        {{ date('d-m-Y', strtotime($users->mf_created)) }} </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table width="100%" height="20" cellpadding="5" cellspacing="1"
                                            style="border:1px solid black; border-collapse:collapse; padding:2px text-align:center;">
                                            <tbody>
                                                <tr
                                                    style="border:1px solid black; border-collapse:collapse; padding:2px text-align:center;">
                                                    <th height="31" colspan="4"
                                                        style="font-size: 12px; text-align: left;" scope="col">DATOS
                                                        COMPAÑÍA</th>
                                                </tr>
                                                <tr>
                                                    <td><span style="font-weight: bold">SUCURSAL:</span><br>
                                                        {{ $users->seguro_seguro }} </td>
                                                    <td style="border: 1px solid black"><span
                                                            style="font-weight: bold">INTERMEDIARIO:</span><br>
                                                        Leonardo Cortes</td>
                                                    <td colspan="2" style="border: 1px solid black"><span
                                                            style="font-weight: bold">CLAVE:</span><br>
                                                        ------ </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table width="100%" height="20" cellpadding="5" cellspacing="1"
                                            style="border:1px solid black; border-collapse:collapse; padding:2px text-align:center;">
                                            <tbody>
                                                <tr
                                                    style="border:1px solid black; border-collapse:collapse; padding:2px text-align:center;">
                                                    <th height="31" colspan="4"
                                                        style="font-size: 12px; text-align: left;" scope="col">DATOS
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td><span style="font-weight: bold">Asegurado:</span><br>
                                                        {{ $users->form_person_name }} </td>
                                                    <td style="border: 1px solid black"><span
                                                            style="font-weight: bold">Cédula de ciudadanía: </span><br>
                                                        {{ $users->form_person_docnumber }} </td>
                                                    <td style="border: 1px solid black"><span
                                                            style="font-weight: bold">Teléfono:</span><br>
                                                        {{ $users->form_person_phone }} </td>
                                                    <td style="border: 1px solid black"><span
                                                            style="font-weight: bold">E-mail:</span><br>
                                                        {{ $users->form_person_email }} </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table width="100%" height="20" cellpadding="5" cellspacing="1"
                                            style="border:1px solid black; border-collapse:collapse; padding:2px text-align:center;">
                                            <tbody>
                                                <tr
                                                    style="border:1px solid black; border-collapse:collapse; padding:2px text-align:center;">
                                                    <th height="31" colspan="4"
                                                        style="font-size: 12px; text-align: left;" scope="col">
                                                        DESCRIPCIÓN DEL VEHÍCULO</th>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid black"><span
                                                            style="font-weight: bold">Marca:</span><br>
                                                        {{ $users->form_vehi_marca }} </td>
                                                    <td style="border: 1px solid black"><span
                                                            style="font-weight: bold">Modelo:</span><br>
                                                        {{ $users->form_vehi_model }} </td>
                                                    <td width="250px" style="border: 1px solid black"><span
                                                            style="font-weight: bold">Clase:</span><br>
                                                        {{ $users->clase_nombre }} </td>
                                                    <td style="border: 1px solid black"><span
                                                            style="font-weight: bold">Placa :</span><br>
                                                        {{ $users->form_vehi_placa }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="120px" style="border: 1px solid black"><span
                                                            style="font-weight: bold">Codigo Fasecolda:</span><br>
                                                        {{ $users->form_vehi_code }} </td>
                                                    <td colspan="2" style="border: 1px solid black"><span
                                                            style="font-weight: bold">Tipo:</span><br>
                                                        {{ $users->mf_name }} </td>
                                                    <td style="border: 1px solid black"><span
                                                            style="font-weight: bold">Valor comercial:</span><br>
                                                        ${{ number_format($users->form_vehi_valorasegurado, 0, ',', '.') }}
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                        <table width="100%" height="20" cellpadding="5" cellspacing="1"
                                            style="border:1px solid black; border-collapse:collapse; padding:2px text-align:center; font-size: 10px;">
                                            <tbody>
                                                <tr style="text-align: center">
                                                    <td style="border: 1px solid black"><span
                                                            style="font-weight: bold;">COBERTURAS</span></td>
                                                    <td style="border: 1px solid black"><span
                                                            style="font-weight: bold">VALOR ASEGURADO</span></td>
                                                    <td style="border: 1px solid black"><span
                                                            style="font-weight: bold">DEDUCIBLES</span></td>
                                                </tr>
                                                @foreach ($amparos as $amparo)
                                                    @if ($amparo->cobertura_deducible)
                                                        <tr style="text-align: center">
                                                            <td style="border: 1px solid black">
                                                                {{ $amparo->cobertura_nombre }}
                                                            </td>
                                                            <td style="border: 1px solid black">
                                                                {{ $amparo->cobertura_limite }}
                                                            </td>
                                                            <td style="border: 1px solid black">
                                                                {{ $amparo->cobertura_deducible }}
                                                            </td>
                                                        </tr>
                                                    @else
                                                        <tr style="text-align: center">
                                                            <td style="border: 1px solid black">
                                                                {{ $amparo->cobertura_nombre }}
                                                            </td>
                                                            <td colspan="2" style="border: 1px solid black">
                                                                {{ $amparo->cobertura_limite }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach


                                                <tr
                                                    style="border:1px solid black; border-collapse:collapse; padding:2px text-align:center;">
                                                    <th height="31" colspan="4"
                                                        style="font-size: 12px; text-align: left;">
                                                        REQUISITOS PARA LA SUSCRIPCIÓN</th>
                                                </tr>
                                                <tr
                                                    style="border:1px solid black; border-collapse:collapse; padding:2px text-align:center;">
                                                    <td colspan="3"
                                                        style="border: 1px solid black; border-collapse: collapse; padding: 5px; text-align: left; font-size: 10px;">
                                                        1. Diligenciar el Formato Conocimiento del Cliente de Persona
                                                        Natural a: SARLAFT-001-N-2013-V3 y<br>
                                                        Persona Jurídica a: SARLAFT-001-J-2013-V3<br>
                                                        2. Fotocopia de la Cedula de Ciudadania del propietario,
                                                        matricula y
                                                        SOAT vigente<br>
                                                        3. Los valores asegurados y el amparo estan sujetos a inspeccion
                                                        y
                                                        analisis técnico.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                </tr>
                            </tbody>
                        </table>

                </tr>
            @endif
        </tbody>
    </table>
</body>

</html>

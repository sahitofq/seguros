<!doctype html>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <table width="650" border="0" cellspacing="0" cellpadding="0"
        style="background-color: #EEEEEE;font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, 'sans-serif'; color:#2E2E2E">
        <tbody>
            <tr>
                <td colspan="2"><img src="{{ env('APP_URL') }}/img/email/cabezote.jpg" width="650" height="129"
                        alt="" /></td>
            </tr>
            @yield('mailinfo')
            <tr>
                <td height="76">&nbsp;</td>
                <td>
                    <p><a href="{{ env('APP_URL') }}">{{ env('APP_URL') }}</a></p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#000000">
                        <tbody>
                            <tr>
                                <td colspan="4"><img src="{{ env('APP_URL') }}/img/email/palito.jpg" width="100%"
                                        height="3" alt="" />
                                </td>
                            </tr>
                            <tr>
                                <td width="156" rowspan="4"><img src="{{ env('APP_URL') }}/img/email/spuma.jpg"
                                        width="150" height="101" alt="" />
                                </td>
                                <td width="47" rowspan="4" bgcolor="#20252D"><img
                                        src="{{ env('APP_URL') }}/img/email/fondo.jpg" width="47" height="150"
                                        alt="" /></td>
                                <td width="727" bgcolor="#20252D">&nbsp;</td>
                                <td width="113">&nbsp;</td>
                            </tr>
                            <tr>
                                <td height="28" valign="top" bgcolor="#20252D"
                                    style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 18px; color: #FFFFFF;">
                                    LEONARDO CORTES</td>
                                <td align="center" valign="top"><a href="https://www.facebook.com/segurospuma"
                                        target="_blank"><img src="{{ env('APP_URL') }}/img/email/ico1.jpg" width="20"
                                            height="20" alt="" /></a>
                                </td>
                            </tr>
                            <tr>
                                <td height="31" valign="top" bgcolor="#20252D"><span
                                        style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #FFA329; font-size: 12px;">+
                                        57 {{ $asesor->asesor_telefono }}<br>
                                        <a href="{{ env('APP_URL') }}"
                                            style="color: #FFFFFF">{{ env('APP_URL') }}<br>
                                        </a> <a href="mailto:{{ $asesor->asesor_correo }}"
                                            style="color: #FFFFFF">{{ $asesor->asesor_correo }}</a></span>
                                </td>
                                <td align="center" valign="middle"><img src="{{ env('APP_URL') }}/img/email/ico2.jpg"
                                        width="20" height="20" alt="" /></td>
                            </tr>
                            <tr>
                                <td height="20" valign="top" bgcolor="#20252D"
                                    style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #FFA329; font-size: 12px;">
                                    <a href="mailto:leonardo.cortes@asesordeseguros.com.co" style="color: #FFFFFF"><br>
                                    </a>
                                </td>
                                <td align="center" valign="top"><img src="{{ env('APP_URL') }}/img/email/ico3.jpg"
                                        width="20" height="20" alt="" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>

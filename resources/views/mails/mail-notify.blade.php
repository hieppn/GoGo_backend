<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>E-receipt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dosis&display=swap" rel="stylesheet">
    <style type="text/css">
        /**
   * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
   */
        @media screen {
            @font-face {
                font-style: normal;
                font-weight: 400;
                font-family: 'Dosis', sans-serif;
            }

            @font-face {
                font-style: normal;
                font-weight: 700;
                font-family: 'Dosis', sans-serif;
            }
        }
        body,
        table,
        td,
        a {
            font-family: 'Raleway', sans-serif;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
           
        }
        .customize {
            
            font-size: 16px; 
            line-height: 24px;
        }
        .total-style {
            padding: 12px; 
            font-size: 16px; 
            line-height: 24px; 
            border-top: 2px dashed #D2C7BA; 
            border-bottom: 2px dashed #D2C7BA;
        }

        .primary-title {
            color: #FF6702;
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -1px;
            line-height: 48px;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }

        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        
        table {
            border-collapse: collapse !important;
        }


        a {
            color: #1a82e2;
        }

        img {
            height: auto;
            line-height: 100%;
            text-decoration: none;
            border: 0;
            outline: none;
        }
    </style>

</head>

<body>

    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" bgcolor="#D2C7BA">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 36px 24px;">
                        </td>
                    </tr>
                </table>

            </td>
        </tr>

        <tr>
            <td align="center" bgcolor="#D2C7BA">

                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="left" bgcolor="#ffffff" style="padding: 24px" class="customize">
                            <h3 class="primary-title">????n h??ng c???a b???n ???? ???????c giao th??nh c??ng</h1>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>

        <tr>
            <td align="center" bgcolor="#D2C7BA">

                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">


                    <tr>
                        <td align="left" bgcolor="#ffffff" style="padding: 24px" class="customize">
                            <p style="margin: 0;">C???m ??n b???n ???? s??? d???ng d???ch v??? t??m ki???m xe t???i ch??? h??ng c???a <b style="color: #FF6702;">GoGo</b>, vui l??ng xem chi ti???t h??a ????n b??n d?????i!.</p>
                        </td>
                    </tr>

                    <tr>
                        <td align="left" bgcolor="#ffffff" style="padding: 24px" class="customize">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr bgcolor="#FF6702" style="color: #ffffff">
                                    <td align="left" width="75%"
                                    style="padding: 12px" class="customize">
                                        <strong>????n h??ng</strong></td>
                                    <td align="left" width="25%"
                                    style="padding: 12px" class="customize">
                                        <strong>{{ $data['id'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td align="left" width="75%"
                                    style="padding: 6px 12px" class="customize">
                                        Lo???i h??ng h??a</td>
                                    <td align="left" width="25%"
                                    style="padding: 6px 12px" class="customize">
                                        <i style="font-style: italic;">{{ $data['name'] }}</i></td>
                                </tr>
                                <tr>
                                    <td align="left" width="75%"
                                    style="padding: 6px 12px" class="customize">
                                        Ph?? v???n chuy???n</td>
                                    <td align="left" width="25%"
                                    style="padding: 6px 12px" class="customize">
                                    {{ number_format($data['price'], 0, ',', '.') . "??" }}</td>
                                </tr>
                                <tr>
                                    <td align="left" width="75%"
                                    style="padding: 6px 12px" class="customize">
                                        Ph?? b???o hi???m</td>
                                    <td align="left" width="25%"
                                    style="padding: 6px 12px" class="customize">
                                    {{ number_format($data['insurance_fee'], 0, ',', '.') . "??" }}
                                   </td>
                                </tr>
                                <tr>
                                    <td align="left" width="75%"
                                    style="padding: 6px 12px" class="customize">
                                        Thu??? VAT (10%)</td>
                                    <td align="left" width="25%"
                                    style="padding: 6px 12px" class="customize">
                                    {{ number_format($data['vat'], 0, ',', '.') . "??" }}
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" width="75%"
                                        class="total-style">
                                        <strong>T???ng</strong></td>
                                    <td align="left" width="25%"
                                        class="total-style">
                                        <strong>{{ number_format($data['total'], 0, ',', '.') . "??" }}</strong></td>
                                </tr>
                            </table>
                        </td>
                    </tr>


                </table>

            </td>
        </tr>

        <tr>
            <td align="center" bgcolor="#D2C7BA" valign="top" width="100%">

                <table align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%"
                    style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="font-size: 0; border-bottom: 3px solid #d4dadf">

                            <div
                                style="display: inline-block; width: 100%; max-width: 50%; min-width: 240px; vertical-align: top;">
                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%"
                                    style="max-width: 300px;">
                                    <tr>
                                        <td align="left" valign="top"
                                            style="padding-bottom: 36px; padding-left: 36px;" class="customize">
                                            <p><strong>?????a ch??? nh???n h??ng</strong></p>
                                            <p> {{ $data['sender_name'] }}<br> {{ $data['sender_phone'] }}<br> {{ $data['sender_address'] }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div
                                style="display: inline-block; width: 100%; max-width: 50%; min-width: 240px; vertical-align: top;">
                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%"
                                    style="max-width: 300px;">
                                    <tr>
                                        <td align="left" valign="top"
                                        style="padding-bottom: 36px; padding-left: 36px;" class="customize">
                                            <p><strong>?????a ch??? giao h??ng</strong></p>
                                            <p> {{ $data['receiver_name'] }}<br> {{ $data['receiver_phone'] }}<br> {{ $data['receiver_address'] }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </td>
                    </tr>
                </table>

            </td>
        </tr>

        <tr>
            <td align="center" bgcolor="#D2C7BA" style="padding: 24px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" bgcolor="#D2C7BA"
                            style="padding: 12px 24px; font-size: 12.5px; line-height: 20px; color: #666;">
                            <p style="margin: 0;">????y l?? email ???????c g???i t??? ?????ng t??? GoGo Truck Delivery Service Partner!<br>Vui l??ng li??n h??? Admin th??ng qua email <a href="mailto:gogo.team2021@gmail.com">gogo.team2021@gmail.com</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">
<link type="text/css" rel="stylesheet" id="dark-mode-custom-link" />
<link type="text/css" rel="stylesheet" id="dark-mode-general-link" />
<style lang="en" type="text/css" id="dark-mode-custom-style"></style>
<style lang="en" type="text/css" id="dark-mode-native-style"></style>
<style lang="en" type="text/css" id="dark-mode-native-sheet"></style>

<head>
    <title>
        {{ config('app.name') }}
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style type="text/css">
        #outlook a {
            padding: 0;
        }

        body {
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            border-collapse: collapse;
            mso-table-lspace: 0;
            mso-table-rspace: 0;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        p {
            display: block;
            margin: 13px 0;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700" rel="stylesheet" type="text/css" />
    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,700);
    </style>
    <!--<![endif]-->
    <style type="text/css">
        @media only screen and (min-width:480px) {
            .mj-column-per-100 {
                width: 100% !important;
                max-width: 100%;
            }
        }
    </style>
    <style type="text/css">
        @media only screen and (max-width:480px) {
            table.mj-full-width-mobile {
                width: 100% !important;
            }

            td.mj-full-width-mobile {
                width: auto !important;
            }
        }
    </style>
    <style type="text/css">
        a,
        span,
        td,
        th {
            -webkit-font-smoothing: antialiased !important;
            -moz-osx-font-smoothing: grayscale !important;
        }
    </style>
</head>

<body style="background-color:#54595f;">
    <div style="background-color:#54595f;">
        <div style="margin:0px auto;max-width:600px;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
                style="width:100%;">
                <tbody>
                    <tr>
                        <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
                            <div class="mj-column-per-100 mj-outlook-group-fix"
                                style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                    style="vertical-align:top;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td style="font-size:0px;word-break:break-word;">
                                                <div style="height:20px;"></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="background:#ffffff;background-color:#ffffff;margin:0px auto;border-radius:4px;max-width:600px;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
                style="background:#ffffff;background-color:#ffffff;width:100%;border-radius:4px;">
                <tbody>
                    <tr>
                        <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">

                            <div class="mj-column-per-100 mj-outlook-group-fix"
                                style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                    style="vertical-align:top;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td align="center"
                                                style="font-size:0px;padding:8px 0;word-break:break-word;">
                                                <table border="0" cellpadding="0" cellspacing="0"
                                                    role="presentation"
                                                    style="border-collapse:collapse;border-spacing:0px;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="width:100px;">
                                                                <img height="auto"
                                                                    src="{{ asset('images/ibr-logo.png') }}"
                                                                    style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                <p
                                                    style="border-top:dashed 1px lightgrey;font-size:1px;margin:0px auto;width:100%;">
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left"
                                                style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                <div
                                                    style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:24px;font-weight:300;line-height:30px;text-align:left;color:#000000;">
                                                    {{ $data['title'] }}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left"
                                                style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                <div
                                                    style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:14px;font-weight:300;line-height:20px;text-align:left;color:#000000;">
                                                    <p>
                                                        {{ $data['message'] }}
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" vertical-align="middle"
                                                style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                <table border="0" cellpadding="0" cellspacing="0"
                                                    role="presentation"
                                                    style="border-collapse:separate;line-height:100%;">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center" bgcolor="#54595f" role="presentation"
                                                                style="border:none;border-radius:3px;cursor:auto;mso-padding-alt:8px 16px;background:#54595f;"
                                                                valign="middle">
                                                                <span
                                                                    style="display: inline-block; background: #db4b31; color: white; font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 23px; font-weight: normal; line-height: 20px; margin: 0; text-decoration: none; text-transform: none; padding: 18px 26px; mso-padding-alt: 0px; border-radius: 3px;">
                                                                    {{ $data['code'] }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left"
                                                style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                <div
                                                    style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:14px;font-weight:300;line-height:20px;text-align:left;color:#000000;">
                                                    {{ $data['note'] }}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="margin:0px auto;max-width:600px;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
                style="width:100%;">
                <tbody>
                    <tr>
                        <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
                            <div class="mj-column-per-100 mj-outlook-group-fix"
                                style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                    style="vertical-align:top;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td align="center"
                                                style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                <div
                                                    style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:14px;font-weight:300;line-height:20px;text-align:center;color:#fafafa;">
                                                    © {{ now()->format('Y') }} - {{ config('app.name') }}</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>

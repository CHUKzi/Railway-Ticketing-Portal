<table class="body-wrap"
    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: transparent; margin: 0;">
    <tr
        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;"
            valign="top"></td>
        <td class="container" width="600"
            style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;"
            valign="top">
            <div class="content"
                style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                <table class="main" width="100%" cellpadding="0" cellspacing="0"
                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 7px; background-color: #eeeeee; color: #495057; margin: 0; box-shadow: 0 0.75rem 1.5rem rgba(18,38,63,.03);"
                    bgcolor="#fff">
                    <tr
                        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                        <td class="alert alert-warning"
                            style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 7px 7px 0 0; background-color: #556ee6; margin: 0; padding: 20px;"
                            align="center" bgcolor="#71b6f9" valign="top">
                            {{-- Your Login Credentials --}}
                        </td>
                    </tr>
                    <tr
                        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                        <td class="content-wrap"
                            style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;"
                            valign="top">
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">

                                <p>
                                    Hello,
                                    <br>
                                    <br>

                                    Tap the button below to verify your email address and set up your {{ env('APP_NAME') }} profile.
                                </p>

                                <tr
                                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                    <td class="content-block"
                                        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
                                        valign="top">

                                    <div align="center" style="padding:0;Margin:0"><span
                                            class="m_-199088950330960735es-button-border"
                                            style="border-style:solid;border-color:#29a643;background:#29a643;border-width:0px;display:inline-block;border-radius:5px;width:auto"><a
                                                href="{{ $MailData['html']['verify_url'] }}"
                                                class="m_-199088950330960735es-button"
                                                style="text-decoration:none;color:#ffffff;font-size:18px;display:inline-block;background:#29a643;border-radius:5px;font-family:arial,'helvetica neue',helvetica,sans-serif;font-weight:bold;font-style:normal;line-height:22px;width:auto;text-align:center;padding:15px 40px 15px 40px;padding-top:15px;padding-bottom:15px"
                                                dir="ltr" target="_blank">Verify
                                                Email</a></span>
                                    </div>

                                    <p>
                                    Best regards,<br />
                                    {{ env('APP_NAME') }}&nbsp;Team
                                </p>
                        </td>
                    </tr>

                </table>
                <hr>
                <center><a href="transit.alexlanka.com">© transit.alexlanka.com</a></center>
        </td>

    </tr>
</table>
</div>
</td>
</tr>
</table>

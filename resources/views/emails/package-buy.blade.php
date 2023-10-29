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
                            Your Payment Confirmation
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
                                    Dear Sir/Madam,
                                    <br>
                                    <br>
                                    Your Payment Confirmation is herewith.
                                </p>

                                <tr
                                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                    <td class="content-block"
                                        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
                                        valign="top">

                                        <div>
                                            <table style="width: 100%; border-collapse: collapse;">
                                                <tr>
                                                    <th style="border: 1px solid black; padding: 8px;">Payment ID</th>
                                                    <th style="border: 1px solid black; padding: 8px;">Payment Type</th>
                                                    <th style="border: 1px solid black; padding: 8px;">Package Name</th>
                                                    <th style="border: 1px solid black; padding: 8px;">Price</th>
                                                    <th style="border: 1px solid black; padding: 8px;">Points</th>
                                                </tr>

                                                <tbody>
                                                    <tr>
                                                        <td style="border: 1px solid black; padding: 8px; text-align: center;">{{ $MailData['html']['payment_id'] }}</td>
                                                        <td style="border: 1px solid black; padding: 8px; text-align: center;">{{ $MailData['html']['payment_type'] }}</td>
                                                        <td style="border: 1px solid black; padding: 8px; text-align: center;">{{ $MailData['html']['package_name'] }}</td>
                                                        <td style="border: 1px solid black; padding: 8px; text-align: center;">{{ $MailData['html']['package_price'] }}&nbsp;{{ $MailData['html']['currency'] }}</td>
                                                        <td style="border: 1px solid black; padding: 8px; text-align: center;">{{ $MailData['html']['buy_points'] }}</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <div style="text-align: right;">
                                            <hr>
                                            <p><b>Total Credit points : </b>{{ $MailData['html']['current_credit_points'] }}</p>
                                            <hr>
                                        </div>
                                        Thank you for using the {{ env('APP_NAME') }} app.
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

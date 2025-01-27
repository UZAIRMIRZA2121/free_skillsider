<style>
    @font-face {
        font-family: 'Telegraf', sans-serif;
        src: url(./FontsFree-Net-Telegraf-Regular.ttf);
    }

    @font-face {
        font-family: 'HK Grotesk', sans-serif;
        src: url(./hk-grotesk/HKGrotesk-Bold.otf);
    }

    @font-face {
        font-family: 'HK Grotesk Medium', sans-serif;
        src: url(./hk-grotesk/HKGrotesk-Medium.otf);
    }

    html,
    body {
        padding: 0;
        margin: 0;
        font-family: 'HK Grotesk', sans-serif;
        font-weight: 400;
    }

    table {
        max-width: 335px;
    }

    @media screen and (max-width: 330px) {
        table {
            max-width: 90%;
        }
    }
</style>
<div
    style="line-height: 1.5; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%; background-color:#E5E5E5">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
        style="border-collapse:collapse;margin:0 auto; padding:0;">
        <tbody>
            <tr>
                <td align="left" valign="center">
                    <div
                        style="color: #4C4C4C; text-align:left; margin: 0 20px; margin-top: 50px; padding: 40px 30px; background-color:#ffffff; border-radius: 6px">
                        <!--begin:Email content-->
                        <!--begin::Logo-->
                        <a href="#" class="py-9 mx-5">
                            <img alt="Logo" src="{{ asset('assets/images/logo.png') }}" class="h-70px" />
                        </a>




                        <div style="padding-bottom: 30px; font-size: 14px;">Hi <strong>{{ $details['name'] }}</strong>,
                        </div>
                        @if($details['verify'] == 1)
                        
                        <div style="padding-bottom: 30px; font-size: 14px; line-height: 24px;">
                            We have activated your package  <b>{{ $details['package'] }}.</b> <br>
                            You are ready to gain access to all of the assets we prepared for students of <b>Skillsider.pk</b>
                        </div>
                        @else
                        <div style="padding-bottom: 30px; font-size: 14px; line-height: 24px;">
                            We have rejected your package <b>{{ $details['package'] }}.</b>  <br>
                           Due to payment issues 
                        </div>
                        @endif
                        <!--end:Email content-->
                        <div style="padding-bottom: 10px; line-height: 24px; font-size: 14px;">Thanks,
                            <br>Skillsider.pk Team.

                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

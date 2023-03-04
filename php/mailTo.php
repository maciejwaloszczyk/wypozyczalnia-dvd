<?php
    $to = 'maciejwaloszczyk04@gmail.com'; 
    $from = 'maciejwaloszczyk2@gmail.com'; 
    $fromName = 'SenderName'; 
    
    $subject = "Send HTML Email in PHP by CodexWorld"; 

    $htmlContent = `
        <!doctype html>
        <html>
            <head>
                <meta charset='utf-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1'>
                <title>Potwierdź rejestrację</title>
                <link href='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css' rel='stylesheet'>
                <link href='' rel='stylesheet'>
                <style> @media screen {
    @font-face {
    font-family: 'Lato';
    font-style: normal;
    font-weight: 400;
    src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
    }

    @font-face {
    font-family: 'Lato';
    font-style: normal;
    font-weight: 700;
    src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
    }

    @font-face {
    font-family: 'Lato';
    font-style: italic;
    font-weight: 400;
    src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
    }

    @font-face {
    font-family: 'Lato';
    font-style: italic;
    font-weight: 700;
    src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
    }
    }

    /* CLIENT-SPECIFIC STYLES */
    body,
    table,
    td,
    a {
    -webkit-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
    }

    table,
    td {
    mso-table-lspace: 0pt;
    mso-table-rspace: 0pt;
    }

    img {
    -ms-interpolation-mode: bicubic;
    }

    /* RESET STYLES */
    img {
    border: 0;
    height: auto;
    line-height: 100%;
    outline: none;
    text-decoration: none;
    }

    table {
    border-collapse: collapse !important;
    }

    body {
    height: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    width: 100% !important;
    background-color: #f4f4f4;
    }

    /* iOS BLUE LINKS */
    a[x-apple-data-detectors] {
    color: inherit !important;
    text-decoration: none !important;
    font-size: inherit !important;
    font-family: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    }

    /* MOBILE STYLES */
    @media screen and (max-width:600px) {
    h1 {
    font-size: 32px !important;
    line-height: 32px !important;
    }
    }

    /* ANDROID CENTER FIX */
    div[style*="margin: 16px 0;"] {
    margin: 0 !important;
    }</style>
                <script type='text/javascript' src=''></script>
                <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
                <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>
            </head>
            <body oncontextmenu='return false' class='snippet-body'>
            <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> We're thrilled to have you here! Get ready to dive into your new account. </div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <!-- LOGO -->
    <tr>
    <td bgcolor="#730cd3" align="center">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
    <tr>
    <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
    </tr>
    </table>
    </td>
    </tr>
    <tr>
    <td bgcolor="#730cd3" align="center" style="padding: 0px 10px 0px 10px;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
    <tr>
    <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
        <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Witamy!</h1> <img src=" https://img.icons8.com/clouds/100/000000/handshake.png" width="125" height="120" style="display: block; border: 0px;" />
    </td>
    </tr>
    </table>
    </td>
    </tr>
    <tr>
    <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
    <tr>
    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
        <p style="margin: 0;">Bardzo nam miło, że zdecydowałeś się na założenie konta w naszym serwisie. Kliknij w przycisk poniżej i potwierdź rejestrację</p>
    </td>
    </tr>
    <tr>
    <td bgcolor="#ffffff" align="left">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="center" style="border-radius: 3px;" bgcolor="#730cd3"><a href="#" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #730cd3; display: inline-block;">POTWIERDŹ KONTO</a></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
    </tr> <!-- COPY -->
    <tr>
    <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
        <p style="margin: 0;">Jeśli to nie zadziała, wklej link do przeglądarki:</p>
    </td>
    </tr> <!-- COPY -->
    <tr>
    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
        <p style="margin: 0;"><a href="#" target="_blank" style="color: #730cd3;">https://localhost/wypozyczalnia-dvd/php/activateUser.php?a=</a></p>
    </td>
    </tr>
    <tr>
    <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
        <p style="margin: 0;">Jeśli masz jakieś pytania skontaktuj się z nami - chętnie na nie odpowiemy.</p>
    </td>
    </tr>
    <tr>
    <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
        <p style="margin: 0;">Serdecznie pozdrawiamy,<br>KNS Web Services</p>
    </td>
    </tr>
    </table>
    </td>
    </tr>
    <tr>
    <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
    <tr>
    <td bgcolor="#d099fa" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
        <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2>
        <p style="margin: 0;"><a href="#" target="_blank" style="color: #730cd3;">We&rsquo;re here to help you out</a></p>
    </td>
    </tr>
    </table>
    </td>
    </tr>
    <tr>
    <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
    <tr>
    <td bgcolor="#f4f4f4" align="left" style="padding: 0px 30px 30px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"> <br>
        <p style="margin: 0;">Jeśli nie zakładałeś konta w wypożyczalni <a href="#" target="_blank" style="color: #111111; font-weight: 700;">zgłoś nam ten błąd</a>.</p>
    </td>
    </tr>
    </table>
    </td>
    </tr>
    </table>
            <script type='text/javascript'></script>
            </body>
        </html>

    `; 
    
    // Set content-type header for sending HTML email 
    $headers = "MIME-Version: 1.0" . "\r\n"; 
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
    
    // Additional headers 
    $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
    $headers .= 'Cc: welcome@example.com' . "\r\n"; 
    $headers .= 'Bcc: welcome2@example.com' . "\r\n"; 
    
    // Send email
    if(mail($to, $subject, $htmlContent, $headers)){ 
        echo 'Email has sent successfully.'; 
    }else{ 
       echo 'Email sending failed.'; 
    }
?>
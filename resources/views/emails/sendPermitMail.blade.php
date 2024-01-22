
<!DOCTYPE html>
<html>
<head>
    <title>Bank Woori Saudara</title>
</head>
<body>
    <h3>{{ $details['title'] }}</h3>
    <p>{{ $details['body'] }}</p>
    <center>
        <table>
            <tr>
                <td>Akun</td>
                <td>:</td>
                <td><b><u>{{ $details['akun'] }}</u></b></td></td>
            </tr>
            <tr>
                <td>Pada</td>
                <td>:</td>
                <td><b><u>{{ $details['waktu'] }}</u></b></td>
            </tr>
            <tr>
                <td>IP Address</td>
                <td>:</td>
                <td><b><u>{{ $details['ip_address'] }}</u></b></td>
            </tr>
            <tr>
                <td>Browser</td>
                <td>:</td>
                <td><b><u>{{ $details['browser'] }}</u></b></td>
            </tr>
        </table>
    </center>
    <br>
    <br>
    <p>PT Bank Woori Saudara Indonesia 1906, Tbk</p>
</body>
</html>
<html lang="en">
    <head>
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="/assets/css/bootstrap.min.css" id="bootstrap-stylesheet" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/assets/css/app-rtl.min.css" id="app-stylesheet" rel="stylesheet" type="text/css" />
        <link href="/assets/css/custom.css" id="app-stylesheet" rel="stylesheet" type="text/css" />
    </head>
<body style="direction: rtl; margin:25px">
    <h5>کارمندان</h5>
    <table width="600px"  style="border: solid 1px #000" cellspacing="10" cellpadding="10">
        @foreach($data['users'] as $row)
        <tr>
            <td>
                نام کارمند : {{$row['user']}}
            </td>
            <td>
                نام غذا : {{$row['plate']}}
            </td>
        </tr>
        @endforeach
    </table>
    <hr/>
    <h5>غذاها</h5>
    <table width="600px" style="border: solid 1px #000;"  cellspacing="10" cellpadding="10">
        @foreach($data['dishes'] as $row)
        <tr>
            <td>
                نام غذا : {{$row['name']}}
            </td>
            <td>
                تعداد : {{$row['count']}}
            </td>
        </tr>
        @endforeach
    </table>
    
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ @$title }} {{config('app.app_name')}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="shortcut icon" href="{{url('themes/default/images/favicon.ico')}}">
    <link rel="stylesheet" href="{{ url('themes/default/css/style_report.css')}}">
</head>
<body>
    <h4 align="center">
      {{config('app.app_alias')}} {{config('app.area')}} <br>
      {{config('app.address')}}<hr>
    </h4>
    <h5 align="center">
      <u><i>{{ @$title }} </i></u><br>
    </h5>
    <div class="container">
      <style>
        table, th, td {
          border: 0px!important;
        }
      </style>
      <table>
        <thead>
          <tr>
            <td style="width: 25%">No Rekening</td>
            <td style="width: 3%">:</td>
            <td>{{ @$item->id_pinjaman }}</td>
          </tr>
          <tr>
            <td style="width: 25%">Nasabah</td>
            <td style="width: 3%">:</td>
            <td>{{ @$item->nama_nasabah }}</td>
          </tr>
          <tr>
            <td style="width: 25%">{{ @$label}}</td>
            <td style="width: 3%">:</td>
            <td>{{ 'Rp ' .number_format(@$item->total, 2) }}</td>
          </tr>
          <tr>
            <td style="width: 25%">Sisa Angsuran</td>
            <td style="width: 3%">:</td>
            <td>{{ 'Rp ' .number_format(@$item->sisa_pinjaman, 2) }}</td>
          </tr>
        </thead>
      </table>
      <br>
      <table style="border: 0px!important">
        <tr>
          <td width="50%" style="border: 0px!important">
            <p style="margin-bottom: 70px">Penyetor</p>

            <p><i>{{ @$item->nama_nasabah }}</i></p>
          </td>
          <td width="50%" align="right" style="border: 0px!important">
            <p style="margin-bottom: 70px"><?php echo 'Mas, '.date('d M Y') ?>,<br>
            Penerima</p>

            <p><i>{{ @$item->nama_user }}</i></p>
          </td>
        </tr>
      </table>
      </div>
    <p style="z-index: 100;position: absolute;bottom: 0px;float: right;font-size: 11px;"><i>Tanggal Cetak : <?php echo date('d-m-Y') ?></i></p>
</body>
</html>
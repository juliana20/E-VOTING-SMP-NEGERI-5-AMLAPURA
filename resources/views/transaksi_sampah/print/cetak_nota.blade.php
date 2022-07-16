<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ @$title }} | {{config('app.app_name')}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="shortcut icon" href="{{url('themes/default/images/favicon.ico')}}">
    <link rel="stylesheet" href="{{ url('themes/default/css/style_report.css')}}">
</head>
<body>
    <h5 align="center">
      {{config('app.app_alias')}} {{config('app.area')}} <br>
      {{config('app.address')}}<hr>
    </h5>
    <h5 align="center">
      {{ @$title }}<br>
    </h5>
    <h5 align="center">
      <u>Bukti Pembayaran Sampah</u>
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
            <td style="width: 35%">Kode Transaksi</td>
            <td style="width: 3%">:</td>
            <td>{{ @$item->kode_transaksi_sampah }}</td>
          </tr>
          <tr>
            <td style="width: 35%">Nama Pelanggan</td>
            <td style="width: 3%">:</td>
            <td>{{ @$item->nama_pelanggan }}</td>
          </tr>
          <tr>
            <td style="width: 35%">Tanggal Transaksi</td>
            <td style="width: 3%">:</td>
            <td>{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
          </tr>
          <tr>
            <td style="width: 35%">Jumlah Pembayaran</td>
            <td style="width: 3%">:</td>
            <td>Rp. {{ number_format($item->jumlah, 0) }}</td>
          </tr>
          <tr>
            <td style="width: 35%">Biaya Jasa</td>
            <td style="width: 3%">:</td>
            <td>Rp. {{ number_format($item->biaya_jasa, 0) }}</td>
          </tr>
          <tr>
            <td colspan="3"><hr></td>
          </tr>
          
          <tr>
            <td style="width: 35%">Total Bayar</td>
            <td style="width: 3%">:</td>
            <td>Rp. {{ number_format($item->total_bayar, 0) }}</td>
          </tr>
        </thead>
      </table>
      <br>
      <table style="border: 0px!important">
        <tr>
          <td width="50%" style="border: 0px!important">

          </td>
          <td width="50%" align="right" style="border: 0px!important">
            <p style="margin-bottom: 70px"><?php echo 'Kerambitan, '.date('d M Y') ?>,<br>
            Penerima</p>

            <p><i>{{ @$item->nama_user }}</i></p>
          </td>
        </tr>
      </table>
      </div>
    <p style="z-index: 100;position: absolute;bottom: 0px;float: right;font-size: 11px;"><i>Tanggal Cetak : <?php echo date('d-m-Y') ?></i></p>
</body>
</html>
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
    <style>
      table, tr, th, td{
        border: 0px!important;
      }
    </style>
</head>
<body>
    <h5 align="center">
      {{config('app.app_name')}} {{config('app.area')}} <br>
      Alamat : {{config('app.address')}} <br>Telepon : {{config('app.phone')}}<hr>
    </h5>
    <h4 align="center">
      {{ @$title }} <br>
      Periode : {{ $params->date_start ." s/d ". $params->date_end }}
    </h4>
    <div class="container">
      <table width="100%">
        {{-- 1 --}}
        <tr>
          <th colspan="3" style="background-color: #ddd">Arus Kas Dari Aktivitas Operasi</th>
        </tr>
        <tr>
          <td width="50%">Tabungan Sukarela</td>
          <td>Rp. {{number_format( $tabungan_sukarela, 2)}}</td>
        </tr>
        <tr>
          <td width="50%">Tabungan Berjangka</td>
          <td>Rp. {{number_format( $tabungan_berjangka, 2)}}</td>
        </tr>
        {{-- 2 --}}
        <tr>
          <th colspan="3" style="background-color: #ddd">Arus Kas Dari Aktivitas Investasi</th>
        </tr>
        <tr>
          <td width="50%">Aset Lainnya</td>
          <td>(Rp. {{number_format( $pengeluaran, 2)}})</td>
        </tr>
        {{-- 3 --}}
        <tr>
          <th colspan="3" style="background-color: #ddd">Arus Kas Dari Aktivitas Pendanaan</th>
        </tr>
        <tr>
          <td width="50%">Simpanan Pokok</td>
          <td>Rp. {{number_format( $simpanan_pokok, 2)}}</td>
        </tr>
        <tr>
          <td width="50%">Simpanan Wajib</td>
          <td>Rp. {{number_format( $simpanan_wajib, 2)}}</td>
        </tr>
        <br>
        <tr>
          <th colspan="2" style="background-color: #ddd">KAS BERSIH</th>
          <th style="text-align: right!important">Rp. {{number_format(($simpanan_wajib + $simpanan_pokok + $tabungan_berjangka + $tabungan_sukarela) - $pengeluaran, 2)}}</th>
        </tr>


      </table>
      </div>
    <p style="z-index: 100;position: absolute;bottom: 0px;float: right;font-size: 11px;"><i>Tanggal Cetak : <?php echo date('d-m-Y') ?></i></p>
</body>
</html>
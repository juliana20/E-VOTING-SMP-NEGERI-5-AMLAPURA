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
    <h5 align="center">
      {{ @$title }} <br>
      Periode : {{ $params->date_start ." s/d ". $params->date_end }}
    </h5>
    <div class="container">
      <table width="100%">
        {{-- PENDAPATAN --}}
        <tr>
          <th colspan="3" style="background-color: #ddd">PENDAPATAN</th>
        </tr>
        <?php  $total_pendapatan = 0; ?>
        @foreach($pendapatan as $kelompok => $item)
          <tr>
            <td colspan="3"><b>{{ $kelompok }}</b></td>
          </tr>
          @foreach($item as $row)
          <?php  $total_pendapatan += $row->kredit - $row->debet; ?>
            <tr>
              <td style="padding-left: 20px;">{{$row->nama_akun}}</td>
              <td colspan="2">Rp. {{number_format($row->kredit - $row->debet, 2)}}</td>
            </tr>
          @endforeach
        @endforeach
        <tr>
          <td colspan="2"><b>Total Pendapatan</b></td>
          <td><b>Rp. {{number_format( $total_pendapatan, 2)}}</b></td>
        </tr>

        {{-- BIAYA --}}
        <tr>
          <th colspan="3" style="background-color: #ddd">BIAYA - BIAYA</th>
        </tr>
        <?php  $total_biaya = 0; ?>
        @foreach($biaya as $kelompok => $item)
          <tr>
            <td colspan="3"><b>{{ $kelompok }}</b></td>
          </tr>
          @foreach($item as $row)
          <?php  $total_biaya += $row->debet - $row->kredit; ?>
            <tr>
              <td style="padding-left: 20px;">{{$row->nama_akun}}</td>
              <td colspan="2">Rp. {{number_format($row->debet - $row->kredit, 2)}}</td>
            </tr>
          @endforeach
        @endforeach
        <tr>
          <td colspan="2"><b>Total Biaya</b></td>
          <td><b>Rp. {{number_format( $total_biaya, 2)}}</b></td>
        </tr>
        {{-- LABA RUGI --}}
        <tr>
          <th colspan="2" style="background-color: #ddd">LABA RUGI</th>
          <th style="text-align: right!important">Rp. {{number_format($total_pendapatan - $total_biaya, 2)}}</th>
        </tr>


      </table>
      </div>
    <p style="z-index: 100;position: absolute;bottom: 0px;float: right;font-size: 11px;"><i>Tanggal Cetak : <?php echo date('d-m-Y') ?></i></p>
</body>
</html>
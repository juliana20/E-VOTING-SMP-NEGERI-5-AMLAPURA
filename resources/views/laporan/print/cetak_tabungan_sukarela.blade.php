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
          <thead>
            <tr>
              <th style="text-align: center!important">No</th>
              <th>No Tabungan</th>
              <th>Nama Nasabah</th>
              {{-- <th>Tanggal Mulai</th> --}}
              <th>Saldo</th>
              <th>Bunga</th>
              <th>Saldo Akhir</th>
            </tr>
          </thead>
          <tbody>
            <?php  $no = 1; $saldo = 0; $bunga = 0; $grandtotal = 0; ?>
            @if(!empty($item)) 
              @foreach($item as $row)
              <?php 
                $saldo += $row['saldo'];  
                $bunga += $row['bunga'];  
                $grandtotal = $saldo + $bunga;  
              
              ?>
                <tr>
                  <td align="center">{{ $no++ }}</td>
                  <td>{{ $row['no_rek_tabungan'] }}</td>
                  <td>{{ $row['nama_nasabah'] }}</td>
                  {{-- <td>{{ date('d M Y',strtotime($row['tanggal_daftar'])) }}</td> --}}
                  <td>Rp. {{ number_format($row['saldo'], 2) }}</td>
                  <td>Rp. {{ number_format($row['bunga'], 2) }}</td>
                  <td>Rp. {{ number_format($row['saldo'] + $row['bunga'], 2) }}</td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="6" align="center">Tidak terdapat data</td>
              </tr>
            @endif
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3" align="right"><b>Total</b></td>
              <td><b>Rp. {{ number_format($saldo, 2) }}</b></td>
              <td><b>Rp. {{ number_format($bunga, 2) }}</b></td>
              <td><b>Rp. {{ number_format($grandtotal, 2) }}</b></td>
            </tr>
          </tfoot>

        </table>
      </div>
    <p style="z-index: 100;position: absolute;bottom: 0px;float: right;font-size: 11px;"><i>Tanggal Cetak : <?php echo date('d-m-Y') ?></i></p>
</body>
</html>
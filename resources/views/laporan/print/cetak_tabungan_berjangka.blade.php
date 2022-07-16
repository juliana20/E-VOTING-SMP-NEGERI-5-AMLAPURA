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
              <th>No. Tab. Berjangka</th>
              <th>Nama Nasabah</th>
              <th>Tanggal Setor</th>
              <th>Jangka Waktu</th>
              <th>Nominal</th>
            </tr>
          </thead>
          <tbody>
            <?php  $no = 1;  $grandtotal = 0; ?>
            @if(!empty($item)) 
              @foreach($item as $row)
              <?php 
                $grandtotal += $row->kredit - $row->debet;  
              
              ?>
                <tr>
                  <td align="center">{{ $no++ }}</td>
                  <td>{{ $row->id_tabungan_berjangka }}</td>
                  <td>{{ $row->nama_nasabah }}</td>
                  <td>{{ date('d M Y',strtotime($row->tanggal_awal)) }}</td>
                  <td>{{ $row->jangka_waktu }} Tahun</td>
                  <td>Rp. {{ number_format($row->kredit - $row->debet, 2) }}</td>
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
              <td colspan="5" align="right"><b>Total</b></td>
              <td><b>Rp. {{ number_format($grandtotal, 2) }}</b></td>
            </tr>
          </tfoot>

        </table>
      </div>
    <p style="z-index: 100;position: absolute;bottom: 0px;float: right;font-size: 11px;"><i>Tanggal Cetak : <?php echo date('d-m-Y') ?></i></p>
</body>
</html>
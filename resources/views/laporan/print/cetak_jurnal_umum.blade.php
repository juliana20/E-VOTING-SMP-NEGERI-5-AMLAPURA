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
        table{
            border:1px!important;
            border-collapse:collapse;
            margin:0 auto;
            width: 100%; 
        }
        th{
            padding:7px;
            border:0px!important;
            text-align:left;
            background-color:#ddd;
        }
        td, tr{
            padding:5px;
            border:0px!important;
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
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>No Bukti</th>
              <th>Akun</th>
              <th>Keterangan</th>
              <th>Debet</th>
              <th>Kredit</th>
            </tr>
          </thead>
          <tbody>
            <?php  $no = 1;$debet = 0; $kredit = 0; ?>
            @if(!empty($item)) 
                @foreach($item as $row)
                  @php $debet += $row->debet; $kredit += $row->kredit; @endphp
                  <tr>
                      <td><b>{{ $row->tanggal }}</b></td>
                      <td><b>{{ $row->id_jurnal }}</b></td>
                      <td>{{ $row->id_akun }}</td>
                      <td>{{ $row->nama_akun }}</td>
                      <td>Rp. {{ number_format($row->debet, 2) }}</td>
                      <td>Rp. {{ number_format($row->kredit, 2) }}</td>
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
              <td colspan="4" align="right"><b>Total</b></td>
              <td><b>Rp. {{ number_format($debet, 2) }}</b></td>
              <td><b>Rp. {{ number_format($kredit, 2) }}</b></td>
            </tr>
          </tfoot>

        </table>
      </div>
    <p style="z-index: 100;position: absolute;bottom: 0px;float: right;font-size: 11px;"><i>Tanggal Cetak : <?php echo date('d-m-Y') ?></i></p>
</body>
</html>
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
    <h4 align="center">
      {{ @$title }} <br>
      Periode : {{ $params->date_start ." s/d ". $params->date_end }}
    </h4>
    <div class="container">
      <h4>Akun : {{ @$akun->nama_akun }}</h4>
        <table width="100%">
          <thead>
            <tr>
              <th style="text-align: center!important">No</th>
              <th>Tanggal</th>
              <th>No Bukti</th>
              <th>Keterangan</th>
              <th>Debet</th>
              <th>Kredit</th>
              <th>Saldo Akhir</th>
            </tr>
          </thead>
          <tbody>
            <?php  $no = 1;$debet = 0; $kredit = 0;$saldo_akhir = 0; $saldo_awal_bulan = @$saldo_awal + @$saldo_akhir_bulan_lalu; ?>
              <tr>
                <td align="center">{{ $no++ }}</td>
                <td>{{ date('01 M Y',strtotime($params->date_start)) }}</td>
                <td>SA</td>
                <td>Saldo Awal</td>
                <td>Rp. {{ number_format(0, 2) }}</td>
                <td>Rp. {{ number_format(0, 2) }}</td>
                <td>Rp. {{ number_format($saldo_awal_bulan, 2) }}</td>
              </tr>
            @if(!empty($item)) 
              @foreach($item as $row)
              <?php 
                $debet += $row->debet; 
                $kredit += $row->kredit; 
                //jika akun tabungan sukarela
                if($params->id_akun == '20103' || $params->id_akun == '20104' || $params->id_akun == '20105' || $params->id_akun == '20106')
                {
                  $saldo_akhir = ( $row->debet > 0) ? $saldo_akhir - $row->debet : $saldo_akhir  + $row->kredit;
                }else{
                  $saldo_akhir = ( $row->debet > 0) ? $saldo_akhir + $row->debet : $saldo_akhir  - $row->kredit;
                }

              
              ?>
                <tr>
                  <td align="center">{{ $no++ }}</td>
                  <td>{{ date('d M Y',strtotime($row->tanggal)) }}</td>
                  <td>{{ $row->no_bukti }}</td>
                  <td>{{ $row->keterangan }}</td>
                  <td>Rp. {{ number_format($row->debet, 2) }}</td>
                  <td>Rp. {{ number_format($row->kredit, 2) }}</td>
                  <td>Rp. {{ number_format($saldo_akhir + $saldo_awal_bulan, 2) }}</td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="6" align="center">Tidak terdapat data</td>
              </tr>
            @endif
          </tbody>
          <tfoot>
            {{-- <tr>
              <td colspan="4" align="right"><b>Total</b></td>
              <td><b>Rp. {{ number_format($debet, 2) }}</b></td>
              <td><b>Rp. {{ number_format($kredit, 2) }}</b></td>
              <td><b>Rp. {{ number_format(($akun->normal_pos == 'Debit') ? $debet - $kredit : $kredit - $debet , 2) }}</b></td>
            </tr> --}}
          </tfoot>

        </table>
      </div>
    <p style="z-index: 100;position: absolute;bottom: 0px;float: right;font-size: 11px;"><i>Tanggal Cetak : <?php echo date('d-m-Y') ?></i></p>
</body>
</html>
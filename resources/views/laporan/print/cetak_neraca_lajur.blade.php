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
        <table width="100%">
          <thead>
            <tr>
              <td rowspan="2"><b>No Akun</b></td>
              <td rowspan="2"><b>Nama Akun</b></td>
              <td colspan="2" align="center"><b>Neraca Saldo</b></td>
              <td colspan="2" align="center"><b>Penyesuaian</b></td>
              <td colspan="2" align="center"><b>Neraca Penyesuaian</b></td>
              <td colspan="2" align="center"><b>Laba Rugi</b></td>
              <td colspan="2" align="center"><b>Neraca</b></td>
            </tr>
            <tr>
              <td align="center"><b>Debet</b></td>
              <td align="center"><b>Kredit</b></td>
              <td align="center"><b>Debet</b></td>
              <td align="center"><b>Kredit</b></td>
              <td align="center"><b>Debet</b></td>
              <td align="center"><b>Kredit</b></td>
              <td align="center"><b>Debet</b></td>
              <td align="center"><b>Kredit</b></td>
              <td align="center"><b>Debet</b></td>
              <td align="center"><b>Kredit</b></td>
            </tr>
          </thead>
          <tbody>
            <?php  
              $debet1 = 0; 
              $kredit1 = 0;
              $debet2 = 0; 
              $kredit2 = 0;
              $debet3 = 0; 
              $kredit3 = 0;
              $debet4 = 0; 
              $kredit4 = 0;
              $debet5 = 0; 
              $kredit5 = 0; 
              $nominal = 0;

            ?>
            @if(!empty($akun)) 
              @foreach($akun as $row)
                @php 
                  $debet1 += $row['debet_neraca_saldo']; 
                  $kredit1 += $row['kredit_neraca_saldo'];
                  $debet2 += 0; 
                  $kredit2 += 0;
                  $debet3 += $row['debet_neraca_saldo']; 
                  $kredit3 += $row['kredit_neraca_saldo'];
                  $debet4 += in_array($row['golongan'], ['Pendapatan','Biaya']) ? $row['debet_neraca_saldo'] : 0; 
                  $kredit4 += in_array($row['golongan'], ['Pendapatan','Biaya']) ? $row['kredit_neraca_saldo'] : 0;
                  $debet5 += in_array($row['golongan'], ['Pendapatan','Biaya']) ? 0 : $row['debet_neraca_saldo']; 
                  $kredit5 += in_array($row['golongan'], ['Pendapatan','Biaya']) ? 0 : $row['kredit_neraca_saldo']; 
                @endphp
                <tr>
                  <td>{{ $row['id_akun'] }}</td>
                  <td>{{ $row['nama_akun'] }}</td>
                  <td>Rp. {{ number_format($row['debet_neraca_saldo'])  }}</td>
                  <td>Rp. {{ number_format(($row['nama_akun'] == 'Modal') ? $balance : $row['kredit_neraca_saldo']) }}</td>
                  <td>Rp. {{ number_format(0, 2) }}</td>
                  <td>Rp. {{ number_format(0, 2) }}</td>
                  <td>Rp. {{ number_format($row['debet_neraca_saldo']) }}</td>
                  <td>Rp. {{ number_format($row['kredit_neraca_saldo']) }}</td>
                  <td>Rp. {{ number_format(in_array($row['golongan'], ['Pendapatan','Biaya']) ? $row['debet_neraca_saldo'] : 0) }}</td>
                  <td>Rp. {{ number_format(in_array($row['golongan'], ['Pendapatan','Biaya']) ? $row['kredit_neraca_saldo'] : 0) }}</td>
                  <td>Rp. {{ number_format(in_array($row['golongan'], ['Pendapatan','Biaya']) ? 0 : $row['debet_neraca_saldo'] ) }}</td>
                  <td>Rp. 
                    @if($row['nama_akun'] == 'Modal')
                      @php $nominal = $balance; @endphp
                    @else
                     @php $nominal = in_array($row['golongan'], ['Pendapatan','Biaya']) ? 0 : $row['kredit_neraca_saldo']; @endphp
                    @endif

                    {{ number_format($nominal) }} 
                  </td>

                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="12" align="center">Tidak terdapat data</td>
              </tr>
            @endif
          </tbody>
          <tfoot>
            @php $balance_neraca_saldo = $kredit1 + ($debet1 - $kredit1) @endphp
            <tr>
              <td colspan="2" align="right"><strong>TOTAL </strong></td>
              <td><strong>{{ number_format($debet1, 0) }}</strong></td>
              <td><strong>{{ number_format($balance_neraca_saldo, 0) }}</strong></td>
              <td><strong>{{ number_format($debet2, 0) }}</strong></td>
              <td><strong>{{ number_format($kredit2, 0) }}</strong></td>
              <td><strong>{{ number_format($debet3, 0) }}</strong></td>
              <td><strong>{{ number_format($balance_neraca_saldo, 0) }}</strong></td>
              <td><strong>{{ number_format($debet4, 0) }}</strong></td>
              <td><strong>{{ number_format($kredit4, 0) }}</strong></td>
              <td><strong>{{ number_format($debet5, 0) }}</strong></td>
              <td><strong>{{ number_format($balance, 0) }}</strong></td>
            </tr>
            <tr>
              <td colspan="8" align="right"><strong> </strong></td>
              <td><strong>{{ number_format(($debet4 > $kredit4) ? 0 : $debet4 - $kredit4, 0) }}</strong></td>
              <td><strong>{{ number_format(($kredit4 < $debet4) ? $debet4 - $kredit4 : 0 , 0) }}</strong></td>
              <td><strong>{{ number_format(($debet5 > $balance) ? 0 : $balance - $debet5, 0) }}</strong></td>
              <td><strong>{{ number_format(($balance < $debet5) ? $balance - $debet5 : 0 , 0) }}</strong></td>
            </tr>
          </tfoot>

        </table>
      </div>
    <p style="z-index: 100;position: absolute;bottom: 0px;float: right;font-size: 11px;"><i>Tanggal Cetak : <?php echo date('d-m-Y') ?></i></p>
</body>
</html>
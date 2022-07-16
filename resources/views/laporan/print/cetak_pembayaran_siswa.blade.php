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
      {{ $params->nama_siswa ." Tahun Ajaran ". $params->tahun_ajaran }}
    </h5>
    <div class="container">
        <table width="100%">
          <thead>
            <tr>
              <th style="text-align: center!important">No</th>
              <th>Nama Bulan</th>
              <th>Tagihan</th>
              <th>Bayar</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php  $no = 1; ?>
            @if(!$pembayaran_siswa->isEmpty()) 
            @foreach($bulan as $bln)
                <tr>
                  <td align="center">{{ $no++ }}</td>
                  <td>{{  $bln['desc'] }}</td>
                  <td>
                    @foreach($pembayaran_siswa as $row)
                        <?php $tagihan = $row->tagihan ?>
                    @endforeach
                    Rp. {{ number_format($tagihan, 0) }}
                  </td>
                  <td>
                    @foreach($pembayaran_siswa as $row)
                      @if($bln['desc'] == $row->bulan)
                        Rp. {{ (!empty($row->nominal_bayar)) ? number_format($row->nominal_bayar, 0) : 0 }}
                      @endif
                    @endforeach
                  </td>
                  <td>
                    @foreach($pembayaran_siswa as $row)
                        @if($bln['desc'] == $row->bulan)
                          {{ 'LUNAS' }}
                          
                        @endif

                    @endforeach
                  </td>

                </tr>
            @endforeach
            @else
              <tr>
                <td colspan="5" align="center">Tidak terdapat data</td>
              </tr>
            @endif
          </tbody>

        </table>
      </div>
    <p style="z-index: 100;position: absolute;bottom: 0px;float: right;font-size: 11px;"><i>Tanggal Cetak : <?php echo date('d-m-Y') ?></i></p>
</body>
</html>
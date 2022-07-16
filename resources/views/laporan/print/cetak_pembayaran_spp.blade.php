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
      <?php  $no = 1; ?>
        @foreach($pembayaran_spp as $key => $item)
        <b>Nama Siswa : {{ $key }}</b>
        <table width="100%">
          <thead>
            <tr>
              <th style="text-align: center!important">No</th>
              <th>Tanggal Pembayaran</th>
              <th>Tahun Ajaran</th>
              <th>Kelas</th>
              <th>Pembayaran Bulan</th>
              <th>Tagihan</th>
              <th>Nominal Bayar</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($item as $row)
                <tr>
                  <td align="center">{{ $no++ }}</td>
                  <td>{{ $row->tanggal }}</td>
                  <td>{{ $row->tahun_ajaran }}</td>
                  <td>{{ $row->tingkat_kelas}}</td>
                  <td>{{ $row->bulan }}</td>
                  <td>Rp. {{ number_format($row->tagihan) }}</td>
                  <td>Rp. {{ number_format($row->nominal_bayar) }}</td>
                  <td>
                    @if($row->tagihan > $row->nominal_bayar)
                      {{ 'BELUM LUNAS' }}
                    @else
                      {{ 'LUNAS' }}
                    @endif
                  </td>
                </tr>
              @endforeach
          </tbody>

        </table>
        <br>
      @endforeach

      </div>
    <p style="z-index: 100;position: absolute;bottom: 0px;float: right;font-size: 11px;"><i>Tanggal Cetak : <?php echo date('d-m-Y') ?></i></p>
</body>
</html>
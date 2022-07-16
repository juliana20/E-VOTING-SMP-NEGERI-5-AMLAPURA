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
              <th>No Anggota</th>
              <th>Nama Anggota</th>
              {{-- <th>Tanggal Mulai</th> --}}
              <th>Jumlah Simpanan Pokok</th>
              <th>Jumlah Simpanan Wajib</th>
              <th>Jumlah Simpanan</th>
            </tr>
          </thead>
          <tbody>
            <?php  $no = 1; $total_pokok = 0; $total_wajib = 0; $grandtotal = 0; ?>
            @if(!empty($item)) 
              @foreach($item as $row)
                @if(@$row['jumlah_pokok'] > 0 || @$row['jumlah_wajib'] > 0)
                  <?php 
                    $total_pokok += @$row['jumlah_pokok'];  
                    $total_wajib += @$row['jumlah_wajib'];  
                    $grandtotal = $total_pokok + $total_wajib;  
                  
                  ?>
                    <tr>
                      <td align="center">{{ $no++ }}</td>
                      <td>{{ @$row['no_anggota'] }}</td>
                      <td>{{ @$row['nama_nasabah'] }}</td>
                      {{-- <td>{{ date('d M Y',strtotime(@$row['tanggal_daftar'])) }}</td> --}}
                      <td>Rp. {{ number_format(@$row['jumlah_pokok'], 2) }}</td>
                      <td>Rp. {{ number_format(@$row['jumlah_wajib'], 2) }}</td>
                      <td>Rp. {{ number_format(@$row['jumlah_pokok'] + @$row['jumlah_wajib'], 2) }}</td>
                    </tr>
                    @else
                    @endif
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
              <td><b>Rp. {{ number_format($total_pokok, 2) }}</b></td>
              <td><b>Rp. {{ number_format($total_wajib, 2) }}</b></td>
              <td><b>Rp. {{ number_format($grandtotal, 2) }}</b></td>
            </tr>
          </tfoot>

        </table>
      </div>
    <p style="z-index: 100;position: absolute;bottom: 0px;float: right;font-size: 11px;"><i>Tanggal Cetak : <?php echo date('d-m-Y') ?></i></p>
</body>
</html>
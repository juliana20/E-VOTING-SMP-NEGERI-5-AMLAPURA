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
      table, tr, th,td{
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
    <div class="col-sm-12">
      <div class="">
          <table class="table">
              <thead>
                  <tr>
                      <th align="center"><b>Aktiva</b></th>
                      <th align="center"><b>Pasiva</b></th>                        
                  </tr> 
              </thead>
              <tbody>	
                  <tr>
                      <td width="50%">
                        @php $total_aktiva = 0 + @$piutang_anggota->total; @endphp
                        @foreach($aktiva as $key => $item)
                          <table>
                              <tr>
                                <td colspan="2"><b>{{ $key }}</b></td>
                              </tr>
                              @php $subtotal_aktiva = 0; @endphp
                              @if($key == 'Aktiva Lancar')
                                <tr>
                                  <td width="50%" style="padding-left: 20px">Piutang Anggota</td>
                                  <td>Rp. {{ number_format(@$piutang_anggota->total, 2) }}</td>
                                </tr>
                              @endif
                              @foreach($item as $row)
                                @php $subtotal_aktiva += ($row['normal_pos'] == 'Kredit') ? $row['nilai'] * -1 : $row['nilai']; @endphp
                                <tr>
                                  <td width="50%" style="padding-left: 20px">{{ $row['nama_akun'] }}</td>
                                  <td>Rp. {{ ($row['normal_pos'] == 'Kredit') ? '('.number_format($row['nilai'],2).')' : number_format($row['nilai'], 2) }}</td>
                                </tr>
                              @endforeach
                              <tr>
                                <td><b>Total {{ $key }}</b></td>
                                <td><b>Rp. {{ number_format(($key == 'Aktiva Lancar') ? $subtotal_aktiva + @$piutang_anggota->total : $subtotal_aktiva , 2) }}</b></td>
                              </tr>
                          </table>
                          @php $total_aktiva += $subtotal_aktiva; @endphp
                        @endforeach
                        <br>
                       
                      </td>

                      {{-- ===================== --}}
                      @php $total_passivaX = 0; @endphp
                      @foreach($passiva as $key => $item)
                          @php $subtotal_passivaX = 0; @endphp
                          @foreach($item as $row)
                            @if($row['nama_akun'] == 'Hutang Nasabah')
                              @php $subtotal_passivaX += $hutang_nasabah + $row['nilai']; @endphp
                            @elseif($row['nama_akun'] == 'Modal')
                              @php $subtotal_passivaX += $row['nilai'] + @$simpanan_pokok + @$simpanan_wajib; @endphp
                            @else
                              @php $subtotal_passivaX += $row['nilai']; @endphp
                        @endif
                      @endforeach
                      @php $total_passivaX += $subtotal_passivaX; @endphp
                    @endforeach
                      {{-- ========================= --}}
                      @php $selisih =  $total_aktiva - $total_passivaX - @$tabungan_sukarela - @$tabungan_berjangka @endphp

                      <td width="50%">
                        @php $total_passiva = @$tabungan_sukarela + @$tabungan_berjangka; @endphp
                        @foreach($passiva as $key => $item)
                          <table>
                              <tr>
                                <td colspan="2"><b>{{ $key }}</b></td>
                              </tr>
                              @php $subtotal_passiva = 0; @endphp
                              @foreach($item as $row)
                                @if($row['nama_akun'] == 'Hutang Nasabah')
                                  @php $subtotal_passiva += $hutang_nasabah + $row['nilai']; @endphp
                                @elseif($row['nama_akun'] == 'Modal')
                                  @php $subtotal_passiva += $selisih + $row['nilai'] + @$simpanan_pokok + @$simpanan_wajib; @endphp
                                @else
                                  @php $subtotal_passiva += $row['nilai']; @endphp
                                @endif
                                  <tr>
                                    <td width="50%" style="padding-left: 20px">{{ $row['nama_akun'] }}</td>
                                    <td>
                                      @if($row['nama_akun'] == 'Hutang Nasabah')
                                        Rp. {{ number_format($hutang_nasabah,2) }}
                                      @elseif($row['nama_akun'] == 'Modal')
                                        Rp. {{ number_format($selisih ,2) }}
                                      @else 
                                        Rp. {{ number_format($row['nilai'], 2) }}
                                      @endif
                                    </td>
                                  </tr>
                              @endforeach
                                @if($row['nama_akun'] == 'Hutang Lain-lain')
                                  <tr>
                                    <td width="50%" style="padding-left: 20px">Tabungan Sukarela</td>
                                    <td>Rp. {{ number_format(@$tabungan_sukarela,2 ) }}</td>
                                  </tr>
                                  <tr>
                                    <td width="50%" style="padding-left: 20px">Tabungan Berjangka</td>
                                    <td>Rp. {{ number_format(@$tabungan_berjangka,2 ) }}</td>
                                  </tr>
                                @endif

                                @if($row['nama_akun'] == 'Modal')
                                  <tr>
                                    <td width="50%" style="padding-left: 20px">Simpanan Pokok</td>
                                    <td>Rp. {{ number_format(@$simpanan_pokok,2 ) }}</td>
                                  </tr>
                                  <tr>
                                    <td width="50%" style="padding-left: 20px">Simpanan Wajib</td>
                                    <td>Rp. {{ number_format(@$simpanan_wajib,2 ) }}</td>
                                  </tr>
                                @endif
                                <tr>
                                  <td><b>Total {{ $key }}</b></td>
                                  <td><b>Rp. {{ number_format(($key == 'Hutang Lancar') ? $subtotal_passiva + @$tabungan_sukarela + @$tabungan_berjangka : $subtotal_passiva, 2) }}</b></td>
                                </tr>

                          </table>
                          @php $total_passiva += $subtotal_passiva; @endphp
                        @endforeach
                        <br>
          

                      
                      </td>
                  </tr>
              </tbody>
          </table>
          <table>
            <tr>
              <td width="50%">
                <table>
                  <tr>
                    <td width="50%"><b>TOTAL AKTIVA</b></td>
                    <td><b>Rp. {{ number_format($total_aktiva, 2)  }}</td>
                  </tr>
                </table>
              </td>
              <td width="50%">
                <table>
                  <tr>
                    <td width="50%"><b>TOTAL PASSIVA</b></td>
                    <td><b>Rp. {{ number_format($total_passiva, 2)  }}</td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>


      </div>
  </div>

    <p style="z-index: 100;position: absolute;bottom: 0px;float: right;font-size: 11px;"><i>Tanggal Cetak : <?php echo date('d-m-Y') ?></i></p>
</body>
</html>
@extends('themes.AdminLTE.layouts.template')
<style>
  .form-horizontal .control-label {
    text-align: left!important;
}
</style>
@section('breadcrumb')  
  <h1>
    {{ @$title }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Master</a></li>
    <li><a href="{{ url($nameroutes) }}">{{ @$title }}</a></li>
    <li class="active">{{ @$header }}</li>
  </ol>
@endsection
@section('content')  
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">{{ @$header }}</h3>
        <div class="box-tools pull-right">
          <div class="btn-group">
            <a href="{{ url("{$nameroutes}/cetak-nota/{$item->id}") }}" target="_blank" class="btn btn-warning btn-sm"><i class="fa fa-print" aria-hidden="true"></i> Cetak Nota Transaksi</a>
          </div>
        </button>
      </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="col-sm-10 col-sm-offset-1">
        <form  method="POST" action="{{ url($submit_url) }}" class="form-horizontal" name="form_crud">
          <div class="form-group">
            <label class="col-lg-3 control-label">Kode Transaksi</label>
            <div class="col-lg-9">
              <label class="control-label">: {{ $item->kode_transaksi_online }}</label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Tanggal Transaksi</label>
            <div class="col-lg-9">
              <label class="control-label">: {{ date('d-m-Y', strtotime($item->tanggal)) }}</label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Pelanggan</label>
            <div class="col-lg-9">
              <label class="control-label">: {{ @$item->nama_pelanggan }}</label>
            </div>
          </div>
        </form>
          <table class="table table-bordered table-hover" width="100%">   
            <thead>
              <tr>
                <th>Jenis Transaksi</th>
                <th>Jumlah Tagihan</th>
                <th>Biaya Jasa</th>
                <th>Total Bayar</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ $item->jenis_transaksi }}</td>
                <td>Rp. {{ number_format($item->jumlah, 0) }}</td>
                <td>Rp. {{ number_format($item->biaya_jasa, 0) }}</td>
                <td>Rp. {{ number_format($item->total_bayar, 0) }}</td>
                <td>{{ $item->keterangan }}</td>
              </tr>
            </tbody>
          </table>
      </div>
      </div>
    </div>
      

<script type="text/javascript">
  $(document).ready(function(){
    mask_number.init()
  })
</script>

@endsection
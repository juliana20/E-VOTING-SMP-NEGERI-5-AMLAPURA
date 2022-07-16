@extends('themes.AdminLTE.layouts.template')
@section('content')
{{-- jurnal umum --}}
<div class="col-sm-6">
  <div class="box box-primary">
      <div class="box-header with-border">
        <h4 class="box-title">Jurnal Umum</h4>
      </div>
    <div class="row">
      <div class="box-body">
          <div class="col-md-12">
              <form  method="POST" action="{{ url(@$url_print_jurnal_umum) }}" class="form-horizontal">
              {!! csrf_field() !!}
              <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Periode Awal</label>
                  <div class="col-md-9">
                      <input type="date" class="form-control" name="f[date_start]" required value="{{ @$item->date_start}}">
                  </div>
              </div>
              <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Periode Akhir</label>
                  <div class="col-md-9">
                      <input type="date" class="form-control" name="f[date_end]" required value="{{ @$item->date_end}}">
                  </div>
              </div>
              
              <div class="form-group">
                  <label for="name" class="col-sm-3 control-label"></label>
                  <div class="col-md-9">
                      <button type="sumbit" formtarget="_blank" class="btn btn-success btn-block" data-dismiss="modal"><i class="fa fa-print" aria-hidden="true"></i> Cetak</button>
                  </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- buku besar --}}
<div class="col-sm-6">
  <div class="box box-primary">
      <div class="box-header with-border">
        <h4 class="box-title">Buku Besar</h4>
      </div>
    <div class="row">
      <div class="box-body">
          <div class="col-md-12">
              <form  method="POST" action="{{ url(@$url_print_buku_besar) }}" class="form-horizontal">
              {!! csrf_field() !!}
              <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Periode Awal</label>
                  <div class="col-md-9">
                      <input type="date" class="form-control" name="f[date_start]" required value="{{ @$item->date_start}}">
                  </div>
              </div>
              <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Periode Akhir</label>
                  <div class="col-md-9">
                      <input type="date" class="form-control" name="f[date_end]" required value="{{ @$item->date_end}}">
                  </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">Akun</label>
                <div class="col-lg-9">
                  <div class="input-group data_collect_wrapper">
                    <input type="hidden" id="id_akun" name="f[id_akun]" required>
                    <input type="text" name="f[nama_akun]" id="nama_akun" class="form-control" placeholder="Akun" required="" readonly>
                    <div class="input-group-btn">
                      <a href="javascript:;" id="lookup_akun" class="btn btn-info btn-flat data_collect_btn"><i class="fa fa-search"></i> Cari</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                  <label for="name" class="col-sm-3 control-label"></label>
                  <div class="col-md-9">
                      <button type="sumbit" formtarget="_blank" class="btn btn-success btn-block" data-dismiss="modal"><i class="fa fa-print" aria-hidden="true"></i> Cetak</button>
                  </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- neraca lajur --}}
<?php /*
<div class="col-sm-6">
  <div class="box box-primary">
      <div class="box-header with-border">
        <h4 class="box-title">Neraca Lajur</h4>
      </div>
    <div class="row">
      <div class="box-body">
          <div class="col-md-12">
              <form  method="POST" action="{{ url(@$url_print_neraca_lajur) }}" class="form-horizontal">
              {!! csrf_field() !!}
              <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Periode Awal</label>
                  <div class="col-md-9">
                      <input type="date" class="form-control" name="f[date_start]" required value="{{ @$item->date_start}}">
                  </div>
              </div>
              <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Periode Akhir</label>
                  <div class="col-md-9">
                      <input type="date" class="form-control" name="f[date_end]" required value="{{ @$item->date_end}}">
                  </div>
              </div>
              
              <div class="form-group">
                  <label for="name" class="col-sm-3 control-label"></label>
                  <div class="col-md-9">
                      <button type="sumbit" formtarget="_blank" class="btn btn-success btn-block" data-dismiss="modal"><i class="fa fa-print" aria-hidden="true"></i> Cetak</button>
                  </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
*/ ?>
{{-- Laba Rugi --}}
<div class="col-sm-6">
  <div class="box box-primary">
      <div class="box-header with-border">
        <h4 class="box-title">Laba Rugi</h4>
      </div>
    <div class="row">
      <div class="box-body">
          <div class="col-md-12">
              <form  method="POST" action="{{ url(@$url_print_laba_rugi) }}" class="form-horizontal">
              {!! csrf_field() !!}
              <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Periode Awal</label>
                  <div class="col-md-9">
                      <input type="date" class="form-control" name="f[date_start]" required value="{{ @$item->date_start}}">
                  </div>
              </div>
              <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Periode Akhir</label>
                  <div class="col-md-9">
                      <input type="date" class="form-control" name="f[date_end]" required value="{{ @$item->date_end}}">
                  </div>
              </div>
              
              <div class="form-group">
                  <label for="name" class="col-sm-3 control-label"></label>
                  <div class="col-md-9">
                      <button type="sumbit" formtarget="_blank" class="btn btn-success btn-block" data-dismiss="modal"><i class="fa fa-print" aria-hidden="true"></i> Cetak</button>
                  </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Neraca --}}
<div class="col-sm-6">
  <div class="box box-primary">
      <div class="box-header with-border">
        <h4 class="box-title">Neraca</h4>
      </div>
    <div class="row">
      <div class="box-body">
          <div class="col-md-12">
              <form  method="POST" action="{{ url(@$url_print_neraca) }}" class="form-horizontal">
              {!! csrf_field() !!}
              <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Periode Awal</label>
                  <div class="col-md-9">
                      <input type="date" class="form-control" name="f[date_start]" required value="{{ @$item->date_start}}">
                  </div>
              </div>
              <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Periode Akhir</label>
                  <div class="col-md-9">
                      <input type="date" class="form-control" name="f[date_end]" required value="{{ @$item->date_end}}">
                  </div>
              </div>
              
              <div class="form-group">
                  <label for="name" class="col-sm-3 control-label"></label>
                  <div class="col-md-9">
                      <button type="sumbit" formtarget="_blank" class="btn btn-success btn-block" data-dismiss="modal"><i class="fa fa-print" aria-hidden="true"></i> Cetak</button>
                  </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Arus kas --}}
<div class="col-sm-6">
  <div class="box box-primary">
      <div class="box-header with-border">
        <h4 class="box-title">Arus Kas</h4>
      </div>
    <div class="row">
      <div class="box-body">
          <div class="col-md-12">
              <form  method="POST" action="{{ url(@$url_print_arus_kas) }}" class="form-horizontal">
              {!! csrf_field() !!}
              <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Periode Awal</label>
                  <div class="col-md-9">
                      <input type="date" class="form-control" name="f[date_start]" required value="{{ @$item->date_start}}">
                  </div>
              </div>
              <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Periode Akhir</label>
                  <div class="col-md-9">
                      <input type="date" class="form-control" name="f[date_end]" required value="{{ @$item->date_end}}">
                  </div>
              </div>
              
              <div class="form-group">
                  <label for="name" class="col-sm-3 control-label"></label>
                  <div class="col-md-9">
                      <button type="sumbit" formtarget="_blank" class="btn btn-success btn-block" data-dismiss="modal"><i class="fa fa-print" aria-hidden="true"></i> Cetak</button>
                  </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
        $('#lookup_akun').dataCollect({
          ajaxUrl: "{{ url('akun/datatables') }}",
          modalSize : 'modal-md',
          modalTitle : 'DAFTAR PILIHAN AKUN',
          modalTxtSelect : 'Pilih Akun',
          dtOrdering : true,
          dtOrder: [],
          dtThead:['ID Akun','Nama Akun'],
          dtColumns: [
              {data: "id_akun"}, 
              {data: "nama_akun"}, 
          ],
          onSelected: function(data, _this){	
            $('#id_akun').val(data.id_akun);
            $('#nama_akun').val(data.nama_akun); 
              
            return true;
          }
      });
    });
</script>
@endsection
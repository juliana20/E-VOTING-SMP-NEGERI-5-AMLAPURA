@extends('themes.AdminLTE.layouts.template')
@section('content')
<div class="col-sm-6 col-sm-offset-3 col-xs-12">
<div class="box box-primary">
    <div class="box-header with-border">
      <h4 class="box-title">{{ @$title }}</h4>
    </div>
  <div class="row">
    <div class="box-body">
        <div class="col-md-12">
            <form  method="POST" action="{{ url(@$url_print) }}" class="form-horizontal">
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
@endsection
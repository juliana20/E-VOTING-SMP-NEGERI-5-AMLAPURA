@extends('themes.AdminLTE.layouts.template')
@section('content')
@if(empty(@Helpers::isNasabah()))
<section class="content-header">
  <h1 align="center">
    <strong>{{ config('app.app_name') }}</strong>
  </h1>
</section>
<br><br>
<div class="row">
  <a href="" id="modalPemasukan">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box bg-green">
      <span class="info-box-icon"><i class="fa fa-sign-in"></i></span>

      <div class="info-box-content">
        <span class="info-box-text"></span>
        <span class="info-box-number">Rp {{ number_format($pemasukan, 2) }}</span>

        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
            <span class="progress-description">
              Pemasukan
            </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  </a>
  <!-- /.col -->
  <a href="" id="modalPengeluaran">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-red">
        <span class="info-box-icon"><i class="fa fa-cloud-upload"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"></span>
          <span class="info-box-number">Rp {{ number_format($pengeluaran, 2) }}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
              <span class="progress-description">
                Pengeluaran
              </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </a>
  <!-- /.col -->
  <a href="" id="modalPengeluaran">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-yellow">
        <span class="info-box-icon"><i class="fa fa-money"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"></span>
          <span class="info-box-number">Rp {{ number_format($pemasukan - $pengeluaran, 2) }}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
              <span class="progress-description">
                Saldo Akhir
              </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </a>




</div>
<!-- /.row -->
       <div class="row">
        <section class="col-lg-12 connectedSortable">
          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik Pengeluaran dan Penerimaan Kas</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="col-md-2 pull-right">
                <select name="year" id="select_year" class="form-control">
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                  <option value="2022" selected>2022</option>
                </select>
              </div>

              <div class="graph">
                <div class="chart" id="bar-chart" style="height:230px"></div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </section>
        </div>
        @else
          <div class="login-logo">
            <img src="{{url('themes/login/images/logo_koperasi.png')}}" width="180" style="margin-top: 10px">
          </div>
          <section class="content-header">
            <h1 align="center">
              <strong>SELAMAT DATANG, {{ @Helpers::getNasabah() }}<br>{{ config('app.app_name') }}</strong>
            </h1>
          </section>
          <br><br>
        @endif
        </section>
      </div>
      <!-- /.col -->
    <!-- /.row -->
    <script>
    $(function () {
      $.fn.extend({
        functionGraph: { 
          init:function(){
                var post_data = {};
                    post_data.header = {
                      'year':$('#select_year').val()
                    }
                $.post( "{{url('dashboard/chart')}}", post_data, function( response, status, xhr ){
                    if ( response.status == 'error')
                    {
                      return false;
                    }
                    $.fn.functionGraph.chart(response.data);    
                  });												
              $('#select_year').on( "change",  function(e){
                $('#bar-chart').remove();
                var post_data = {};
                    post_data.header = {
                      'year':$('#select_year').val()
                    }
                $.post( "{{url('dashboard/chart')}}", post_data, function( response, status, xhr ){
                    if ( response.status == 'error')
                    {
                      return false;
                    }

                    $( ".graph" ).append( " <div class=\"chart\" id=\"bar-chart\"></div>" );
                    $.fn.functionGraph.chart(response.data);    
                  });												
              });
          },
        chart: function(data)
            {
              var bar = new Morris.Bar({
                  barSizeRatio:1,
                  element: 'bar-chart',
                  resize: true,
                  data: data,
                  barColors: ['#00a65a', '#dd4b39'],
                  xkey: 'Bulan',
                  ykeys: ['Pemasukan', 'Pengeluaran'],
                  labels: ['Pemasukan', 'Pengeluaran'],
                  hideHover: 'auto',
                  xLabelAngle: 14,
              });

            },
          }
      });

      $(document).ready(function(){
        $.fn.functionGraph.init();
      })
    }); 
    </script>

    @endsection
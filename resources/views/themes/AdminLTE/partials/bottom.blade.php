
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('themes/AdminLTE-2.4.3/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('themes/AdminLTE-2.4.3/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ url('themes/AdminLTE-2.4.3/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ url('themes/AdminLTE-2.4.3/bower_components/morris.js/morris.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ url('themes/AdminLTE-2.4.3/bower_components/chart.js/Chart.js') }}"></script>
<!-- Sparkline -->
<script src="{{ url('themes/AdminLTE-2.4.3/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ url('themes/AdminLTE-2.4.3/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ url('themes/AdminLTE-2.4.3/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('themes/AdminLTE-2.4.3/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ url('themes/AdminLTE-2.4.3/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ url('themes/AdminLTE-2.4.3/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ url('themes/AdminLTE-2.4.3/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ url('themes/AdminLTE-2.4.3/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ url('themes/AdminLTE-2.4.3/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ url('themes/AdminLTE-2.4.3/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('themes/AdminLTE-2.4.3/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ url('public/themes/AdminLTE-2.4.3/dist/js/pages/dashboard.js') }}"></script> --}}
<!-- AdminLTE for demo purposes -->
<script src="{{ url('themes/AdminLTE-2.4.3/dist/js/demo.js') }}"></script>

<!-- DataTables -->
<script src="{{ url('themes/AdminLTE-2.4.3/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('themes/AdminLTE-2.4.3/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
	
<!-- mask number -->
{{-- <script src="{{url('themes/default/js/mask-number.js')}}"></script> --}}


{{-- AUDIO --}}
<audio id="audio-alert" src="{{ url('') }}/themes/default/audio/alert.mp3" preload="auto"></audio>
<audio id="audio-fail" src="{{ url('') }}/themes/default/audio/fail.mp3" preload="auto"></audio>

<!-- modal -->
<script src="{{url('themes/default/js/tools.js')}}"></script>

<!-- Select2 -->
<script src="{{ url('') }}/themes/AdminLTE-2.4.3/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>  
  $(document).ready(function(){
    //Initialize Select2 Elements
    $('.select2').select2();


  });
  // DATATABLES DEFAULT
  (function( $ ){
    $.extend({
        alert_success: function( message, fn, scope ){
            swal({
                title: "Sukses!",
                text: message,
                icon: "success",
                button: false,
              });

						try{ $( "#audio-alert" ).get(0).play(); }catch(ex){}
						if( $.isFunction(fn) ){
							setTimeout(function(){
									fn.call( scope || $ )
								}, 1000)
						}
					},
				alert_warning: function( message, fn, scope ){
            swal({
                icon: 'warning',
                title: 'Perhatian',
                text: message,
              });
						
						try{ $( "#audio-fail" ).get(0).play(); }catch(ex){}
						if( $.isFunction(fn) ){
							setTimeout(function(){
									fn.call( scope || $ )
								}, 1000)
						}
						
					},
				alert_error: function( message, fn, scope ){
            swal({
                icon: 'error',
                title: 'Oops...',
                text: message,
              });
						
						try{ $( "#audio-fail" ).get(0).play(); }catch(ex){}
						if( $.isFunction(fn) ){
							setTimeout(function(){
									fn.call( scope || $ )
								}, 1000)
						}
						
					}
      });	

      
    $.extend(true, $.fn.dataTable.defaults, {
        processing: true,
        serverSide: true,
        paginate: true,
        ordering: true,
        order: [],
        searching: true,
        info: true,
        responsive: true,
        columnDefs: [
          { targets: "no-sort", searchable: false, orderable: false }
        ], 
        language: {
          "decimal": "",
          "emptyTable": "Tidak ada hasil ditemukan dari pencarian Anda.",
          "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ rekaman",
          "infoEmpty": "Menampilkan 0 sampai 0 dari 0 rekaman",
          "infoFiltered": "(disaring dari _MAX_ total rekaman)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Tampilkan _MENU_ Per Halaman",
          "loadingRecords": "Memuat...",
          "processing": "<img src='{{ url('') }}/themes/AdminLTE-2.4.3/dist/img/preloader.gif' style='margin-top:-24px;width:42px' />",
          "search": "Cari",
          "zeroRecords": "Tidak ada hasil yang sesuai ditemukan",
          "paginate": {
            "first": "Pertama",
            "last": "Terakhir",
            "previous": "Sebelumnya",
            "next": "Berikutnya"
          },
          "aria": {
            "sortAscending": ": aktifkan untuk mengurutkan kolom ascending",
            "sortDescending": ": aktifkan untuk mengurutkan kolom descending"
          }
        },
        fnDrawCallback: function(settings) {
            $(window).trigger("resize");
        },
      });

    })( jQuery );

    $(function(){
      $.ajaxSetup({
                  beforeSend: function(xhr) {
                          $('.btn').addClass('disabled', true);
                          $(".spinner").css("display", "");
                  },
                  success: function(response, status, xhr){
                          $('.btn').removeClass('disabled', true);
                          $(".spinner").css("display", "none");
                  },
                  complete: function(xhr) {
                          $('.btn').removeClass('disabled', true);
                          $(".spinner").css("display", "none");
                  },
                  error: function(error){
                          $('.btn').removeClass('disabled', true);
                          $.alert_error(error);
                          return false
                  },
          });
  });
</script>

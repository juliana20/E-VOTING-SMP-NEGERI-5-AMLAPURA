<!-- MODAL EDIT-->
<div class="modal fade" id="{{$idModalEdit}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-{{ @$modalSize }}" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times-circle-o" aria-hidden="true" style="color: red" title="Tutup"></i></span>
        </button>
        <h4 class="modal-title" align="center"><strong>{{$headerModalEdit}}</strong></h4>
      </div>
      <div class="modal-body" id="{{$idLoadEdit}}">
        
      
      </div>

    </div>
  </div>
</div>
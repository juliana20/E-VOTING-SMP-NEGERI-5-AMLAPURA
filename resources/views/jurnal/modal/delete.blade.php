<form action="{{url($submit_url)}}" method="POST">
{{csrf_field()}}
<input type="hidden" name="f[id]" value="{{ $item->id }}">
<p>
    Apakah anda yakin membatalkan data ini?
</p>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
    <button type="submit" class="btn btn-success">Ya</button>
</div>
</form>
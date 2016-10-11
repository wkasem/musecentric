<!-- Modal Structure -->
<div id="upload" class="modal modal-fixed-footer">
  <div class="modal-content">

    <form action="/media-upload"
        class="dropzone"
        id="media">
       {{ csrf_field() }}
      </form>
  </div>
  <div class="modal-footer">
    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
  </div>
</div>

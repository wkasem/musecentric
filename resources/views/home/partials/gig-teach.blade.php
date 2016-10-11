<!-- Modal Structure -->
<div id="gig-teach" class="modal modal-fixed-footer">
  <div class="modal-content">

   <div class="row">
    @if(auth()->user()->type == 2)
      @if(auth()->user()->subscribed)
       <div class="col s6 gigR">

         <a href="/new-gig">New Gig</a>
       </div>
       @endif
     <div class="col s6 teachR">
     <a href="/new-teach">New Class</a>
     </div>
     @else
     <div class="col s12 teachR">
     <a href="/new-teach">New Class</a>
     </div>
    @endif
   </div>
  </div>
  <div class="modal-footer">
    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
  </div>
</div>

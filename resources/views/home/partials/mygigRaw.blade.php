<template id="mygigsTemp">

  <ul class="collapsible z-depth-0" data-collapsible="accordion" v-if='gigs.length'>
    <li v-for='(index , gig) in gigs'>
      <div class="collapsible-header red-text">
        <div class="row">
          <div class="col s10">
            @{{ gig.title }}
          </div>
          <div class="col s2">
            <span class="green-text" v-on:click.stop='showEdit(index ,gig)'><i class="material-icons medium">border_color</i></span>
            <span class="red-text" v-on:click.stop='showDelete(index ,gig)'><i class="material-icons medium">delete</i></span>
          </div>
        </div>

      </div>
      <div class="collapsible-body" style="background:rgba(255, 255, 255, 0.73);">

        <table class="striped" v-if='!gig.hire && !gig.offer'>
          <tbody>
            <tr v-for='bid in gig.bids'>
              <td>
                <a target="_blank" href="/profile/@{{ bid.user.id}}" class="black-text">
                  <span class="thin">@{{ bid.user.first_name}} @{{ bid.user.last_name}}</span>
                </a>
              </td>
              <td class="green-text" >
                @{{ bid.budget }} $
                <a target="_blank" href="/messages/@{{ bid.user.id}}" class="btn-flat right">Message</a>
                <a href="#" class="btn-flat right green white-text" v-on:click.prevent='offerPop(gig,bid)'>Select</a>

              </td>
            </tr>
          </tbody>
      </table>

        <div class="row" v-if='gig.offer && !gig.hire'>
          <div class="col s12 center-align">
            <h5 class="thin">Waiting
              <a target="_blank" href="/profile/@{{ gig.offer.user.id }}">
                @{{ gig.offer.user.first_name }}
              </a>
              Approval
            </h5>
          </div>
        </div>

        <div class="row" v-if='gig.hire'>
          <div class="col s12 center-align">
            <h5 class="thin">You Have Hired
              <a target="_blank" href="/profile/@{{ gig.hire.user.id }}">
                @{{ gig.hire.user.first_name }}
              </a>
            </h5>
          </div>
        </div>

        <div class="row" v-if='!gig.bids.length'>
          <div class="col s12">
             <h5 class="thin center-align">
               No Bids For this Gig
             </h5>
          </div>
        </div>

      </div>
    </li>
  </ul>


  <div class="row card z-depth-0" style="margin:0;"  v-if='!gigs.length'>
    <div class="card-content">
      <div class="col s9">
        <h5 class="thin center-align">
          No Gigs
        </h5>
      </div>
      <div class="col s3">
        <a href="/new-gig" class="btn-flat red white-text" style="margin:0.82rem 0 0.656rem 0;">Create One</a>
      </div>
    </div>
  </div>

  <div id='gig-hire-pop' class="modal">
    <form action="/gig/offer" method="post">
      {{ csrf_field()}}
      <div v-if='current_gig'>
      <div class="modal-shadow"></div>
      <input type="hidden" name="owner_id" value="@{{current_gig.user_id}}" />
      <input type="hidden" name="gig_title" value="@{{current_gig.title}}" />
      <input type="hidden" name="gig_id" value="@{{current_gig.id}}" />
      <input type="hidden" name="user_id" value="@{{current_bid.user_id}}" />
      <input type="hidden" name="bid_id" value="@{{current_bid.id}}" />
      <input type="hidden" name="commission" value="@{{commission}}" />
      <div class="modal-content" v-if='current_bid' style="text-align:center;">
        <h5 class="thin">
          Are You sure you want to Send Offer To  <bold class="green-text">@{{ current_bid.user.first_name}}</bold> ?
        </h5>
        <span class="red-text">And Pay @{{commission}}$ as A fee , @{{ current_bid.user.first_name}} will get @{{user_get}}$ he knows that</span>
        <button class="btn-flat green white-text" type="submit">Send</button>
        <button class="btn-flat red white-text">cancel</button>
      </div>
      </div>
    </form>
  </div>


  <div id="gig-edit" class="modal modal-fixed-footer" v-if='gigs.length'>
    <form v-if='current_gig' v-on:submit.prevent='edit($event)'>
      <div class="modal-content">
        <div class="row" style="padding-left:5px;">
              {{ csrf_field() }}
              <div class="row">
                <div class="input-field col s12">
                  <h6 class="thin">Title</h6>
                  <input  type="text" name="title" value="@{{ current_gig.title }}">
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <h6 class="thin">requirements</h6>
                  <ul class="collection" id="requirements">
                   <li class="collection-item" v-for='(index, r) in current_gig.requirements'>
                     <input type="text" name="requirements" value='@{{ r }}' />
                      <a href="#" class="list-remove"><i class="red-text material-icons">remove_circle</i></a>
                   </li>
                   <a href="#" class="list-add btn-flat"><i class="material-icons">add</i></a>
                  </ul>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <h6 class="thin">Date</h6>
                    <input type="text" class="datepicker" name="date" value="@{{ current_gig.date }}">
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <h6 class="thin">Summary</h6>
                    <textarea name="summary" class="materialize-textarea">@{{current_gig.summary}}</textarea>
                  </div>
                </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class=" modal-action modal-close waves-effect waves-green btn-flat">
            edit
          </button>
    </div>
    </form>
  </div>

  <div id='gig-delete' class="modal">
    <div class="modal-shadow"></div>
    <div class="modal-content" style="text-align:center;" v-if='curr_delete'>
    <h5 class="thin">
      Are You sure you want to Delete This
    </h5>
    <button class="btn-flat red white-text" v-on:click='delete'>Delete</button>
  </div>
  </div>

</template>

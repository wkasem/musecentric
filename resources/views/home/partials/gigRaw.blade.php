<template id="gigsTemp">
  <div class="row" v-for='gig in gigs'>
       <div class="col s12 m12">
         <div class="card z-depth-0">
              <div class="card-content black-text">

                <div class="row">
                  <div class="col s12">
                    <h5 class="bold red-text">@{{ gig.title }}</h5>
                    <i class="material-icons left red-text">location_on</i>
                    <a target="_blank" href="https://www.google.com/maps?q=@{{ gig.location }}">
                     <h6 style="line-height:1.6;">@{{ gig.location }}</h6>
                    </a>
                  </div>
                </div>

                <div class="row">
                  <div class="col s9">
                    <p class="thin">
                      @{{ gig.summary }}
                    </p>
                  </div>
                  <div class="col s3">
                    <div class="card-panel grey z-depth-0 white-text center-align" style="padding:5px;">
                      <h4>@{{ (gig.date > 1) ? gig.date + ' days' : gig.date + ' day'  }} </h4>
                      <h6>
                        Remaining
                      </h6>
                    </div>
                    <span class="bold green-text">
                      @{{ (gig.bids.length != 1) ? gig.bids.length + ' bids' : gig.bids.length + ' bid'}}
                    </span>
                    <div v-if='user_id != gig.user_id'>
                      <a href="#" class="btn-flat  green white-text"
                                  v-on:click='showBid($event, gig)'
                                  v-if='!gig.has_bid'>Bid</a>
                      <span class="green-text bold" v-else>
                       You Have bidded
                      </span>
                    </div>
                  </div>
                  <div class="col s12">
                    <img src="@{{ img }}" v-for='img in gig.attachments' width="100" class="materialboxed" />
                  </div>
                </div>
              </div>
            </div>
       </div>
  </div>

  <div class="row" v-if='hasMoreGigs'>
    <div class="col s12">
      <button class="btn-flat white-text green" v-on:click='moreGigs($event)'>Load More</button>
    </div>
  </div>

  <div class="row" v-if='!(gigs.length)'>
    <div class="col s12">
      <div class="card z-depth-0">
        <div class="card-content">
          <h5 class="thin center-align">Nothing To Show</h5>
        </div>
      </div>
    </div>
  </div>


  <div id="gig-bid" class="modal" >
    <div class="modal-shadow"></div>
    <form v-if='current_gig' v-on:submit.prevent='bid($event)'>
      <div class="modal-content">
        <h5>@{{ current_gig.title }}</h5>
        <h6 class="thin">recruiter budget </h6> <span class="green-text bold">@{{ current_gig.budget }} $</span>
          <div class="row">
            <div class="col input-field s9">
              <label for="Budget">Enter Your Budget</label>
              <input type="number" id="Budget" name="budget" v-model="budget" />
              <span class="red-text">
                @{{ commission}}$ (5% commission)
              </span>
              You Get
              <span class="green-text">
                @{{ user_get }}$
              </span>
            </div>
          </div>
          <div class="row">
            <div class="col input-field s9">
              <label for='cover-letter'>Your Cover Letter</label>
              <textarea class="materialize-textarea" id='cover-letter' name="cover_letter"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class=" modal-action modal-close waves-effect waves-green btn-flat">
            Bid
          </button>
      </form>
    </div>
  </div>

</template>

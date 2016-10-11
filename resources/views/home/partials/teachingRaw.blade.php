<template id="teachingTemp">
  <div class="row" v-for='teach in teaches'>
       <div class="col s12 m12">
         <div class="card z-depth-0">
              <div class="card-content black-text">

                <div class="row">
                  <div class="col s12">
                    <h5 class="bold red-text">@{{ teach.title }} - @{{ teach.type }} class</h5>
                    <i class="material-icons left red-text">location_on</i>
                    <a target="_blank" href="https://www.google.com/maps?q=@{{ teach.location }}">
                     <h6 style="line-height:1.6;">@{{ teach.location }}</h6>
                    </a>
                  </div>
                </div>

                <div class="row">
                  <div class="col s9">
                    <p class="thin">
                      @{{ teach.summary }}
                    </p>
                  </div>
                  <div class="col s3">
                    <div class="card-panel grey z-depth-0 white-text center-align" style="padding:5px;">
                      <h4>@{{ (teach.date > 1) ? teach.date + ' days' : teach.date + ' day'  }} </h4>
                      <h6>
                        Remaining
                      </h6>
                    </div>
                    <span class="bold green-text">
                      @{{ (teach.enrolls.length != 1) ? teach.enrolls.length + ' enrolls' : teach.enrolls.length + ' bid'}}
                    </span>
                    <div v-if='user_id != teach.user_id'>
                      <a href="#" class="btn-flat  green white-text"
                                  v-on:click='showEnroll(teach)'
                                  v-if='!teach.has_enroll'>Enroll</a>
                      <span class="green-text bold" v-else>
                       You Have Enrolled
                     </span>
                   </div>
                  </div>
                  <div class="col s12">
                    <img src="@{{ img }}" v-for='img in teach.attachments' width="100" class="materialboxed" />
                  </div>
                </div>
              </div>
            </div>
       </div>
  </div>

  <div class="row" v-if='hasMoreTeaches'>
    <div class="col s12">
      <button class="btn-flat white-text green" v-on:click='moreGigs($event)'>Load More</button>
    </div>
  </div>

  <div class="row" v-if='!(teaches.length)'>
    <div class="col s12">
      <div class="card z-depth-0">
        <div class="card-content">
          <h5 class="thin center-align">Nothing To Show</h5>
        </div>
      </div>
    </div>
  </div>


  <div id="teach-enroll" class="modal" >
    <div class="modal-shadow"></div>
    <form v-if='current_teach' v-on:submit.prevent='enroll($event)'>
      <div class="modal-content">
        <h5>@{{ current_teach.title }}</h5>
        <h6 class="thin">recruiter budget </h6> <span class="green-text bold">@{{ current_teach.budget }} $</span>
          <div class="row">
            <div class="col input-field s9">
              <label for='cover-letter'>Your Cover Letter</label>
              <textarea class="materialize-textarea" id='cover-letter' name="cover_letter"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class=" modal-action modal-close waves-effect waves-green btn-flat">
            Enroll
          </button>
      </form>
    </div>
  </div>

</template>

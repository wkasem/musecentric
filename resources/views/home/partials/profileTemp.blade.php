<template id="profileTemp">

  <div class="col s12 profile">
    <div class="row">
      <div class="col s2">
        <div class="profile-letter">@{{ user_letter}}</div>
      </div>
      <div class="col s10">
        <h4 class="profile-name">
          @{{ user.first_name }}
        </h4>
        <h6 class="thin profile-type">
          @{{ user.type.name.toUpperCase()}} - <a href="#" class="white-text" v-on:click.prevent='showConnects'>@{{ user.connects.length}} Connect</a>
        </h6>
        <div v-if='user.id != curr_user.id'>
          <button class="btn-flat  white-text red" v-if='has_connected'  v-on:click='unconnect($event,user.id)'>unConnect</button>
          <button class="btn-flat  white-text blue"  v-on:click='connect($event,user.id)' v-else>Connect</button>
        </div>
      </div>
    </div>
  </div>


  <div id='user-connects' class="modal">
    <div class="modal-shadow"></div>
    <div class="modal-content">
    <div class="row" v-for='u in user.connects' v-if='user.connects.length'>
      <div class="col s5">
        <h6 class="thin">@{{ u.user.first_name }} @{{ u.user.last_name }}</h6>
      </div>
      <div class="col s7" v-if='u.user.id != curr_user.id'>
        <button class="btn-flat  white-text connected red right" v-if='u.has_connected'  v-on:click='unconnect($event,u.user.id , u)'>unConnect</button>
        <button class="btn-flat  white-text connect blue right"  v-on:click='connect($event,u.user.id , u)' v-else>Connect</button>
      </div>
    </div>
    <div class="row" v-if='!user.connects.length'>
      <div class="col s12">
        <h5 class="thin center-align">No Connections</h5>
      </div>
    </div>
  </div>
  </div>

</template>

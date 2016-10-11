<template id="messages">


  <div class="row" v-if='conversations.length != 0'>
    <div class="col s3">
      <div class="collection">
          <a href="#" class="collection-item @{{(c.conversation_id == crr_id) ? 'active' : ''}}" v-for='c in conversations' v-on:click='changeBoard($event ,c)'>
            <h5 class="thin">@{{ c.other.first_name}}</h5>
            <p v-if='c.messages[0]'>
              @{{ c.messages[(c.messages.length - 1)].message }}
            </p>
          </a>
        </div>
    </div>
    <div class="col s9" v-if='current_conversation'>
      <div class="row">

        <div class="col s12 card z-depth-0 conversation-board">

          <div class="row" v-for='message in current_conversation.messages'>

            <div class="col s6  card z-depth-0 red darken-1 white-text"
                 v-if='message.user_id != user_id'>
                <div class="card-content">
                  <span class="right grey-text text-lighten-2">@{{ message.time }}</span>
                  <p style="clear:both;">
                    @{{ message.message }}
                  </p>
                </div>
            </div>

            <div class="col s6 push-s6 card z-depth-0 grey darken-3 white-text"
                  v-if='message.user_id == user_id'>
                <div class="card-content">
                  <span class="right grey-text text-lighten-2">@{{ message.time }}</span>
                  <p style="clear:both;">
                    @{{ message.message }}
                  </p>
                </div>
            </div>
          </div>

          <h4 v-if='current_conversation.messages.length == 0' class="thin center-align">No Messages</h4>

        </div>

        <div class="divider"></div>

        <div class="input-filed col s12 card z-depth-0">
          <form v-on:submit='sendMsg($event)'>
           <textarea class="materialize-textarea" placeholder="Type Your Message" name="msg"></textarea>
           <button class="btn-flat green white-text">Send</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="row" v-if='conversations.length == 0'>
      <div class="col s12">
        <h4  class="thin center-align">No Conversations</h4>
      </div>
  </div>

</template>

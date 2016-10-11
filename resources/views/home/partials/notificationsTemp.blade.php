<template id="notificationsTemp">

<div class="row card z-depth-0" v-if='notis.length' style="margin-left:5px;">
  <div class="card-content">
    <table class="highlight">

      <tbody>

        <tr v-for='n in notis' >

            <td v-if="n.type == 'Offer'">
              <h6 >
                <a href="/profile/@{{ n.data.user_id }}">
                  @{{ n.data.user_name }}
                </a>
                Has Sent You Invite For
                <a href="/gig/@{{ n.data.gig_id }}" style="font-weight:700;">
                  @{{ n.data.gig_title }}
                </a>
                Gig
              </h6>
            </td>

            <td v-if="n.type == 'Bid'">
              <h6 >
                <a href="/profile/@{{ n.data.user_id }}">
                  @{{ n.data.user_name }}
                </a>
                Has Bid <span class="green-text">@{{ n.data.budget }} $</span> On Your Gig
                <a href="/gig/@{{ n.data.gig_id }}" style="font-weight:700;">
                  @{{ n.data.gig_title }}
                </a>
              </h6>
            </td>

            <td v-if="n.type == 'Accept'">
              <h6 >
                <a href="/profile/@{{ n.data.user_id }}">
                  @{{ n.data.user_name }}
                </a>
                Has Accept Your Offer
              </h6>
            </td>

            <td v-if="n.type == 'Decline'">
              <h6 >
                <a href="/profile/@{{ n.data.user_id }}">
                  @{{ n.data.user_name }}
                </a>
                Has Declined Your Offer , You Can Choose Another One now
              </h6>
            </td>

            <td class="right" v-if="n.type == 'Offer'">
              <section v-if='!n.data.accepted'>
                <a href="/offer/@{{ n.data.offer_id }}" class="btn-flat black white-text" >View Offer</a>
              </section>
            </td>
            <td class="right" v-if="n.type == 'Bid'">
              <section>
                <a href="/my-gigs" class="btn-flat green white-text">Show Gig</a>
              </section>
            </td>


          </tr>
      </tbody>
    </table>
  </div>
</div>


<div class=" card z-depth-0" v-if='!notis.length'>
   <div class="card-content">
     <h5 class="center-align thin">No Notifications</h5>
   </div>
</div>
</template>

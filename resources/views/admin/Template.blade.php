<template id="admin">

  <div class="row">
  <div class="col s12">
  <ul class="tabs">
  <li class="tab col s3"><a class="active" href="#stats">Stats</a></li>
  <li class="tab col s3"><a  href="#users">Users</a></li>
  <li class="tab col s3"><a href="#messages">Messages</a></li>
  </ul>
  </div>

  <div class="col s12">

    <div id="stats">
      <h5 class="thin">Total : @{{count}} Users</h5>
      <a href="/admin/logout" class="btn-flat red white-text">Logout</a>
    <div id="chartdiv"></div>
    </div>

    <div id="users">
      <table class="striped">
        <tr v-for='(index , user) in users.data'>
          <td><h6 class="thin">@{{ user.first_name }} @{{ user.last_name }}</h6> </td>
          <td>
            <button class="btn-flat red white-text" v-on:click='deleteWarning(user , index)' v-if='user.warning'>remove warning</button>
            <button class="btn-flat red white-text right" v-on:click='showDelete(user , index)'>remove</button>
            <button class="btn-flat right" v-on:click='addToConversation(user)'>Message</button>
          </td>
        </tr>
      </table>

      <div class="row" v-if='hasMoreUsers'>
        <div class="col s3 push-s4">
          <button class="btn green" v-on:click='moreUsers($event)'>Load More</button>
        </div>
      </div>
      <h5 class="thin center-align" v-if='!users.data.length'>No Users Have Been Registred Yet</h5>
    </div>

  </div>
</div>



<div id='user-delete' class="modal" v-if='users.data.length'>
  <div class="modal-shadow"></div>
  <div class="modal-content" v-if='current_user' style="text-align:center;">
  <h5 class="thin">
    Are You sure you want to Delete  <bold class="green-text">@{{ current_user.first_name}}</bold> ?
  </h5>
  <button class="btn-flat red white-text" v-on:click='deleteUser'>Delete</button>
  <button class="btn-flat">cancel</button>
</div>
</div>


<div id="messages">
  @include('admin.messages')
</div>


</template>

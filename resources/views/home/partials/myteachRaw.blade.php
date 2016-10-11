<template id="myteachTemp">

  <ul class="collapsible z-depth-0" data-collapsible="accordion" v-if='teaches.length'>
    <li v-for='(index , teach) in teaches'>
      <div class="collapsible-header red-text">
        <div class="row">
          <div class="col s10">
            @{{ teach.title }}
          </div>
          <div class="col s2">
            <span class="green-text" v-on:click.stop='showEdit(index ,teach)'><i class="material-icons medium">border_color</i></span>
            <span class="red-text" v-on:click.stop='showDelete(index ,teach)'><i class="material-icons medium">delete</i></span>
          </div>
        </div>

      </div>
      <div class="collapsible-body" style="background:rgba(255, 255, 255, 0.73);">

        <table class="striped" v-if='teach.enrolls'>
          <tbody>
            <tr v-for='enroll in teach.enrolls'>
              <td>
                <a target="_blank" href="/profile/@{{ enroll.user.id}}" class="black-text">
                  <span class="thin">@{{ enroll.user.first_name}} @{{ enroll.user.last_name}}</span>
                </a>
              </td>
              <td class="green-text" >
                @{{ teach.budget }} $
                <a target="_blank" href="/messages/@{{ enroll.user.id}}" class="btn-flat right">Message</a>
              </td>
            </tr>
          </tbody>
      </table>


        <div class="row" v-if='!teach.enrolls.length'>
          <div class="col s12">
             <h5 class="thin center-align">
               No Enrolls For this Class
             </h5>
          </div>
        </div>

      </div>
    </li>
  </ul>


  <div class="row card z-depth-0" style="margin:0;"  v-if='!teaches.length'>
    <div class="card-content">
      <div class="col s9">
        <h5 class="thin center-align">
          No Teach Classes
        </h5>
      </div>
      <div class="col s3">
        <a href="/new-teach" class="btn-flat red white-text" style="margin:0.82rem 0 0.656rem 0;">Create One</a>
      </div>
    </div>
  </div>



  <div id="teach-edit" class="modal modal-fixed-footer" v-if='teaches.length'>
    <form v-if='current_teach' v-on:submit.prevent='edit($event)'>
      <div class="modal-content">
        <div class="row" style="padding-left:5px;">
              {{ csrf_field() }}
              <div class="row">
                <div class="input-field col s12">
                  <h6 class="thin">Title</h6>
                  <input  type="text" name="title" value="@{{ current_teach.title }}">
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <h6 class="thin">benefits</h6>
                  <ul class="collection" id="benefits">
                   <li class="collection-item" v-for='(index, r) in current_teach.benefits'>
                     <input type="text" name="benefits" value='@{{ r }}' />
                      <a href="#" class="list-remove"><i class="red-text material-icons">remove_circle</i></a>
                   </li>
                   <a href="#" class="list-add btn-flat"><i class="material-icons">add</i></a>
                  </ul>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <h6 class="thin">Date</h6>
                    <input type="text" class="datepicker" name="date" value="@{{ current_teach.date }}">
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <h6 class="thin">Summary</h6>
                    <textarea name="summary" class="materialize-textarea">@{{current_teach.summary}}</textarea>
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

  <div id='teach-delete' class="modal">
    <div class="modal-shadow"></div>
    <div class="modal-content" style="text-align:center;" v-if='curr_delete'>
    <h5 class="thin">
      Are You sure you want to Delete This
    </h5>
    <button class="btn-flat red white-text" v-on:click='delete'>Delete</button>
  </div>
  </div>

</template>

Vue.component('notifications', {
  template : '#notificationsTemp',

  props : ['notis'],

  methods :{

    acceptOffer:function(id ,noti){

      $.post('gig/hire/accept', {id : id})
       .done(function(){
          noti.accepted = true;
       });
    }

  },

  created :function(){

    this.notis = JSON.parse(this.notis);
  }

});

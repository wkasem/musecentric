Vue.component('profile', {
  template : '#profileTemp',

  props : ['user' , 'curr_user' , 'user_letter'],

  data:function(){
    return { has_connected : false}
  },

  methods :{

   connect:function(e , id , u){
     $(e.target).attr('disabled' , 'disabled');
     showProgressLine();
     $.post('/user/connect' , {id : id})
      .done(function(){
        endProgress();
        this.has_connected = true;
        if(u){u.has_connected = true;}
      }.bind(this));
   },
   unconnect:function(e , id , u){
     showProgressLine();
     $.post('/user/unconnect' , {id : id})
      .done(function(){
        hideProgressLine();
        this.has_connected = false;
        if(u){u.has_connected = false;}

      }.bind(this));
   },
   showConnects:function(){
      $('#user-connects').openModal();
   },
   hasConnect:function(){
     $.map(this.curr_user.connects ,function(c , i){
       if(c.connects = this.user.id){
          this.has_connected = true;
       }
     }.bind(this));
   }

  },

  created :function(){
    this.user = JSON.parse(this.user);
    this.curr_user = JSON.parse(this.curr_user);
    this.user_letter = this.user.first_name.substring(0 ,1).toUpperCase();

    this.hasConnect();
  }

});

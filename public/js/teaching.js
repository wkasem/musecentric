Vue.component('teaching', {
  template : '#teachingTemp',

  props : ['teaches' , 'path' , 'user_id' , 'profile'],

  data :function(){
    return { current_teach : null, budget : 0, commission : 0, user_get: 0 , hasMoreTeaches : true ,
      current_page : 1, last_page : 0}
  },

  methods :{

   showEnroll : function(teach){

     this.current_teach = teach;
     $('#teach-enroll').openModal();

   },
   moreTeaches:function(e){

     $(e.target).attr('disabled' , 'disabled');

     $.get('/teaches/more' , {page : this.current_page + 1})
      .done(function(data){
       this.current_page = data.current_page;
       this.last_page    = data.last_page;
       $.each(data.data,function(i , t){
         this.teaches.push(t);
       }.bind(this));
       $(e.target).removeAttr('disabled');
       this.checkHasMoreTeaches();
      }.bind(this));
   },
   enroll : function(e){

     var data = $(e.target).serializeArray();

     window.startProgress();

     $.post('/teach/enroll/'+this.current_teach.id , {
       data : data ,
       teach :
       {
         owner_id : this.current_teach.user_id ,
         teach_title : this.current_teach.title
       }})
      .done(function(){
        $('#teach-enroll').closeModal();
        this.current_teach.has_enroll = true;
        window.endProgress();
      }.bind(this));
   },

   checkHasMoreTeaches:function(){
     if(this.current_page == this.last_page){
       this.hasMoreTeaches = false;
     }
     if(this.last_page == 0){
       this.hasMoreTeaches = false;
     }
   }

  },
  watch : {
    budget :function(v){
       this.commission = Math.ceil((v/100) * 5);
       this.user_get   = this.budget - this.commission;
    }
  },

  created : function(){
    if(!this.profile){
      var parsed = JSON.parse(this.teaches);
      this.last_page = parsed.last_page;
      this.teaches = JSON.parse(this.teaches).data;
    }else{
      this.hasMoreTeaches = false;
      this.teaches = JSON.parse(this.teaches);
    }
  },
  ready : function(){
    this.checkHasMoreTeaches();
    $('.materialboxed').materialbox();
  }
});

Vue.component('gigs', {
  template : '#gigsTemp',

  props : ['gigs' , 'path' , 'user_id' , 'profile'],

  data :function(){
    return { current_gig : null, budget : 0, commission : 0, user_get: 0 , hasMoreGigs : true ,
      current_page : 1, last_page : 0}
  },

  methods :{
    moreGigs:function(e){

      $(e.target).attr('disabled' , 'disabled');

      $.get('/gigs/more' , {page : this.current_page + 1})
       .done(function(data){
        this.current_page = data.current_page;
        this.last_page    = data.last_page;
        $.each(data.data,function(i , gig){
          this.gigs.push(gig);
        }.bind(this));
        $(e.target).removeAttr('disabled');
        this.checkHasMoreGigs();
       }.bind(this));
    },
   showBid : function(e , gig){
     e.preventDefault();

     this.current_gig = gig;
     $('#gig-bid').openModal();

   },
   bid : function(e){

     var data = $(e.target).serializeArray();

     window.startProgress();

     $.post('/gig/bid/'+this.current_gig.id , {
       data : data ,
       gig :
       {
         owner_id : this.current_gig.user_id ,
         gig_title : this.current_gig.title
       }})
      .done(function(){
        $('#gig-bid').closeModal();
        this.current_gig.has_bid = true;
        window.endProgress();
      }.bind(this));
   },
   checkHasMoreGigs:function(){

     if(this.current_page == this.last_page){
       this.hasMoreGigs = false;
     }

     if(this.last_page == 0){
       this.hasMoreGigs = false;
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
     var parsed = JSON.parse(this.gigs);
     this.last_page = parsed.last_page;
     this.gigs = parsed.data;
     this.checkHasMoreGigs();
   }else{
     this.hasMoreGigs = false;
     this.gigs = JSON.parse(this.gigs);
   }

  },
  ready : function(){


    $('.materialboxed').materialbox();
  }
});

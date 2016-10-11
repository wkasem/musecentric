Vue.component('mygigs', {
  template : '#mygigsTemp',

  props : ['gigs'],

  data :function(){
    return { current_gig : null ,curr_delete : null , curr_delete_indx : 0, current_indx : 0, current_bid : null,
    commission : 0 , user_get:0}
  },

  methods :{

   showEdit :function(indx ,gig){
     this.current_gig = gig;
     this.current_indx = indx;
     $('#gig-edit').openModal();
   },
   edit :function(e){
     var data = $(e.target).serializeArray();
     window.startProgress();
     $.post('/gig/edit/'+this.current_gig.id , {data : data})
      .done(function(data){
        $.map(data,function(value, name){
          this.gigs[this.current_indx][name] = value;
        }.bind(this));
        $('#gig-edit').closeModal();
        window.endProgress();
      }.bind(this));
   },
   offerPop : function(gig,bid){
     this.current_bid = bid;
     this.current_gig = gig;
     this.commission = Math.ceil((this.current_bid.budget/100) * 5);
     this.user_get   = this.current_bid.budget - this.commission;
     $('#gig-hire-pop').openModal();

   },
   showDelete : function(indx , gig){

     this.curr_delete = gig;
     this.curr_delete_indx = indx;
     $('#gig-delete').openModal();
   },
   delete:function(){
      window.startProgress();
     $.post('/gig/delete/'+this.curr_delete.id)
      .done(function(data){
        this.gigs.splice(this.curr_delete_indx , 1);
        $('#gig-delete').closeModal();
        window.endProgress();
      }.bind(this));
   }

  },

  created : function(){

    this.gigs = JSON.parse(this.gigs);
  },
  ready : function(){

    $('.collapsible').collapsible({
          accordion : false
    });
  }
});

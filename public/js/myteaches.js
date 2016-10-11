Vue.component('myteaches', {
  template : '#myteachTemp',

  props : ['teaches'],

  data :function(){
    return { current_teach : null , curr_delete : null , curr_delete_indx : 0 , current_indx : 0, current_enroll : null}
  },

  methods :{

   showEdit :function(indx ,teach){
     this.current_teach = teach;
     this.current_indx = indx;
     $('#teach-edit').openModal({
       ready:function(){
         $("#benefits").dynamiclist({
           itemClass : 'collection-item'
         });
         $('.datepicker').pickadate({
         selectMonths: true,
         selectYears: 15
       });
       }
     });

   },
   edit :function(e){
     var data = $(e.target).serializeArray();
      window.startProgress();
     $.post('/teach/edit/'+this.current_teach.id , {data : data})
      .done(function(data){
        $.map(data,function(value, name){
          this.teaches[this.current_indx][name] = value;
        }.bind(this));
        $('#teach-edit').closeModal();
        window.endProgress();
      }.bind(this));
   },
   showDelete : function(indx , teach){

     this.curr_delete = teach;
     this.curr_delete_indx = indx;
     $('#teach-delete').openModal();
   },
   delete:function(){
      window.startProgress();
     $.post('/teach/delete/'+this.curr_delete.id)
      .done(function(data){
        this.teaches.splice(this.curr_delete_indx , 1);
        $('#teach-delete').closeModal();
        window.endProgress();
      }.bind(this));
   }
  },

  created : function(){

    this.teaches = JSON.parse(this.teaches);
  },
  ready : function(){

    $('.collapsible').collapsible({
          accordion : false
    });
  }
});

Vue.component('admin', {
  template : '#admin',

  props : ['users' , 'conversations' , 'musicans_percent', 'recuters_percent' , 'count'],

  data :function(){

    return {
      current_user : null ,
      current_user_indx : 0 ,
      hasMoreUsers : true ,
      current_conversation : null,
      loading_messages : false
    }
  },
  methods :{
    loadCharts:function(){
      AmCharts.makeChart("chartdiv", {
        "type": "pie",
        "theme": "chalk",

        "dataProvider": [
         {
             type: 'Musicans',
             percent: this.musicans_percent,
             color: '#e42323'
           },
           {
             type: 'recuters',
             percent: this.recuters_percent,
             color: '#ffb100'
           }
        ],
        "labelText": "[[title]]: [[value]]%",
        "balloonText": "[[title]]: [[value]]%",
        "titleField": "type",
        "valueField": "percent",
        "outlineColor": "#FFFFFF",
        "outlineAlpha": 0.8,
        "outlineThickness": 2,
        "colorField": "color",
        "pulledField": "pulled",
        "fontFamily":"Roboto",
        "legend": {
         "useGraphSettings": true,
         "position":"absolute",
         "left" : 50,
         "color":"#000"
        },
      });
    },
    showDelete:function(user , indx){

    this.current_user = user;
    this.current_user_index = indx;
    $('#user-delete').openModal();
    },
    deleteUser:function(){

      $.post('/admin/delete' , {id : this.current_user.id})
       .done(function(){
         this.users.data.splice(this.current_user_index , 1);
         $('#user-delete').closeModal();
       }.bind(this));
    },
    moreUsers:function(e){

      $(e.target).attr('disabled' , 'disabled');

      $.get('/admin/moreUsers' , {page : this.users.current_page + 1})
       .done(function(data){
        this.users.current_page = data.current_page;
        this.users.last_page    = data.last_page;
        $.each(data.data,function(i , user){
          this.users.data.push(user);
        }.bind(this));
        $(e.target).removeAttr('disabled');
        this.checkHasMoreUsers();
       }.bind(this));
    },
    checkHasMoreUsers:function(){

      if(this.users.current_page == this.users.last_page){
        this.hasMoreUsers = false;
      }
    },
    changeBoard : function(e , c){
      $(e.target).closest('.collection-item').siblings().removeClass('active');
      $(e.target).closest('.collection-item').addClass('active');
      this.current_conversation = c;
    },

    sendMsg :function(e){
      var msg = $(e.srcElement).serializeArray()[0].value;


      $.post('/admin/new-msg' , {msg : msg , id : this.current_conversation.conversation_id})
       .done(function(data){
         this.current_conversation.messages.push(data);
         $(e.srcElement[0]).val('');

           var h = $('.conversation-board').height();
           $('.conversation-board').animate({ scrollTop: h });
       }.bind(this));
    },
    addToConversation:function(user){
      $("a[href='#messages']").click();

      this.loading_messages = true;

      $.post('/admin/conversation/'+user.id)
       .done(function(co){
         var found = false;
         var index;
         this.conversations.forEach(function(c , i){
           if(c.conversation_id == co.conversation_id && !found){
             found = true;
             index = i;
           }
         }.bind(this));
         if(found){
           this.current_conversation = this.conversations[index];
         }else{
           this.conversations.push(co);
           this.current_conversation = this.conversations[this.conversations.length - 1];
         }

         this.loading_messages = false;
       }.bind(this));
    },
    deleteWarning:function(user , index){
      $.post('/admin/delete/warning' , {id : user.id})
       .done(function(){
         this.users.data[index].warning = false;
       }.bind(this));
    }
  },
  created:function(){

    this.users = JSON.parse(this.users);
    this.conversations = JSON.parse(this.conversations);
    this.current_conversation = this.conversations[0];
  },
  ready:function(){

   this.loadCharts();
   $('ul.tabs').tabs();
   this.checkHasMoreUsers();
  }


});

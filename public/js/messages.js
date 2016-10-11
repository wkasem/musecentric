Vue.component('messages', {
  template : '#messages',

  props : ['conversations' , 'user_id' , 'crr_id'],

  data :function(){
    return { current_conversation : null}
  },

  methods :{

  changeBoard : function(e ,c){
    e.preventDefault();
    $(e.target).closest('.collection-item').siblings().removeClass('active');
    $(e.target).closest('.collection-item').addClass('active');
    this.current_conversation = c;
  },

  sendMsg :function(e){
    e.preventDefault();

    var msg = $(e.srcElement).serializeArray()[0].value;


    $.post('/new-msg' , {msg : msg , id : this.current_conversation.conversation_id})
     .done(function(data){
       this.current_conversation.messages.push(data);
       $(e.srcElement[0]).val('');

         var h = $('.conversation-board').height();
         $('.conversation-board').animate({ scrollTop: h });
     }.bind(this));
  }

  },

  created : function(){
    this.conversations = JSON.parse(this.conversations);

    if(this.crr_id){
      this.conversations.forEach(function(c , i){
        if(c.conversation_id == this.crr_id){
          this.current_conversation = this.conversations[i];
        }
      }.bind(this));

    }else{
      this.current_conversation = this.conversations[0];
    }
  }
});

Vue.component('mycontracts', {
  template : '#mycontractsTemp',

  props : ['contracts'],

  created : function(){

    this.contracts = JSON.parse(this.contracts);
  },

});

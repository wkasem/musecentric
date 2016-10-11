<template id="mycontractsTemp">
  <div class="row" v-for='c in contracts'>
    <div class="col s12">
      <div class="card z-depth-0">
        <div class="card-content">
          @{{ c.gig.title }}
        </div>
      </div>
    </div>
  </div>

</template>

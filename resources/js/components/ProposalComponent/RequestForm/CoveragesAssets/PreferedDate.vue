<template>
  <div>
    <div class="row">
      <div class="col-md-4">
        <label for="">Coverages:</label>
        <span class="label" style="color: red; padding: 0px" v-if="!perils.length">*</span>
        <a @click="isPreferedDateOpen = !isPreferedDateOpen" class="hvr-underline-from-left custom">{{isPreferedDateOpen ? 'Hide Prefered Date' : 'Add Prefered Date'}}</a>
      </div>
    </div> 

    <div class="row" style="margin-bottom: 10px;" v-if="isPreferedDateOpen">
      <div class="col-md-4">
        <div class="form-group">
          <label for="">Effective Date:</label>
          <input 
            v-model="effectiveDate"
            type="date"
            class="form-control input-sm">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="">Expiry Date:</label>
          <input
            :value="expiryDate"
            type="text"
            class="form-control input-sm" readonly >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    'perils'
  ],

  data() {
    return {
      effectiveDate: '',
      expiryDate: '',
      isPreferedDateOpen: false,
      coverages: this.$props
    }
  },

  watch: {
    effectiveDate(val) {
      let date = new Date(val)
      let year = date.getFullYear() + 1
      let month = date.getMonth() + 1
      let day = date.getDate()
      // console.log(date, year, month, day)
      let NewDate  =  `${year}-${month}-${day}`
     //   alert( NewDate  );

      this.expiryDate = `${year}-${month}-${day}`

      this.$emit('prefered-date', this.effectiveDate, this.expiryDate)
    },
  }
}
</script>

<style scoped>
  /* Underline From Left */
.hvr-underline-from-left {
  display: inline-block;
  vertical-align: middle;
  -webkit-transform: translateZ(0);
  transform: translateZ(0);
  box-shadow: 0 0 1px rgba(0, 0, 0, 0);
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  -moz-osx-font-smoothing: grayscale;
  position: relative;
  overflow: hidden;
  cursor: pointer;
}
.hvr-underline-from-left:before {
  content: "";
  position: absolute;
  z-index: -1;
  left: 0;
  right: 100%;
  bottom: 0;
  background: #2098d1;
  height: 4px;
  -webkit-transition-property: right;
  transition-property: right;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-timing-function: ease-out;
  transition-timing-function: ease-out;
}
.hvr-underline-from-left:hover:before, .hvr-underline-from-left:focus:before, .hvr-underline-from-left:active:before {
  right: 0;
}
</style>
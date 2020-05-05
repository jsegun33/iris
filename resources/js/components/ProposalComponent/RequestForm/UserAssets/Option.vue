<template>
  <div class="row">
    <div class="col-md-7">
      <h3 class="box-title"><strong>Personal Details</strong></h3>
      <div class="pull-right">
        <label id="forOthers" style="margin-right: 10px;">
        <input 
          v-model="option"
          type="radio"
          value="individual">
          Individual
        </label>
        <label id="forOthers">
        <input 
          v-model="option"
          type="radio"
          value="others">
          Others
        </label>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      option: 'individual',
    }
  },

  watch: {
    option(val) {
      this.$emit('option', val);
    }
  }
}
</script>

<style>

</style>
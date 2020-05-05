<template>
  <div class="col-md-4">
    <div class="form-goup">
      <label for="platenumber" ><i class="fa fa-info-circle" style="color: red;"></i> 
      
      Plate Number:</label> 
      <span class="label" style="color: red; padding: 0px;" v-if="!platenumber" > *  </span>
      <input
        type="text" 
        v-model="platenumber"
        class="form-control"
        name="platenumber"
        placeholder="Enter Plate Number"
      />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      platenumber: '',
    }
  },

  watch: {
    platenumber(val) {
      this.$emit('platenumber', val)
    }
  }
}
</script>

<style>

</style>
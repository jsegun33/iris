<template>
  <div class="col-md-4">
    <div class="form-group">
      <label for="">Check if you have accessories:</label><br>
      <input id="accessories" type="checkbox" v-model="checked" @change="onChange">
      <label for="accessories">With Accessories</label>
      <a data-toggle="tooltip" data-placement="right" title="Accessories: Aircon, Stereo, Speakers, 5 Wheels">
        <i class="fa fa-info-circle"></i>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      checked: false
    }
  },

  methods: {
    onChange() {
      console.log(this.checked)
      this.$emit('accessories', this.checked)
    }
  }
}
</script>

<style>

</style>
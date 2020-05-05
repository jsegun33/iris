<template>
  <div class="col-md-4">
    <div class="form-group">
      <label for="">Usage:</label>
      <span class="label" style="color: red; padding: 0px;" v-if="!usage">*</span>
      <a @click="isAdditionalUsageOpen = !isAdditionalUsageOpen" class="hvr-underline-from-left">{{isAdditionalUsageOpen ? 'Hide Other Usages' : 'Other Usage'}}</a>
      <select 
        @change="onChange"
        class="form-control input-sm">
        <option value="">Select Usage</option>
        <option value="Personal Use">Personal Use</option>
        <option value="Commercial Use">Commercial Use</option>
      </select>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isAdditionalUsageOpen: false,
      usage: '',
    }
  },

  methods: {
    onChange(e) {
      this.usage = e.target.value
      this.$emit('usage', e.target.value)
    }
  },

  watch: {
    isAdditionalUsageOpen(val) {
      this.$emit('addUsage', val)
    }
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
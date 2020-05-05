<template>
  <div class="col-md-4">
    <div class="form-goup">
      <label for="denomination">Denomination:</label>
      <span class="label" style="color: red; padding: 0px;" v-if="!denomination"> * </span>
      <select
        class="form-control"
        v-model="denomination"
        @change="onChange">
        <option value="" disabled selected>Select MV Type</option>
        <option v-if="!denominations" disabled>Loading...</option>
        <option v-else
          v-for="value in denominations"
          :key="value._id"
          :value="value.Class + ';;' + value.SubLinesName"
        >{{ value.SubLinesName }}</option>
      </select>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      denominations: '',
      denomination: '',
    }
  },

  async created() {
    let res = await axios.get("api/Denomination")
    this.denominations = res.data
  },

  methods: {
    onChange(e) {
      this.$emit('denomination', this.denomination)
    }
  }
}
</script>

<style>

</style>
<template>
  <div class="col-md-4">
    <div class="form-group">
      <label>Net Weight:</label>
      <select class="form-control input-sm" @change="onChange">
        <option value="">Select Net Weight</option>
        <option value="less">Less than 3,930 KG</option>
        <option value="over">Over 3,930 KG</option>
      </select>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    onChange(e) {
      this.$emit('net-weight', e.target.value)
    }
  }
}
</script>

<style>

</style>
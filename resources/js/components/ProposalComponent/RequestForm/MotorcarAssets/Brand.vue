<template>
  <div class="col-md-3">
    <div class="form-goup">
      <label for="brand">Brand:</label>
      <span class="label" style="color: red; padding: 0px;" v-if="!value"> * </span>
      <input
        v-model="value"
        @focus="filter = true"
        autocomplete="off"
        type="text"
        class="form-control"
        placeholder="Enter Car Brand"
      />
      <div v-if="filteredValues && filter" class="custom">
        <ul>
          <li v-for="value in filteredValues" :key="value._id" @click="setValue(value.BrandName)">{{value.BrandName}}</li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      value: '',
      values: '',
      filter: false,
      filteredValues: [],
    }
  },

  async created() {
    let res = await axios.get('api/CarBrands')
    this.values = res.data
    this.filterValues()
  },

  methods: {
    filterValues() {
      if(this.value == 0) {
        this.filteredValues = this.values
      }

      this.filteredValues = this.values.filter(value => {
        return value.BrandName.toLowerCase().startsWith(this.value.toLowerCase())
      })
    },

    setValue(value) {
        this.value = value
        this.filter = false
      }
    },

  watch: {
    value(val) {
      this.filterValues()
      this.$emit('brand', val)
    }
  }
}
</script>

<style scoped>
.custom {
  overflow: auto;
  max-height: 200px;
  position: absolute;
  z-index: 10;
  background: #fff;
  width: 95%;
  color: black;
  margin-right: 1rem;
}

ul {
  list-style: none;
  padding: 1rem;
  cursor: pointer;
}

li:hover {
    color: red;
    background-color: #a5b1c2;
}
</style>
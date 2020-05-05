<template>
  <div class="col-md-4">
    <div class="form-group">
      <label for="">Car Purchased Amount / Market Value:</label>
      <span class="label" style="color: red; padding: 0px;" v-if="!value"> * </span>
      <input type="text" v-model="value" autocomplete="off" @focus="filter = true" class="form-control" placeholder="Enter Car Purchase Amount">
      <div v-if="filteredValues && filter" class="custom">
        <ul>
          <li v-for="value in filteredValues" :key="value._id" @click="setValue(value.CarAmount)">{{value.CarAmount | Peso}}</li>
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
    let res = await axios.get('api/CarAmounts')
    this.values = res.data
    this.filterValues()
  },

  methods: {
    filterValues() {
      if(this.value == 0) {
        this.filteredValues = this.values
      }

      this.filteredValues = this.values.filter(value => {
        return value.CarAmount.toLowerCase().startsWith(this.value.toLowerCase())
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
      this.$emit('amount-purchase', val)
    }
  },

  filters: {
    peso(amount) {
      const amt = Number(amount)
      return 'Php ' + amt.toLocaleString('ko-KR', {minimumFractionDigits: 2, maximumFractionDigits: 2})
    },
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
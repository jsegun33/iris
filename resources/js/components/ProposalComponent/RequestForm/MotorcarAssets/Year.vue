<template>
  <div class="col-md-3">
    <div class="form-goup">
      <label for="year">Year:</label>
      <span class="label" style="color: red; padding: 0px;" v-if="!year"> * </span>
     
      <select  v-model="year"  class="form-control">
         
           <option v-for="yearDs in yearD" :value="yearDs" :key="yearDs">{{ yearDs }}</option>

      </select>

    </div>
  </div>
</template>

<script>
export default {
  
  data() {
    return {
      year: '',
     //yearD:30,
      
    }
  },

  watch: {
    year(val) {
      this.$emit('year', val)
    }
  },


  computed : {
    yearD () {
      const year = new Date().getFullYear()
      //return Array.from({length: year - 1900}, (value, index) => 1901 + index)
         // sortArrays(year) {
                let MinusYear = year - 10;
                return Array.from({length: year - MinusYear}, (value, index) => year - index)
         // }
    }
  }
}
</script>

<style>

</style>
<template>
  <div class="col-md-3">
    <div class="form-goup">
      <label for="model">Model:</label>
      <span class="label" style="color: red; padding: 0px;" v-if="!value"> * </span>
      <input
        v-model="value"  
        @focus="ListOFModel()" @click="ListOFModel()"
        autocomplete="off" 
        type="text"
        class="form-control"
        placeholder="Enter Car Model"
      />

      <div v-if="filteredValues && filter" class="custom" >
        <ul>
          <li v-for="value in filteredValues" :key="value._id" @click="setValue(value.ModelName)">{{value.ModelName}}</li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    brand: {
      type: String,
      required: true
    }
  },

  data() {
    return {
      value: '',
      values: '',
      filter: false,
      filteredValues: [],
    }
  },

  created() {
    // let res = await axios.get('api/CarModels' +  PassBrandName) // Change EndPoint here to change the suggested data.
    // this.values = res.data
    // axios.get("api/CarModels/"  +  PassBrandName) .then(({ data }) => (this.values = data)  );
     //alert(PassBrandName);
    //this.filterValues();
   
  },

  methods: {

   ListOFModel() {
    let PassBrandName = this.brand;
    //alert(PassBrandName);
    axios.get("api/CarModels/"  +  PassBrandName) .then(({ data }) => (this.values = data)  );
   // await axios.get('api/CarModels' +  PassBrandName) // Change EndPoint here to change the suggested data.
    //this.values = res.data
    this.filter = true
    this.filterValues()
  },



    filterValues() {
      if(this.value == 0) {
        this.filteredValues = ''
      }

      this.filteredValues = this.values.filter(value => {
        return value.ModelName.toLowerCase().startsWith(this.value.toLowerCase())
      })
    },

    setValue(value) {
      this.value = value
      this.filter = false
    }
  },

  computed: {
    brands() {
      return this.$props.brand
    }
  },

  watch: {
    value(val) {
      this.filterValues()
      this.$emit('model', val)
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
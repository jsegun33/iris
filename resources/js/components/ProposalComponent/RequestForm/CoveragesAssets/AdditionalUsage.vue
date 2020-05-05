<template>
<div class="row" style="margin-bottom: 10px;">
  <template v-if="surcharges">
    <div class="col-md-4"   v-for="surcharge in surcharges"  :key="surcharge._id" >
      <div class="form-group" style="margin-bottom: 0">
        <input type="checkbox" v-model="surchageList" :value="surcharge.SurchargeName" :id="surcharge._id" />
        <label :for="surcharge._id">{{ surcharge.SurchargeName }}</label>
      </div>
    </div>
  </template>

  <template v-else>
    <div class="custom">
      <div class="blue ball"></div>
      <div class="red ball"></div>  
      <div class="yellow ball"></div>  
      <div class="green ball"></div>  
    </div>
  </template>
</div>
</template>

<script>
export default {
  data() {
    return { 
      surcharges: '',
      surchageList: [],
    }
  },

  async created() {
    let res = await axios.get('/api/Surcharge')
    this.surcharges = res.data
  },

  watch: {
    surchageList(val) {
      this.$emit('surcharge', val)
    }
  }
}
</script>

<style scoped>
label {
  font-weight: 500;
}

.custom {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100px
}

.ball {
  width: 10px;
  height: 10px;
  border-radius: 11px;
  margin: 0 10px;
  
  animation: 2s bounce ease infinite;
}

.blue {
  background-color: #34A952;
}

.red {
  background-color: #34A952;
  animation-delay: .25s;
}

.yellow {
  background-color: #34A952;
  animation-delay: .5s;
}

.green {
  background-color: #34A952;
  animation-delay: .75s;
}

@keyframes bounce {  
    50% {
        transform: translateY(25px);
    }
}
</style>

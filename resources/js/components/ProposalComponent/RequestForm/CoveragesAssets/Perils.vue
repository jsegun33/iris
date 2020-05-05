<template>
  <div>
    <div class="row" style="margin-bottom: 10px;">
      <template v-if="perils">
        <div class="col-md-4" v-for="peril in perils" :key="peril._id">
          <div class="form-group" style="margin-bottom: 0">
            <input :id="peril._id" type="checkbox" @change="checked" v-model="peril.Checkbox1" :checked="peril.Checkbox1" :disabled="peril.PerilsCode == 'OD' || peril.PerilsCode == 'CT' ? false : disabled"/>
            <label id="peril" :for="peril._id">{{ peril.PerilsName }}</label>
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

    <div class="row" v-if="PersonalAccident">
      <!-- <div class="col-md-4">
        <label for="">Driver:</label>
        <input v-model="driver" type="text" class="form-control input-sm" disabled>
      </div> -->
      <div class="col-md-4">
        <label for="">Passengers:</label>
        <input v-model="passengers" type="number" class="form-control input-sm" placeholder="Enter Number of  Passengers">
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      perils: '',
      disabled: true,
      PersonalAccident: false,
      driver: '1',
      passengers: '',
    }
  },

  async created() {
    let res = await axios.get('api/GetPerils')
    this.perils = res.data.data
    this.setPerils()
    this.setPA()
    let driver = this.driver

    this.$emit('driver', driver)
  },

  methods: {
    checked(e) {
      let od = this.perils.find(peril => peril.PerilsCode == 'OD')
      let ct = this.perils.find(peril => peril.PerilsCode == 'CT')
      let aog = this.perils.find(peril => peril.PerilsCode == 'AOG')
      let pd = this.perils.find(peril => peril.PerilsCode == 'PD')
      let xbi = this.perils.find(peril => peril.PerilsCode == 'XBI')
      let pa = this.perils.find(peril => peril.PerilsCode == 'PA')

      if(!od.Checkbox1 && !ct.Checkbox1) {
        this.disabled = true
        aog.Checkbox1 = false
        pd.Checkbox1 = false
        xbi.Checkbox1 = false
        pa.Checkbox1 = false
        this.passengers = ''
      } else {
        this.disabled = false
      }

      if (!pa.Checkbox1) {
        this.passengers = ''
      }

      this.setPerils()
    },

    setPerils() {
      let newPerils = this.perils.filter(peril => peril.Checkbox1 && !this.disabled)
      let per = newPerils.map(peril => {
        return peril.PerilsNo
      })

      let findPA = per.find(this.checkedPA)
      if (findPA == '2019-PA-0007') {
        this.PersonalAccident = true
      } else {
        this.PersonalAccident = false
      }
      
      this.$emit('perils', newPerils)
      console.log(newPerils);
      
    },

    checkedPA(val) {
      return val == '2019-PA-0007'
    },

    setPA() {
      let Perils = this.perils.map(peril => {
        return peril.PerilsNo
      })
      let PA = Perils.filter(this.checkedPA)
      // console.log(PA);
    }
  },

   watch: {
    passengers(val) {
      this.$emit('passengers', val)
    }
  }
}
</script>

<style scoped>
label#peril {
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
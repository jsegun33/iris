<template>
    <div class="box-body">
      <div class="row" style="margin-bottom: 10px;">
        <Platenumber @platenumber="setPlatenumber" />
        <Denomination @denomination="setDenomination" />
        <AmountPurchase @amount-purchase="setAmountPurchase" />
      </div>
      <div class="row" style="margin-bottom: 10px;">
        <Year @year="setYear" />
        <Brand @brand="setBrand" />
        <Model @model="setModel" :brand="details.brand"/>
        <BodyType @body-type="setBodyType" />
      </div>
      <div class="row" style="margin-bottom: 10px;">
        <Usage @usage="setUsage" @addUsage="setAddUsage"/>
        <div v-if="details.usage === 'Commercial Use'" style="display:block">
          <NetWeight @net-weight="setNetWeight" />
          <Accessories @accessories="setAccessories" />
        </div>
      </div>

      <!-- <a @click="isAdditionalUsageOpen = !isAdditionalUsageOpen" class="hvr-underline-from-left">{{isAdditionalUsageOpen ? 'Hide Other Usages' : 'Additional Usages'}}</a> -->
      <!-- <button @click="isAdditionalUsageOpen = !isAdditionalUsageOpen">{{isAdditionalUsageOpen ? 'Hide' : 'Show'}}</button> -->

      <AdditionalUsage v-if="isAdditionalUsageOpen" @surcharge="setSurcharge" />   

      <!-- <div class="row">
        <div class="col-md-4">
          <label for="">Coverages:</label>
          <span class="label" style="color: red; padding: 0px" v-if="coverages == 0">*</span>
          <a @click="isPreferedDateOpen = !isPreferedDateOpen" class="hvr-underline-from-left custom">{{isPreferedDateOpen ? 'Hide Prefered Date' : 'Add Prefered Date'}}</a>
        </div>
      </div> -->

      <!-- <button @click="isPreferedDateOpen = !isPreferedDateOpen">{{isPreferedDateOpen ? 'Hide' : 'Show'}}</button> -->

      <!-- <PreferedDate v-if="isPreferedDateOpen" @prefered-date="setPreferedDate" /> -->
      <PreferedDate @prefered-date="setPreferedDate" :perils="coverages"/>

      <Perils @perils="setPerils" @driver="setDriver" @passengers="setPassengers"/>
    </div>
</template>

<script>
import Usage from './CoveragesAssets/Usage'
import NetWeight from './CoveragesAssets/NetWeight'
import Accessories from './CoveragesAssets/Accessories'
import AdditionalUsage from './CoveragesAssets/AdditionalUsage'
import PreferedDate from './CoveragesAssets/PreferedDate'
import Perils from './CoveragesAssets/Perils'

import Platenumber from './MotorcarAssets/Platenumber'
import Denomination from './MotorcarAssets/Denomenation'
import AmountPurchase from './MotorcarAssets/AmountPurchase'
import Year from './MotorcarAssets/Year'
import Brand from './MotorcarAssets/Brand'
import Model from './MotorcarAssets/Model'
import BodyType from './MotorcarAssets/BodyType'

export default {
  components: {
    Usage,
    NetWeight,
    Accessories,
    AdditionalUsage,
    PreferedDate,
    Perils,
    Platenumber,
    Denomination,
    AmountPurchase,
    Year,
    Brand,
    Model,
    BodyType,
  },

  data() {
    return {
      details: {
        platenumber: '',
        denomination: '',
        amountPurchase: '',
        year: '',
        brand: '',
        model: '',
        bodyType: '',
        usage: '',
        netWeight: '',
        accessories: '',
        surcharge: [],
        effectiveDate: '',
        expiryDate: '',
        driver: '',
        passengers: '',
      },

      coverages: {},

      isAdditionalUsageOpen: false,
      isPreferedDateOpen: false,
    }
  },

  methods: {
    setUsage(val) {
      this.details.usage = val
      this.setMotorcarDetails()
    },

    setAddUsage(val) {
      this.isAdditionalUsageOpen = val
      this.setMotorcarDetails()
    },

    setPlatenumber(val) {
      this.details.platenumber = val
      this.setMotorcarDetails()
    },

    setDenomination(val) {
      this.details.denomination = val
      this.setMotorcarDetails()
    },

    setAmountPurchase(val) {
      this.details.amountPurchase = val
      this.setMotorcarDetails()
    },

    setYear(val) {
      this.details.year = val
      this.setMotorcarDetails()
    },

    setBrand(val) {
      this.details.brand = val
      this.setMotorcarDetails()
    },

    setModel(val) {
      this.details.model = val
      this.setMotorcarDetails()
    },

    setBodyType(val) {
     this.details.bodyType = val
      this.setMotorcarDetails()
      //console.log(this.details.bodyType);
     
    },

    setNetWeight(val) {
      this.details.netWeight = val
      this.setMotorcarDetails()
    },

    setAccessories(val) {
      this.details.accessories = val
      this.setMotorcarDetails()
    },

    setPreferedDate(effective, expiry) {
      this.details.effectiveDate = effective
      this.details.expiryDate = expiry
      this.setMotorcarDetails()
    },

    setSurcharge(val) {
      this.details.surcharge = val
      this.setMotorcarDetails()
    },

    setPerils(val) {
      this.coverages = val
      this.setMotorcarDetails()
    },

    setDriver(val) {
      this.details.driver = val
      this.setMotorcarDetails()
    },

    setPassengers(val) {
      this.details.passengers = val
      this.setMotorcarDetails()
    },

    setMotorcarDetails() {
      let details = this.details
      let coverages = this.coverages

      this.$emit('motorcar-details', details, coverages)
    }
  },
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
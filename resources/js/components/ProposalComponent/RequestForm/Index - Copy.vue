<template>
  <div>
    <form @submit.prevent="onSubmit()">
      <MotorcarDetails @motorcar-details="setMotorcarDetails" />
      <UserDetails @personal-details="setPersonalDetails" :form="form"/>
      <!-- <div class="box-footer">
        <button  type="submit" class="btn btn-block btn-primary pull-right" >Submit</button>
  
      </div> -->
    </form>
  <!-- --------<pre>{{ $data }}</pre>------ -->
  </div>
</template>

<script>
import MotorcarDetails from './MotorcarDetails'
import UserDetails from './UserDetails'

export default {
  components: {
    MotorcarDetails,
    UserDetails
  },
  mounted: function() {
       this.setPersonalDetails();
     
},

  data() {
    return {
      form: new Form({
        // coverages: {},
        // motorcar: {},
      // personal: {},

        PlateNumber: '',
        Denomination: '',
        POAMount: '',
        YearPO: '',
        CarBrand: '',
        CarModel: '',
        BodyType: '',
        PerilsName: [],
        driver: '',
        passengers: '',
        EffectiveDate:'',
        ExpiryDate:'',
        MotorNetWeight:'',
        first_name: "",
        middle_name: "",
        last_name: "",
        last_name: "",
        EmailAddress: '',
		    CustAcctNo: '',
        LinesNo: "",
        usages: '',
        MotorAccessories: '',
      }),

      loading: false,

    }
  },

  methods: {
    setMotorcarDetails(motorcar, coverages) {
      let motorcarDetails = motorcar
      let coveragesDetails = coverages
     

      // this.form.motorcar = motorcar
      // this.form.coverages = coverages
      let coverage = coverages.map(peril => {
        return peril.PerilsNo
      })
      
        this.form.PlateNumber     = motorcar.platenumber,
        this.form.Denomination    = motorcar.denomination,
        this.form.POAMount        = motorcar.amountPurchase,
        this.form.YearPO          = motorcar.year,
        this.form.CarBrand        = motorcar.brand,
        this.form.CarModel        = motorcar.model,
        this.form.BodyType        = motorcar.bodyType,
        this.form.PerilsName      = coverage,
        this.form.driver          = motorcar.driver,
        this.form.passengers      = motorcar.passengers,
        this.form.EffectiveDate   = motorcar.effectiveDate,
        this.form.ExpiryDate      = motorcar.expiryDate,
        this.form.MotorNetWeight  = motorcar.netWeight,
        this.form.MotorAccessories = motorcar.accessories,
        // this.form.middle_name = "",
        // this.form.last_name = "",
        // this.form.LinesNo = "",
        // this.form.EmailAddress = "",
        this.form.usages = motorcar.usage,

      this.$emit('new-motorcar-details', motorcarDetails, coveragesDetails)
      // console.log(motorcar)
    },

    setPersonalDetails(personal) {
      let personalDetails = personal
          this.form.first_name      = personal.first_name;
          this.form.middle_name     = personal.middle_name,
          this.form.last_name       = personal.last_name,
          this.form.EmailAddress    = personal.email,
		  this.form.CustAcctNo      = personal.CustAcctNo,
            // console.log(personalDetails)
      this.$emit('new-personal-details', personalDetails)
    },

    onSubmit() {
     
      this.loading = true,
      this.form
        .post('api/quotation')
        .then(res => {
          console.log(res);
          //this.$router.push("Home");
          this.$router.push("/proposal-lists-customer");
        })
        .catch(error => {
          //console.log(error);
             alert(error);
        });
    }
  },

  created() {
    // this.setPersonalDetails()
  }
}
</script>

<style>

</style>
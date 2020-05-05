<template>
  <div class="box-header with-border box box-success">
      <Option @option="setOption" />
      <Individual v-if="option === 'individual' || !option" @details="setPersonalDetails" />
      <Others v-else @details="setPersonalDetails"/>
      <div class="box-footer">
        <!-- <button v-if="!loading" type="submit" class="btn btn-primary pull-left" @click.prevent="onSubmit">Submit </button>
         <button v-if="loading" type="submit" class="btn btn-secondary pull-right" disabled>Sending...</button> -->
         <button type="submit" class="btn btn-primary pull-left" @click.prevent="onSubmit">Submit </button>
      </div>
  </div>
</template>

<script>
import Option from './UserAssets/Option'
import Individual from './UserAssets/Individual'
import Others from './UserAssets/Others'

export default {
  props: [
    'form'
  ],

  components: {
    Option,
    Individual,
    Others,
  },

  data() {
    return {
      option: '',
      loading: false,
      details: {},
      firstName: '',
    }
  },

  methods: {
    setOption(val) {
      this.option = val
    },

    setPersonalDetails(val) {
      let newPersonalDetails = val
      this.details = val
      this.$emit('personal-details', newPersonalDetails)
    },

     onSubmit() {
      // this.form.post('api/quotation')
      // .then(res => {
      //   Swal.fire(
      //       'Successful!',
      //       `Quotaion has been submitted.`,
      //       'success'
      //   )
      //   console.log(res);
      //   //this.$router.push('/dashboard');
      //   this.$router.push("/proposal-lists-customer");
      // })
      // .catch(error => {
      //   console.log(error);
      // });

      if (!this.form.PlateNumber) {
         Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Pls. Input Plate No.',
          
          })
            
          
      }else if (!this.form.Denomination) {
         Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Pls. Select Denomination.',
          
          })
      }else if (!this.form.POAMount) {
         Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Pls. Select Car Purchased Amount / Market Value.',
          
          })
      }else if (!this.form.YearPO) {
         Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Pls. Select Year.',
          
          })
      }else if (!this.form.CarBrand) {
         Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Pls. Select Brand.',
          
          })
      }else if (!this.form.CarModel) {
         Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Pls. Select Model.',
          
          })
      // }else if (this.form.BodyType.length  > 0) {
      //    Swal.fire({
      //       icon: 'error',
      //       title: 'Oops...',
      //       text: 'Pls. Select Body Type.',
          
      //     })
      // }else if (this.form.usages.length > 0) { 
      //    Swal.fire({
      //       icon: 'error',
      //       title: 'Oops...',
      //       text: 'Pls. Select Usages.',
          
      //     })
      }else if (!this.form.EffectiveDate) {
         Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Pls. Select /Input Effective Date.',
          
         })
      // }else if (this.form.Perils.length > 0) {
      //    Swal.fire({
      //       icon: 'error',
      //       title: 'Oops...',
      //       text: 'Pls. Select Coverages.',
          
      //     })
      }else{
             this.loading = true,
              Swal.fire({
                title: "Are you sure ?",
                text: "Add New Quotation Option",
                icon: "success",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then(result => {
                  //  let GetRequestNo =  this.form.RequestNoPass  + ';;'  + this.form.Denomination + ';;'  + this.form.RequestNoOptionNo  ;
                 if (result.value) {
                             this.form.post("api/quotation" )
                            .then(() => {
                                Swal.fire(
                                    " Successfull....",
                                    "New Quotation Submitted",
                                    "success"
                                );
                                 
                                  this.$router.push("/proposal-lists-customer");
                            }) .catch(() => {
                            Swal.fire(
                                "Failed",
                                "There was something wrong",
                                "warning"
                            );
                        });
                }else{
                  this.$router.push("/request-form");
                }
           })
      }



    
      
    }
  },
}
</script>

<style>

</style>
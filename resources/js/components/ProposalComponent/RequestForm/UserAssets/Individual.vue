<template>
  <div class="box-body" >
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="">TIN Number:</label>
          <input 
            type="text" 
            class="form-control input-sm"
            autocomplete="off"
            
            v-model="details.tin">
			
			<input 
            type="hidden" 
            class="form-control input-sm"
            autocomplete="off"
            readonly
            v-model="details.CustAcctNO1">
			
			
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="">Email Address:</label>
          <input 
            type="email" 
            class="form-control input-sm"
            autocomplete="off"
            readonly
            v-model="details.email">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="">Contact Number:</label>
          <input 
            type="text" 
            class="form-control input-sm"
            autocomplete="off"
            
            v-model="details.contact">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="">First Name:</label>
          <input 
            type="text"
            class="form-control input-sm"
            autocomplete="off"
            readonly
            v-model="details.first_name">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="">Middle Name:</label>
          <input 
            type="text"
            class="form-control input-sm"
            autocomplete="off"
            readonly
            v-model="details.middle_name">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="">Last Name:</label>
          <input 
            type="text"
            class="form-control input-sm"
            autocomplete="off"
            readonly
            v-model="details.last_name">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="">Address:</label>
          <input 
            type="text"
            class="form-control input-sm"
            autocomplete="off"
            
            v-model="details.address">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <div class="form-group">
            <label for="">City:</label>
            <input 
              type="text"
              class="form-control input-sm"
              autocomplete="off"
              
              v-model="details.city">
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="">Barangay:</label>
          <input 
            type="text"
            class="form-control input-sm"
            autocomplete="off"
            
            v-model="details.barangay">
        </div>
     
      </div>
    </div>
  </div>
</template>

<script>
export default {
     mounted: function() {
         axios.get("GetUserData").then(({ data }) => {
        this.UserDetails = data
        this.details.email          = data.email
        this.details.first_name     = data.first_name
        this.details.middle_name    = data.user_mname
        this.details.last_name      = data.last_name
      });


      // let newDetails = this.details
      // this.$emit('details', newDetails)
    },

  data() {
    return {
      UserDetails: {},

      details: {
        first_name: '',
        middle_name: '',
        last_name: '',
        address: '',
        city: '',
        barangay: '',
        tin: '',
        email: '',
        contact: '',
        CustAcctNo:'',
        AcctName:'',
      }
    }
  },

  methods: {
    loadUserData() {
      axios.get("GetUserData").then(({ data }) => {
        this.UserDetails = data
        this.details.email          = data.email
        this.details.first_name     = data.first_name
        this.details.middle_name    = data.user_mname
        this.details.last_name      = data.last_name
        this.details.CustAcctNo     = data.AccountNo
        this.details.AcctName       = data.first_name +  " " +  data.user_mname  +  " " +  data.last_name 
      });
    }
  },

  created() {
    this.loadUserData()
    let newDetails =  this.details
    //this.$emit('details', newDetails)
 
    this.RetrieveTimeInterval = setInterval(() => {
                   this.$emit('details', newDetails)
      }, 1000);
      

 },


}
</script>

<style>

</style>
<template>
  <div class="box-body">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="tin">TIN Number:</label>
          <input
            v-model="details.tin"
            class="form-control input-sm"
            type="text"
            name="tin"
            id="tin"
            placeholder="Enter TIN Number"
          />
		  
		  <input 
            type="hidden" 
            class="form-control input-sm"
            autocomplete="off"
            readonly
            v-model="details.CustAcctNO">
			
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="email">Email Address:</label>
          <input
            v-model="details.email"
            class="form-control input-sm"
            type="email"
            name="email"
            id="email"
            placeholder="Enter Email Address"
          />
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="contact">Contact Number:</label>
          <input
            v-model="details.contact"
            class="form-control input-sm"
            type="text"
            name="contact"
            id="contact"
            placeholder="Enter Contact Number"
          />
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="first_name">First Name:</label>
          <input
            v-model="details.first_name"
            class="form-control input-sm"
            type="text"
            name="first_name"
            id="first_name"
            placeholder="Enter First Name"
          />
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="middle_name">Middle Name:</label>
          <input
            v-model="details.middle_name"
            class="form-control input-sm"
            type="text"
            name="middle_name"
            id="middle_name"
            placeholder="Enter Middle Name"
          />
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="last_name">Last Name:</label>
          <input
            v-model="details.last_name"
            class="form-control input-sm"
            type="text"
            name="last_name"
            id="last_name"
            placeholder="Enter Last Name"
          />
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="address">Address:</label>
          <input
            v-model="details.address"
            class="form-control input-sm"
            type="text"
            name="address"
            id="address"
            placeholder="Enter Address"
          />
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="barangay">Barangay:</label>
          <select v-model="details.barangay" class="form-control input-sm" @change="onChange">
            <option value="" disabled selected>Select Barangay</option>
            <option value="Barangay 288">Barangay 288</option>
            <option value="Barangay 289">Barangay 289</option>
          </select>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label for="city">City:</label>
          <select v-model="details.city" class="form-control input-sm" @change="onChange">
            <option value="" disabled selected>Select City</option>
            <option value="Quezon City">Quezon City</option>
            <option value="Manila City">Manila City</option>
          </select>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
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
    onChange(e) {
      console.log(e.target.value)
      this.$emit('details', this.details)
    },
	 loadUserData() {
      axios.get("GetUserData").then(({ data }) => {
        this.UserDetails = data
       
          this.details.CustAcctNo     = data.AccountNo
          this.details.AcctName       = data.first_name +  " " +  data.user_mname  +  " " +  data.last_name 
      });
    }
  },
  
   created() {
    this.loadUserData()
    

 },
 

  watch: {
    'details.first_name'() {
      this.$emit('details', this.details)
    },

    'details.middle_name'() {
      this.$emit('details', this.details)
    },

    'details.last_name'() {
      this.$emit('details', this.details)
    },

    'details.address'() {
      this.$emit('details', this.details)
    },

    'details.tin'() {
      this.$emit('details', this.details)
    },

    'details.email'() {
      this.$emit('details', this.details)
    },

    'details.contact'() {
      this.$emit('details', this.details)
    },
  },


}
</script>

<style>

</style>
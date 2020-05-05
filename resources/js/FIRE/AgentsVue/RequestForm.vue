<template>
    <section class="content">
        <div class="row">
        <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title"><strong>Property Details</strong></h3>
            </div>
           
            <form @submit.prevent="FireRequestQuotation()" enctype="multipart/form-data" >
                <div class="box-body">

                
                     <div class="form-group row">

                                <!-- <select  @change="LoadPerilsSub($event)" v-model="form.PerilsName" class="form-control" id="PerilsName" name="PerilsName" required>
                                    <option value='' selected >pls. select</option>
                                    <option v-for="FirePerilss in FirePerils" :key="FirePerilss._id" v-bind:value="FirePerilss.PerilsAcct + ';;' + FirePerilss.PerilsDecription">{{ FirePerilss.PerilsDecription }}</option>
                                </select> -->
                     
                       
                            <label for="inputPassword" class="col-sm-12 col-form-label"><big style="color:red"> * </big> Property Type </label>
                             <div class="col-sm-4"  v-for="FirePerilss in FirePerils" :key="FirePerilss._id">
                                  <p id="forOthers"  ><input type="checkbox" @click="FocusPushRecord()"  v-model="form.FireCoverages[FirePerilss._id]"  v-bind:data-perils="FirePerilss._id"/>
                                       {{ FirePerilss.PerilsDecription }}  
                                    </p>
                            </div>
                   
                      
                    </div>

                  

                    <label style="color:green" ><h3> Bounderies : </h3></label>
                     <div class="form-group row">
                         
                         
                             <div class="col-sm-3">
                                <label for="inputPassword" class="col-form-label"><big style="color:red"> * </big> Image of Left Boundery </label>
                                     <input class="form-control" type="file" v-on:change="onImageChangeImgBounderyLeft" accept="image/*"  multiple tabindex="-1"  />
                            </div>
                             <div class="col-sm-3">
                                <label for="inputPassword" class="col-form-label"><big style="color:red"> * </big> Image of Right Boundery </label>
                                     <input class="form-control" type="file" v-on:change="onImageChangeImgBounderyRight" multiple tabindex="-1"  />
                            </div>
                             <div class="col-sm-3">
                                <label for="inputPassword" class="col-form-label"><big style="color:red"> * </big> Image of Front Boundery </label>
                                     <input class="form-control" type="file" v-on:change="onImageChangeImgBounderyFront" multiple tabindex="-1"  />
                            </div>
                             <div class="col-sm-3">
                                <label for="inputPassword" class="col-form-label"><big style="color:red"> * </big> Image of Rear Boundery </label>
                                     <input class="form-control" type="file" v-on:change="onImageChangeImgBounderyRear" multiple tabindex="-1"  />
                            </div>



                    </div>




                    
                     <!-- <div class="form-group row">
                        
                        <label for="inputPassword" class="col-sm-2 col-form-label"><big style="color:red"> * </big> Coverages </label>
                        <div class="col-sm-4">
                               <select   v-model="form.PerilsNameSub" class="form-control" id="PerilsNameSub" name="PerilsNameSub" required>
                                    <option value='' selected >pls. select</option>
                                    <option v-for="PerilsSubs in PerilsSub" :key="PerilsSubs._id" v-bind:value="PerilsSubs.SubAcct + ';;' + PerilsSubs.SubName">{{ PerilsSubs.SubName }}</option>
                                </select>
                     
                        </div>
                    </div> -->



                     <div class="form-group row">
                          <div class="col-sm-3">
                                <label for="inputPassword" class="col-form-label"><big style="color:red"> * </big> Business Type</label>
                                 <select   v-model="form.PerilsNameSub" class="form-control" id="PerilsNameSub" name="PerilsNameSub" required>
                                    <option value='' selected >pls. select</option>
                                    <option v-for="PerilsSubs in PerilsSub" :key="PerilsSubs._id" v-bind:value="PerilsSubs.SubAcct + ';;' + PerilsSubs.SubName + ';;' + PerilsSubs.RateSub">{{ PerilsSubs.SubName }}</option>
                                </select>
                            </div>
                             <div class="col-sm-3">
                                <label for="inputPassword" class="col-form-label"><big style="color:red"> * </big> Market Value / Sum Insured</label>
                                <input type="number"  class="form-control"    v-model="form.MarketValue" placeholder="Market Value" required />
                            </div>
                            <div class="col-sm-3">
                                <label for="inputPassword" class="col-form-label"><big style="color:red"> * </big> Effective Date </label>
                                <input type="date"  class="form-control"    v-model="form.EffectiveDate"  required />
                     
                            </div>
                            
                            <div class="col-sm-3">
                                <label for="inputPassword" class="col-form-label"><big style="color:red"> * </big> Expiry Date  </label>
                                <input type="date"  class="form-control"    v-model="form.ExpiryeDate" required />
                            </div>


                    </div>

                     <div class="form-group row">
                     
                            <label for="inputPassword" class="col-sm-12 col-form-label"><big style="color:red"> * </big> Assured Property</label>
                             <div class="col-sm-12" >
                                  <input type="text"  class="form-control"    v-model="form.PropertyAssuredName" placeholder="Property Address" required />
                            </div>
                         
                      
                    </div>

                     <div class="form-group row">
                     
                            <label for="inputPassword" class="col-sm-12 col-form-label"><big style="color:red"> * </big> Property Address </label>
                             <div class="col-sm-4" >
                                  <input type="text"  class="form-control"    v-model="form.PropertyAddress" placeholder="Property Address" required />
                            </div>
                             <div class="col-sm-4" >
                                  <input type="text"  class="form-control"    v-model="form.PropertyAddressCity" placeholder="Property Address City" required />
                            </div>
                             <div class="col-sm-4" >
                                  <input type="text"  class="form-control"    v-model="form.PropertyAddressBarangay" placeholder="Property Address Barangay" required />
                            </div>
                   
                      
                    </div>
                    
                     <div class="form-group row">
                     
                            <label for="inputPassword" class="col-sm-12 col-form-label"><big style="color:red"> * </big> Building Description (Pin your Location)</label>
                             <div class="col-sm-12" >
                                      <gmap-map
                                        :center="center"
                                        :zoom="12"
                                        style="width:100%;  height: 400px;"
                                        >
                                                    <gmap-marker
                                                        :key="index"
                                                        v-for="(m, index) in markers"
                                                        :position="m.position"
                                                        @click="center=m.position"
                                                    ></gmap-marker>
                                        </gmap-map>

                              
                           
                           
                            </div>
                   
                      
                    </div>


                   

                </div>


                

                
                <div class="box box-danger">
                      <div class="box-header with-border">
                        <h3 class="box-title"><strong>Personal Details</strong></h3>
                            <div style="margin-left: 50%;">
                                    <label id="forIndividual" ><input  type="radio" v-model="form.Individual" value="Individual">
                                        Individual
                                    </label>
                                    <label id="forOthers" ><input type="radio"   v-model="form.Others" value="Others">
                                        Others
                                    </label>
                            </div>
                     </div>

                    <div class="form-group row col-sm-12">
                        <div class="col-sm-4">
                                <label for="inputPassword" class="col-form-label"><big style="color:red"> * </big> TIN Number </label>
                                 <input type="number"  class="form-control"    v-model="form.TINNumber" required />
                        </div>
                   
                        <div class="col-sm-4">
                                <label for="inputPassword" class="col-form-label"><big style="color:red"> * </big> Email Address </label>
                                 <input type="email"  class="form-control"    v-model="form.EmailAddress" required />
                        </div>

                         <div class="col-sm-4">
                                <label for="inputPassword" class="col-form-label"><big style="color:red"> * </big> Contact Number</label>
                                 <input type="number"  class="form-control"    v-model="form.ContactNumber" required />
                        </div>

                    </div>

                      <div class="form-group row col-sm-12">
                        <div class="col-sm-4">
                                <label for="inputPassword" class="col-form-label"><big style="color:red"> * </big> First Name </label>
                                 <input type="text"  class="form-control"    v-model="form.FirstName" required />
                        </div>
                   
                        <div class="col-sm-4">
                                <label for="inputPassword" class="col-form-label"><big style="color:red"> * </big> Middle Name</label>
                                 <input type="text"  class="form-control"    v-model="form.MiddleName" required />
                        </div>

                         <div class="col-sm-4">
                                <label for="inputPassword" class="col-form-label"><big style="color:red"> * </big> Last Name:</label>
                                 <input type="text"  class="form-control"    v-model="form.LastName" required />
                        </div>

                    </div>

                    <div class="form-group row col-sm-12" >
                     
                            <label for="inputPassword" class="col-sm-12 col-form-label"><big style="color:red"> * </big>Address </label>
                             <div class="col-sm-4" >
                                  <input type="text"  class="form-control"    v-model="form.PersonalAddress" placeholder="Personal Address" required />
                            </div>
                             <div class="col-sm-4" >
                                  <input type="text"  class="form-control"    v-model="form.PersonalAddressCity" placeholder="Personal Address City" required />
                            </div>
                             <div class="col-sm-4" >
                                  <input type="text"  class="form-control"    v-model="form.PersonalAddressBarangay" placeholder="Personal Address Barangay" required />
                            </div>
                   
                      
                    </div>


                   
                </div>

               


                <!--------<pre> {{ $data }}</pre>-------->
                <div class="box-footer">
                
                    <button  type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
	<!-- ------<pre>{{ $data }}</pre>------ -->
        </div>
        </div>
        

    </section>

    
	
</template>


<script>
import Vue from 'vue'
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'

Vue.use(VueMaterial)

export default {
     mounted() {
        console.log('Component mounted.')
        this.LoadFirePerils();this.LoadPerilsSub(); 
         this.geolocate();
           axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));	
    },

    data() {
        return {
           FirePerils:{},
           PerilsSub:{},
           UserDetails:{},
           checked:true,

             center:  { lat: 14.6042004, lng: 120.9822006 },
                markers: [],
                places: [],
                currentPlace: null,
					
            form: new Form({
                _id: '',
               
                PerilsName: '',
                MarketValue: '',
                Usage: '',
                UserAcctNo: '',
                UserAcctName: '',
                PropertyAssuredName: '',
           
                PerilsNameSub: '',
                MarketValue: '',
                EffectiveDate: '',
                ExpiryeDate: '',
                PropertyAddress: '',
                PropertyAddressCity: '',
                PropertyAddressBarangay: '',
                TINNumber: '',
                EmailAddress: '',
                ContactNumber: '',
                FirstName: '',
                MiddleName: '',
                LastName: '',
                PersonalAddress: '',
                PersonalAddressCity: '',
                PersonalAddressBarangay: '',
                ImgBounderyLeft: '',
                ImgBounderyRight: '',
                ImgBounderyFront: '',
                ImgBounderyRear: '',

                FireCoverages:[],
               
            
               
            }),
        }
    },
    
    methods: { 

        FocusPushRecord(e){
           
            let DataPerils = event.target.getAttribute('data-perils');
             //alert(DataPerils);
         
           if ( !(this.form.FireCoverages[DataPerils])){
               this.form.FireCoverages.push(DataPerils);
           }else{
               this.form.FireCoverages.splice(DataPerils, 1);
           }


        },
     

     onImageChangeImgBounderyLeft(e){
        

       
          let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImageImgBounderyLeft(files[0]);
      },

      createImageImgBounderyLeft(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                    this.form.ImgBounderyLeft =  vm.image;
                };
                reader.readAsDataURL(file);

            },


 onImageChangeImgBounderyRight(e){
       
          let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImageImgBounderyRight(files[0]);
      },

      createImageImgBounderyRight(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                    this.form.ImgBounderyRight =  vm.image;
                };
                reader.readAsDataURL(file);
            },
 onImageChangeImgBounderyFront(e){
       
          let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImageImgBounderyFront(files[0]);
      },

      createImageImgBounderyFront(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                    this.form.ImgBounderyFront =  vm.image;
                };
                reader.readAsDataURL(file);
            },
     onImageChangeImgBounderyRear(e){
       
          let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImageImgBounderyRear(files[0]);
      },

      createImageImgBounderyRear(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                    this.form.ImgBounderyRear =  vm.image;
                };
                reader.readAsDataURL(file);
            },

        ///---------------MAp

                 setPlace(place) {
                    this.currentPlace = place;
                    },
                    addMarker() {
                    if (this.currentPlace) {
                        const marker = {
                        lat: this.currentPlace.geometry.location.lat(),
                        lng: this.currentPlace.geometry.location.lng()
                        };
                        this.markers.push({ position: marker });
                        this.places.push(this.currentPlace);
                        this.center = marker;
                        this.currentPlace = null;
                    }
                    },
                    geolocate: function() {
                    navigator.geolocation.getCurrentPosition(position => {
                        this.center = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                        };
                    });
              },
              

        ///End Map

     FireRequestQuotation() {
           if (!this.form.MarketValue) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pls. Input Market Value.',
                
                })
          }else if (!this.form.EffectiveDate) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pls. Select Effective Date.',
            
            })

    }else{
                 this.form.UserAcctNo       = this.UserDetails.AccountNo;
                 this.form.UserAcctName     = this.UserDetails.CName;
                    this.form.post('api/FireRequestQuotation')
                        .then(res => {
                        console.log(res);
                                        Swal.fire(
                                                " QUOTATION ",
                                                " Request QUOTATION has been SUBMITTED",
                                                "success"
                                            );
                        
                                this.$router.push("/proposal-lists-fire");
                        })
                        .catch(error => {
                        //console.log(error);
                            alert(error);
                        });
     }

    },

        LoadPerilsSub(){
             axios.get("api/LoadPerilsSub").then(({ data }) => (this.PerilsSub = data));
            console.log(e.target.value);


        },     
        

         LoadFirePerils() {
            axios.get("api/GetFirePerils").then(({ data }) => (this.FirePerils = data));
        },
          

    },

    created() {
       

    }
}
</script>


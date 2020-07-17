<template>
    <div id="MainPage"  >
        <!-- <section class="content-header">
            <h1>
                Proposal Lists
                <small>Table of Proposal</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#"><i class="fa fa-file-text"></i> Quotation / Proposal</a></li>
                <li class="active">Proposal List</li>
            </ol>
        </section>
      -->

      <!-- <section class="content" v-show="isShowingLoading" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >Loading... {{ this.IntervalLoading  }}</big></h1>
                </div>
         </section> -->
           <section class="content" @mouseover="VerifyAccessRoles()"   v-if ="this.AllRolesList ==='NO ACCESS'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >{{ this.AllRolesList }}</big></h1>
                    
                </div>
           </section>


      <section class="content" v-if="this.RequestQuotations === 'NO RECORD FOUND' && this.AllRolesList ==='YES ACCESS'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" > {{ this.RequestQuotations  }}</big></h1>
                </div>
         </section>

         <section class="content"  v-if="this.RequestQuotations !== 'NO RECORD FOUND'  && this.AllRolesList ==='YES ACCESS'">
                <div class="box-header with-border box box-success" id="quotehead" >
               <h1>Request List</h1>
                    <v-client-table 
                        :data="tableData"
                        :columns="columns" 
                        :options="options">
                    <div slot="actions" slot-scope="{ row }">
                        <a :href="'/ViewQuoteList?' + row.RequestNo" class="btn btn-info" style="text-decoration: none;" @click="UpdateRequest(row)" > <i class="fa fa-eye"></i> View</a>
                       <a :href="'/proposal-form?' + row.RequestNo" class="btn btn-primary" style="text-decoration: none;" @click="UpdateRequest(row)" > <i class="fa fa-eye"></i> Edit</a>
                    
                    </div>
                     
                      
                    </v-client-table>
                   
                </div>

         </section>


       
       <!-- ------- <pre>{{ $data }}</pre>------ -->
     
    </div>
</template>
		



<script>

$(document).ready(function() {
     

 });   
export default {


     mounted() {
                 this.GetUserData();
                 this.StartLoading();
               
            
        
         
        },
         data() {
            return {
                UserDetails:{},
                 TimeLoading1:null,
                 RetrieveTimeInterval:null,
                 RetrieveTimeInterval2:null,
                 HrsLimit:null,
         
                 

                editmode: false,
                AllRolesList: {},


                columns: ['RequestNo', 'RequestType', 'PlateNumber','AssignCRD', 'Name','Status','actions'],
                tableData: [],
                options: {
                    headings: {
                        RequestNo: 'RequestNo',
                        RequestType: 'RequestType',
                        PlateNumber: 'PlateNumber',
                        AssignCRD: 'AssignCRD',
                        Name: 'Assured Name',
                          Status: 'Status',
                         action: "Action"
                        
                    },
                    sortable: ['RequestNo', 'Status', 'RequestType', 'PlateNumber', 'AssignCRD', 'Name'],
                    filterable: ['RequestNo', 'Status', 'RequestType', 'PlateNumber', 'AssignCRD', 'Name']
                },


                form: new Form({
                CustAcctNO: "",
               
                RoleAlias: "",
                 CustAcctNo: "",
                PassURL:"",
                })
                
            }
        },


        methods: {
            async GetUserData() {
             const response    =  await  axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));
                        this.form.CustAcctNO    = this.UserDetails.AccountNo;
                  
                        this.form.RoleAlias     = this.UserDetails.RoleAlias;
                        this.form.CustAcctNo    = this.UserDetails.AccountNo;
                        let PassID               = window.location.pathname;
                        this.form.PassURL       = PassID;
                    await this.form.post("api/GetAllUserAccessRole").then(({ data }) => (this.AllRolesList = data));
                  this.LoadDataForm();
            },
 async StartLoading() {
     // if (!this.RequestQuotations || !this.RequestQuotations.length){  ///if record is is empty
   
               let timerInterval
                await Swal.fire({
                title: '<h3>Loading Data</h3>',
                text: 'Please wait...',
                timer: 1000,
               //  timer: this.HrsLimit,
                
                timerProgressBar: true,
                icon: 'info',
               // background: '#f39c12',
                timerProgressBarColor:"#00a65a",
             
                allowOutsideClick: false,
                allowEscapeKey: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                    const content = Swal.getContent()
                    if (content) {
                        const b = content.querySelector('b')
                        if (b) {
                        b.textContent = Swal.getTimerLeft()
                        }
                    }
                    }, 100)
                },
                onClose: () => {
                    clearInterval(timerInterval)
                            $(".ContentSection").removeClass("DisabledSection");
                        
                   
                            
                }
                }).then((result) => {
                         
                })
            // }else{
            //       clearInterval(timerInterval)
            //          $(".ContentSection").removeClass("DisabledSection");
                     
            // }    
      },


          async LoadDataForm() {
                     try {
                         await this.form.post("api/GetRequestQuotation"  ).then(({ data }) => (this.tableData = data));
                    } catch(error) {
                       
                        alert("error", error);
                       
                    }
            },
           VerifyAccessRoles(){
                if( this.AllRolesList === "NO ACCESS"){
                    this.$router.push('/Dashboard'); 
                 
                }
                   
            },


            
            UpdateRequest(row) {
              let  PassID  =row.RequestNo;
                axios.get("api/UpdateRequest/" + PassID   ).then(({ data }) => (this.RequestQuotations = data));
               // alert(RequestQuotationss.RequestNo);
            },
         
          },

       

         computed: {
        date() {
           let date = new Date()
           let day = date.getDate()
           let month = date.getMonth() + 1
           let year = date.getFullYear()
           return `${month} / ${day} / ${year}`
        },
		 
    }
    
}
</script>

<style>


</style>
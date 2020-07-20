<template>
    <div id="MainPage" >
      
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
     <section class="content" v-if="this.RequestQuotations === 'NO RECORD FOUND' && this.AllRolesList ==='YES ACCESS'">
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >{{ this.RequestQuotations  }} </big></h1>
                </div>
    </section>

     <section class="content"   v-if="this.RequestQuotations !== 'NO RECORD FOUND' &&  this.AllRolesList ==='YES ACCESS'">
                <div class="box-header with-border box box-success" id="quotehead" >
               <h1>List Request Proposals / Quotations</h1>
                    <v-client-table  
                        :data="RequestQuotations"
                        :columns="columns" 
                        :options="options">
                    <div slot="actions" slot-scope="{ row }" @mouseover="GetResquestNo(row)">
                        <a :href="'/ProposalOptions?' + row.RequestNo" v-if="row.RequestModify > 0  || row.OktoAccept  == 1" class="btn btn-success" style="text-decoration: none;" > <i class="fa fa-eye"></i>  Accept</a>
                        <a :href="'/CustAcceptedView?' + row.RequestNo" v-if="row.AcceptedOption > 0 || row.RequestModify > 0" class="btn btn-info" style="text-decoration: none;" > <i class="fa fa-eye"></i> View</a>
                        <a :href="'/Payment-Mode?' + row.RequestNo" v-if="row.PaymentMode !== 'Paid' && row.PaymentGateway  !== 'Cashier' &&  row.AcceptedOption > 0"  class="btn btn-danger" style="text-decoration: none;" > <i class="fa fa-money"></i> Pay NOW</a>
                        <a :href="'/Customer-Issuance?' + row.RequestNo" v-if="row.Status == 'Approved'"    class="btn btn-warning" style="text-decoration: none;" > <i class="fa fa-eye"></i> Policy</a>

                    </div>
                     
                      
                    </v-client-table>
                   
                </div>

         </section>
         
            
       
        
    <!-- --------<pre>{{ $data }}</pre>----- -->
     
      
    </div>
</template>
		



<script>

 
//import udmodal  from './Proposal'


export default {


     mounted() {
            this.GetUserData();
            this.StartLoading();
         
        
        },
         data() {
            return {
                editmode: false,
                RequestQuotations: {},
                UserDetails:{},
                RetrieveTimeInterval:null,
                RetrieveTimeInterval2:null,
                 RetrieveTimeInterva3:null,
                RetrieveTimeInterval4:null,


                 columns: ['RequestNo', 'PlateNumber', 'Denomination','CName', 'AmountDue','QuoteExpiry','Status','Payment','actions'],
                RequestQuotations: [],
                options: {
                    headings: {
                        RequestNo: 'RequestNo',
                        PlateNumber: 'PlateNumber',
                        Denomination: 'Denomination',
                        CName: 'Assured Name',
                        AmountDue: 'AmountDue',
                          QuoteExpiry: 'QuoteExpiry',
                         Status: "Status",
                          action: "action"
                        
                    },
                    sortable: ['RequestNo', 'Status', 'Denomination', 'PlateNumber', 'AmountDue', 'CName','QuoteExpiry','Payment'],
                    filterable: ['RequestNo', 'Status', 'Denomination', 'PlateNumber', 'AmountDue', 'CName','QuoteExpiry','Payment']
                },

            
               
               
               IntervalLoading:null,
                IntervalLoading1:null,
                 isShowingLoading:true,
                 isShowingRecord:false,
                 timedCount:5000,
                 timer:0,
                 clock:47,
                 timer_is_on:0,
         
                    form: new Form({
                       // UserLastName:[],
                       AcctNo: '',
                       RequestNo: '',
                        CustAcctNo: "",
                        PassURL:"",
                        
                    }),
             }

        },


        methods: {

              async GetUserData() {
             const response    =  await  axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));
                       this.form.AcctNo       = this.UserDetails.AccountNo;
                        let PassNO            = this.UserDetails.AccountNo;
                        let PassEmail         = this.UserDetails.email;	    		
                        let NewPassID         = PassNO.trim() ; 
                        this.form.CustAcctNo  = this.UserDetails.AccountNo;
                        let PassID              = window.location.pathname;
                        this.form.PassURL       = PassID;

                    await this.form.post("api/GetAllUserAccessRole").then(({ data }) => (this.AllRolesList = data));
                  this.loadRequestQuotation();
            },

              VerifyAccessRoles(){
                if( this.AllRolesList === "NO ACCESS"){
                    this.$router.push('/Dashboard'); 
                 
                }
                   
            },

           

            GetResquestNo(row){
                this.form.RequestNo = row.RequestNo;
                //alert(RequestQuotationss.RequestNo);

            },

          async StartLoading() {
              
               let timerInterval
                await Swal.fire({
                title: '<h3>Loading Data</h3>',
                text: 'Please wait...',
                timer: 1000,
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
              
            },


        async loadRequestQuotation() {
        //  this.RetrieveTimeInterval = setInterval(() => {  
        //         this.form.AcctNo = this.UserDetails.AccountNo;
        //        let PassNO            = this.UserDetails.AccountNo;
        //         let PassEmail         = this.UserDetails.email;	    		
        //         let NewPassID         = PassNO.trim() ; 
        //          this.form.CustAcctNo = this.UserDetails.AccountNo;
        //                 let PassID      = window.location.pathname;
        //                     this.form.PassURL = PassID;

        //     this.form.post("api/GetAllUserAccessRole").then(({ data }) => (this.AllRolesList = data));
        //     axios.get("api/GetRequestQuotationCustomer/" + NewPassID).then(({ data }) => {
        //             (this.RequestQuotations = data)
                    

        //           }).catch((response) => {
                 
        //         });
        //      }, 1000)
        //      this.RetrieveTimeInterval2 = setInterval(() => {
        //                     clearInterval(this.RetrieveTimeInterval);  
                          
        //               },3000) 

                     try {
                         await axios.get("api/GetRequestQuotationCustomer/" +  this.form.AcctNo  ).then(({ data }) => (this.RequestQuotations = data));
                    } catch(error) {
                       
                        alert("error", error);
                       
                    }
         } 

          
         
          },
        //     created() {
        //     this.loadRequestQuotation();
        //     Fire.$on('AfterCreate',() => {
        //         this.loadRequestQuotation();
        //     });
        // },   
          
         
    
}
</script>
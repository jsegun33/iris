<template>
    <div>
        <DashboardHeader/>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                 <div class="box-body table-responsive">
                    <table class="table table-hover text-center" >
                        <tbody>
                             <tr>
                                <th style="text-align:right">Account # :</th>
                                <td style="text-align:left">{{ this.UserDetails.AccountNo }} </td>
                            </tr>


                            <tr>
                                <th style="text-align:right">Name :</th>
                                <td style="text-align:left">{{ this.UserDetails.CName }} </td>
                            </tr>

                              <tr>
                                <th style="text-align:right">Email Address :</th>
                                <td style="text-align:left">{{ this.UserDetails.email }} </td>
                            </tr>

                              <tr>
                                <th style="text-align:right">Department :</th>
                                <td style="text-align:left">{{ this.UserDetails.department }} </td>
                            </tr>


                              <tr>
                                <th style="text-align:right">Approved Limit :</th>
                                <td style="text-align:left">{{ this.UserDetails.ApprovedLimit | peso }} </td>
                            </tr>
                           
                        </tbody>
                    </table>
                  
                </div>
               
                
              
            </div>
        </section>
    </div>
</template>

<script>
import DashboardHeader from './components/PageHeaders/DashboardHeader'
export default {
    components: {
        DashboardHeader,
    },

    mounted() {
        console.log('Component mounted.')
        axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));
    },

    data() {
        return {
            UserDetails:{},

        }
    },

    methods: {

    },

    created() {

    }
}
</script>
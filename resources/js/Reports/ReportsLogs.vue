<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Report Logs
                <small>Table of Logs</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <router-link to="/dashboard">
                        <i class="fa fa-dashboard"></i> 
                        Dashboard
                    </router-link>
                </li>
                <li class="active">
                    <i class="fa fa-cogs"></i> 
                    File Maintenance
                </li>
                <li class="active">
                    <i class="fa fa-cog"></i> 
                    Logs
                </li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Report Logs</h3>

                            <div class="box-tools">
                                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                                    <input v-model="search" type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <table class="table table-hover text-center">
                                <tbody>
                                    <tr>
                                        <th>Date</th>
                                        <th>Account No</th>
                                        <th>Trace</th>
                                        <th>Time Modified</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    <tr v-for="log in filteredLogs" :key="log._id">
                                        <td>{{log.TransactionDate | DateFormat}}</td>
                                        <td>{{log.AcctNo}}</td>
                                        <td>{{log.Transaction}}</td>
                                        <td>{{log.TransactionDate | DatePassed}}</td>
                                        <td>
                                            <span class="label label-success">Approved</span>
                                        </td>
                                        <td>
                                            <router-link :to="`/logs? ${log._id}`" class="btn btn-info" style="text-decoration: none;">
                                                <i class="fa fa-eye"></i>
                                                View
                                            </router-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <pagination :data="logs" :limit="2" @pagination-change-page="getResults" class="pull-right">
                                <span slot="prev-nav">&lt; Previous</span>
                                <span slot="next-nav">Next &gt;</span>
                            </pagination>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            logs: {},
            search: '',
        }
    },

    methods: {
        getResults(page = 1) {
            axios.get('api/logs?page=' + page).then(({data}) => {
                this.logs = data;
            });
        },

        loadLogs() {
            axios.get('api/logs').then(({data}) => {
                this.logs = data
            }).catch(() => {

            })
        }
    },

    created() {
        this.loadLogs()
        setInterval(() => {
            this.loadLogs()
            console.log(this.loadLogs());
        }
        , 60000)

        
    },

    computed: {
        // filteredList() {
        //     return this.logs.filter(log => {
        //         return log.AcctNo.toLowerCase().includes(this.search.toLowerCase())
        //     })
        // },

        filteredLogs() {
            if(this.search){
                return this.logs.data.filter(value => {
                    return value.TransactionDate.toLowerCase().includes(this.search.toLowerCase());
                })
            }else{
                return this.logs.data;
            }

            console.log(filterLog);
        }
    }
}
</script>
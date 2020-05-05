<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Log
                <small>Detail of Log</small>
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
                    Logs
                </li>
                <li class="active">
                    <i class="fa fa-cog"></i>
                    Log
                </li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img
                                class="profile-user-img img-responsive img-circle"
                                src="/img/user4-128x128.jpg"
                                alt="User profile picture"/>

                            <h3 class="profile-username text-center">
                                Nina Mcintire
                            </h3>

                            <p class="text-muted text-center">
                                {{ details.AcctNo }}
                            </p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Transaction ID</b>
                                    <a class="pull-right">{{ details.TransaID }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Transaction Date</b>
                                    <a class="pull-right">{{ details.TransactionDate | DateFormat }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Status</b>
                                    <a class="pull-right"><span class="label label-danger">Error</span></a>
                                </li>
                            </ul>

                            <router-link to="/report-logs" class="btn btn-primary btn-block" style="text-decoration: none;">
                                <b>Back</b>
                            </router-link>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#info" data-toggle="tab">Information</a>
                            </li>
                            <li>
                                <a href="#coverage" data-toggle="tab">Coverages</a>
                            </li>
                            <li>
                                <a href="#charges" data-toggle="tab">Charges</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="info">
                               <ol v-for="value in orderedOptionNo" :key="value.OptionNo" class="list-group list-group-unbordered">
                                   <li class="list-group-item">Option No: {{ value.OptionNo }}</li>
                               </ol>
                            </div>

                            <div class="tab-pane" id="coverage">
                                <div v-for="value in orderedCoverages" :key="value.OptionNo">
                                    <h4>Option No: {{ value.OptionNo }}</h4>
                                    <ol v-for="value in value.ListCoverages || value.OldCoverages" :key="value.CoveragesName">
                                        <li>Perils Name: {{ value.PerilsName }} - {{ value.CoveragesAmount }}</li>
                                    </ol>
                                </div>
                            </div>

                            <div class="tab-pane" id="charges">
                                <div v-for="value in orderedCharges" :key="value._id">
                                    <h4>Option No: {{ value.OptionNo }}</h4>
                                    <ol v-for="value in value.OldChargers" :key="value._id">
                                        <li>Charges Name: {{ value.ChargesName }} - {{ value.ChargesPremium }}</li>
                                    </ol>
                                </div>
                            </div>
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
            details: {}
        };
    },

    created() {
        let uri = window.location.href.split("?");
        let PassID = uri[1].trim();
        axios
            .get("api/log/" + PassID)
            .then(({ data }) => (this.details = data));
        // console.log(PassID);
    },

    computed: {
        orderedOptionNo() {
            return _.orderBy(this.details.OldRecord, 'OptionNo')
        },

        orderedCoverages() {
            return _.orderBy(this.details.OldRecord, 'OptionNo')
        },

        orderedCharges() {
            return _.orderBy(this.details.OldRecord, 'OptionNo')
        }
    }
};
</script>

<style scoped>
    li.list-group-item>a {
        text-decoration: none;
        cursor: pointer;
    }
</style>

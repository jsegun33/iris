<template>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-body" id="requestpreview" >
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="page-header">
                                    <img src="/img/rsilogo.png" alt="RSILogo" style="height: 50px;">
                                    <small class="pull-right">Date: {{date}}</small>
                                </h2>
                            </div>
                        </div>
                        
                        <div class="row"  >
                            <div class="col-md-2 ">
                                <strong>To</strong> <strong class="pull-right">:</strong> <br> <br>
                                <strong>From</strong> <strong class="pull-right">:</strong> <br> <br>
                                <strong>Subject</strong> <strong class="pull-right">:</strong> <br> <br>
                            </div>
                            <div class="col-md-5 ">
                                <strong>Juan Dela Cruz</strong> <br> <br>
                                <strong>Juan Dela Cruz</strong> <br> <small>Customer Relations Department</small> <br>
                                <strong>MOTOR CAR INSURANCE QUOTATION</strong> <br> <br>
                            </div>
                            <div class="col-md-12 ">
                                <p>We are pleased to present to you our Motor Car Insurace quotation the particulars are as follows:</p>
                                <br>
                                <div class="col-md-2 ">
                                    <strong>Unit</strong> <strong class="pull-right">:</strong>
                                </div>
                                <div class="col-md-6 ">
                                    <strong>2019 TOYOTA VIOS A/T</strong>
                                </div>
                            </div>
                        </div>

                        <div v-for="(mc, index) in mcs" :key="index">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr v-if="mc.coverages.ctpl > 0">
                                                    <th>CTPL</th>
                                                    <td>200,000.00</td>
                                                    <td>8,125.00</td>
                                                </tr>
                                                <tr v-if="mc.coverages.odth > 0">
                                                    <th>Own Damage/Theft</th>
                                                    <td>200,000.00</td>
                                                    <td>8,125.00</td>
                                                </tr>
                                                <tr v-if="mc.coverages.pd > 0">
                                                    <th>Third Party Property Damage</th>
                                                    <td>200,000.00</td>
                                                    <td>1,245.00</td>
                                                </tr>
                                                <tr v-if="mc.coverages.xbi > 0">
                                                    <th>Third Party Bodily Injury</th>
                                                    <td>200,000.00</td>
                                                    <td>420.00</td>
                                                </tr>
                                                <tr>
                                                    <th>Personal Accident</th>
                                                    <td>250,000.00</td>
                                                    <td id="sub-total">625.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-9">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th><i>Net Premium</i></th>
                                                    <td></td>
                                                    <td>10,415.00</td>
                                                </tr>
                                                <tr>
                                                    <th><i>Doc. Stamps</i></th>
                                                    <td></td>
                                                    <td>1,302.00</td>
                                                </tr>
                                                <tr>
                                                    <th><i>ROAD-SIDE ASSISTANCE</i></th>
                                                    <td></td>
                                                    <td>300.00</td>
                                                </tr>
                                                <tr>
                                                    <th><i>12% VAT</i></th>
                                                    <td></td>
                                                    <td>1,249.80</td>
                                                </tr>
                                                <tr>
                                                    <th><i>LGT</i></th>
                                                    <td></td>
                                                    <td id="sub-totals">12.61</td>
                                                </tr>
                                                <tr>
                                                    <th><strong>Amount Due</strong></th>
                                                    <td></td>
                                                    <td id="total">13,279.41</td>
                                                </tr>
                                                <br>
                                                <tr>
                                                    <th><strong>Deductible</strong></th>
                                                    <td><strong>3,250</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Coverage -->

                        <!-- <div class="row no-print">
                            <div class="col-xs-12">
                                <router-link to="/print" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</router-link>
                                <a href="" class="btn btn-success pull-right">
                                    <i class="fa fa-credit-card"></i>
                                    Submit Proposal
                                </a>
                                <router-link to="/proposal-lists" class="btn btn-primary pull-right" style="margin-right: 5px; text-decoration: none;">
                                    Back
                                </router-link>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'mcs'
    ],
    data() {
        return {

        }
    },
    

    methods: {

    },

    computed: {
        
        date() {
           let date = new Date()
           let day = date.getDate()
           let month = date.getMonth() + 1
           let year = date.getFullYear()
           return `${month} / ${day} / ${year}`
        }
    }
}
</script>
<template>
    <div>
        <RequestHeader/>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <strong>Motor Car Details</strong>
                            </h3>
                        </div>
                        <RequestForm @new-motorcar-details="motorcarDetails" @new-personal-details="personalDetails" />
                    </div>
                </div>
                <!-- <div v-if="motorcar || personal"> -->
                    <RequestPreview :motorcar="motorcar" :personal="personal" :coverages="coverages" />
            </div>
        </section>
    </div>
</template>

<script>
import RequestHeader from '../components/PageHeaders/RequestHeader'
import RequestForm from '../components/ProposalComponent/RequestForm/Index'
import RequestPreview from '../components/ProposalComponent/RequestPreview'

export default {
    components: {
        RequestHeader,
        RequestForm,
        RequestPreview,
    },

    data() {
        return {
            motorcar: null,
            coverages: null,
            personal: null,
        }
    },

    methods: {
        motorcarDetails(motorcar, coverages) {
            this.motorcar = motorcar
            this.coverages = coverages
        },

        personalDetails(val) {
            this.personal = val
        },

        requestForm(RequestForm) {
            this.request = RequestForm
        },
        getBrand(numbers) {
            this.prevs.brand = numbers
        },

        getYear(years) {
            this.UNIT.year = years
        },

        getAccessories(Accessories) {
            this.use.accessories = Accessories
        },
        getNetWeight(Net) {
            this.use.netweight = Net
        },
        getUsage(Usage) {
            this.use.usage = Usage
        },
    }
}
</script>
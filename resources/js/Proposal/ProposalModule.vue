<template>
    <div>
        <section class="content-header">
            <h1>
                Proposal
                <small>Proposal Form</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#"><i class="fa fa-file-text"></i> Proposal / Quotation</a></li>
                <li class="active">
                    <a href="">
                        <i class="fa fa-file-text"></i> 
                        Proposal
                    </a>
                </li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <ProposalForm v-on:mc-proposal="newMc"/>
                <!-- <ProposalPreview :mcs="mc"/> -->
            </div>
        </section>
    </div>
</template>

<script>
import ProposalForm from '../components/ProposalComponent/ProposalForm'
import ProposalPreview from '../components/ProposalComponent/ProposalPreview'
export default {
    data() {
        return {
            mc: null,
        }
    },

    methods: {
        newMc(newMcPremium) {
            this.mc = newMcPremium

            console.log(this.mc)
        }
    },

    components: {
        ProposalForm,
        ProposalPreview
    },
}
</script>
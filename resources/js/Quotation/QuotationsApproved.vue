<template>
    <div>
        <section class="content-header">
            <h1>
                Quotation List
                <small>Table of Quotation</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Quotation List</li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"><strong>List of all Quotations</strong></h3>
                </div>

                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="dataTables_length" id="example1_length">
                                    <label class="pull-left">Show: 
                                        <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                                            <option value="10">Client</option>
                                            <option value="25">Agent</option>
                                            <option value="50">Public</option>
                                            <option value="100">Employee</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="example1_filter" class="dataTables_filter">
                                    <label class="pull-right">Search:
                                        <input type="search" class="form-control input-sm" placeholder="" aria-controls="example1">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="example1" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column descending" style="width: 297px;" aria-sort="ascending">Date</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 361px;">Unit</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 322px;">Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 257px;">Status</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 190px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr role="row" class="odd"  v-for="Proposals in ApprovedProposals.data" :key="Proposals._id">
                                            <td class="sorting_1">September 9, 2019</td>
                                            <td>{{Proposals.MotorYear}} {{Proposals.MotorBrand}} {{Proposals.MotorModel}} {{Proposals.MotorBodyType}}</td>
                                            <td>{{Proposals.FirstName}} {{Proposals.MiddleName}} {{Proposals.LastName}}</td>
                                            <td>Approved</td>
                                            <td>
                                                <a v-bind:href="'/options?' + Proposals.RequestNo" class="btn btn-info">
                                                   <i class="fa fa-eye"></i> 
                                                   View
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                    Showing 1 to 10 of 57 entries
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                    <ul class="pagination pull-right">
                                        <li class="paginate_button previous disabled" id="example1_previous">
                                            <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a>
                                        </li>
                                        <li class="paginate_button active">
                                            <a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a>
                                        </li>
                                        <li class="paginate_button ">
                                            <a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a>
                                        </li>
                                        <li class="paginate_button ">
                                            <a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a>
                                        </li>
                                        <li class="paginate_button ">
                                            <a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a>
                                        </li>
                                        <li class="paginate_button ">
                                            <a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a>
                                        </li>
                                        <li class="paginate_button ">
                                            <a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a>
                                        </li>
                                        <li class="paginate_button next" id="example1_next">
                                            <a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a>
                                        </li>
                                    </ul>
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
            ApprovedProposals: {},
        }
    },

    methods: {
        loadProposal() {
            axios.get("api/GetRequestQuotation").then(({ data }) => (this.ApprovedProposals = data));
        },
    },

    created() {
        this.loadProposal()
    }
}
</script>
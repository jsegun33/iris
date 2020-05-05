<template>
<div>
    <div class="col-md-12" >
        <div class="box box-success">
            <!-- Personal Details -->
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Personal Details</strong></h3>
            </div>
            <form>
                <input type="hidden" v-model="form.RequestNoPass" />
                <input type="hidden" v-model="form.RequestNoOptionNo" />
            
                <input type="hidden" v-model="form.ToSAvedAmountRequest" />
                <input type="hidden" v-model="form.PerilsNameForDisplay" />
                <input
                    type="hidden"
                    v-model="form.PerilsNameAmountForDisplay"
                />
                <input
                    type="hidden"
                    v-model="form.ChargesNameAmountForDisplay"
                />
                <input type="hidden" v-model="form.TxtChargesNameID" />
                <input
                    type="hidden"
                    v-model="form.TxtChargesPremiumForDisplay"
                />

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tin">TIN Number:</label>
                                <input
                                    v-model="form.TINNumber"
                                    class="form-control"
                                    type="text"
                                    name="tin"
                                    id="tin"
                                    placeholder="Enter TIN Number"
                                />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email Address:</label>
                                <input
                                    v-model="form.EmailAddress"
                                    class="form-control"
                                    type="email"
                                    name="email"
                                    id="email"
                                    placeholder="Enter Email Address"
                                />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact">Contact Number:</label>
                                <input
                                    v-model="form.ContactNumber"
                                    class="form-control"
                                    type="text"
                                    name="contact"
                                    id="contact"
                                    placeholder="Enter Contact Number"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name">First Name:</label>
                                <input
                                    v-model="form.FirstName"
                                    class="form-control"
                                    type="text"
                                    name="first_name"
                                    id="first_name"
                                    placeholder="Enter First Name"
                                />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="middle_name">Middle Name:</label>
                                <input
                                    v-model="form.MiddleName"
                                    class="form-control"
                                    type="text"
                                    name="middle_name"
                                    id="middle_name"
                                    placeholder="Enter Middle Name"
                                />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_name">Last Name:</label>
                                <input
                                    v-model="form.LastName"
                                    class="form-control"
                                    type="text"
                                    name="last_name"
                                    id="last_name"
                                    placeholder="Enter Last Name"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input
                                    v-model="form.Address"
                                    class="form-control"
                                    type="text"
                                    name="address"
                                    id="address"
                                    placeholder="Enter Address"
                                />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="barangay">Barangay:</label>
                                <select
                                    v-model="form.Barangay"
                                    class="form-control"
                                    name="barangay"
                                    id="barangay"
                                >
                                    <option value="">Select Barangay</option>
                                    <option value="Barangay 288"
                                        >Barangay 288</option
                                    >
                                    <option value="Barangay 289"
                                        >Barangay 289</option
                                    >
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">City:</label>
                                <select
                                    v-model="form.City"
                                    class="form-control"
                                    name="city"
                                    id="city"
                                >
                                    <option value="">Select City</option>
                                    <option value="Quezon City"
                                        >Quezon City</option
                                    >
                                    <option value="Manila City"
                                        >Manila City</option
                                    >
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Coverage -->
                <div class="box-header with-border box box-success">
                    <h3 class="box-title">
                        <strong>Motor Car Details</strong>
                    </h3>
                </div>
                <div class="box-body">
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-md-3">
                            <div class="form-goup">
                                <label for="rate">Denomination:</label>
                                <input
                                    v-model="form.Denomination"
                                    class="form-control"
                                    type="text"
                                    name="Denomination"
                                    id="Denomination"
                                    placeholder="Enter Denomination"
                                    readonly
                                />
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-goup">
                                <label for="surcharge">USAGE:</label>
                                <select
                                    class="form-control"
                                    name="surcharge"
                                    id="surcharge"
                                    @change="UsageChange($event)"
                                >
                                    <option selected disabled>
                                        {{ form.OptSurcharge }}
                                    </option>
                                    <option value="Personal">Personal </option>
                                    <option value="Commercial"
                                        >Commercial</option
                                    >
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-goup">
                                <label for="surcharge">PO AMNT:</label>
                                <input
                                    type="text"
                                    v-model="form.MotorPOAmount"
                                    class="form-control"
                                />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-goup">
                                <label for="surcharge"
                                    >Depreciative AMNT:</label
                                >
                                <input
                                    type="text"
                                    v-model="form.DepreciativeAmount"
                                    class="form-control"
                                    readonly
                                />
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-goup">
                                <label for="surcharge">COVERAGE:</label>
                                <input
                                    type="text"
                                    v-model="form.CoverageAmount"
                                    class="form-control"
                                    readonly
                                />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-goup">
                                <label for="type">TYPE:</label>
                                <input
                                    v-model="form.TypeClass"
                                    type="text"
                                    class="form-control text-center"
                                    name="type"
                                    id="type"
                                    value="PC1"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="col-md-3">
                                <div class="form-goup">
                                    <label for="year">Year:</label>

                                    <select
                                    class="form-control"
                                    name="MotorYear"
                                    id="MotorYear"
                                    v-model="form.MotorYear"
                                  >
                                   
                                    <option value="2018">2018 </option>
                                    <option value="2019"  >2019</option
                                    >
                                </select>


                                   
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-goup">
                                    <label for="brand">Brand:</label>
                                    <input
                                        v-model="form.MotorBrand"
                                        type="text"
                                        class="form-control"
                                        name="brand"
                                        id="brand"
                                        placeholder="Enter Car Brand"
                                        value="TOYOTA"
                                    />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-goup">
                                    <label for="model">Model:</label>
                                    <input
                                        v-model="form.MotorModel"
                                        type="text"
                                        class="form-control"
                                        name="model"
                                        id="model"
                                        placeholder="Enter Car Model"
                                        value="INNOVA"
                                    />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-goup">
                                    <label for="bodytype">Body Type:</label>
                                    <input
                                        v-model="form.MotorType"
                                        type="text"
                                        class="form-control"
                                        name="bodytype"
                                        id="bodytype"
                                        placeholder="Enter Body Type"
                                        value="A/T"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!----------------------------Default From Request------------------------------------------------------------------->
                <div class="box box-success" 
                    v-for="URLQueryPerilsCoveragesGroups in URLQueryPerilsCoveragesGroup"
                    :key="URLQueryPerilsCoveragesGroups._id">
                    <div class="box-header with-border">
                        <h3 class="box-title" style="text-align:left;">
                            <strong>
                                Quotation #:
                                {{URLQueryPerilsCoveragesGroups.RequestNo + "-" + URLQueryPerilsCoveragesGroups.OptionNo}}
                            </strong>
                        </h3>
                    </div>
                    
                    <div class="box-body">
                        <div class="form-goup">
                            <input
                                v-model="form.RatePercent"
                                @input="KeyPressRateAmount()"
                                @change="ChangeRateAmount()"
                                type="hidden"
                                class="form-control"
                            />
                            <input type="hidden" v-model="form.ODQueryPassID" />
                            <input type="hidden" v-model="form.TFQueryPassID" />
                            <input
                                type="hidden"
                                v-model="form.GetCurrentClickBySelect"
                            />
                            <input
                                type="hidden"
                                v-model="form.TxtPreviousCoveragesPremium"
                            />
                            <input
                                type="hidden"
                                v-model="form.TxtUpdatedCoveragesPremium"
                            />
                            <input type="hidden" v-model="form.GetOptionNo" />
                            <input
                                type="hidden"
                                v-model="form.QueryCoveragesAmount"
                            />
                            <input
                                type="hidden"
                                v-model="form.QueryCoveragesName"
                            />
                            <input type="hidden" v-model="form.QueryCoveragesID" />

                            <input type="hidden" v-model="form.PostRequestNO" />
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rate" class="pull-left">Coverage Rate:</label>
                                    <input @change="ChangeRateAmount()"
                                            v-model="form.CoveragesRate[URLQueryPerilsCoveragesGroups.OptionNo]"
                                            type="text"
                                            class="form-control"
                                            id="rate"/>
                                </div>
                        </div>
                        </div>
                    <div class="row text-center" style="margin-bottom: 10px;">
                        <div class="col-md-2">
                            <label for="">Code</label>
                            <div class="form-group">
                                <input
                                    type="text"
                                    v-for="coverage in URLQueryPerilsCoveragesGroups.ListCoverages"
                                    :key="coverage._id"
                                    class="form-control input-sm text-left"
                                    v-model="
                                        form.TxtCoveragesName[coverage._id]
                                    "
                                    style="width:250px;font-size:10px"
                                    readonly
                                />
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="">Amount</label>
                            <div class="form-group">
                                <div
                                    class="input-group"
                                    v-for="coverage in URLQueryPerilsCoveragesGroups.ListCoverages"
                                    :key="coverage._id"
                                >
                                    <select 
                                        class="form-control input-sm"
                                        @change="
                                            SelectByAmountRequest(
                                                $event,
                                                coverage
                                            )
                                        "
                                    >
                                        <option selected disabled>{{
                                            form.TxtOptionAmountRequest[
                                                coverage._id
                                            ]
                                        }}</option>
                                        <option
                                            v-for="GetPerilsCoverageAmountByDefaults in GetPerilsCoverageAmountByDefault.data"
                                            :key="
                                                GetPerilsCoverageAmountByDefaults._id
                                            "
                                            v-bind:value="
                                                GetPerilsCoverageAmountByDefaults.CoverageAmount
                                            "
                                            >{{
                                                GetPerilsCoverageAmountByDefaults.CoverageAmount
                                            }}</option
                                        >
                                    </select>
                                   

                                    <span class="input-group-addon">
                                        <input
                                            v-model="
                                                form.TxtSelectAmount[
                                                    coverage._id
                                                ]
                                            "
                                            checked
                                            @change="CheckBoxAmount(coverage)"
                                            type="checkbox"
                                        />
                                    </span>
                                    <input
                                        type="hidden"
                                        v-model="
                                            form.TxtOptionAmountRequest[
                                                coverage._id
                                            ]
                                        "
                                    />
                                    <input
                                        type="hidden"
                                        v-model="
                                            form.CoveragesRateSave[coverage._id]
                                        "
                                    />
                                </div>
                                <label>Total Premium</label><br />
                                <label>Total Coverages</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="">Premium</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input
                                        type="text"
                                        v-for="coverage in URLQueryPerilsCoveragesGroups.ListCoverages"
                                        :key="coverage._id"
                                        class="form-control input-sm text-center"
                                        v-model="
                                            form.TxtCoveragesPremium[
                                                coverage._id
                                            ]
                                        "
                                        readonly
                                    />
                                    <input
                                        type="text"
                                        v-model="
                                            form.TxtPremiumAmount[
                                                URLQueryPerilsCoveragesGroups
                                                    .OptionNo
                                            ]
                                        "
                                        class="form-control input-sm text-center"
                                        readonly
                                    />
                                    <input
                                        type="text"
                                        v-model="
                                            form.TxtCoverageAmount[
                                                URLQueryPerilsCoveragesGroups
                                                    .OptionNo
                                            ]
                                        "
                                        class="form-control input-sm text-center"
                                        readonly
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="">Charges</label>
                            <div class="form-group">
                                <input
                                    type="text"
                                    v-for="Charges in URLQueryPerilsCoveragesGroups.ListCharges"
                                    :key="Charges._id"
                                    class="form-control input-sm"
                                    v-bind:value="Charges.ChargesName"
                                    readonly
                                />
                            </div>

                            <label>Total Charges</label>
                                <br/>
                            <label>Total Amount Due</label>
                            <label>Deductible Amount</label>
                        </div>
                        <div class="col-md-2">
                            <label for="">Amount</label>
                            <div class="form-group">
                                <input
                                    type="text"
                                    v-for="Charges in URLQueryPerilsCoveragesGroups.ListCharges"
                                    :key="Charges._id"
                                    v-model="
                                        form.TxtChargesPremium[Charges._id]
                                    "
                                    class="form-control input-sm text-center"
                                    readonly
                                />
                                <!--------<span class="input-group-addon"  >
                                                    <input    
                                                    v-model='form.TxtSelectAmount[URLQueryPerilsCharges._id]'
                                                    @click="onClick(), DisplayMapByAmount(URLQueryPerilsCharges)"
                                                    type="checkbox"  >
                                              </span>------>
                            </div>
                            <input
                                type="text"
                                class="form-control input-sm text-center"
                                v-model="
                                    form.TotalCharges[
                                        URLQueryPerilsCoveragesGroups.OptionNo
                                    ]
                                "
                                disabled
                            />
                            <input
                                type="text"
                                class="form-control input-sm text-center"
                                v-model="
                                    form.AmountDue[
                                        URLQueryPerilsCoveragesGroups.OptionNo
                                    ]
                                "
                                disabled
                            />
                            <input
                                type="text"
                                class="form-control input-sm text-center"
                                v-model="form.Deductible[
                                        URLQueryPerilsCoveragesGroups.OptionNo
                                    ]"
                                disabled
                            />
                        </div>
                    </div>
                    </div>
                </div>

                <!-------------------------when add is click----------------------------------------------------------------------->
                <div
                    class="box-header box box-success"
                    v-for="(LoopTRs, index) in LoopTR"
                    :key="index"
                >
                    <h3 class="box-title"><strong>Quotation # </strong></h3>
                    <div class="row text-center" style="margin-bottom: 10px;">
                        
                       
                        <input
                            v-model="form.RatePercentADD"
                            type="hidden"
                            class="form-control"
                        />

                        <input
                            type="hidden"
                            v-model="form.ToSAvedAmountRequestADD"
                        />
                        <input
                            type="hidden"
                            v-model="form.PerilsNameForDisplayADD"
                        />
                        <input
                            type="hidden"
                            v-model="form.PerilsNameAmountForDisplayADD"
                        />
                        <input
                            type="hidden"
                            v-model="form.PerilsPremiumForDisplayADD"
                        />
                        <input
                            type="hidden"
                            v-model="form.PassChargesChargesNo"
                        />
                        <input
                            type="hidden"
                            v-model="form.PassChargesChargesName"
                        />
                        <input
                            type="hidden"
                            v-model="form.PassChargesChargesAmount"
                        />

                        <div class="col-md-2">
                            <label for="">Code</label>
                            <div class="form-group">
                                <input
                                    type="text"
                                    style="width:250px;font-size:10px;text-align:left"
                                    v-for="PerilsLists in GetDefaultPerilsForADD.data"
                                    :key="PerilsLists._id"
                                    class="form-control input-sm text-center"
                                    v-model="
                                        form.TxtCoveragesNameAdd[
                                            PerilsLists._id
                                        ]
                                    "
                                    v-model:value="PerilsLists.PerilsName"
                                    readonly
                                />
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="">Amount</label>
                            <div class="form-group">
                                <div
                                    class="input-group"
                                    v-for="PerilsLists in GetDefaultPerilsForADD.data"
                                    :key="PerilsLists._id"
                                >
                                    <select
                                        class="form-control input-sm"
                                        @change="
                                            SelectByAmountRequestADD(
                                                $event,
                                                PerilsLists
                                            )
                                        "
                                    >
                                        <option selected disabled>{{
                                            PerilsLists.CoverageAmount
                                        }}</option>
                                        <!-----<option    v-for="GetPerilsCoverageAmountByDefaults in GetPerilsCoverageAmountByDefault.data" :key="GetPerilsCoverageAmountByDefaults._id"  v-bind:value="GetPerilsCoverageAmountByDefaults.CoverageAmount"  >{{ GetPerilsCoverageAmountByDefaults.CoverageAmount }}</option>--->
                                    </select>

                                    <span class="input-group-addon">
                                        <input
                                            v-model="
                                                form.TxtSelectAmountAdd[
                                                    PerilsLists._id
                                                ]
                                            "
                                            checked
                                            @change="
                                                CheckBoxAmountADD(PerilsLists)
                                            "
                                            type="checkbox"
                                        />
                                    </span>
                                    <input
                                        type="hidden"
                                        v-model="
                                            form.TxtOptionAmountRequestAdd[
                                                PerilsLists._id
                                            ]
                                        "
                                    />
                                </div>
                                <label>Total Premium</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="">Premium</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input
                                        type="text"
                                        v-for="PerilsLists in GetDefaultPerilsForADD.data"
                                        :key="PerilsLists._id"
                                        class="form-control input-sm text-center"
                                        v-model="
                                            form.TxtCoveragesPremiumAdd[
                                                PerilsLists._id
                                            ]
                                        "
                                        readonly
                                    />
                                    <input
                                        type="text"
                                        v-model="form.TxtPremiumAmountAdd"
                                        class="form-control input-sm text-center"
                                        value="Total"
                                        readonly
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="">Charges</label>
                            <div class="form-group">
                                <input
                                    type="text"
                                    v-for="GetProductLineChargess in GetProductLineCharges.data"
                                    :key="GetProductLineChargess._id"
                                    class="form-control input-sm"
                                    v-bind:value="
                                        GetProductLineChargess.ChargesName
                                    "
                                    readonly
                                />
                            </div>

                            <label style="margin: 5px 0px;">Total Charges</label>
                            <br/> 
                            <label style="margin: 5px 0px;">Total Amount Due</label>
                            <br>
                            <label style="margin: 5px 0px;">Deductible Amount</label>
                        </div>
                        <div class="col-md-2">
                            <label for="">Amount</label>
                            <div class="form-group">
                                <input
                                    type="text"
                                    v-for="GetProductLineChargess in GetProductLineCharges.data"
                                    :key="GetProductLineChargess._id"
                                    v-model="
                                        form.TxtChargesPremiumAdd111[
                                            GetProductLineChargess._id
                                        ]
                                    "
                                    class="form-control input-sm text-center"
                                    readonly
                                />
                            </div>
                            <input
                                type="text"
                                class="form-control input-sm text-center"
                                v-model="form.TotalChargesAdd"
                                disabled
                            />
                            <input
                                type="text"
                                class="form-control input-sm text-center"
                                v-model="form.AmountDueAdd"
                                disabled
                            />
                            <input
                                type="text"
                                class="form-control input-sm text-center"
                                v-model="form.DeductibleAdd"
                                disabled
                            />
                        </div>
                    </div>
                    <button
                        @click="SubmitNewCoverages()"
                        type="button"
                        class="btn btn-primary pull-left"
                        style="margin-right: 5px;"
                    >
                        Submit
                    </button>
                </div>

                <!-------------------------when add is click----------------------------------------------------------------------->

                <!-------------------------<pre>{{ $data }}</pre>----------------------------------------------------------------------->
            </form>
            <div
                class="box-footer"
                v-if="
                    form.QuoteExpiryStatus == 0 || form.QuoteExpiryStatus == 2
                "
            >
                <button
                    @click="UpdateQuotation()"
                    type="submit"
                    class="btn btn-success pull-right"
                    v-if="
                        form.QuoteExpiryStatus == 0 ||
                            form.QuoteExpiryStatus == 2
                    "
                >
                    Update
                </button>
                <button
                    @click="DeleteNewQuotation()"
                    class="btn btn-danger pull-right"
                    style="margin-right: 5px;"
                >
                    REMOVE
                </button>
                <button
                    @click="loadGetRequestDetails()"
                    class="btn btn-primary pull-right"
                    style="margin-right: 5px;"
                >
                    ADD
                </button>
            </div>
        </div>

        <div
            v-for="data in URLQueryPerilsCoveragesPreview.data"
            :key="data._id"
        >
            {{ data.requestStatus }} <br /><br />
            {{ data.RequestNo }} <br /><br />
            <div v-for="coverage in data.CoveragesAmount" :key="coverage._id">
                {{ coverage.CoverageName }} <br />
                <br />
                {{ coverage.CoveragePremium }}
            </div>
        </div>
    </div>

    <div>
        <button class="open-button" @click="openForm()">Preview</button>

        <div class="chat-popup" id="myForm">
            <div class="box-body form-container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-header">
                            <img src="/img/rsilogo.png" alt="RSILogo" id="quoteslogo">
                            <small class="pull-right"><strong> Date: {{date}} </strong></small>
                        </h2>
                    </div>
                </div>

                <div class="row text-center">
                    <div class="col-md-12">
                        <h3>Request for Proposal</h3>
                    </div>
                </div>
                
                <section class="content" style="height:50px; overflow-y: scroll; ">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2" style="padding: 0px;">
                                <p><b>Assured</b><b class="pull-right">:</b></p>
                                <p><b>Address</b><b class="pull-right">:</b></p>
                                <p><b>Unit</b><b class="pull-right">:</b></p>
                                <p><b>Coverage</b><b class="pull-right">:</b></p>
                            </div>
                            <div class="col-md-10" style="padding: 0px 0px 0px 10px;">
                                <p>{{form.FirstName + " " +   form.MiddleName + " " +  form.LastName}}</p>
                                <p>{{ form.Address + " " +   form.Barangay + " " + form.City}}</p>
                                <p>{{ form.MotorYear + " " +   form.MotorBrand + " " + form.MotorModel + " " + form.MotorType  }}</p>
                               
                                <div class="table-responsive"  >
                                    
                                        <table  v-for="URLQueryPerilsCoveragesGroups in URLQueryPerilsCoveragesGroup"
                                                                :key="URLQueryPerilsCoveragesGroups._id">
                                              <p><strong>Quotation # :</strong>  {{URLQueryPerilsCoveragesGroups.RequestNo + "-" + URLQueryPerilsCoveragesGroups.OptionNo }} 
                                              <br/> <strong>Rate :</strong> {{ form.CoveragesRate[URLQueryPerilsCoveragesGroups.OptionNo]}}</p>             
                                            <tr > 
                                                    
                                                    <th style=" border: 0.5px solid black;">Perils Name</th>
                                                    <th style=" border: 0.5px solid black;">Amount</th>
                                                    <th style=" border: 0.5px solid black;">Premium</th>
                                            </tr>
                                            
                                            <tr  v-for="coverage in URLQueryPerilsCoveragesGroups.ListCoverages"
                                                        :key="coverage._id" > 
                                                    
                                                    <td style=" border: 0.5px solid black;">{{coverage.PerilsName}}</td>
                                                    <td style=" border: 0.5px solid black;text-align:right">{{coverage.CoveragesAmount}}</td>
                                                    <td style=" border: 0.5px solid black;text-align:right">{{coverage.CoveragesPremium}}</td>
                                            </tr>
                                            <tr >  <th >Total</th>  
                                                <th style="text-align:right">{{ form.TxtPremiumAmount[URLQueryPerilsCoveragesGroups.OptionNo]}}</th>
                                               <th style="text-align:right">{{ form.TxtCoverageAmount[URLQueryPerilsCoveragesGroups.OptionNo]}}</th>
                                            
                                            </tr>
                                             <tr >  <th ><br/><br/></th></tr>

                                        </table>
                                    

                                </div>
                            </div>
                            
                           



                        </div>
                    </div>
                </section>
                <button type="button" class="btn cancel" @click="closeForm()">Close</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    mounted: function() {
        console.log("Component mounted.");
        
        this.AutoLoad();
    },  

    data() {
        return {
            ResultQueryRequest: {},
             UserDetails:{},
            URLQueryPerilsCoverages: {},
            URLQueryPerilsCoveragesPreview: {},
            URLQueryPerilsCoveragesGroup: {},
            GetDefaultPerilsForADD: {},
            PerilsList: {},
            GetPerilsTaripa: {},
            GetPerilsCoverageAmount: {},
            ResultSelectByAmount: {},
            //URLQueryPerilsCharges:{},
            GetPerilsCoverageAmountByDefault: {},
            GetPerilsTaripaByAmount: {},
            GetPerilsTaripaByAmountADD: {},
            GetProductLineCharges: {},
            GetPerilsTaripaByAmountADDs: {},
            RetrieveTimeInterval: null,
            RetrieveTimeInterval1: null,
            CheckNameTrue: true,
            CheckNamefalse: false,
            LoopTR: [],

            form: new Form({
                TINNumber: "",
                EmailAddress: "",
                ContactNumber: "",
                FirstName: "",
                LastName: "",
                MiddleName: "",
                Address: "",
                Barangay: "",
                City: "",
                Denomination: "",
                RatePercent: "",
                Surcharge: "",
                CoverageAmount: "",
                TypeClass: "",
                MotorYear: "",
                MotorBrand: "",
                MotorModel: "",
                MotorType: "",
                CoveragesRateSave: [],
                SelectCoverageAmounts: [],
                ProductLine: "",
                SelectPremiumAmount: [],
                TxtSelectAmount: [],
                SelectTotalPremium: [],
                CompTotalPremium: 0,
                TxtCoveragesPremium: [],
                TxtChargesPremium: [],
                TxtByAmountRequest: [],
                OptionAmountRequest: [],
                TxtOptionAmountRequest: [],
                ODQueryPassID: "",
                TFQueryPassID: "",
                GetCurrentClickBySelect: "",
                TxtPreviousCoveragesPremium: "",
                TxtUpdatedCoveragesPremium: "",
                GetPerilsNO: "",
                ToSAvedAmountRequest: [],
                PerilsNameForDisplay: [],
                PerilsNameAmountForDisplay: [],
                ChargesNameAmountForDisplay: [],
                TxtChargesNameID: [],
                TxtChargesPremiumForDisplay: [],
                TxtCoveragesName: [],
                DepreciativeAmount: "",
                OptSurcharge: "",
                TxtChargesPremiumAdd: [],
                TxtPremiumAmountAdd: "",
                TxtCoveragesPremiumAdd: [],
                TxtSelectAmountAdd: [],
                TxtOptionAmountRequestAdd: [],
                TxtCoveragesNameAdd: [],
                ToSAvedAmountRequestADD: [],
                PerilsNameForDisplayADD: [],
                PerilsNameAmountForDisplayADD: [],
                PerilsPremiumForDisplayADD: [],
                TxtChargesPremiumAdd111: [],
                PassChargesChargesNo: [],
                PassChargesChargesName: [],
                PassChargesChargesPremium: [],
                TxtPremiumAmount: [],
                TxtCoverageAmount: [],
                TotalCharges: [],
                AmountDue: [],
                GetOptionNo: "",
                SaveMotorUsage: "",
                QueryCoveragesAmount: [],
                QueryCoveragesName: [],
                QueryCoveragesID: [],
                RatePercentADD: "",
                PostRequestNO: "",
                CoveragesRate: [],
                QuoteExpiryStatus: "",
                passengers: "",
                CustAcctNo: "",
                CustAcctCName : "",
                PlateNumber: "",
                RequestNoOptionNo: "",
                Deductible: [],
                InputValueAmount: [],
            })
        };
    },

    methods: {
        AutoLoad() {
            axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));

            let uri = window.location.href.split("?");
            let PassID = uri[1].trim();
            axios
                .get("api/URLQueryRequestModify/" + PassID)
                .then(({ data }) => (this.ResultQueryRequest = data));
            //axios.get("api/URLQueryPerilsCoverages/" + PassID ) .then(({ data }) => (this.URLQueryPerilsCoverages = data)  );
            //axios.get("api/URLQueryPerilsCharges/" + PassID ) .then(({ data }) => (this.URLQueryPerilsCharges = data)  );
            axios
                .get("api/GetPerilsCoverageAmountByDefault/" + PassID)
                .then(({ data }) => (this.GetPerilsCoverageAmountByDefault = data));
            axios.get("api/URLQueryPerilsCoveragesPreview/" + PassID) .then(({ data }) => (this.URLQueryPerilsCoveragesPreview = data));
            axios.get("api/URLQueryPerilsCoveragesGroupEdit/" + PassID).then(({ data }) => (this.URLQueryPerilsCoveragesGroup = data));
            //When ADD is CLICK
            axios
                .get("api/GetProductLineCharges/")
                .then(({ data }) => (this.GetProductLineCharges = data));
            //axios.get("api/GetPerilsTaripaByAmountLoop/" + PassID ) .then(({ data }) => (this.GetPerilsTaripaByAmount = data)  );
        },

        QueryByOPtion() {
            this.URLQueryPerilsCoveragesPreview.data.map(
                URLQueryPerilsCoveragesPreviews => {
                    let uri = window.location.href.split("?");
                    let PassID = uri[1].trim();
                    let PassIDNew =
                        PassID +
                        ";;" +
                        URLQueryPerilsCoveragesPreviews.OptionNo;
                    //alert();
                    axios
                        .get(
                            "api/URLQueryPerilsCoveragesPreviewNew/" + PassIDNew
                        )
                        .then(
                            ({ data }) => (this.URLQueryPerilsCoverages = data)
                        );
                }
            );
        },

        AutoPushRecord() {
            this.URLQueryPerilsCoveragesGroup.map(
                URLQueryPerilsCoveragesGroups => {
                    URLQueryPerilsCoveragesGroups.ListCoverages.map(
                        ListCoveragesURL => {
                            this.form.ToSAvedAmountRequest.push(
                                parseFloat(
                                    this.form.TxtCoveragesPremium[
                                        ListCoveragesURL._id
                                    ]
                                )
                            );
                            this.form.PerilsNameForDisplay.push(
                                ListCoveragesURL._id
                            );
                            this.form.PerilsNameAmountForDisplay.push(
                                parseFloat(
                                    this.form.TxtOptionAmountRequest[
                                        ListCoveragesURL._id
                                    ]
                                )
                            );
                            this.form.CoveragesRateSave.push(
                                parseFloat(
                                    this.form.CoveragesRate[
                                        ListCoveragesURL.OptionNo
                                    ]
                                )
                            );
                        }
                    );

                    URLQueryPerilsCoveragesGroups.ListCharges.map(
                        ListChargesURL => {
                            this.form.ChargesNameAmountForDisplay.push(
                                ListChargesURL.ChargesName
                            );
                            this.form.TxtChargesNameID.push(ListChargesURL._id);
                            this.form.TxtChargesPremiumForDisplay.push(
                                parseFloat(
                                    this.form.TxtChargesPremium[
                                        ListChargesURL._id
                                    ]
                                )
                            );
                        }
                    );
                }
            );
        },

        CheckBoxAmount(coverage) {
            let uri = window.location.href.split("?");
            let PassID = uri[1].trim();
            this.form.PostRequestNO = PassID;
            this.form.QueryCoveragesAmount = [];
            this.form.QueryCoveragesName = [];
            this.form.QueryCoveragesID = []; ///clear array

            let GetTxtByAmountRequest = this.form.TxtOptionAmountRequest[
                coverage._id
            ];

            this.form.GetCurrentClickBySelect = coverage._id;
            let GetCoverageAmount = this.form.CoverageAmount;
            let CompPremium;

            // alert(passQuery);
            if (this.form.TxtSelectAmount[coverage._id] == false) {
                //if Unchecked
                clearInterval(this.RetrieveTimeInterval);
                clearInterval(this.RetrieveTimeInterval1);
                this.form.TxtCoveragesPremium[coverage._id] = "0.00";
                this.ReComputeByselectAmount();
                this.form.QueryCoveragesAmount = [];
                this.form.QueryCoveragesName = [];
                this.form.QueryCoveragesID = []; ///clear array
            } else {
                //if checked
                this.URLQueryPerilsCoveragesGroup.map(
                    URLQueryPerilsCoveragesGroups => {
                        URLQueryPerilsCoveragesGroups.ListCoverages.map(
                            ListCoveragesURL => {
                                this.form.QueryCoveragesAmount.push(
                                    this.form.TxtOptionAmountRequest[
                                        ListCoveragesURL._id
                                    ]
                                );
                                this.form.QueryCoveragesName.push(
                                    ListCoveragesURL.CoveragesName
                                );
                                this.form.QueryCoveragesID.push(
                                    ListCoveragesURL._id
                                );
                            }
                        );
                    }
                );

                //axios.get("api/GetPerilsTaripaByAmountLoop/" + PassID ) .then(({ data }) => (this.GetPerilsTaripaByAmount = data)  );
                this.form
                    .post("api/GetPerilsTaripaByAmountLoop")
                    .then(({ data }) => (this.GetPerilsTaripaByAmount = data));
                //alert(PassID);
                let RatePercentage = this.form.CoveragesRate[coverage.OptionNo]; //this.form.RatePercent;
                let CompPremium;

                this.RetrieveTimeInterval1 = setInterval(() => {
                    this.GetPerilsTaripaByAmount.map(
                        GetPerilsTaripaByAmounts => {
                            // alert(RatePercentage);
                            let ExplodePerilsNo = GetPerilsTaripaByAmounts.PerilsNo.split(
                                "-"
                            );

                            let QueryCoverageAmount =
                                GetPerilsTaripaByAmounts.CoverageAmount;
                            let QueryPremiumAmount =
                                GetPerilsTaripaByAmounts.PremiumAmount;

                            if (
                                ExplodePerilsNo[1].trim() === "OD" ||
                                ExplodePerilsNo[1].trim() === "TF"
                            ) {
                                CompPremium =
                                    (RatePercentage / 100) *
                                    QueryCoverageAmount *
                                    QueryPremiumAmount;
                                //this.form.TxtCoveragesPremium[ListCoveragesURL._id] = parseFloat(CompPremium).toFixed(2)
                            } else {
                                CompPremium = QueryPremiumAmount;
                            }
                            //alert(CompPremium);

                            if (
                                this.form.TxtSelectAmount[
                                    GetPerilsTaripaByAmounts._id
                                ] == false
                            ) {
                                //if Unchecked
                                this.form.TxtCoveragesPremium[
                                    GetPerilsTaripaByAmounts._id
                                ] = "0.00";
                            } else {
                                this.form.TxtCoveragesPremium[
                                    GetPerilsTaripaByAmounts._id
                                ] = parseFloat(CompPremium).toFixed(2);
                            }

                            this.form.TxtUpdatedCoveragesPremium = CompPremium;

                            this.$forceUpdate();
                            this.ReComputeByselectAmount();
                        }
                    );
                }, 1000);

                this.RetrieveTimeInterval2 = setInterval(() => {
                    clearInterval(this.RetrieveTimeInterval1);
                }, 5000);
            }
        },
        SelectByAmountRequest(e, coverage) {
            // this.form.TxtSelectAmount[URLQueryPerilsCoveragess._id].CheckNameTrue;
            clearInterval(this.RetrieveTimeInterval);

            let GetCoverageAmount = this.form.CoverageAmount;
            let GetCurrentClick = coverage._id;
            this.form.GetOptionNo = coverage.OptionNo;

            this.form.GetCurrentClickBySelect = coverage._id;
            this.form.TxtPreviousCoveragesPremium = this.form.TxtCoveragesPremium[
                GetCurrentClick
            ];
            if (parseFloat(e.target.value) === parseFloat(GetCoverageAmount)) {
                clearInterval(this.RetrieveTimeInterval);
                clearInterval(this.RetrieveTimeInterval1);
            } else {
                if (this.form.TxtSelectAmount[coverage._id] == false) {
                    //if Unchecked
                    this.form.TxtCoveragesPremium[
                        this.form.GetCurrentClickBySelect
                    ] = 0.0;
                    clearInterval(this.RetrieveTimeInterval);
                    clearInterval(this.RetrieveTimeInterval1);
                    this.form.TxtOptionAmountRequest[coverage._id] =
                        e.target.value;
                } else {
                    this.form.TxtOptionAmountRequest[coverage._id] =
                        e.target.value;

                    let ValCoveragesPremium = this.form
                        .TxtPreviousCoveragesPremium;
                    let passQuery =
                        this.form.Denomination.trim() +
                        ";;" +
                        e.target.value.trim() +
                        ";;" +
                        coverage.CoveragesName.trim();

                    axios
                        .get("api/GetPerilsTaripaByAmount/" + passQuery.trim())
                        .then(
                            ({ data }) => (this.GetPerilsTaripaByAmount = data)
                        );

                    let RatePercentage = this.form.CoveragesRate[
                        coverage.OptionNo
                    ]; //this.form.RatePercent;
                    let CompPremium;
                    let ComputeTotal = 0;

                    this.RetrieveTimeInterval1 = setInterval(() => {
                        this.GetPerilsTaripaByAmount.data.map(
                            GetPerilsTaripaByAmounts => {
                                let ExplodePerilsNo = GetPerilsTaripaByAmounts.PerilsNo.split(
                                    "-"
                                );
                                let QueryCoverageAmount =
                                    GetPerilsTaripaByAmounts.CoverageAmount;
                                let QueryPremiumAmount =
                                    GetPerilsTaripaByAmounts.PremiumAmount;

                                if (
                                    ExplodePerilsNo[1].trim() === "OD" ||
                                    ExplodePerilsNo[1].trim() === "TF"
                                ) {
                                    CompPremium =
                                        (RatePercentage / 100) *
                                        QueryCoverageAmount *
                                        QueryPremiumAmount;
                                } else {
                                    CompPremium = QueryPremiumAmount;
                                }

                                this.form.TxtUpdatedCoveragesPremium = CompPremium;
                                this.form.TxtCoveragesPremium[
                                    this.form.GetCurrentClickBySelect
                                ] = parseFloat(CompPremium).toFixed(2);

                                this.$forceUpdate();
                            }
                        );

                        this.ReComputeByselectAmount();
                    }, 1000);
                    this.RetrieveTimeInterval2 = setInterval(() => {
                        clearInterval(this.RetrieveTimeInterval1);
                    }, 5000);
                }
            }
        },
        ReComputeByselectAmount() {
            this.URLQueryPerilsCoveragesGroup.map(
                URLQueryPerilsCoveragesGroups => {
                    this.form.TxtPremiumAmount[
                        URLQueryPerilsCoveragesGroups.OptionNo
                    ] = 0.0;
                    this.form.TxtCoverageAmount[
                        URLQueryPerilsCoveragesGroups.OptionNo
                    ] = 0.0;
                    URLQueryPerilsCoveragesGroups.ListCoverages.map(
                        ListCoveragesURL => {
                            this.form.TxtPremiumAmount[
                                URLQueryPerilsCoveragesGroups.OptionNo
                            ] += parseFloat(
                                this.form.TxtCoveragesPremium[
                                    ListCoveragesURL._id
                                ]
                            );
                            this.form.TxtCoverageAmount[
                                URLQueryPerilsCoveragesGroups.OptionNo
                            ] += parseFloat(
                                this.form.TxtOptionAmountRequest[
                                    ListCoveragesURL._id
                                ]
                            );
                        }
                    );
                    parseFloat(
                        this.form.TxtPremiumAmount[
                            URLQueryPerilsCoveragesGroups.OptionNo
                        ]
                    ).toFixed(2);
                    parseFloat(
                        this.form.TxtCoverageAmount[
                            URLQueryPerilsCoveragesGroups.OptionNo
                        ]
                    ).toFixed(2);
                }
            );

            this.ReComputeCharges();
        },
        loadGetRequestDetails() {
            axios
                .get("api/PerilsList/" + this.form.ProductLine.trim())
                .then(({ data }) => (this.PerilsList = data));
            axios
                .get("api/GetPerilsTaripa/" + this.form.Denomination.trim())
                .then(({ data }) => (this.GetPerilsTaripa = data));
            axios
                .get(
                    "api/GetPerilsCoverageAmount/" +
                        this.form.Denomination.trim()
                )
                .then(({ data }) => (this.GetPerilsCoverageAmount = data));

            this.LoopTR.push({ value: 2 });
            axios
                .get(
                    "api/GetDefaultPerilsForADD/" +
                        this.form.Denomination.trim()
                )
                .then(({ data }) => (this.GetDefaultPerilsForADD = data));
            this.DefaultAutoCompute();
        },
        DeleteNewQuotation: function(index) {
            this.LoopTR.splice(index, 1);
            this.form.reset();
            
        },
        SelectByAmount(e, PerilsLists) {
            axios
                .get("api/ResultSelectByAmount/" + e.target.value)
                .then(({ data }) => (this.ResultSelectByAmount = data));
        },
        KeyPressRateAmount() {
            clearInterval(this.RetrieveTimeInterval);
        },
        UsageChange(e) {
            clearInterval(this.RetrieveTimeInterval);
            clearInterval(this.RetrieveTimeInterval1);
            this.form.SaveMotorUsage = e.target.value.trim();
            let CompPremium;
            this.URLQueryPerilsCoveragesGroup.map(
                URLQueryPerilsCoveragesGroups => {
                    URLQueryPerilsCoveragesGroups.ListCoverages.map(
                        ListCoveragesURL => {
                            let ExplodePerilsNo = ListCoveragesURL.CoveragesName.split(
                                "-"
                            );
                            if (
                                e.target.value.trim() === "Commercial" ||
                                e.target.value.trim() === "commercial"
                            ) {
                                if (
                                    ExplodePerilsNo[1].trim() === "PA" ||
                                    ExplodePerilsNo[1].trim() === "XBI" ||
                                    ExplodePerilsNo[1].trim() === "PD"
                                ) {
                                    CompPremium =
                                        parseFloat(
                                            ListCoveragesURL.PremiumAmount
                                        ) * 1.2;
                                    this.$forceUpdate();
                                    this.form.TxtCoveragesPremium[
                                        ListCoveragesURL._id
                                    ] = parseFloat(CompPremium).toFixed(2);
                                }
                            }
                        }
                    );
                }
            );
            this.ReComputeByselectAmount();
        },
        ChangeRateAmount() {
            clearInterval(this.RetrieveTimeInterval);
            //let  RatePercentage         = this.form.RatePercent;

            let PassIDOD = this.form.ODQueryPassID;
            let PassIDTF = this.form.TFQueryPassID;
            let PreviousAmountOD = this.form.TxtCoveragesPremium[PassIDOD];
            let PreviousAmountTF = this.form.TxtCoveragesPremium[PassIDTF];
            let CompPremium;
            //alert(PassIDOD);
            this.URLQueryPerilsCoveragesGroup.map(
                URLQueryPerilsCoveragesGroups => {
                    let RatePercentage = this.form.CoveragesRate[
                        URLQueryPerilsCoveragesGroups.OptionNo
                    ];
                    URLQueryPerilsCoveragesGroups.ListCoverages.map(
                        ListCoveragesURL => {
                            let ExplodePerilsNo = ListCoveragesURL.CoveragesName.split(
                                "-"
                            );

                            if (
                                ExplodePerilsNo[1].trim() === "OD" ||
                                ExplodePerilsNo[1].trim() === "TF"
                            ) {
                                CompPremium =
                                    (parseFloat(RatePercentage) / 100) *
                                    parseFloat(
                                        ListCoveragesURL.CoveragesAmount
                                    ) *
                                    parseFloat(ListCoveragesURL.PremiumAmount);

                                this.$forceUpdate();
                                this.form.TxtCoveragesPremium[
                                    ListCoveragesURL._id
                                ] = parseFloat(CompPremium).toFixed(2);
                            }
                        }
                    );
                }
            );

            this.ReComputeByselectAmount();
            //this.ReComputeCharges();
        },

        ReComputeCharges() {
            let GetOptionNo = this.form.GetOptionNo;

            this.URLQueryPerilsCoveragesGroup.map(
                URLQueryPerilsCoveragesGroups => {
                    let ComputeCharges = 0;
                    URLQueryPerilsCoveragesGroups.ListCharges.map(
                        URLQueryPerilsChargess => {
                            if (
                                URLQueryPerilsChargess.ChargesType === "Percent"
                            ) {
                                let CompChargesAmount =
                                    parseFloat(
                                        URLQueryPerilsChargess.ChargesAmount
                                    ) *
                                    parseFloat(
                                        this.form.TxtPremiumAmount[
                                            URLQueryPerilsCoveragesGroups
                                                .OptionNo
                                        ]
                                    );

                                if (
                                    URLQueryPerilsChargess.ChargesNo ===
                                    "2019-DP-0001"
                                ) {
                                    let value = CompChargesAmount; //parseFloat(URLQueryPerilsChargess.ChargesAmount )  *  parseFloat(this.form.TxtPremiumAmount )  ;
                                    let numpart = parseFloat(value)
                                        .toFixed(2)
                                        .split(".");

                                    if (numpart[1] < 51) {
                                        let CompChargesAmount =
                                            parseFloat(numpart[0]) + "." + 50;
                                        this.form.TxtChargesPremium[
                                            URLQueryPerilsChargess._id
                                        ] = parseFloat(
                                            CompChargesAmount
                                        ).toFixed(2);
                                    } else {
                                        let CompChargesAmount =
                                            parseFloat(numpart[0]) + 1;
                                        this.form.TxtChargesPremium[
                                            URLQueryPerilsChargess._id
                                        ] = parseFloat(
                                            CompChargesAmount
                                        ).toFixed(2);
                                    }
                                } else {
                                    let CompChargesAmount =
                                        parseFloat(
                                            URLQueryPerilsChargess.ChargesAmount
                                        ) *
                                        parseFloat(
                                            this.form.TxtPremiumAmount[
                                                URLQueryPerilsCoveragesGroups
                                                    .OptionNo
                                            ]
                                        );
                                    this.form.TxtChargesPremium[
                                        URLQueryPerilsChargess._id
                                    ] = parseFloat(CompChargesAmount).toFixed(
                                        2
                                    );
                                }

                                ComputeCharges += parseFloat(
                                    this.form.TxtChargesPremium[
                                        URLQueryPerilsChargess._id
                                    ]
                                );
                            } else {
                                let CompChargesAmount = parseFloat(
                                    URLQueryPerilsChargess.ChargesAmount
                                );
                                this.form.TxtChargesPremium[
                                    URLQueryPerilsChargess._id
                                ] = parseFloat(CompChargesAmount).toFixed(2);
                                //this.form.TotalCharges += parseFloat(CompChargesAmount );

                                ComputeCharges += parseFloat(
                                    this.form.TxtChargesPremium[
                                        URLQueryPerilsChargess._id
                                    ]
                                );
                            }
                            this.form.TotalCharges[
                                URLQueryPerilsChargess.OptionNo
                            ] = parseFloat(ComputeCharges).toFixed(2);
                        }
                    );

                    let CompAmount =
                        parseFloat(
                            this.form.TxtPremiumAmount[
                                URLQueryPerilsCoveragesGroups.OptionNo
                            ]
                        ) +
                        parseFloat(
                            this.form.TotalCharges[
                                URLQueryPerilsCoveragesGroups.OptionNo
                            ]
                        );
                    this.form.AmountDue[
                        URLQueryPerilsCoveragesGroups.OptionNo
                    ] = parseFloat(CompAmount).toFixed(2);
                }
            );

            //alert(ComputeCharges);
        },

        //---------------CODES FOR ADD CLICK------------------------------------------------------------------------------------
        AutoPushRecordADD() {
         

                this.GetDefaultPerilsForADD.data.map(PerilsLists => {
                this.form.ToSAvedAmountRequestADD.push(PerilsLists.PerilsNo);
                this.form.PerilsNameForDisplayADD.push(PerilsLists._id);
                this.form.PerilsNameAmountForDisplayADD.push(
                    parseFloat(
                        this.form.TxtOptionAmountRequestAdd[PerilsLists._id]
                    )
                );
                this.form.PerilsPremiumForDisplayADD.push(
                    parseFloat(
                        this.form.TxtCoveragesPremiumAdd[PerilsLists._id]
                    )
                );
            });

            this.GetProductLineCharges.data.map(URLQueryPerilsChargess => {
                this.form.PassChargesChargesNo.push(
                    URLQueryPerilsChargess.ChargesNo
                );
                this.form.PassChargesChargesName.push(
                    URLQueryPerilsChargess.ChargesName
                );
                this.form.PassChargesChargesPremium.push(
                    parseFloat(
                        this.form.TxtChargesPremiumAdd111[
                            URLQueryPerilsChargess._id
                        ]
                    )
                );

                //this.form.TxtChargesNameID.push(URLQueryPerilsChargess._id);
                //this.form.TxtChargesPremiumForDisplay.push(parseFloat(this.form.TxtChargesPremium[URLQueryPerilsChargess._id]));
            });
        },

        ReComputeByselectAmountADD() {
            this.form.TxtPremiumAmountAdd = 0.0;

            this.GetDefaultPerilsForADD.data.map(PerilsLists => {
                this.form.TxtPremiumAmountAdd += parseFloat(
                    this.form.TxtCoveragesPremiumAdd[PerilsLists._id]
                );
            });
            parseFloat(this.form.TxtPremiumAmountAdd).toFixed(2);

            this.ReComputeChargesADD();
        },

        SubmitNewCoverages() {
            this.AutoPushRecordADD();
            this.form
                .post("api/SubmitNewCoverages")
                .then(() => {
                    // Success!
                    // this.load()
                     Fire.$emit("AfterCreate");
                    Swal.fire(
                        'Successful!',
                        'Coverage has been added.',
                        'success'
                        
                    )
                     this.load();
                     this.AutoLoad();
                     this.DeleteNewQuotation();
                       //this.form.PerilsNameAmountForDisplayADD = "";
                })
                .catch(response => {
                    alert(response);
                });
               //this.form.PerilsNameAmountForDisplayADD.push({});
        },
        DefaultAutoCompute() {
            let RatePercentage = this.form.RatePercent;
            let CompPremium;
            let ComputeTotal = 0;

            this.RetrieveTimeInterval1 = setInterval(() => {
                this.GetDefaultPerilsForADD.data.map(
                    GetPerilsTaripaByAmountADDs => {
                        let ExplodePerilsNo = GetPerilsTaripaByAmountADDs.PerilsNo.split(
                            "-"
                        );
                        let QueryCoverageAmount =
                            GetPerilsTaripaByAmountADDs.CoverageAmount;
                        let QueryPremiumAmount =
                            GetPerilsTaripaByAmountADDs.PremiumAmount;

                        if (
                            ExplodePerilsNo[1].trim() === "OD" ||
                            ExplodePerilsNo[1].trim() === "TF"
                        ) {
                            // CompPremium  =  ( (( RatePercentage / 100) * QueryCoverageAmount) * QueryPremiumAmount);
                            CompPremium =
                                (RatePercentage / 100) *
                                QueryCoverageAmount *
                                QueryPremiumAmount;
                            //alert(CompPremium);
                        } else {
                            CompPremium = QueryPremiumAmount;
                        }

                        //alert(GetPerilsTaripaByAmountADDs._id);
                        if (
                            this.form.TxtSelectAmountAdd[
                                GetPerilsTaripaByAmountADDs._id
                            ] == false
                        ) {
                            //if Unchecked
                            this.form.TxtCoveragesPremiumAdd[
                                GetPerilsTaripaByAmountADDs._id
                            ] = "0.00";
                        } else {
                            //if Checked
                            //this.DefaultAutoCompute();
                            this.form.TxtCoveragesPremiumAdd[
                                GetPerilsTaripaByAmountADDs._id
                            ] = parseFloat(CompPremium).toFixed(2);
                            this.form.TxtOptionAmountRequestAdd[
                                GetPerilsTaripaByAmountADDs._id
                            ] = GetPerilsTaripaByAmountADDs.CoverageAmount;
                        }
                        this.ReComputeByselectAmountADD();
                        this.$forceUpdate();
                    }
                );
                //this.ReComputeByselectAmountADD();
            }, 1000);
            this.RetrieveTimeInterval2 = setInterval(() => {
                clearInterval(this.RetrieveTimeInterval1);
            }, 5000);
        },

        SelectByAmountRequestADD(e, PerilsLists) {
            // this.form.TxtSelectAmount[URLQueryPerilsCoveragess._id].CheckNameTrue;
            //clearInterval(this.RetrieveTimeInterval);
            clearInterval(this.RetrieveTimeInterval1);

            let GetCurrentClick = PerilsLists._id;
            this.form.GetCurrentClickBySelect = PerilsLists._id;
            this.form.TxtPreviousCoveragesPremium = this.form.TxtCoveragesPremium[
                GetCurrentClick
            ];

            if (this.form.TxtSelectAmountAdd[PerilsLists._id] == false) {
                //if Unchecked
                this.form.TxtCoveragesPremium[
                    this.form.GetCurrentClickBySelect
                ] = 0.0;
                clearInterval(this.RetrieveTimeInterval);
                clearInterval(this.RetrieveTimeInterval1);
                this.form.TxtOptionAmountRequestAdd[PerilsLists._id] =
                    e.target.value;
            } else {
                this.form.TxtOptionAmountRequestAdd[PerilsLists._id] =
                    e.target.value;
                let ValCoveragesPremium = this.form.TxtPreviousCoveragesPremium;
                let passQuery =
                    this.form.Denomination.trim() +
                    ";;" +
                    e.target.value.trim() +
                    ";;" +
                    PerilsLists.PerilsNo.trim();

                axios
                    .get("api/GetPerilsTaripaByAmountADD/" + passQuery.trim())
                    .then(
                        ({ data }) => (this.GetPerilsTaripaByAmountADD = data)
                    );

                let RatePercentage = this.form.RatePercent;
                let CompPremium;
                let ComputeTotal = 0;

                this.RetrieveTimeInterval1 = setInterval(() => {
                    this.GetPerilsTaripaByAmountADD.data.map(
                        GetPerilsTaripaByAmountADDs => {
                            let ExplodePerilsNo = GetPerilsTaripaByAmountADDs.PerilsNo.split(
                                "-"
                            );
                            let QueryCoverageAmount =
                                GetPerilsTaripaByAmountADDs.CoverageAmount;
                            let QueryPremiumAmount =
                                GetPerilsTaripaByAmountADDs.PremiumAmount;

                            if (
                                ExplodePerilsNo[1].trim() === "OD" ||
                                ExplodePerilsNo[1].trim() === "TF"
                            ) {
                                CompPremium =
                                    (RatePercentage / 100) *
                                    QueryCoverageAmount *
                                    QueryPremiumAmount;
                            } else {
                                CompPremium = QueryPremiumAmount;
                            }
                            //alert(CompPremium);

                            //this.form.TxtUpdatedCoveragesPremium = CompPremium;
                            this.form.TxtCoveragesPremiumAdd[
                                this.form.GetCurrentClickBySelect
                            ] = parseFloat(CompPremium).toFixed(2);

                            this.$forceUpdate();
                        }
                    );
                    this.ReComputeByselectAmountADD();
                    //this.ReComputeChargesADD();
                }, 1000);
                this.RetrieveTimeInterval2 = setInterval(() => {
                    clearInterval(this.RetrieveTimeInterval1);
                }, 5000);
            }
        },
        CheckBoxAmountADD(PerilsLists) {
            if (this.form.TxtSelectAmountAdd[PerilsLists._id] == false) {
                //if Unchecked
                this.form.TxtCoveragesPremiumAdd[PerilsLists._id] = "0.00";
            } else {
                //if Checked
                this.DefaultAutoCompute();
                this.$forceUpdate();
            }
            this.ReComputeByselectAmountADD();
        },
        ReComputeChargesADD() {
            let ComputeCharges = 0;

            this.GetProductLineCharges.data.map(URLQueryPerilsChargesss => {
                //alert(URLQueryPerilsChargesss._id);
                if (URLQueryPerilsChargesss.ChargesType === "Percent") {
                    let CompChargesAmount =
                        parseFloat(URLQueryPerilsChargesss.ChargesAmount) *
                        parseFloat(this.form.TxtPremiumAmountAdd);
                    if (URLQueryPerilsChargesss.ChargesNo === "2019-DP-0001") {
                        let value = CompChargesAmount; //parseFloat(URLQueryPerilsChargess.ChargesAmount )  *  parseFloat(this.form.TxtPremiumAmount )  ;
                        let numpart = parseFloat(value)
                            .toFixed(2)
                            .split(".");

                        if (numpart[1] < 51) {
                            let CompChargesAmount =
                                parseFloat(numpart[0]) + "." + 50;
                            this.form.TxtChargesPremiumAdd111[
                                URLQueryPerilsChargesss._id
                            ] = parseFloat(CompChargesAmount).toFixed(2);
                        } else {
                            let CompChargesAmount = parseFloat(numpart[0]) + 1;
                            this.form.TxtChargesPremiumAdd111[
                                URLQueryPerilsChargesss._id
                            ] = parseFloat(CompChargesAmount).toFixed(2);
                        }
                    } else {
                        let CompChargesAmount =
                            parseFloat(URLQueryPerilsChargesss.ChargesAmount) *
                            parseFloat(this.form.TxtPremiumAmountAdd);
                        this.form.TxtChargesPremiumAdd111[
                            URLQueryPerilsChargesss._id
                        ] = parseFloat(CompChargesAmount).toFixed(2);
                    }

                    ComputeCharges += parseFloat(
                        this.form.TxtChargesPremiumAdd111[
                            URLQueryPerilsChargesss._id
                        ]
                    );
                    //alert(URLQueryPerilsChargesss.ChargesNo);
                } else {
                    let CompChargesAmount = parseFloat(
                        URLQueryPerilsChargesss.ChargesAmount
                    );
                    this.form.TxtChargesPremiumAdd111[
                        URLQueryPerilsChargesss._id
                    ] = parseFloat(CompChargesAmount).toFixed(2);
                    //this.form.TotalCharges += parseFloat(CompChargesAmount );

                    ComputeCharges += parseFloat(
                        this.form.TxtChargesPremiumAdd111[
                            URLQueryPerilsChargesss._id
                        ]
                    );
                }
                //alert(ComputeCharges);
            });

            this.form.TotalChargesAdd = parseFloat(ComputeCharges).toFixed(2);

            let CompAmount =
                parseFloat(this.form.TxtPremiumAmountAdd) +
                parseFloat(this.form.TotalChargesAdd);
            this.form.AmountDueAdd = parseFloat(CompAmount).toFixed(2);
        },

        UpdateQuotation() {
            this.AutoPushRecord();
            // Submit the form via a POST request
            this.form
                .post("api/UpdateQuotation")
                .then(() => {
                    // Success!
                    Fire.$emit("AfterCreate");
                    Swal.fire(
                        'Updated!',
                        'Your Quotation has been updated.',
                        'success'
                    )
                   // this.$router.push('/dashboard');
                    this.load();
                     this.AutoLoad();
                })
                .catch(response => {
                    alert(response);
                });
        },

        load() {
            this.RetrieveTimeInterval = setInterval(() => {
                this.form.CustAcctNo        =  this.UserDetails.AccountNo;
                this.form.CustAcctCName     =  this.UserDetails.CName;


            this.ResultQueryRequest.data.map(ResultRequestDetailss => {
                this.form.RequestNoPass = ResultRequestDetailss.RequestNo;
                 this.form.PlateNumber = ResultRequestDetailss.PlateNumber;
                this.form.TINNumber = ResultRequestDetailss.TINNumber;
                this.form.EmailAddress = ResultRequestDetailss.EmailAddress;
                this.form.MotorBrand = ResultRequestDetailss.MotorBrand;
                this.form.ContactNumber = ResultRequestDetailss.ContactNumber;
                this.form.FirstName = ResultRequestDetailss.FirstName;
                this.form.MiddleName = ResultRequestDetailss.MiddleName;
                this.form.LastName = ResultRequestDetailss.LastName;
                this.form.Address = ResultRequestDetailss.Address;
                this.form.Barangay = ResultRequestDetailss.Barangay;
                this.form.City = ResultRequestDetailss.City;
                this.form.Denomination = ResultRequestDetailss.Denomination;
                this.form.TypeClass = ResultRequestDetailss.MotorBodyType;
                this.form.MotorYear = ResultRequestDetailss.MotorYear;
                this.form.MotorBrand = ResultRequestDetailss.MotorBrand;
                this.form.CoverageAmount = ResultRequestDetailss.CoverageAmount;
                this.form.MotorPOAmount = ResultRequestDetailss.MotorPOAmount;
                this.form.RatePercent = ResultRequestDetailss.RatePercent;
                this.form.MotorModel = ResultRequestDetailss.MotorModel;
                this.form.MotorType = ResultRequestDetailss.MotorBodyType;
                this.form.OptSurcharge = ResultRequestDetailss.MotorUsage;
                // this.form.TxtPremiumAmount   =ResultRequestDetailss.PremiumAmount;
                  this.form.passengers         =ResultRequestDetailss.Passengers;
                this.form.ProductLine = ResultRequestDetailss.ProductLine;
                //this.form.Deductible = ResultRequestDetailss.Deductable;
                this.form.QuoteExpiryStatus =
                    ResultRequestDetailss.QuoteExpiryStatus;
                this.form.DepreciativeAmount =
                    ResultRequestDetailss.DepreciativeAmount;

                this.$forceUpdate();
            });

            this.URLQueryPerilsCoveragesGroup.map(
                URLQueryPerilsCoveragesGroups => {
                     this.form.Deductible[URLQueryPerilsCoveragesGroups.OptionNo] = URLQueryPerilsCoveragesGroups.Deductible;
                    let CompCoveragesAmount = 0;
                    let CompChargesAmount = 0;
                     this.form.RequestNoOptionNo    =  URLQueryPerilsCoveragesGroups.OptionNo;
                    
                    URLQueryPerilsCoveragesGroups.ListCoverages.map(
                        ListCoveragesURL => {
                            this.form.TxtCoveragesPremium[
                                ListCoveragesURL._id
                            ] = ListCoveragesURL.CoveragesPremium;
                            this.form.TxtOptionAmountRequest[
                                ListCoveragesURL._id
                            ] = ListCoveragesURL.CoveragesAmount;
                            this.form.TxtCoveragesName[ListCoveragesURL._id] =
                                ListCoveragesURL.PerilsName;

                            CompCoveragesAmount += parseFloat(
                                ListCoveragesURL.CoveragesPremium
                            );

                            let ExplodePerilsNo = ListCoveragesURL.CoveragesName.split(
                                "-"
                            );
                            if (ExplodePerilsNo[1].trim() === "OD") {
                                this.form.ODQueryPassID = ListCoveragesURL._id;
                            }
                            if (ExplodePerilsNo[1].trim() === "TF") {
                                this.form.TFQueryPassID = ListCoveragesURL._id;
                            }
                            this.form.CoveragesRate[
                                URLQueryPerilsCoveragesGroups.OptionNo
                            ] = ListCoveragesURL.CoverageRates;
                        }
                    );
                    this.form.TxtPremiumAmount[
                        URLQueryPerilsCoveragesGroups.OptionNo
                    ] = parseFloat(CompCoveragesAmount).toFixed(2);

                    URLQueryPerilsCoveragesGroups.ListCharges.map(
                        ListChargesURL => {
                            CompChargesAmount += parseFloat(
                                ListChargesURL.ChargesPremium
                            );
                            this.form.TxtChargesPremium[ListChargesURL._id] =
                                ListChargesURL.ChargesPremium;
                        }
                    );
                    this.form.TotalCharges[
                        URLQueryPerilsCoveragesGroups.OptionNo
                    ] = parseFloat(CompChargesAmount).toFixed(2);
                    let TotalAmountDue =
                        parseFloat(CompCoveragesAmount) +
                        parseFloat(CompChargesAmount);
                    this.form.AmountDue[
                        URLQueryPerilsCoveragesGroups.OptionNo
                    ] = parseFloat(TotalAmountDue).toFixed(2);
                }
            );
        }, 1000);

        this.RetrieveTimeInterval2 = setInterval(() => {
            clearInterval(this.RetrieveTimeInterval);
        }, 5000);
        },

        openForm() {
            document.getElementById("myForm").style.display = "block";
        },

        closeForm() {
            document.getElementById("myForm").style.display = "none";
        },
    },
    
    computed: {
        date() {
           let date = new Date()
           let day = date.getDate()
           let month = date.getMonth() + 1
           let year = date.getFullYear()
           return `${month} / ${day} / ${year}`
        }
    },

    beforeDestroy() {
        clearInterval(this.RetrieveTimeInterval1);
        clearInterval(this.RetrieveTimeInterval);
        this.RetrieveTimeInterval11 = setInterval(() => {
            clearInterval(this.RetrieveTimeInterval1);
        }, 1000);
    },

    watch: {
        GetPerilsTaripaByAmount: function(val) {
            //do something when the data changes.
            if (val) {
                //this.ReComputeByselectAmount();
            }
        }
    },

    created() {
        this.load()
        //this.RetrieveTimeInterval     = setInterval(this.fetchEventsList, 1000) ;
        //this.RetrieveTimeInterval1    = setInterval(this.GetPerilsTaripaByAmount, 1000) ;
        //this.loadGetRequestDetails();
        
    }
};
</script>

<style scoped>
/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: green;
  color: white;
  padding: 10px 10px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 50px;
  right: 28px;
  width: 280px;
  border-radius: 25px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 50px;
  right: 15px;
  border: 1px solid #f1f1f1;
  z-index: 9;
  border-radius: 10px;
}

/* Add styles to the form container */
.form-container {
  width: 550px;
  max-width: 500px;
  padding: 10px;
  background-color: white;
  display: inline-block;
}

/* Full-width textarea */
/* .form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
} */

/* When the textarea gets focus, do something */
/* .form-container textarea:focus {
  background-color: #ddd;
  outline: none;
} */

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 10px 10px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
  border-radius: 25px;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

#quoteslogo {
    width: 125px;
}
</style>

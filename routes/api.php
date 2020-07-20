<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// File Maintenance (Product Lines)
Route::apiResources(['lines' => 'FileMaintenance\ProductLineController']);
Route::put('line/{id}', 'FileMaintenance\ProductLineController@restore');
Route::delete('line/{id}', 'FileMaintenance\ProductLineController@softDelete');

// File Maintenance (User Department)
Route::apiResources(['departments' => 'FileMaintenance\User\DepartmentController']);
Route::put('department/{id}', 'FileMaintenance\User\DepartmentController@restore');
Route::delete('department/{id}', 'FileMaintenance\User\DepartmentController@softDelete');
Route::get('Departments', 'FileMaintenance\User\DepartmentController@getUserDepartment');

// File Maintenance (User Type)
Route::apiResources(['types' => 'FileMaintenance\User\TypeController']);
Route::put('type/{id}', 'FileMaintenance\User\TypeController@restore');
Route::delete('type/{id}', 'FileMaintenance\User\TypeController@softDelete');
Route::get('Types', 'FileMaintenance\User\TypeController@getUserType');

// File Maintenance (User SubType)
// Route::apiResources(['sub-types' => 'FileMaintenance\User\SubTypeController']);
// Route::put('sub-type/{id}', 'FileMaintenance\User\SubTypeController@restore');
// Route::delete('sub-type/{id}', 'FileMaintenance\User\SubTypeController@softDelete');
// Route::get('SubTypes', 'FileMaintenance\User\SubTypeController@getUserSubType');
// Route::get('SubTypesList', 'FileMaintenance\User\SubTypeController@SubTypesList');

// File Maintenance (User Authority)
Route::apiResources(['authorities' => 'FileMaintenance\User\AuthorityController']);
Route::put('authority/{id}', 'FileMaintenance\User\AuthorityController@restore');
Route::delete('authority/{id}', 'FileMaintenance\User\AuthorityController@softDelete');
Route::get('Authorities', 'FileMaintenance\User\AuthorityController@getUserAuthority');

// File Maintenance (Motor Car Class)
Route::apiResources(['class' => 'FileMaintenance\ClassController']);
Route::put('car-class/{id}', 'FileMaintenance\ClassController@restore');
Route::delete('car-class/{id}', 'FileMaintenance\ClassController@softDelete');
Route::get('CarClass', 'FileMaintenance\ClassController@getCarClass');

// File Maintenance (Motor Car Denomination)
// Route::apiResources(['denomination' => 'FileMaintenance\DenominationController']);
// Route::put('denominations/{id}', 'FileMaintenance\DenominationController@restore');
// Route::delete('denominations/{id}', 'FileMaintenance\DenominationController@softDelete');
// Route::get('Denomination', 'FileMaintenance\DenominationController@getDenomination');

// File Maintenance (Motor Car Brand)
Route::apiResources(['car-brands' => 'FileMaintenance\CarBrandController']);
Route::put('car-brand/{id}', 'FileMaintenance\CarBrandController@restore');
Route::delete('car-brand/{id}', 'FileMaintenance\CarBrandController@softDelete');
Route::get('CarBrands', 'FileMaintenance\CarBrandController@getCarBrand');

// File Maintenance (Motor Car Model)
Route::apiResources(['car-models' => 'FileMaintenance\CarModelController']);
Route::put('car-model/{id}', 'FileMaintenance\CarModelController@restore');
Route::delete('car-model/{id}', 'FileMaintenance\CarModelController@softDelete');
Route::get('CarModels/{id}', 'FileMaintenance\CarModelController@getCarModel');

// File Maintenance (Motor Car Body Type)
Route::apiResources(['car-body-types' => 'FileMaintenance\CarBodyTypeController']);
Route::put('car-body-type/{id}', 'FileMaintenance\CarBodyTypeController@restore');
Route::delete('car-body-type/{id}', 'FileMaintenance\CarBodyTypeController@softDelete');
Route::get('CarBodyTypes', 'FileMaintenance\CarBodyTypeController@getCarBodyType');

// File Maintenance (Motor Car Purchased Amount)
Route::apiResources(['car-amounts' => 'FileMaintenance\CarAmountController']);
Route::put('car-amount/{id}', 'FileMaintenance\CarAmountController@restore');
Route::delete('car-amount/{id}', 'FileMaintenance\CarAmountController@softDelete');
Route::get('CarAmounts', 'FileMaintenance\CarAmountController@getCarAmount');

// File Maintenance (Coverages Perils)
Route::apiResources(['perils' => 'FileMaintenance\Coverages\PerilsController']);
Route::put('peril/{id}', 'FileMaintenance\Coverages\PerilsController@restore');
Route::delete('peril/{id}', 'FileMaintenance\Coverages\PerilsController@softDelete');
Route::get('Perils', 'FileMaintenance\Coverages\PerilsController@getPerils');
Route::get('GetPerils', 'FileMaintenance\Coverages\PerilsController@GetPeril');

// File Maintenance (Coverages Taripa)
Route::apiResources(['taripas' => 'FileMaintenance\Coverages\TaripaController']);
Route::put('taripa/{id}', 'FileMaintenance\Coverages\TaripaController@restore');
Route::delete('taripa/{id}', 'FileMaintenance\Coverages\TaripaController@softDelete');
Route::get('Taripas', 'FileMaintenance\Coverages\TaripaController@getTaripas');

// File Maintenance (Coverages Surcharge)
Route::apiResources(['surcharges' => 'FileMaintenance\Coverages\SurchargeController']);
Route::put('surcharge/{id}', 'FileMaintenance\Coverages\SurchargeController@restore');
Route::delete('surcharge/{id}', 'FileMaintenance\Coverages\SurchargeController@softDelete');
Route::get('Surcharge', 'FileMaintenance\Coverages\SurchargeController@getSurcharge');

// File Maintenance (Clauses & Warranties)
Route::apiResources(['clauses' => 'FileMaintenance\ClausesController' ]);
Route::put('warranties/{id}', 'FileMaintenance\ClausesController@restore');
Route::delete('warranties/{id}', 'FileMaintenance\ClausesController@softDelete');
Route::get('Warranties', 'FileMaintenance\ClausesController@getWarranties');


// Quotation Controller
Route::get('URLQueryPerilsCoveragesGroupEdit/{id}', 'QuotationController@URLQueryPerilsCoveragesGroupEdit');
Route::get('URLQueryPerilsCoveragesGroup/{id}', 'QuotationController@URLQueryPerilsCoveragesGroup');
Route::get('ListCoveragesForApproval/{id}', 'QuotationController@ListCoveragesForApproval');
Route::get('ListCoveragesForApprovalUW/{id}', 'QuotationController@ListCoveragesForApprovalUW');
Route::get('CustomerRequestQuotation/{id}', 'QuotationController@CustomerRequestQuotation');
Route::get('CustomerAcceptedCoverage/{id}', 'QuotationController@CustomerAcceptedCoverage');
Route::get('UploadRecordTaripa', 'QuotationController@UploadRecordTaripa');
//Quotation /Proposal
Route::post('quotation', 'QuotationController@store');
//Route::post('TrySave', 'QuotationController@TrySave');
Route::get('SubLineCount/{id}', 'QuotationController@GetSubLines');
Route::get('TaripaSubLineCount/{id}', 'QuotationController@GetSubLinesTaripa');
Route::get('PerilsList/{id}', 'QuotationController@GetPerilsList');
Route::post('RequestQuotation', 'QuotationController@RequestQuotation');
Route::get('GetRequestQuotation', 'QuotationController@GetRequestQuotation');
Route::get('GetRequestQuotationAccepted', 'QuotationController@GetRequestQuotationAccepted');
Route::get('GetRequestProposalApprover/{id}', 'QuotationController@GetRequestProposalApprover');
Route::get('GetRequestQuotationApprover/{id}', 'QuotationController@GetRequestQuotationApprover');
Route::get('GetRequestQuotationCustomer/{id}', 'QuotationController@GetRequestQuotationCustomer');
Route::get('GetListProposal', 'QuotationController@GetListProposal');
Route::post('UpdateQuotation', 'QuotationController@UpdateQuotation');
Route::post('SubmitNewCoverages', 'QuotationController@SubmitNewCoverages');
Route::post('AutoReviewedQuotation', 'QuotationController@AutoReviewedQuotation');
Route::post('PassForReviewedQuotation', 'QuotationController@PassForReviewedQuotation');
Route::post('ReviewedQuotation', 'QuotationController@ReviewedQuotation');
Route::post('AcceptQuotation', 'QuotationController@AcceptQuotation');
Route::post('ComposeMessageCustomer', 'QuotationController@ComposeMessageCustomer');
Route::post('SetApproverQuotation', 'QuotationController@SetApproverQuotation');
Route::post('MktgApprovedQuotation', 'QuotationController@MktgApprovedQuotation');
Route::post('ApproverQuotation', 'QuotationController@ApproverQuotation');
Route::get('GetAllFieldsRequest', 'QuotationController@GetAllFieldsRequest');
Route::get('GetDenomination', 'QuotationController@GetDenomination');
Route::get('GetListClauses/{id}', 'QuotationController@GetListClauses');
Route::get('GetListBanksIssuance/{id}', 'QuotationController@GetListBanksIssuance');
Route::get('GetSurcharge', 'QuotationController@GetSurcharge');
Route::get('ListApproverQuotation', 'QuotationController@ListApproverQuotation');
Route::get('ListApproverQuotationUW/{id}', 'QuotationController@ListApproverQuotationUW');
//Perils
// Route::get('GetPeril', 'QuotationController@GetPeril');
Route::get('GetPerilsTaripa/{id}', 'QuotationController@GetPerilsTaripa');
Route::get('GetPerilsCoverageAmount/{id}', 'QuotationController@GetPerilsCoverageAmount');
Route::get('ResultSelectByAmount/{id}', 'QuotationController@SelectByAmount');
Route::get('URLQueryRequest/{id}', 'QuotationController@URLQueryRequest');
Route::get('URLQueryRequestModify/{id}', 'QuotationController@URLQueryRequestModify');
Route::get('URLQueryPerilsCoverages/{id}', 'QuotationController@URLQueryPerilsCoverages');
Route::get('DetectExpirationQuotation', 'QuotationController@DetectExpirationQuotation');
Route::get('URLQueryPerilsCoveragesPreview/{id}', 'QuotationController@URLQueryPerilsCoveragesPreview');
Route::get('URLQueryPerilsCoveragesPreviewNew/{id}', 'QuotationController@URLQueryPerilsCoveragesPreviewNew');
Route::get('GetDefaultPerilsForADD/{id}', 'QuotationController@GetDefaultPerilsForADD');
//------------------proposal-form ------------------------------
Route::get('URLQueryPerilsCharges/{id}', 'QuotationController@URLQueryPerilsCharges');
Route::get('GetPerilsCoverageAmountByDefault/{id}', 'QuotationController@GetPerilsCoverageAmountByDefault');
Route::get('GetPerilsTaripaByAmount/{id}', 'QuotationController@GetPerilsTaripaByAmount');
Route::get('GetPerilsTaripaByAmountADD/{id}', 'QuotationController@GetPerilsTaripaByAmount');
Route::post('GetPerilsTaripaByAmountLoop', 'QuotationController@GetPerilsTaripaByAmountLoop');
Route::get('GetProductLineCharges', 'QuotationController@GetProductLineCharges');
//Route::get('UploadRecordTaripa', 'QuotationController@UploadRecordTaripa');
Route::patch('/SubmitUploadRecordTaripa', 'QuotationController@SubmitUploadRecordTaripa')->name('SubmitUploadRecordTaripa');

//---------------Registration
Route::post('registration', 'RegistrationController@store');
Route::get('registrations', 'RegistrationController@index');
Route::get('registrations/{id}', 'RegistrationController@show');
Route::put('registrations/{id}', 'RegistrationController@update');
Route::delete('registrations/{id}', 'RegistrationController@destroy');

//!---------FileMaintenance---departments--------------
Route::get('Department', 'FileMaintenance@Department');
Route::get('DepartmentList', 'FileMaintenance@DepartmentList');
Route::post('DepartmentAddNew', 'FileMaintenance@DepartmentAddNew');
Route::put('DepartmentUpdate/{id}', 'FileMaintenance@DepartmentUpdate');
Route::put('DepartmentRestore/{id}', 'FileMaintenance@DepartmentRestore');
Route::delete('DepartmentDelete/{id}', 'FileMaintenance@DepartmentDelete');

//!---------FileMaintenance----Authority-----------------
Route::get('Authority', 'FileMaintenance@Authority');
Route::get('AuthorityList', 'FileMaintenance@AuthorityList');
Route::post('AuthorityAddNew', 'FileMaintenance@AuthorityAddNew');
Route::put('AuthorityUpdate/{id}', 'FileMaintenance@AuthorityUpdate');
Route::delete('AuthorityDelete/{id}', 'FileMaintenance@AuthorityDelete');
Route::put('AuthorityRestore/{id}', 'FileMaintenance@AuthorityRestore');

//!---------FileMaintenance----under----Subtypes--------------
Route::get('SubTypes/{id}', 'FileMaintenance@IndexTypeSubLink');
Route::get('SubTypesList/{id}', 'FileMaintenance@SubTypesList');
Route::post('UpdateTypeSubLink', 'FileMaintenance@UpdateTypeSubLink');
Route::post('SubTypes', 'FileMaintenance@AddTypeSubLink');
Route::get('SubTypesLoad', 'FileMaintenance@SubTypesLoad');
Route::delete('SubTypeDelete/{id}', 'FileMaintenance@SubTypeDelete');
Route::put('SubTypeRestore/{id}', 'FileMaintenance@SubTypeRestore');

//!---------FileMaintenance----types--------------
Route::get('MenuType', 'FileMaintenance@MenuType');
Route::get('MenuTypeDisplay', 'FileMaintenance@MenuTypeDisplay');
Route::post('MenuTypeAddNew', 'FileMaintenance@MenuTypeAddNew');
Route::post('MenuTypeUpdate', 'FileMaintenance@MenuTypeUpdate');
Route::get('MenuTypeFind/{id}', 'FileMaintenance@MenuTypeFind');
Route::delete('RecordDeletes/{id}', 'FileMaintenance@MenuTypeRecordDeletes');
Route::put('ActivateRecord/{id}', 'FileMaintenance@MenuTypeActivateRecord');






Route::put('DeleteRequestClauses/{id}', 'QuotationController@DeleteRequestClauses');
Route::get('AddClausesWarrantiesToPolicy/{id}', 'QuotationController@AddClausesWarrantiesToPolicy');
Route::get('ChangeBankDetails/{id}', 'QuotationController@ChangeBankDetails');
Route::get('GetListBanks', 'QuotationController@GetListBanks');
Route::get('CustomerAcceptedCoverageView/{id}', 'QuotationController@CustomerAcceptedCoverageView');
Route::get('UpdateScheduleVehicle/{id}', 'QuotationController@UpdateScheduleVehicle');
Route::get('EditAmountPolicyMktg/{id}', 'QuotationController@EditAmountPolicyMktg');
Route::get('PolicyModificationAmount/{id}', 'QuotationController@PolicyModificationAmount');
Route::get('PolicyAmountForModification/{id}', 'QuotationController@PolicyAmountForModification');
Route::get('PolicyModificationEditBtn/{id}', 'QuotationController@PolicyModificationEditBtn');
Route::post('SubmitNewCoveragesModification', 'QuotationController@SubmitNewCoveragesModification');
Route::get('GetIssuanceForSignaturePaging', 'QuotationController@GetIssuanceForSignaturePaging');
Route::get('GetIssuanceForSignature/{id}', 'QuotationController@GetIssuanceForSignature');

Route::get('SubmitForSignature/{id}', 'QuotationController@SubmitForSignature');
Route::get('GetListSignatory', 'QuotationController@GetListSignatory');
Route::get('ListPolicy', 'QuotationController@ListPolicy');



//report / logs quotation
Route::get('LogsReport', 'QuotationController@LogsReport');
Route::get('logs', 'QuotationController@getLogsReport');
Route::get('log/{id}', 'QuotationController@getLog');

//---Commission-----
Route::get('AgentCommissionReport/{id}', 'QuotationController@AgentCommissionReport');
Route::get('AgentCommissionReportGet/{id}', 'QuotationController@AgentCommissionReportGet');
Route::get('AgentCommReportCashOut/{id}', 'QuotationController@AgentCommReportCashOut');
Route::get('GetAgentComReport/{id}', 'QuotationController@GetAgentComReport');
Route::get('AgentCommissionForCashOut/{id}', 'QuotationController@AgentCommissionForCashOut');
Route::get('CheckUserPassword/{id}', 'RegistrationController@CheckUserPassword');
Route::post('CashOutCommission', 'QuotationController@CashOutCommission');
Route::get('ListCashOutAgent/{id}', 'QuotationController@ListCashOutAgent');
Route::get('ListCashOutAgentPaid/{id}', 'QuotationController@ListCashOutAgentPaid');
Route::post('CashOutPayOut', 'QuotationController@CashOutPayOut');

///try URL
Route::get('ComputeDaysDiff', 'QuotationController@ComputeDaysDiff');


Route::get('wordings', 'QuotationController@Wordings');

Route::get('ISAPInternalAuth', 'QuotationController@ISAPInternalAuth');

// File Maintenance (Charges)
Route::apiResources(['charges' => 'FileMaintenance\Coverages\ChargesController']);
Route::put('charge/{id}', 'FileMaintenance\Coverages\ChargesController@restore');
Route::delete('charge/{id}', 'FileMaintenance\Coverages\ChargesController@softDelete');
Route::get('Charges', 'FileMaintenance\Coverages\ChargesController@getCharges');

// File Maintenance (Sub Charges)
Route::apiResources(['sub-charges' => 'FileMaintenance\Coverages\SubChargesController']);
Route::put('sub-charge/{id}', 'FileMaintenance\Coverages\SubChargesController@restore');
Route::delete('sub-charge/{id}', 'FileMaintenance\Coverages\SubChargesController@softDelete');
Route::get('SubCharges', 'FileMaintenance\Coverages\SubChargesController@getSubCharges');


///NEw Routes
Route::get('ProposalEditCheckBoxAmount/{id}', 'QuotationController@ProposalEditCheckBoxAmount');
Route::get('ProposalEditTxtBoxAmount/{id}', 'QuotationController@ProposalEditTxtBoxAmount');
Route::get('GetPerilsCoverageUsingTxtBox/{id}', 'QuotationController@GetPerilsCoverageUsingTxtBox');
Route::post('SubmitNewCoveragesOption', 'QuotationController@SubmitNewCoveragesOption');
Route::get('GetPerilsOption', 'QuotationController@GetPerilsOption');
Route::get('GetPerilsDefaultData/{id}', 'QuotationController@GetPerilsDefaultData');



Route::post('UpdateQuotationOption', 'QuotationController@UpdateQuotationOption');
Route::get('ProposalFormEdit/{id}', 'QuotationController@ProposalFormEdit');
Route::get('UploadSignature/{id}', 'QuotationController@UploadSignature');
Route::get('TestData', 'QuotationController@TestData');
//Upload Image

Route::post('UploadImage', 'QuotationController@UploadImage');
//-----------Payment Route
Route::get('PaymentMode/{id}', 'QuotationController@PaymentMode');
Route::get('PayPalMode/{id}', 'QuotationController@PayPalMode');
Route::get('SaveAuthentication/{id}', 'QuotationController@SaveAuthentication');
Route::get('UpdateAuthentication/{id}', 'QuotationController@UpdateAuthentication');
Route::get('GetCOCNo', 'QuotationController@GetCOCNo');
Route::get('GetListNeedAuth', 'QuotationController@GetListNeedAuth');
Route::get('DragonPayPostBack', 'QuotationController@DragonPayPostBack');
Route::get('GetDefaultSurcharge', 'QuotationController@GetDefaultSurcharge');
Route::get('GetPerilsComm', 'QuotationController@GetPerilsComm');
Route::get('GetLinesComm', 'QuotationController@GetLinesComm');




///-------------API-------------API
Route::get('Get_Request_Quotation', 'QuotationController@Get_Request_Quotation');
Route::get('API_Get_Request_Quotation', 'QuotationController@API_Get_Request_Quotation');
//Route::get('API_Get_Request_Quotation', ['as' => 'demo', 'uses' => 'QuotationController@API_Get_Request_Quotation']);


//-new registration

Route::get('ViewUserList', 'RegistrationController@ViewUserList');
Route::post('RestoreUser', 'RegistrationController@RestoreUser');
Route::post('RemoveUser', 'RegistrationController@RemoveUser');
Route::get('UserProfileView/{id}', 'RegistrationController@UserProfileView');
Route::post('LoadUsersProfileView', 'RegistrationController@LoadUsersProfileView');
Route::post('RemoveUserAccess', 'RegistrationController@RemoveUserAccess');
Route::post('RestoreUserAccess', 'RegistrationController@RestoreUserAccess');
Route::post('UpdateUserDetails', 'RegistrationController@UpdateUserDetails');
Route::post('AddNewPrivileges', 'RegistrationController@AddNewPrivileges');
Route::post('AddNewCommission', 'RegistrationController@AddNewCommission');



//------FIRE--------

///-----------AGENT's 
Route::get('GetFirePerils', 'FireController@GetFirePerils');
Route::get('LoadPerilsSub', 'FireController@LoadPerilsSub');
Route::post('FireRequestQuotation', 'FireController@FireRequestQuotation');
Route::get('FireGetUserRequest/{id}', 'FireController@FireGetUserRequest');
Route::get('FireGetUserRequestPaging', 'FireController@FireGetUserRequestPaging');
Route::get('ProposalViewFire/{id}', 'FireController@ProposalViewFire');


//!-----NEw----FileMaintenance------------------
Route::get('GetDenomination', 'FileMaintenance@GetDenomination');   
Route::get('GetCarAmount', 'FileMaintenance@GetCarAmount');   
Route::get('GetCarBrands', 'FileMaintenance@GetCarBrands');  
Route::get('GetCarModels/{id}', 'FileMaintenance@GetCarModels');
Route::get('GetCarBodyTypes', 'FileMaintenance@GetCarBodyTypes');
Route::get('GetSurcharges', 'FileMaintenance@GetSurcharges');
Route::get('GetPerils', 'FileMaintenance@GetPerils');
Route::get('GetBarangays/{id}', 'FileMaintenance@GetBarangays');
Route::get('GetCities', 'FileMaintenance@GetCities');



Route::post('QuotationMotor', 'QuotationController@QuotationMotor');
Route::get('UpdateRequest/{id}', 'QuotationController@UpdateRequest');
Route::post('UpdatePersonalDetails', 'QuotationController@UpdatePersonalDetails');
Route::post('UpdateMotorDetails', 'QuotationController@UpdateMotorDetails');




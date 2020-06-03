<html>
<head>
<script src='/testing-cocaf/jquery.min.js'   type="text/javascript"></script>
<script>
jQuery( document ).ready(function( $ ) {  //avoid conflict for jquery 
var value= "Sample";
//$(".fixme" ).attr('href','/testing/page2.php?url=' + value);  //val('Sample');


 //$("#IDDiv" ).load("https://www.google.com/ #registration");

 $('#IDDiv').load('load.php?url=www.google.com')
//var GetValue = $("#IDDiv" ).html();

					
				$.ajax({
					url:"https://www.google.com/",  // name / function of the controller
					type: 'POST',
					
					success: function (dataCheck) { 
                     	//$('#IDDiv1').load($(dataCheck).find('#registration').load());
					
					},   
					error: function(err){  
						//alert('error');				
					}           
				});

$(".fixme").click(function(){ 
		$("#sampleRes" ).val(value);
		//$("#IDDiv11" ).load("http://localhost/fuman/index.php/login #username");
		//$(".fixme" ).attr('href','/testing/page2.php?sampleRes=' + value);  //val('Sample');
});
$("#MainCOCNumber").keyup(function(){ 
	$("#cocNo" ).val(this.value	);

});
$("#MainPlateNo").keyup(function(){ 
	$("#plateNo" ).val(this.value	);

});


});
</script> 
</head>

<body><div>
<table border="1" width="847" height="280" cellpadding="0" cellspacing="0" align="center" style="background-color: white;">
	<tbody><tr>

		<td height="30" colspan="2">

<div><img src="https://cocaftest1.cloudapp.net/images/piraLogo.png"></div>
		</td>
	</tr>
    
	<tr>
	<td width="136" height="250" valign="top">
<link rel="stylesheet" href="css/menu.css" type="text/css">
<link rel="stylesheet" href="css/flyout.css" type="text/css">
<script language="JavaScript" src="javascripts/home.js">
</script>
<script type="text/javascript" src="javascripts/flyout.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta http-equiv="PRAGMA" content="NO-CACHE">
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE">
<title>
ISAP COC Authentication Facility
</title>

<style type="text/css">
#menuId {
background:url("https://cocaftest1.cloudapp.net/images/bgnav.gif") repeat-y;
}
A:link, A:active, A:visited {
  text-decoration: none;
  color: #FFFF00;
  background:transparent;
}
A:hover {color: white; font-weight: bold}
</style>

<div id="menuId" style="background: url('https://cocaftest1.cloudapp.net/images/bgnav.gif') repeat-y;background-color: green;height: 600px; padding-left: 5px; width:136px">
  <!--<table border="0"><tr><td align="center" >-->
  <font face="Verdana" size="1"><br><br>
  {{-- <b><font face="Verdana" size="1" color="#000000">Welcome - MSHC6</font></b><br><br> --}}
  </font><div style="position: absolute; margin: 0 auto; padding-top: 10px;background: url('https://cocaftest1.cloudapp.net/images/bgnav.gif') repeat-y;"><font face="Verdana" size="1">
    
    {{-- <dl class="dropdown" style="z-index: 5">
      <dt id="cocTran-ddheader" class="upperdd" onmouseover="ddMenu('cocTran',1)" onmouseout="ddMenu('cocTran',-1)">COC Transactions</dt>
      <dd id="cocTran-ddcontent" onmouseover="cancelHide('cocTran')" onmouseout="ddMenu('cocTran',-1)" style="display: none; height: 91px; z-index: 118; opacity: 0.742647;">
      {{-- <ul>
      
      
      
         <li><a href="Registration.action" class="underline">COC Single Registration</a></li>
        <li><a href="BatchAuthentication.action" class="underline">COC Batch Registration</a></li>
        <li><a href="VerificationAuth.action" class="underline">COC Verification - By Authentication No.</a></li>
        <li><a href="Verification.action" class="underline">COC Verification - By COC&nbsp;No.</a></li>
        
      
      </ul> 
      </dd>
    </dl> --}}
   
    {{-- <dl class="dropdown" style="z-index: 4">
      <dt id="credits-ddheader" class="upperdd" onmouseover="ddMenu('credits',1)" onmouseout="ddMenu('credits',-1)">Credits</dt>
      <dd id="credits-ddcontent" onmouseover="cancelHide('credits')" onmouseout="ddMenu('credits',-1)" style="display: none; height: 24px; z-index: 122; opacity: 0.627907;">
      <ul>
        <li><a href="BalanceInquiry.action" class="underline">Balance Inquiry</a></li>	
       
      
        </ul>
      </dd>
    </dl> --}}
    
  
    {{-- <dl class="dropdown" style="z-index: 3">
      <dt id="report-ddheader" class="upperdd" onmouseover="ddMenu('report',1)" onmouseout="ddMenu('report',-1)">Reports </dt>
      <dd id="report-ddcontent" onmouseover="cancelHide('report')" onmouseout="ddMenu('report',-1)" style="display: none; height: 21px; z-index: 120; opacity: 0.348485;">
      <ul>
          <li><a href="ReportSummaryCoc.action" class="underline">Summary of COCs</a></li>		 
          <li><a href="ReportIssuedCoc.action" class="underline">Issued COCs</a></li>
          
        </ul>
      </dd>
    </dl> --}}
    <!--< s : if test="%{#session.membType!=null && (#session.membType==4 || #session.membType==0)}">-->
  
    {{-- <dl class="dropdown" style="z-index: 2">
      <dt id="admin-ddheader" class="upperdd" onmouseover="ddMenu('admin',1)" onmouseout="ddMenu('admin',-1)">Admin </dt>
      <dd id="admin-ddcontent" onmouseover="cancelHide('admin')" onmouseout="ddMenu('admin',-1)" style="display: none; height: 13px; z-index: 123; opacity: 0.325581;">
      <ul>
        <li><a href="changePassword.action" class="underline">Change Password</a></li>
      
        </ul>
      </dd>
    </dl> --}}
    <!--/s :if -->
    
    {{-- <dl class="dropdown" style="z-index: 1">
        <dt id="umanual-ddheader" class="upperdd"><a href="users_manual/CompanyUser/index.jsp" target="_blank"><font face="Verdana" size="1">User Manual</font></a></dt>
      </dl>
    
    
    <dl class="dropdown" style="z-index: 0">
      <dt id="purchase-ddheader" class="upperdd"><a href="Logout.action"><font face="Verdana" size="1">Log Out</font></a></dt>
    </dl>
    <br><br>
          <p align="left">
          <font size="1" face="Verdana">Developed by
          <br><br></font><a href="http://www.wizardsgroup.com" target="_blank"><img border="0" src="images/wizards_logo.png" width="110" height="50" alt="System Developed By Wizardsgroup ">
          </a>
          <br><br>
          <font face="Verdana" size="1"><font color="#000000"><b>COCAF Hotlines</b>
          <br>
          Technical Assistance
          <br>
          &nbsp;&nbsp;&nbsp;&nbsp; 752 53 56
          <br>
          Billing Concerns</font>
          <br>
          &nbsp;&nbsp;&nbsp;&nbsp; <font color="#000000">889 69 99 loc 123</font>
      <br>
      <br>
      <font color="#000000">cocaf@wizardsgroup.com</font>
          </font>
          </p>
  
         
          </font>
  
  
  </div> --}}
  
  
  <!--</td>
  </tr></table>-->
  
  </div>

</div>

</td>
		<td width="711" style="vertical-align: top; padding-top: 25px">





<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>COC Registration</title>
<script type="text/javascript" src="javascripts/date-picker.js"></script>
<script type="text/javascript" src="javascripts/registration.js"></script>

<script language="JavaScript" type="text/javascript">
    // Dojo configuration
    djConfig = {
        isDebug: false,
        bindEncoding: "UTF-8"
          ,baseRelativePath: "/struts/dojo/"
          ,baseScriptUri: "/struts/dojo/"
         ,parseWidgets : false
        
    };
</script>



  <script language="JavaScript" type="text/javascript" src="/struts/dojo/struts_dojo.js"></script><textarea id="dojo.widget.RichText.savedContent" style="display:none;position:absolute;top:-100px;left:-100px;height:3px;width:3px;overflow:hidden;"></textarea>

<script language="JavaScript" type="text/javascript" src="/struts/ajax/dojoRequire.js"></script>
<link rel="stylesheet" href="/struts/xhtml/styles.css" type="text/css">

<script language="JavaScript" src="/struts/utils.js" type="text/javascript"></script>
<script language="JavaScript" src="/struts/xhtml/validation.js" type="text/javascript"></script>
<script language="JavaScript" src="/struts/css_xhtml/validation.js" type="text/javascript"></script>


        
<form id="registration" name="registration" onsubmit="return validate(this)" action="https://cocaftest1.cloudapp.net/Register.action" method="post">
  <table border="0" width="100%" height="457">
    <tbody><tr>
      <td width="100%" height="19" valign="top" align="left">
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tbody><tr><td colspan="2"><font face="Verdana">COC Registration</font></td></tr>
        </tbody></table>
        <hr>
      </td>
    </tr>
      <tr id="detailErrorRow">
        <td width="100%" valign="top" align="left">
          <font face="Verdana" size="1" color="red">
			
			<br>
          </font>
        </td>
      </tr>
      <tr id="errorRow" style="display: none">
        <td width="100%" valign="top" align="left">
          <font face="Verdana" size="1" color="red">
			<span id="formErrors"></span>
			<br>
          </font>
        </td>
      </tr>
    <tr>
      <td width="100%" height="19" valign="top" align="left"><font face="Verdana" size="1">Please supply the following information to register COC</font></td>
    </tr>
    <tr>
      <td width="100%" height="426" valign="top" align="center">
		<img id="indicator1" src="/images/ajax-loader.gif" alt="Loading Info" style="display: none;">
        <br>
        
        <div dojotype="struts:BindDiv" id="widget_1974296838" formid="registration" href="RetrieveDetails.action" listentopics="renewal_topic" indicator="indicator1" showerror="true" parsecontent="true">


		<input type="hidden" name="hiddenMvPremType" value="1" id="hiddenMvPremType">
        <table border="0" width="95%" style="text-align: left">
          <tbody><tr>
            <td width="47%"><font face="Verdana" size="1">New</font></td>
            <td width="60%"><input type="checkbox" name="regType" value="true" id="regType" onchange="retrieveDetails('cb')"><input type="hidden" id="__checkbox_regType" name="__checkbox_regType" value="true"></td>
          </tr>
          <tr>
            <td width="47%"><font face="Verdana" size="1">COC Number</font></td>
            <td width="60%"><font face="universe"><input type="text" name="cocNo" size="20" maxlength="15"  id="cocNo" value="<?php echo $_GET['COCNo'] ?>"></font></td>
          </tr>
          <tr>
            <td width="47%"><font face="Verdana" size="1">Plate No. (e.g. THY615)</font></td>
            <td width="60%"><font face="universe"><input type="text" name="plateNo" size="20" maxlength="7"  id="plateNo" value="<?php echo $_GET['PlateNumber'] ?>"   onblur="retrieveDetails('plateno')" onchange="retrieveDetails('plateno')"></font></td>
          </tr>
          <tr>
            <td width="47%"><font face="Verdana" size="1">MV File No.</font></td>
            <td width="60%"><font face="universe"><input type="text" name="mvFileNo" size="20" maxlength="15"  id="mvFileNo"  value="<?php echo $_GET['MvFileNo'] ?>"   onblur="retrieveDetails('mvfileno')" onchange="retrieveDetails('mvfileno')"></font></td>
          </tr>
          <tr>
            <td width="47%"><font face="Verdana" size="1">Engine No.</font></td>
            <td width="60%"><font face="universe"><input type="text" name="engineNo" size="20" maxlength="40" value="<?php echo $_GET['EngineNo'] ?>"   id="engineNo"></font></td>
          </tr>
          <tr>
            <td width="47%"><font face="Verdana" size="1">Chassis No.</font></td>
            <td width="60%"><font face="universe"><input type="text" name="chassisNo" size="20" maxlength="40"  id="chassisNo" value="<?php echo $_GET['ChassisNo'] ?>"></font></td>
          </tr>
          <tr>
            <td width="47%"><font face="Verdana" size="1">Inception Date (mm/dd/yyyy)</font></td>
            <td width="60%">
              <input type="text" name="inceptionDate" value="<?php echo $_GET['MotorEffectiveDate'] ?>"id="inceptionDate" onchange="adjustExpiryDate()">
              <a href="javascript:show_calendar('registration.inceptionDate')" onmouseover="window.status='Date Picker';return true;" onmouseout="window.status='';return true;">
                <img src="https://cocaftest1.cloudapp.net/images/cal_icon.gif" width="24" height="22" border="0">
              </a>
            </td>
          </tr>
          <tr>
            <td width="47%"><font face="Verdana" size="1">Expiry Date (mm/dd/yyyy)</font></td>
            <td width="60%">
              <input type="text" name="expiryDate" value="<?php echo $_GET['MotorExpiryDate'] ?>"  id="expiryDate">
              <a href="javascript:show_calendar('registration.expiryDate')" onmouseover="window.status='Date Picker';return true;" onmouseout="window.status='';return true;">
                <img src="https://cocaftest1.cloudapp.net/images/cal_icon.gif" width="24" height="22" border="0">
              </a>
            </td>
          </tr>
          <tr>
            <td width="47%"><font face="Verdana" size="1">MV Type</font></td>
            <td width="60%"><select name="mvType" id="mvType" onchange="dojo.event.topic.publish('mv_type_topic'); return false">
            <option value="<?php echo $_GET['mvType'] ?>" selected="selected">[<?php echo $_GET['mvType'] ?>] - <?php echo $_GET['mvPremTypeDesc'] ?></option>
            <option value="C">[C] - Car</option>
            <option value="HB">[HB] - Shuttle Bus</option>
            <option value="LE">[LE] - Light Electric Vehicle</option>
            <option value="M">[M] - Motorcycle without Side Car</option>
            <option value="MO">[MO] - Mopeds (0-49 cc)</option>
            <option value="MS">[MS] - Motorcycle with Side Car</option>
            <option value="NC">[NC] - Non-Conventional MC (Car)</option>
            <option value="NV">[NV] - Non-Conventional MV (UV)</option>
            <option value="OB">[OB] - Tourist Bus</option>
            <option value="SB">[SB] - School Bus</option>
            <option value="SV">[SV] - Sports Utility Vehicle</option>
            <option value="TB">[TB] - Truck Bus</option>
            <option value="TC">[TC] - Tricycle</option>
            <option value="TK">[TK] - Truck</option>
            <option value="TL">[TL] - Trailer</option>
            <option value="UV">[UV] - Utility Vehicle</option>


</select>

</td>
          </tr>
          <tr>
            <td width="47%"><font face="Verdana" size="1">Premium Type</font></td>
            <td width="60%">
              
              <div dojotype="struts:BindDiv" id="widget_1008165691" formid="registration" href="GetMVPremiumTypes.action" listentopics="mv_type_topic" showerror="true" parsecontent="true">

<select name="mvPremType" id="mvPremType">
    <option value="1" >1 - Private Cars (including jeeps and AUVs) - 1 year  (Php 560.00)</option>
    <option value="2">2 - Light Medium Trucks  (Own Goods) Not over 3,930 kgs. - 1 year  (Php 610.00)</option>
    <option value="4">4 - AC and Tourists Cars - 1 year  (Php 740.00)</option>
    <option value="5">5 - Taxi, PUJ and Mini bus - 1 year  (Php 1100.00)</option>
    <option value="8">8 - Private Cars (including jeeps and AUVs) - 3 years  (Php 1610.00)</option>
    <option value="9">9 - Light Medium Trucks  (Own Goods) Not over 3,930 kgs.- 3 years  (Php 1750.00)</option>
    <option value="11">11 - AC and Tourists Cars - 3 years  (Php 2120.00)</option>
    <option value="12">12 - Taxi, PUJ and Mini bus - 3 years  (Php 3150.00)</option>


</select>

</div>


            </td>
          </tr>
          <tr>
            <td width="47%"><font face="Verdana" size="1">Tax Type</font></td>
            <td width="60%">
              <div style="width: 146px; border: solid 1px #A5ACB2;">
                <font face="Verdana" size="1"><input type="radio" name="taxType" id="taxType1" checked="checked" value="1"><label for="taxType1">[1] VAT</label>
<br>
<input type="radio" name="taxType" id="taxType2" value="2"><label for="taxType2">[2] Non-VAT</label>
<br>
<input type="radio" name="taxType" id="taxType3" value="3"><label for="taxType3">[3] Zero Rated</label>
<br>
<input type="radio" name="taxType" id="taxType0" value="0"><label for="taxType0">[0] VAT Exempt</label>
<br>
</font> 
              </div>
            </td>
          </tr>
          <tr>
            <td width="47%"><font face="Verdana" size="1">Assured Name</font></td>
            <td width="60%"><font face="universe"><input type="text" name="assuredName" value="<?php echo $_GET['AssuredName'] ?>" size="40" maxlength="100"  id="assuredName"></font></td>
          </tr>
          <tr>
            <td width="47%"><font face="Verdana" size="1">Assured TIN</font></td>
            <td width="60%">
              <font face="universe">
              <input type="text" name="assuredTinA" size="3" maxlength="3" value="<?php echo $_GET['TinNOA'] ?>" id="assuredTinA">
              -
              <input type="text" name="assuredTinB" size="3" maxlength="3" value="<?php echo $_GET['TinNOB'] ?>"  id="assuredTinB">
              -
              <input type="text" name="assuredTinC" size="3" maxlength="3" value="<?php echo $_GET['TinNOC'] ?>" id="assuredTinC">
              -
              <input type="text" name="assuredTinD" size="3" maxlength="3" value="<?php echo $_GET['TinNOD'] ?>"  id="assuredTinD">
              </font>
            </td>
          </tr>
        </tbody></table></div>
<script language="JavaScript" type="text/javascript">djConfig.searchIds.push("widget_1974296838");</script>

        <br>
        <font face="Verdana"><input type="submit" value="Register COC" id="registerBtn" name="registerBtn">
</font>
      </td>
    </tr>
  </tbody></table>
</form>




</td>

</tr>
	
</tbody></table>
</div>


</body>


</body>

</html>


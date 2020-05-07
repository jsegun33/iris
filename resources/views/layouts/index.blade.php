
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name='user_id' content="{{ Auth::user()->user_lname }}">

  <title>IRIS</title>
  

  <link rel="shortcut icon" href="{{ asset('img/IRISLogo.png') }}">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <!-- Vue MultiSelect -->
  <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper" id="app">

        <header class="main-header">
            <!-- Logo -->
            <router-link to="/dashboard" class="logo" style="text-decoration: none;">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">
                    <!-- <b>IRIS</b> -->
                    <img src="/img/IRISLogo.png" alt="Logo">
                </span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">
                    <!-- <b>IRIS</b>web -->
                    <img src="/img/irislog.png" alt="Logo">
                </span>
            </router-link>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="text-decoration: none;">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                {{-- <li class="header">You have 4 messages</li> --}}
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small>
                                                        <i class="fa fa-clock-o"></i> 
                                                        5 mins
                                                    </small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    AdminLTE Design Team
                                                    <small>
                                                        <i class="fa fa-clock-o"></i> 
                                                        2 hours
                                                    </small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Developers
                                                    <small>
                                                        <i class="fa fa-clock-o"></i> 
                                                        Today
                                                    </small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <ul class="menu">
                                        {{-- <li>
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> 
                                                5 new members joined today
                                            </a> --}}
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-red"></i> 
                                                5 new members joined
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="/img/avatar5.png" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ Auth::user()->user_fname." ".Auth::user()->user_lname }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="/img/avatar5.png" class="img-circle" alt="User Image">
                                    <p>
                                        {{ Auth::user()->user_fname." " .Auth::user()->user_lname }}
                                        {{-- <small>Member since December 20191</small> --}}
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="row">
                                        {{-- <div class="col-xs-4 text-center">
                                            <a href="#" class="btn btn-default btn-flat" style="text-decoration: none;">Proposal</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#" class="btn btn-default btn-flat" style="text-decoration: none;">Proposal</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#" class="btn btn-default btn-flat" style="text-decoration: none;">Proposal</a>
                                        </div> --}}
                                        
                                       
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-success btn-flat" style="text-decoration: none;">
                                            <i class="fa fa-user"></i>
                                            Profile
                                        </a>
                                    </div>
                                    <div class="pull-right">
                                        <a class="btn btn-danger btn-flat" 
                                            href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"
                                            style="text-decoration: none;">
                                                <i class="fa fa-power-off"></i>
                                                {{ __('Sign out') }}
                                        </a>

                                        <form id="logout-form" 
                                            action="{{ route('logout') }}" 
                                            method="POST" 
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="/img/avatar5.png" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p class="no-margin">{{ Auth::user()->user_fname." " .Auth::user()->user_lname }}</p>
                        <p>{{ Auth::user()->AccountNo }}</p>
                        <!-- <a href="#">
                            <i class="fa fa-circle text-success"></i> 
                            Online
                        </a> -->
                    </div>
                </div>
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">Dashboard</li>
                    {{-- <li>
                        <router-link to="/dashboard">
                            <i class="fa fa-dashboard"></i> 
                            <span>Dashboard</span>
                        </router-link>
                    </li> --}}
                    <?php if ( trim(Auth::user()->AccountNo) == '2019-0001'  ){ ?>
                        <?php

                        $GetRole = DB::table('type')
                            ->select('*')  
                            //->where('AccountNo', Auth::user()->AccountNo)  
                            ->where('active',1)  
                            ->where('UnderSubMenu','')  
                            ->get();

                            foreach ($GetRole as $GetRoles){
                    
                        ?>   
                        <li class="treeview" style="height: auto;">
                            <a href="#"> 
                                <?php if ( !empty($GetRoles['icon_display'])) {?>
                                <i class="{{ $GetRoles['icon_display'] }}"></i>
                                <?php  }  ?>  
                                
                                {{ $GetRoles['type_name']  }}
                              <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                              </span>
                            </a>
                                       
                            <ul class="treeview-menu">
                                <?php 
                                //echo $GetRoles['acctTypeName'] ;
        
                                $GetSubMenu = DB::table('type_sub_link')
                                    ->select('*')
                                    ->where('type_ID',trim($GetRoles['_id']) ) 
                                    ->where('type_name',trim($GetRoles['type_name']) ) 
                                    ->where('active', 1)
                                    ->orderBy('SubLink_TypeName','ASC')
                                    //->groupBy('_id')  
                                    ->get();
        
        
                                    foreach ($GetSubMenu as $GetSubMenus){
                                ?>
                                          <li><router-link to="{{ $GetSubMenus['SubLink_URL'] }}"> <?php if ( !empty($GetSubMenus['icon_display'])) {?><i class="{{ $GetSubMenus['icon_display'] }}"></i><?php }?>{{ $GetSubMenus['SubLink_TypeName'] }}</router-link></li>
                                <?php }  ?>


                                    <!-------if has sub menu------------>
                                    <?php 
                                
            
                                    $GetSubMenuType = DB::table('type')
                                        ->select('*')
                                        ->where('UnderSubMenu',trim($GetRoles['_id']) ) 
                                        //->where('type_name',trim($GetRoles['type_name']) ) 
                                        ->where('active', 1)
                                        ->orderBy('type_name','ASC')
                                        //->groupBy('_id')  
                                        ->get();
            
            
                                        foreach ($GetSubMenuType as $GetSubMenuTypes){
                                    ?>
                                        <li class="treeview">
                                            <a href="#">
                                                
                                                <?php if ( !empty($GetSubMenuTypes['icon_display'])) {?>
                                                    <i class="{{ $GetSubMenuTypes['icon_display'] }}"></i>
                                                    <?php  }  ?>  
                                                {{ $GetSubMenuTypes['type_name'] }}
                                                
                                                 
                                                <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                                 </span>
                                                </a>
                                           
                                   
                                            <ul class="treeview-menu">
                                                <?php 
                                                //echo $GetRoles['acctTypeName'] ;
                        
                                                $GetSubMenuSub = DB::table('type_sub_link')
                                                    ->select('*')
                                                    ->where('type_ID',trim($GetSubMenuTypes['_id']) ) 
                                                   // ->where('type_name',trim($GetRoles['type_name']) ) 
                                                    ->where('active', 1)
                                                    ->orderBy('SubLink_TypeName','ASC')
                                                    //->groupBy('_id')  
                                                    ->get();
                        
                        
                                                    foreach ($GetSubMenuSub as $GetSubMenuSubs){
                                                ?>
                                                          <li><router-link to="{{ $GetSubMenuSubs['SubLink_URL'] }}"> <?php if ( !empty($GetSubMenuSubs['icon_display'])) {?><i class="{{ $GetSubMenuSubs['icon_display'] }}"></i><?php }?>{{ $GetSubMenuSubs['SubLink_TypeName'] }}</router-link></li>
                                                <?php }  ?>
                                             
                                            </ul>
                                        </li>
                                    <?php }?>  
                                      <!-------if has sub menu------------>
                             </ul>
                             

                          </li>
                        <?php } ?>

                    
                    



                    <?php } ?> <!---------Close Admin------------------------>
					
                    <?php  if ( trim(Auth::user()->pageRegister) == 1  ){ ?>
                        <?php

                        $GetRole = DB::table('type')
                            ->select('*')  
                            ->where('UserMenu',1)  
                            ->where('active',1)  
                            ->where('UnderSubMenu','')  
                            ->get();

                            foreach ($GetRole as $GetRoles){
                    
                        ?>   
                        <li class="treeview" style="height: auto;">
                            <a href="#"> 
                                <?php if ( !empty($GetRoles['icon_display'])) {?>
                                <i class="{{ $GetRoles['icon_display'] }}"></i>
                                <?php  }  ?>  
                                
                                {{ $GetRoles['type_name']  }}
                              <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                              </span>
                            </a>
                                       
                            <ul class="treeview-menu">
                                <?php 
                                //echo $GetRoles['acctTypeName'] ;
        
                                $GetSubMenu = DB::table('type_sub_link')
                                    ->select('*')
                                    ->where('type_ID',trim($GetRoles['_id']) ) 
                                    ->where('type_name',trim($GetRoles['type_name']) ) 
                                    ->where('UserMenu',1) 
                                    ->where('active', 1)
                                    ->orderBy('SubLink_TypeName','ASC')
                                    //->groupBy('_id')  
                                    ->get();
        
        
                                    foreach ($GetSubMenu as $GetSubMenus){
                                ?>
                                          <li><router-link to="{{ $GetSubMenus['SubLink_URL'] }}"> <?php if ( !empty($GetSubMenus['icon_display'])) {?><i class="{{ $GetSubMenus['icon_display'] }}"></i><?php }?>{{ $GetSubMenus['SubLink_TypeName'] }}</router-link></li>
                                <?php }  ?>


                                    <!-------if has sub menu------------>
                                    <?php 
                                
            
                                    $GetSubMenuType = DB::table('type')
                                        ->select('*')
                                        ->where('UnderSubMenu',trim($GetRoles['_id']) ) 
                                        ->where('UserMenu',1) 
                                        ->where('active', 1)
                                        ->orderBy('type_name','ASC')
                                        //->groupBy('_id')  
                                        ->get();
            
            
                                        foreach ($GetSubMenuType as $GetSubMenuTypes){
                                    ?>
                                        <li class="treeview">
                                            <a href="#">
                                                
                                                <?php if ( !empty($GetSubMenuTypes['icon_display'])) {?>
                                                    <i class="{{ $GetSubMenuTypes['icon_display'] }}"></i>
                                                    <?php  }  ?>  
                                                {{ $GetSubMenuTypes['type_name'] }}
                                                
                                                 
                                                <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                                 </span>
                                                </a>
                                           
                                   
                                            <ul class="treeview-menu">
                                                <?php 
                                                //echo $GetRoles['acctTypeName'] ;
                        
                                                $GetSubMenuSub = DB::table('type_sub_link')
                                                    ->select('*')
                                                    ->where('type_ID',trim($GetSubMenuTypes['_id']) ) 
                                                    ->where('UserMenu',1) 
                                                    ->where('active', 1)
                                                    ->orderBy('SubLink_TypeName','ASC')
                                                    //->groupBy('_id')  
                                                    ->get();
                        
                        
                                                    foreach ($GetSubMenuSub as $GetSubMenuSubs){
                                                ?>
                                                          <li><router-link to="{{ $GetSubMenuSubs['SubLink_URL'] }}"> <?php if ( !empty($GetSubMenuSubs['icon_display'])) {?><i class="{{ $GetSubMenuSubs['icon_display'] }}"></i><?php }?>{{ $GetSubMenuSubs['SubLink_TypeName'] }}</router-link></li>
                                                <?php }  ?>
                                             
                                            </ul>
                                        </li>
                                    <?php }?>  
                                      <!-------if has sub menu------------>
                             </ul>
                             

                          </li>
                        <?php } ?>




                   
					<!---------Close page Registration------------------------>
					
					
                    <?php }else{ ?>  
                                <!-------Agent Menu--------->
                                <?php

                                    $GetRole = DB::table('user_roles')
                                    ->select('*')  
                                    ->where('AccountNo', Auth::user()->AccountNo)  
                                    ->where('active', 1)  
                                    //->where('',$GetRoles['acctType']) 
                                    ->groupBy('acctTypeName','acctType','UnderSubMenu','icon_display')  
                                    ->get();
                                     foreach ($GetRole as $GetRoles){

                                        $GetRoleTypes = DB::table('type')
                                            ->select('*')  
                                            ->where('UnderSubMenu','!=', $GetRoles['UnderSubMenu'] )  
                                            ->where('active',1)  
                                            //->groupBy('UnderSubMenu')  
                                            ->orderBy('order','DESC')
                                            ->first();

                                       if ( !empty($GetRoleTypes['UnderSubMenu'] )  ) {
                                        
                                ?>   

                                <li class="treeview" style="height: auto;">
                                    <a href="#"> 
                                        <?php if ( !empty($GetRoles['icon_display'])) {?>
                                        <i class="{{ $GetRoles['icon_display'] }}"></i>
                                        <?php  }  ?>  
                                        
                                        {{ $GetRoles['acctTypeName'] }}   <!-------Agent Menu-------->
                                      <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                      </span>
                                    </a>

                                    <ul class="treeview-menu">
                                        <?php 
                                            $GetSubMenu = DB::table('user_role_access')
                                            ->select('*')
                                            ->where('AccountNo',trim(Auth::user()->AccountNo)) 
                                            ->where('acctTypeSub',$GetRoles['acctType'] )
                                            ->where('active', 1)
                                            ->where('status', 1)
                                            ->orderBy('role_name_access','ASC')
                                            ->groupBy('AccountNo','acctTypeSub','role_number_url','role_name_access','acctType','icon_display')  
                                            ->get();
                                        foreach ($GetSubMenu as $GetSubMenus){
                                        ?>
                                                  <li><router-link to="{{ $GetSubMenus['role_number_url'] }}"> <?php if ( !empty($GetSubMenus['icon_display'])) {?><i class="{{ $GetSubMenus['icon_display'] }}"></i><?php }?>{{ $GetSubMenus['role_name_access'] }}</router-link></li>  <!---ok-->
                                        <?php }  ?>


                                         <!-------if has sub menu------------>
                                         <?php
                                         $GetSubMenuType = DB::table('user_roles')
                                             ->select('*')
                                             ->where('UnderSubMenu',$GetRoles['acctType']) 
                                             ->where('AccountNo',Auth::user()->AccountNo ) 
                                             ->where('active',1 )
                                             ->where('status',1 )
                                             ->orderBy('acctTypeName','ASC')
                                            ->groupBy('acctTypeName','acctType','icon_display')  
                                             ->get();
                 
                 
                                             foreach ($GetSubMenuType as $GetSubMenuTypes){
                                         ?>
                                             <li class="treeview">
                                                 <a href="#">
                                                     
                                                     <?php if ( !empty($GetSubMenuTypes['icon_display'])) {?>
                                                         <i class="{{ $GetSubMenuTypes['icon_display'] }}"></i>
                                                         <?php  }  ?>  
                                                     {{ $GetSubMenuTypes['acctTypeName']}}
                                                     
                                                      
                                                     <span class="pull-right-container">
                                                     <i class="fa fa-angle-left pull-right"></i>
                                                      </span>
                                                     </a>
                                                
                                        
                                                 <ul class="treeview-menu">
                                                     <?php 
                                                  
                                                     $GetSubMenuAccess = DB::table('user_role_access')
                                                         ->select('*')
                                                         ->where('acctTypeSub',$GetSubMenuTypes['acctType']) 
                                                        // ->where('type_name',trim($GetRoles['type_name']) ) 
                                                         ->where('active', 1)
                                                         ->orderBy('role_name_access','ASC')
                                                         ->groupBy('role_name_access','role_number_url','icon_display')  
                                                         ->get();
                             
                             
                                                         foreach ($GetSubMenuAccess as $GetSubMenuAccesss){
                                                     ?>
                                                               <li><router-link to="{{ $GetSubMenuAccesss['role_number_url'] }}"> <?php if ( !empty($GetSubMenuAccesss['icon_display'])) {?><i class="{{ $GetSubMenuAccesss['icon_display'] }}"></i><?php }?>{{ $GetSubMenuAccesss['role_name_access']  }}</router-link></li>
                                                     <?php }  ?>
                                                  
                                                 </ul>
                                             </li>
                                         <?php }?>  
                                           <!-------if has sub menu------------>


                                   </ul>

                                               
                                    
        
                                  </li>
                                <?php }  ?>
                                <?php } ?>
                            
                            




                    
                    

                    <?php }  ?><!---------close User Menu------------------------>
                    <!-- <li class="header">FILE MAINTENANCE</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-users"></i> 
                            <span>User Management</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/registration">
                                    <i class="fa fa-circle-o"></i> 
                                    Registration
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/maintenance-user-department">
                                    <i class="fa fa-circle-o"></i> 
                                    Department
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/maintenance-user-type">
                                    <i class="fa fa-circle-o"></i> 
                                    Type
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/maintenance-user-sub-type">
                                    <i class="fa fa-circle-o"></i> 
                                    Sub - Type
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/maintenance-user-authority">
                                    <i class="fa fa-circle-o"></i> 
                                    Authority
                                </router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-line-chart"></i> 
                            <span>Product Lines</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/maintenance-product-lines">
                                    <i class="fa fa-circle-o"></i> 
                                    Create Product Line
                                </router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-car"></i> 
                            <span>Motor Car</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/maintenance-class">
                                    <i class="fa fa-circle-o"></i> 
                                    Class / Kind
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/maintenance-denomination">
                                    <i class="fa fa-circle-o"></i> 
                                    Denomination
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/CarBodyBranch">
                                    <i class="fa fa-circle-o"></i> 
                                    Car Brand
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/CarModel">
                                    <i class="fa fa-circle-o"></i> 
                                    Car Model
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/CarBodyType">
                                    <i class="fa fa-circle-o"></i> 
                                    Car Body Type
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/maintenance-car-amount">
                                    <i class="fa fa-circle-o"></i> 
                                    Car Amount
                                </router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-database"></i> 
                            <span>Coverages</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <router-link to="/maintenance-peril">
                                    <i class="fa fa-circle-o"></i> 
                                    Perils
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/maintenance-taripa">
                                    <i class="fa fa-circle-o"></i> 
                                    Taripa
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/maintenance-surcharge">
                                    <i class="fa fa-circle-o"></i> 
                                    Surcharge
                                </router-link>
                            </li>
                        </ul>
                    </li> -->
                    <!-- <li class="header">LABELS</li>
                    <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
                </ul>
            </section>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <router-view></router-view>
        </div>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            <strong>2020 @
            <a href="https://www.iristech.ph/">IRISTech Creative Solutions Inc.</a>
            </strong> All rights reserved.
        </footer>
    </div>

<script src="/js/app.js"></script>
<!-- jQuery 3 -->
<script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('adminlte/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('js/vue.min.js')}}"></script>
</body>
</html>

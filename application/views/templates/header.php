<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Karter</title>
    <!-- Searchable Dropdown List -->
    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url() . 'css/bootstrap.min.css'?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?=base_url() . 'css/plugins/metisMenu/metisMenu.min.css'?>" rel="stylesheet">

    <!-- Mobile Menu CSS -->
    <link href="<?=base_url() . 'css/mob_menu.css'?>" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?=base_url() . 'css/plugins/dataTables.bootstrap.css'?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=base_url() . 'css/sb-admin-2.css'?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=base_url() . 'css/font-awesome/font-awesome.min.css'?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
      <div class='navbar-header'>
        <a class="navbar-brand" href="<?=base_url() . 'home'?>">Karter Dashboard</a>


      </div>


        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                  <li>
                    <a href="home"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                   </li>
                    <li>
                        <a href="#">
                          <i class="fa fa-table fa-fw"></i> Tables
                          <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <?foreach($ArrURL as $url){?>
                              <?if(isset($url['Name'])){?>
                              <li>
                                <a href="#"><?=$url['Name']?><span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                      <?if(isset($url['HomeLink'])){?>
                                        <a href="<?=base_url() . $url['HomeLink']?>">Show/Modify</a>
                                      <?}?>
                                    </li>
                                    <li>
                                      <?if(isset($url['AddLink'])){?>
                                        <a href="<?=base_url() . $url['AddLink']?>">Add</a>
                                      <?}?>
                                    </li>
                                  </ul>
                              </li>
                              <?}?>
                            <?}?>
                          </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-home fa-fw"></i> Home <span class="fa arrow"></span>
                      </a>
                        <ul class="nav nav-second-level">
                          <li>
                            <a href="home"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            <a href="home"><i class="fa fa-globe fa-fw"></i> Push Notifications</a>
                          </li>
                        </ul>
                      </li>

                      <li>
                              <a href="#">
                                <i class="fa fa-table fa-fw"></i> Database <span class="fa arrow"></span>
                              </a>
                                <ul class="nav nav-second-level">
                                    <?$ArrControlURL = $ArrURL['AdminControllers'];
                                    foreach($ArrControlURL as $url){?>
                                      <?if(isset($url['Name'])){?>
                                      <li>
                                        <a href="<?=base_url() . $url['HomeLink']?>"><?=$url['Name']?></a>
                                      </li>
                                      <?}?>
                                  <?}?>
                              </ul>
                        </li>

                        <li>
                                <a href="#">
                                  <i class="fa fa-tasks fa-fw"></i> Live Lines <span class="fa arrow"></span>
                                </a>
                                  <ul class="nav nav-second-level">
                                      <?$ArrControlURL = $ArrURL['AdminControllers'];
                                      foreach($ArrControlURL as $url){?>
                                        <?if(isset($url['Name'])){?>
                                        <li>
                                          <a href="<?=base_url() . $url['HomeLink']?>"><?=$url['Name']?></a>
                                        </li>
                                        <?}?>
                                    <?}?>
                                </ul>
                          </li>

                      <li>
                              <a href="#">
                                <i class="fa fa-barcode fa-fw"></i> Promo Codes <span class="fa arrow"></span>
                              </a>
                                <ul class="nav nav-second-level">
                                    <?$ArrControlURL = $ArrURL['AdminControllers'];
                                    foreach($ArrControlURL as $url){?>
                                      <?if(isset($url['Name'])){?>
                                      <li>
                                        <a href="<?=base_url() . $url['HomeLink']?>"><?=$url['Name']?></a>
                                      </li>
                                      <?}?>
                                  <?}?>
                              </ul>
                        </li>
                        <li>
                                <a href="#">
                                  <i class="fa fa-file-word-o fa-fw"></i> Articles <span class="fa arrow"></span>
                                </a>
                                  <ul class="nav nav-second-level">
                                      <?$ArrControlURL = $ArrURL['AdminControllers'];
                                      foreach($ArrControlURL as $url){?>
                                        <?if(isset($url['Name'])){?>
                                        <li>
                                          <a href="<?=base_url() . $url['HomeLink']?>"><?=$url['Name']?></a>
                                        </li>
                                        <?}?>
                                    <?}?>
                                </ul>
                          </li>
                          <li>
                                  <a href="#">
                                    <i class="fa fa-child fa-fw"></i> Clients <span class="fa arrow"></span>
                                  </a>
                                    <ul class="nav nav-second-level">
                                        <?$ArrControlURL = $ArrURL['AdminControllers'];
                                        foreach($ArrControlURL as $url){?>
                                          <?if(isset($url['Name'])){?>
                                          <li>
                                            <a href="<?=base_url() . $url['HomeLink']?>"><?=$url['Name']?></a>
                                          </li>
                                          <?}?>
                                      <?}?>
                                  </ul>
                            </li>
                            <li>
                                    <a href="#">
                                      <i class="fa fa-car fa-fw"></i> Drivers <span class="fa arrow"></span>
                                    </a>
                                      <ul class="nav nav-second-level">
                                          <?$ArrControlURL = $ArrURL['AdminControllers'];
                                          foreach($ArrControlURL as $url){?>
                                            <?if(isset($url['Name'])){?>
                                            <li>
                                              <a href="<?=base_url() . $url['HomeLink']?>"><?=$url['Name']?></a>
                                            </li>
                                            <?}?>
                                        <?}?>
                                    </ul>
                              </li>
                            <li>
                                    <a href="#">
                                      <i class="fa fa-life-saver fa-fw"></i> Customer Support <span class="fa arrow"></span>
                                    </a>
                                      <ul class="nav nav-second-level">
                                          <?$ArrControlURL = $ArrURL['AdminControllers'];
                                          foreach($ArrControlURL as $url){?>
                                            <?if(isset($url['Name'])){?>
                                            <li>
                                              <a href="<?=base_url() . $url['HomeLink']?>"><?=$url['Name']?></a>
                                            </li>
                                            <?}?>
                                        <?}?>
                                    </ul>
                              </li>
                              <li>
                                      <a href="#">
                                        <i class="fa fa-money fa-fw"></i> Finance <span class="fa arrow"></span>
                                      </a>
                                        <ul class="nav nav-second-level">
                                            <?$ArrControlURL = $ArrURL['AdminControllers'];
                                            foreach($ArrControlURL as $url){?>
                                              <?if(isset($url['Name'])){?>
                                              <li>
                                                <a href="<?=base_url() . $url['HomeLink']?>"><?=$url['Name']?></a>
                                              </li>
                                              <?}?>
                                          <?}?>
                                      </ul>
                                </li>
                                <li>
                                        <a href="#">
                                          <i class="fa fa-line-chart fa-fw"></i> Reports <span class="fa arrow"></span>
                                        </a>
                                          <ul class="nav nav-second-level">
                                              <?$ArrControlURL = $ArrURL['AdminControllers'];
                                              foreach($ArrControlURL as $url){?>
                                                <?if(isset($url['Name'])){?>
                                                <li>
                                                  <a href="<?=base_url() . $url['HomeLink']?>"><?=$url['Name']?></a>
                                                </li>
                                                <?}?>
                                            <?}?>
                                        </ul>
                                  </li>
                                  <li>
                                          <a href="#">
                                            <i class="fa fa-cc fa-fw"></i> About Us <span class="fa arrow"></span>
                                          </a>
                                            <ul class="nav nav-second-level">
                                                <?$ArrControlURL = $ArrURL['AdminControllers'];
                                                foreach($ArrControlURL as $url){?>
                                                  <?if(isset($url['Name'])){?>
                                                  <li>
                                                    <a href="<?=base_url() . $url['HomeLink']?>"><?=$url['Name']?></a>
                                                  </li>
                                                  <?}?>
                                              <?}?>
                                          </ul>
                                    </li>
                                    <li>
                                      <a href="#">
                                              <i class="fa fa-group fa-fw"></i> Users <span class="fa arrow"></span>
                                            </a>
                                              <ul class="nav nav-second-level">
                                                  <?$ArrControlURL = $ArrURL['AdminControllers'];
                                                  foreach($ArrControlURL as $url){?>
                                                    <?if(isset($url['Name'])){?>
                                                    <li>
                                                      <a href="<?=base_url() . $url['HomeLink']?>"><?=$url['Name']?></a>
                                                    </li>
                                                    <?}?>
                                                <?}?>
                                            </ul>
                                      </li>

                    <li>
                      <a href="logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                     </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function getHeaderArr(){

    $tmp = array();
    if(isset($this->session->userdata['USRNAME'])) {
      $tmp[0] = true;
      $tmp['Cities'] = array(
        'HomeLink' => 'cities',
        'AddLink' => 'addcities',
        'Type' => 'table',
        'Name' => 'Cities',
        'Permissions' => array(
          'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL',
          'USER-HOME', 'USER-ADD'
        )
      );
      $tmp['Districts'] = array(
        'HomeLink' => 'districts',
        'AddLink' => 'adddistricts',
        'Type' => 'table',
        'Name' => 'Districts',
        'Permissions' => array(
          'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL',
          'USER-HOME', 'USER-ADD'
        )
      );
      $tmp['Clients'] = array(
        'HomeLink' => 'clients',
        'AddLink' => 'addclients',
        'Type' => 'table',
        'Name' => 'Clients',
        'Permissions' => array(
          'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL',
          'USER-HOME', 'USER-ADD'
        )
      );
      $tmp['Favourite_Lines'] = array(
        'HomeLink' => 'favourite_lines',
        'AddLink' => 'addfavourite_lines',
        'Type' => 'table',
        'Name' => 'Client\'s Favourite Lines',
        'Permissions' => array(
          'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL',
          'USER-HOME', 'USER-ADD'
        )
      );
      $tmp['Balancelogs'] = array(
        'HomeLink' => 'balancelogs',
        'AddLink' => 'addbalancelogs',
        'Type' => 'table',
        'Name' => 'Balancelogs',
        'Permissions' => array(
          'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL',
          'USER-HOME', 'USER-ADD'
        )
      );
      $tmp['Stations'] = array(
        'HomeLink' => 'stations',
        'AddLink' => 'addstations',
        'Type' => 'table',
        'Name' => 'Stations',
        'Permissions' => array(
          'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL',
          'USER-HOME', 'USER-ADD'
        )
      );
      $tmp['Lines'] = array(
        'HomeLink' => 'lines',
        'AddLink' => 'addlines',
        'Type' => 'table',
        'Name' => 'Lines',
        'Permissions' => array(
          'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL',
          'USER-HOME', 'USER-ADD'
        )
      );
      $tmp['Linerequests'] = array(
        'HomeLink' => 'linerequests',
        'AddLink' => 'addlinerequests',
        'Type' => 'table',
        'Name' => 'Line Requests',
        'Permissions' => array(
          'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL',
          'USER-HOME', 'USER-ADD'
        )
      );
      $tmp['Paths'] = array(
        'HomeLink' => 'paths',
        'AddLink' => 'addpaths',
        'Type' => 'table',
        'Name' => 'Paths',
        'Permissions' => array(
          'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL',
          'USER-HOME', 'USER-ADD'
        )
      );
      $tmp['Articles'] = array(
        'HomeLink' => 'articles',
        'AddLink' => 'addarticles',
        'Type' => 'table',
        'Name' => 'Articles',
        'Permissions' => array(
          'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL',
          'USER-HOME', 'USER-ADD'
        )
      );
      $tmp['Notifications'] = array(
        'HomeLink' => 'notifications',
        'AddLink' => 'addnotifications',
        'Type' => 'table',
        'Name' => 'Notifications',
        'Permissions' => array(
          'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL',
          'USER-HOME', 'USER-ADD'
        )
      );
      $tmp['Faqs'] = array(
        'HomeLink' => 'faqs',
        'AddLink' => 'addfaqs',
        'Type' => 'table',
        'Name' => 'Faqs',
        'Permissions' => array(
          'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL',
          'USER-HOME', 'USER-ADD'
        )
      );
      $tmp['Messages'] = array(
        'HomeLink' => 'messages',
        'AddLink' => 'addmessages',
        'Type' => 'table',
        'Name' => 'Messages',
        'Permissions' => array(
          'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL',
          'USER-HOME', 'USER-ADD'
        )
      );
      $tmp['Drivers'] = array(
        'HomeLink' => 'drivers',
        'AddLink' => 'adddrivers',
        'Type' => 'table',
        'Name' => 'Drivers',
        'Permissions' => array(
          'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL',
          'USER-HOME', 'USER-ADD'
        )
      );

      $tmp['Buses'] = array(
        'HomeLink' => 'buses',
        'AddLink' => 'addbuses',
        'Type' => 'table',
        'Name' => 'Buses',
        'Permissions' => array(
          'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL',
          'USER-HOME', 'USER-ADD'
        )
      );

      $tmp['LiveLines'] = array(
        'HomeLink' => 'livelines',
        'AddLink' => 'addlivelines',
        'Type' => 'table',
        'Name' => 'Live Lines',
        'Permissions' => array(
          'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL',
          'USER-HOME', 'USER-ADD'
        )
      );

      $tmp['Traveltickets'] = array(
        'HomeLink' => 'traveltickets',
        'AddLink' => 'addtraveltickets',
        'Type' => 'table',
        'Name' => 'Tickets',
        'Permissions' => array(
          'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL',
          'USER-HOME', 'USER-ADD'
        )
      );


      $tmp['AboutUs'] = array(
        'HomeLink' => 'aboutus',
        'AddLink' => 'addaboutus',
        'Type' => 'table',
        'Name' => 'About Us',
        'Permissions' => array(
          'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL',
          'USER-HOME', 'USER-ADD'
        )
      );


      $tmp['Privilages'] = array(
        'HomeLink' => 'privilages',
        'AddLink' => 'addprivilages',
        'Type' => 'table',
        'Name' => 'Privilages',
        'Permissions' => array(
          'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL',
          'USER-HOME', 'USER-ADD'
        )
      );


      if($this->session->userdata['USRNAME'] == 'admin'){
        $tmp['Users'] = array(
          'HomeLink' => 'users',
          'AddLink' => 'addusers',
          'Name' => 'Users',
          'Permissions' => array(
            'ADMIN-HOME', 'ADMIN-ADD', 'ADMIN-EDIT', 'ADMIN-DEL'
          )
        );
      }

      $tmp['AdminControllers'] = array();
      $tmp['AdminControllers']['Push_Notification']= array(
        'HomeLink' => 'push',
        'Type' => 'controller',
        'Name' => 'Push Notification',
        'Permissions' => array(
          'ADMIN-HOME'
        )
      );

      return $tmp;
    } else {
      $tmp[0] = false;
      $tmp[1] = array(
        'Link' => 'login',
        'Name' => 'Login'
      );
      return $tmp;
    }
  }

  public function checkPageByUrl($Pageurl){
    return in_array($Pageurl, $this->session->userdata['USRPAGES']);
  }

  public function getPagesByType(){

    $Pages = $this->Privilages_model->getPrivilage_byUserID($this->session->userdata['USRID']);

    $OrganizedPages = array();

    foreach ($Pages as $page){
      switch ($page['PAGE_TYPE']) {

        case 'customersupport':
        if(isset($OrganizedPages['customersupport'])) {
          array_push($OrganizedPages['customersupport'], $page);
        }
        else {
          $OrganizedPages['customersupport'] = array($page);
        }
        break;
        case 'users' :
        if(isset($OrganizedPages['users'])) {
          array_push($OrganizedPages['users'], $page);
        }
        else {
          $OrganizedPages['users'] = array($page);
        }
        break;
        case 'articles' :
        if(isset($OrganizedPages['articles'])) {
          array_push($OrganizedPages['articles'], $page);
        }
        else {
          $OrganizedPages['articles'] = array($page);
        }
        break;
        case 'livelines' :
        if(isset($OrganizedPages['livelines'])) {
          array_push($OrganizedPages['livelines'], $page);
        }
        else {
          $OrganizedPages['livelines'] = array($page);
        }
        break;
        case 'clients' :
        if(isset($OrganizedPages['clients'])) {
          array_push($OrganizedPages['clients'], $page);
        }
        else {
          $OrganizedPages['clients'] = array($page);
        }
        break;
        case 'database' :
        if(isset($OrganizedPages['database'])) {
          array_push($OrganizedPages['database'], $page);
        }
        else {
          $OrganizedPages['database'] = array($page);
        }
        break;
        case 'promocodes' :
        if(isset($OrganizedPages['promocodes'])) {
          array_push($OrganizedPages['promocodes'], $page);
        }
        else {
          $OrganizedPages['promocodes'] = array($page);
        }
        break;
        case 'drivers' :
        if(isset($OrganizedPages['drivers'])) {
          array_push($OrganizedPages['drivers'], $page);
        }
        else {
          $OrganizedPages['drivers'] = array($page);
        }
        break;
        case 'finance' :
        if(isset($OrganizedPages['finance'])) {
          array_push($OrganizedPages['finance'], $page);
        }
        else {
          $OrganizedPages['finance'] = array($page);
        }
        break;
        case 'reports' :
        if(isset($OrganizedPages['reports'])) {
          array_push($OrganizedPages['reports'], $page);
        }
        else {
          $OrganizedPages['reports'] = array($page);
        }
        break;
        case 'aboutus' :
        if(isset($OrganizedPages['aboutus'])) {
          array_push($OrganizedPages['aboutus'], $page);
        }
        else {
          $OrganizedPages['aboutus'] = array($page);
        }

        default:
          # code...
          break;
      }
    }

    return $OrganizedPages;
  }

    public function user_login($userName, $passWord, $userType){
      $strSQL = "SELECT COUNT(*) AS EXP, USR_ID FROM users
                WHERE USR_NAME = '{$userName}' AND USR_TYPE='{$userType}'
                AND USR_PASS = '{$passWord}'";

      $query = $this->db->query($strSQL);
      $result = $query->result_array();
      if($result[0]['EXP'] == 1){
        $SESSArr = array (
          'USRNAME'  => $userName,
          'USRTYPE'  => $userType,
          'USRID'    => $result[0]['USR_ID'],
          'USRPAGES' => $this->Privilages_model->getPrivilageNames_PageURL_byUserID($result[0]['USR_ID'])
        );
        $this->session->set_userdata($SESSArr);
        return true;
      }else {
        return false;
      }
    }





  }

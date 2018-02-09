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

    public function user_login($userName, $passWord, $userType){
      $strSQL = "SELECT COUNT(*) AS EXP FROM users
                WHERE USR_NAME = '{$userName}' AND USR_TYPE='{$userType}'
                AND USR_PASS = '{$passWord}'";

      $query = $this->db->query($strSQL);
      $result = $query->result_array();
      if($result[0]['EXP'] == 1){
        $SESSArr = array (
          'USRNAME' => $userName,
          'USRTYPE' => $userType
        );
        $this->session->set_userdata($SESSArr);
        return true;
      }else {
        return false;
      }
    }
  }

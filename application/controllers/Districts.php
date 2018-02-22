<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Districts extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser2($PageURL){

    if(!isset($this->session->userdata['USRNAME'])) return false;

    $result = $this->Master_model->checkPageByUrl($PageURL);

    if($result) return 1;
    else {

      $this->load->view("home_redirect");
      return 2;
    }

  }

  public function home($MSGErr = '', $MSGOK = '')
  {

    $result = $this->CheckUser2('districts');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 2){
      // User not permitted
      return;
    }
    else {
      if(strcmp($this->session->user['USRNAME'], 'admin') == 0)
      $header['ArrURL'] = $result;
      $header['OrgArr'] = $this->Master_model->getPagesByType();
    }


    $data['TableData'] = $this->Districts_model->getDistricts();

    $data['TableHeaders'] = array(
      'ID',
      'District Name',
      'Arabic Name',
      'City Name',
      'Edit',
      'Delete'
    );

    $data['Table_Name'] = 'Districts';
    $data['Url_Name']   = 'districts';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/districts', $data);
    $this->load->view('templates/footer');

  }

  public function addpage($MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('adddistricts');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 2){
      // User not permitted
      return;
    }
    else {
      if(strcmp($this->session->user['USRNAME'], 'admin') == 0)
      $header['ArrURL'] = $result;
      $header['OrgArr'] = $this->Master_model->getPagesByType();
    }

    $data['Cities'] = $this->Cities_model->getCities();

    $data['DIST_ID']      = ''              ;
    $data['DIST_NAME']    = ''              ;
    $data['DIST_CITY_ID']    = ''              ;

    $data['formURL']      = 'insertdistricts'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/adddistrict', $data);
    $this->load->view('templates/footer');
  }

  public function insert(){

    $result = $this->CheckUser2('adddistricts');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 2){
      // User not permitted
      return;
    }
    else {
      if(strcmp($this->session->user['USRNAME'], 'admin') == 0)
      $header['ArrURL'] = $result;
      $header['OrgArr'] = $this->Master_model->getPagesByType();
    }

    $districtName = $this->input->post('districtName');
    $districtArbcName = $this->input->post('districtArbcName');
    $districtCityID = $this->input->post('districtCityID');
    $this->Districts_model->insertDistrict($districtName, $districtArbcName, $districtCityID);

    $this->load->view('pages/districts_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('adddistricts');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 2){
      // User not permitted
      return;
    }
    else {
      if(strcmp($this->session->user['USRNAME'], 'admin') == 0)
      $header['ArrURL'] = $result;
      $header['OrgArr'] = $this->Master_model->getPagesByType();
    }

    $District = $this->Districts_model->getDistrict_byID($ID)[0];

    $data['Cities'] = $this->Cities_model->getCities();

    $data['DIST_ID']      = $District['DIST_ID']  ;
    $data['DIST_NAME']    = $District['DIST_NAME'];
    $data['DIST_ARBC_NAME']    = $District['DIST_ARBC_NAME'];
    $data['DIST_CITY_ID']    = $District['DIST_CITY_ID'];

    $data['formURL']      = 'editdistricts/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/adddistrict', $data);
    $this->load->view('templates/footer');

  }

  public function edit($ID){

    $result = $this->CheckUser2('adddistricts');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 2){
      // User not permitted
      return;
    }
    else {
      if(strcmp($this->session->user['USRNAME'], 'admin') == 0)
      $header['ArrURL'] = $result;
      $header['OrgArr'] = $this->Master_model->getPagesByType();
    }

    $districtName = $this->input->post('districtName');
    $districtCityID = $this->input->post('districtCityID');
    $districtArbcName = $this->input->post('districtArbcName');
    $this->Districts_model->editDistrict($ID, $districtName, $districtArbcName, $districtCityID);

    $this->load->view('pages/districts_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser2('districts/delete');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 2){
      // User not permitted
      return;
    }
    else {
      if(strcmp($this->session->user['USRNAME'], 'admin') == 0)
      $header['ArrURL'] = $result;
      $header['OrgArr'] = $this->Master_model->getPagesByType();
    }

    $this->Districts_model->deleteDistrict($ID);
    $this->load->view('pages/districts_redirect');

  }








}

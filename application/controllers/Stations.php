<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stations extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Stations'){
    //Returns header array if user is correct

    $userType = $this->session->userdata['USRTYPE'];
    $headerArr = $this->Master_model->getHeaderArr();
    if(!$headerArr[0])   return false;          // If a user is not logged in
    if (!in_array($userType . '-' . $Function, $headerArr[$PageName]['Permissions'] )) {
      // If logged in And not permitted type
      return 1;

    }else {
      return $headerArr;
    }

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

    $result = $this->CheckUser2('stations');
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


    $data['TableData'] = $this->Stations_model->getStations();

    $data['TableHeaders'] = array(
      'ID',
      'En Name',
      'Ar Name',
      'District',
      'Ar Address',
      'En Address',
      'Edit',
      'Delete'
    );

    $data['Table_Name'] = 'Stations';
    $data['Url_Name']   = 'stations';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/stations', $data);
    $this->load->view('templates/footer');

  }

  public function addpage($MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addstations');
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

    $data['Districts'] = $this->Districts_model->getDistricts();
    $data['Cities'] = $this->Cities_model->getCities();

    $data['STTN_ID']      = ''              ;
    $data['STTN_NAME']    = ''              ;
    $data['STTN_LATT']    = ''              ;
    $data['STTN_LONG']    = ''              ;
    $data['STTN_ARBC_ADRS']    = ''         ;
    $data['STTN_ARBC_NAME']    = ''         ;
    $data['STTN_ADRS']    = ''              ;
    $data['STTN_DIST_ID']    = ''           ;

    $data['formURL']      = 'insertstations'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addstation', $data);
    $this->load->view('templates/footer');
  }

  public function insert(){

    $result = $this->CheckUser2('addstations');
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


    $stationName = $this->input->post('stationName');
    $stationLatitude = $this->input->post('stationLatitude');
    $stationLong = $this->input->post('stationLong');
    $stationArbcAdrs = $this->input->post('stationArbcAdrs');
    $stationArbcName = $this->input->post('stationArbcName');
    $stationDistrictID = $this->input->post('stationDistrictID');
    $stationAddress = $this->input->post('stationAddress');

    $this->Stations_model->insertStation($stationName, $stationDistrictID, $stationLatitude,
                                         $stationLong, $stationArbcAdrs, $stationAddress, $stationArbcName);

    $this->load->view('pages/stations_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addstations');
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


    $Station = $this->Stations_model->getStation_byID($ID)[0];

    $data['Districts'] = $this->Districts_model->getDistricts();
    $data['Cities'] = $this->Cities_model->getCities();

    $data['STTN_ID']      = $Station['STTN_ID']  ;
    $data['STTN_NAME']    = $Station['STTN_NAME']  ;
    $data['STTN_LATT']    = $Station['STTN_LATT']   ;
    $data['STTN_LONG']    = $Station['STTN_LONG'] ;
    $data['STTN_ARBC_ADRS']    = $Station['STTN_ARBC_ADRS']   ;
    $data['STTN_ARBC_NAME']    = $Station['STTN_ARBC_NAME']   ;
    $data['STTN_ADRS']    = $Station['STTN_ADRS']  ;
    $data['STTN_DIST_ID']    = $Station['STTN_DIST_ID'];

    $data['formURL']      = 'editstations/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addstation', $data);
    $this->load->view('templates/footer');

  }

  public function edit($ID){

    $result = $this->CheckUser2('addstations');
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


    $stationName = $this->input->post('stationName');
    $stationLatitude = $this->input->post('stationLatitude');
    $stationLong = $this->input->post('stationLong');
    $stationArbcAdrs = $this->input->post('stationArbcAdrs');
    $stationArbcName = $this->input->post('stationArbcName');
    $stationDistrictID = $this->input->post('stationDistrictID');
    $stationAddress = $this->input->post('stationAddress');

    $this->Stations_model->editStation($ID, $stationName, $stationDistrictID, $stationLatitude,
                                       $stationLong, $stationArbcAdrs, $stationAddress, $stationArbcName);

    $this->load->view('pages/stations_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser2('stations/delete');
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


    $this->Stations_model->deleteStation($ID);
    $this->load->view('pages/stations_redirect');

  }
}

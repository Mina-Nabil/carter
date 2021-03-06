<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buses extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Buses'){
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

    $result = $this->CheckUser2('buses');
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


    $data['TableData'] = $this->Buses_model->getBuses();

    $data['TableHeaders'] = array(
      'ID',
      'Type',
      'Driver',
      'Seats Number',
      'Plate Number',
      'Edit',
      'Delete'
    );

    $data['Table_Name'] = 'Buses';
    $data['Url_Name']   = 'buses';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/buses', $data);
    $this->load->view('templates/footer');

  }

  public function addpage($MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addbuses');
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

    $data['Drivers'] = $this->Drivers_model->getDrivers();
    $data['BusTypes'] = $this->Bustypes_model->getBustypes();

    $data['BUS_ID']      = ''              ;
    $data['BUS_BSTP_ID']    = ''              ;
    $data['BUS_NUMBER']    = ''              ;
    $data['BUS_SEATS']    = ''         ;
    $data['BUS_CHAR']    = ''         ;
    $data['BUS_DRVR_ID']    = ''           ;

    $data['formURL']      = 'insertbuses'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addbus', $data);
    $this->load->view('templates/footer');
  }

  public function insert(){

    $result = $this->CheckUser2('addbuses');
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

    $busType = $this->input->post('busType');
    $busNumber = $this->input->post('busNumber');
    $busSeats = $this->input->post('busSeats');
    $busChar = $this->input->post('busChar');
    $busDriverID = $this->input->post('busDriverID');

    $this->Buses_model->insertBus($busType, $busDriverID, $busNumber, $busSeats, $busChar);

    $this->load->view('pages/buses_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addbuses');
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

    $Bus = $this->Buses_model->getBus_byID($ID)[0];

    $data['Drivers'] = $this->Drivers_model->getDrivers();
    $data['BusTypes'] = $this->Bustypes_model->getBustypes();

    $data['BUS_ID']      = $Bus['BUS_ID']  ;
    $data['BUS_BSTP_ID']    = $Bus['BUS_BSTP_ID']  ;
    $data['BUS_NUMBER']    = $Bus['BUS_NUMBER']   ;
    $data['BUS_SEATS']    = $Bus['BUS_SEATS']   ;
    $data['BUS_CHAR']    = $Bus['BUS_CHAR']   ;
    $data['BUS_DRVR_ID']    = $Bus['BUS_DRVR_ID'];

    $data['formURL']      = 'editbuses/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addbus', $data);
    $this->load->view('templates/footer');

  }

  public function edit($ID){

    $result = $this->CheckUser2('addbuses');
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

    $busType = $this->input->post('busType');
    $busNumber = $this->input->post('busNumber');
    $busSeats = $this->input->post('busSeats');
    $busDriverID = $this->input->post('busDriverID');
    $busChar = $this->input->post('busChar');

    $this->Buses_model->editBus($ID, $busType, $busDriverID, $busNumber, $busSeats, $busChar);

    $this->load->view('pages/buses_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser2('buses/delete');
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

    $this->Buses_model->deleteBus($ID);
    $this->load->view('pages/buses_redirect');

  }
}

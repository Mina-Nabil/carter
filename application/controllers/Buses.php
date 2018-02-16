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

  public function home($MSGErr = '', $MSGOK = '')
  {

    $result = $this->CheckUser('HOME');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/buses_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
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

    $result = $this->CheckUser('ADD');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/buses_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $data['Drivers'] = $this->Drivers_model->getDrivers();

    $data['BUS_ID']      = ''              ;
    $data['BUS_TYPE']    = ''              ;
    $data['BUS_NUMBER']    = ''              ;
    $data['BUS_SEATS']    = ''         ;
    $data['BUS_DRVR_ID']    = ''           ;

    $data['formURL']      = 'insertbuses'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addbus', $data);
    $this->load->view('templates/footer');
  }

  public function insert(){

    $result = $this->CheckUser('ADD');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/buses_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $busType = $this->input->post('busType');
    $busNumber = $this->input->post('busNumber');
    $busSeats = $this->input->post('busSeats');
    $busDriverID = $this->input->post('busDriverID');

    $this->Buses_model->insertBus($busType, $busDriverID, $busNumber, $busSeats);

    $this->load->view('pages/buses_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser('EDIT');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/buses_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $Bus = $this->Buses_model->getBus_byID($ID)[0];

    $data['Drivers'] = $this->Drivers_model->getDrivers();

    $data['BUS_ID']      = $Bus['BUS_ID']  ;
    $data['BUS_TYPE']    = $Bus['BUS_TYPE']  ;
    $data['BUS_NUMBER']    = $Bus['BUS_NUMBER']   ;
    $data['BUS_SEATS']    = $Bus['BUS_SEATS']   ;
    $data['BUS_DRVR_ID']    = $Bus['BUS_DRVR_ID'];

    $data['formURL']      = 'editbuses/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addbus', $data);
    $this->load->view('templates/footer');

  }

  public function edit($ID){

    $result = $this->CheckUser('EDIT');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/buses_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $busType = $this->input->post('busType');
    $busNumber = $this->input->post('busNumber');
    $busSeats = $this->input->post('busSeats');
    $busDriverID = $this->input->post('busDriverID');

    $this->Buses_model->editBus($ID, $busType, $busDriverID, $busNumber, $busSeats);

    $this->load->view('pages/buses_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser('DEL');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/buses_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $this->Buses_model->deleteBus($ID);
    $this->load->view('pages/buses_redirect');

  }
}

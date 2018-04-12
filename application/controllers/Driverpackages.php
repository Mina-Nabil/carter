<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Driverpackages extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Driverpackages'){
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

    $result = $this->CheckUser2('driverpackages');
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


    $data['TableData'] = $this->Driverpackages_model->getDriverpackages();

    $data['TableHeaders'] = array(
      'ID',
      'Name',
      'Trips Number',
      'Price Per Day',
      'Edit',
      'Delete'
    );

    $data['Table_Name'] = 'Driverpackages';
    $data['Url_Name']   = 'driverpackages';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/driverpackages', $data);
    $this->load->view('templates/footer');

  }

  public function addpage($MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('adddriverpackages');
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

    $data['DPKG_ID']      = ''              ;
    $data['DPKG_NAME']    = ''         ;
    $data['DPKG_PRICE']    = ''         ;
    $data['DPKG_TRIPS']    = ''           ;

    $data['formURL']      = 'insertdriverpackages'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/adddriverpackage', $data);
    $this->load->view('templates/footer');
  }

  public function insert(){

    $result = $this->CheckUser2('adddriverpackages');
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


      $pckgName = $this->input->post('pckgName');
      $pckgPrice = $this->input->post('pckgPrice');
      $pckgTrips = $this->input->post('pckgTrips');

      $this->Driverpackages_model->insertDriverpackage($pckgName, $pckgTrips, $pckgPrice);

      $this->load->view('pages/driverpackages_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('adddriverpackages');
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

    $Driverpackage = $this->Driverpackages_model->getDriverpackage_byID($ID)[0];

    $data['DPKG_ID']      = $Driverpackage['DPKG_ID']  ;
    $data['DPKG_BSTP_ID']    = $Driverpackage['DPKG_BSTP_ID']  ;
    $data['DPKG_NUMBER']    = $Driverpackage['DPKG_NUMBER']   ;
    $data['DPKG_SEATS']    = $Driverpackage['DPKG_SEATS']   ;
    $data['DPKG_CHAR']    = $Driverpackage['DPKG_CHAR']   ;
    $data['DPKG_DRVR_ID']    = $Driverpackage['DPKG_DRVR_ID'];

    $data['formURL']      = 'editdriverpackages/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/adddriverpackage', $data);
    $this->load->view('templates/footer');

  }

  public function edit($ID){

    $result = $this->CheckUser2('adddriverpackages');
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

    $pckgName = $this->input->post('pckgName');
    $pckgPrice = $this->input->post('pckgPrice');
    $pckgTrips = $this->input->post('pckgTrips');

    $this->Driverpackages_model->editDriverpackage($ID, $pckgName, $pckgTrips, $pckgPrice);

    $this->load->view('pages/driverpackages_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser2('driverpackages/delete');
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

    $this->Driverpackages_model->deleteDriverpackage($ID);
    $this->load->view('pages/driverpackages_redirect');

  }
}

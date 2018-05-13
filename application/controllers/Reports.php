<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Push_Notification'){
    //Returns header array if user is correct

    $userType = $this->session->userdata['USRTYPE'];
    $headerArr = $this->Master_model->getHeaderArr();
    if(!$headerArr[0])   return false;          // If a user is not logged in
    if (!in_array($userType . '-' . $Function, $headerArr['AdminControllers'][$PageName]['Permissions'] )) {
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

  public function getDriverReport(){
    $result = $this->CheckUser2('report/drivers');
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

    $data['formURL'] = 'reports/show_drivers';

    $data['Drivers'] = $this->Drivers_model->getDrivers();

    $this->load->view('templates/header', $header);
    $this->load->view('Reports/getDriversReport', $data);
    $this->load->view('templates/footer');

  }

  public function DriverReport(){
    $result = $this->CheckUser2('report/drivers');
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

    $data['TableHeaders'] = array(
      'Time',
      'Line Name',
      'Package',
      'Driver',
      'Ticket Prc.',
      'Tickets / Canc.',
      'Clients / Miss',
      'Paid',
      'Cash / Visa',
      'Promo Count / Paid'
    );

    $DriverID = $this->input->post('repDriverID');
    $startTime = $this->input->post('startTime'). ":00";
    $endTime = $this->input->post('endTime'). ":00";

    $data['TableData'] = $this->LiveLines_model->getLineReport($DriverID, $startTime, $endTime);


    $this->load->view('templates/header', $header);
    $this->load->view('Reports/DriverReport', $data);
    $this->load->view('templates/footer');



  }



}

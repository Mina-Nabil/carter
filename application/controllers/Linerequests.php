<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Linerequests extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Linerequests'){
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

    $result = $this->CheckUser2('linerequests');
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


    $data['TableData'] = $this->Linerequests_model->getLinerequests();

    $data['TableHeaders'] = array(
      'Client Name',
      'Start Station',
      'End Station',
      'Start Time',
      'Seats',
      'isTwo Ways?',
      'Return Time',
      'Show',
      'Delete'
    );

    $data['Table_Name'] = 'Linerequests';
    $data['Url_Name']   = 'linerequests';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/linerequests', $data);
    $this->load->view('templates/footer');

  }

  public function addpage($MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addlinerequests');
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


    $data['Clients']  = $this->Clients_model->getClients();
    $data['Stations']  = $this->Stations_model->getStations();

    $data['LNRQ_ID']      = ''  ;
    $data['LNRQ_SEATS']    = ''         ;
    $data['LNRQ_TWO_WAYS']    = ''      ;
    $data['LNRQ_CLNT_ID']    = ''      ;
    $data['LNRQ_BACK_TIME']    = ''       ;
    $data['LNRQ_START_STTN']    = ''           ;
    $data['LNRQ_START_TIME']    = ''         ;
    $data['LNRQ_END_STTN']    = ''           ;
    $data['LNRQ_NOTES']    = ''           ;

    $data['formURL']      = 'insertlinerequests'  ;

    $data['disabled']     = false;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addlinerequest', $data);
    $this->load->view('templates/footer');
  }

  public function insert(){

    $result = $this->CheckUser2('addlinerequests');
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

    $Seats = $this->input->post('linerequestSeats');
    $isTwoWays = $this->input->post('linerequestisTwoWays');
    $ClientID = $this->input->post('linerequestClientID');
    $BackTime = $this->input->post('linerequestBackTime');
    $StartTime= $this->input->post('linerequestStartTime');
    $Notes= $this->input->post('linerequestNotes');
    $StartStationID= $this->input->post('linerequestStrtSttnID');
    $EndStationID= $this->input->post('linerequestEndSttnID');

    $this->Linerequests_model->insertLinerequest($Seats, $isTwoWays, $ClientID, $BackTime, $StartTime, $Notes, $StartStationID, $EndStationID);

    $this->load->view('pages/linerequests_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addlinerequests');
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

    $Linerequest = $this->Linerequests_model->getLinerequest_byID($ID)[0];

    $data['Clients'] = $this->Clients_model->getClients();
    $data['Stations'] = $this->Stations_model->getStations();

    $data['LNRQ_ID']      = $Linerequest['LNRQ_ID']  ;
    $data['LNRQ_SEATS']    = $Linerequest['LNRQ_SEATS']   ;
    $data['LNRQ_TWO_WAYS']    = $Linerequest['LNRQ_TWO_WAYS'];
    $data['LNRQ_CLNT_ID']    = $Linerequest['LNRQ_CLNT_ID'];
    $data['LNRQ_BACK_TIME']    = $Linerequest['LNRQ_BACK_TIME'] ;
    $data['BackTimestamp']    = strtotime($Linerequest['LNRQ_BACK_TIME']);
    $data['LNRQ_START_STTN']    = $Linerequest['LNRQ_START_STTN']     ;
    $data['LNRQ_START_TIME']    = $Linerequest['LNRQ_START_TIME']   ;
    $data['StartTimestamp']    = strtotime($Linerequest['LNRQ_START_TIME']);
    $data['LNRQ_END_STTN']    = $Linerequest['LNRQ_END_STTN']     ;
    $data['LNRQ_NOTES']    = $Linerequest['LNRQ_NOTES']     ;

    $data['formURL']      = 'editlinerequests/' . $ID  ;

    $data['disabled']     = true;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addlinerequest', $data);
    $this->load->view('templates/footer');

  }

  public function edit($ID){

    $result = $this->CheckUser2('addlinerequests');
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

    $Seats = $this->input->post('linerequestSeats');
    $isTwoWays = $this->input->post('linerequestisTwoWays');
    $ClientID = $this->input->post('linerequestClientID');
    $BackTime = $this->input->post('linerequestBackTime');
    $StartTime= $this->input->post('linerequestStartTime');
    $Notes= $this->input->post('linerequestNotes');
    $StartStationID= $this->input->post('linerequestStrtSttnID');
    $EndStationID= $this->input->post('linerequestEndSttnID');

    $this->Linerequests_model->editLinerequest($ID, $Seats, $isTwoWays, $ClientID, $BackTime, $StartTime, $Notes, $StartStationID, $EndStationID);

    $this->load->view('pages/linerequests_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser2('linerequests/delete');
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

    $this->Linerequests_model->deleteLinerequest($ID);
    $this->load->view('pages/linerequests_redirect');

  }
}

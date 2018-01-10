<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Traveltickets extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Traveltickets'){
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
      $this->load->view('pages/traveltickets_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }


    $data['TableData'] = $this->Traveltickets_model->getTraveltickets();

    $data['TableHeaders'] = array(
      'ID',
      'Line Name',
      'Client Name',
      'Bus Type/ Bus Seat Count',
      'Start Time',
      'Canceled?',
      'Paid?',
      'Price',
      'Edit',
      'Delete'
    );

    $data['Table_Name'] = 'Traveltickets';
    $data['Url_Name']   = 'traveltickets';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/traveltickets', $data);
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
      $this->load->view('pages/traveltickets_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $data['Clients'] = $this->Clients_model->getClients();
    $data['LiveLines'] = $this->LiveLines_model->getLiveLines();

    $data['TRTK_ID']      = ''              ;
    $data['TRTK_LVLN_ID']    = ''              ;
    $data['TRTK_BUS_ID']    = ''              ;
    $data['TRTK_TIME']    = ''              ;
    $data['TRTK_CANC']    = ''         ;
    $data['TRTK_PAID']    = ''              ;
    $data['TRTK_CLNT_ID']    = ''           ;

    $data['formURL']      = 'inserttraveltickets'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addtravelticket', $data);
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
      $this->load->view('pages/traveltickets_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $travelticketLivelineID = $this->input->post('travelticketLivelineID');
    $travelticketStartIndx = $this->input->post('travelticketStartIndx');
    $travelticketEndIndx = $this->input->post('travelticketEndIndx');
    $travelticketTime = $this->input->post('travelticketTime') . ':00';
    $travelticketPrice = $this->input->post('travelticketPrice');
    $travelticketClientID = $this->input->post('travelticketClientID');
    $travelticketisPaid = $this->input->post('travelticketisPaid');
    $travelticketisCancelled = $this->input->post('travelticketisCancelled');

    $this->Traveltickets_model->insertTravelticket($travelticketClientID, $travelticketLivelineID, $travelticketStartIndx,
                                  $travelticketEndIndx, $travelticketisCancelled, $travelticketisPaid, $travelticketPrice);

    $this->load->view('pages/traveltickets_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser('EDIT');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/traveltickets_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $Travelticket = $this->Traveltickets_model->getTravelticket_byID($ID)[0];

    $data['Clients'] = $this->Clients_model->getClients();
    $data['LiveLines'] = $this->LiveLines_model->getLiveLines();

    $data['TRTK_ID']      = $Travelticket['TRTK_ID'] ;
    $data['TRTK_LVLN_ID']    = $Travelticket['TRTK_LVLN_ID'] ;
    $data['TRTK_CANC']    = $Travelticket['TRTK_CANC']  ;
    $data['TRTK_START_INDX']    = $Travelticket['TRTK_START_INDX']  ;
    $data['TRTK_END_INDX']    = $Travelticket['TRTK_END_INDX']  ;
    $data['TRTK_PAID']    = $Travelticket['TRTK_PAID']  ;
    $data['TRTK_PRICE']    = $Travelticket['TRTK_PRICE']  ;
    $data['TRTK_CLNT_ID']    = $Travelticket['TRTK_CLNT_ID'];

    $data['formURL']      = 'edittraveltickets/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addtravelticket', $data);
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
      $this->load->view('pages/traveltickets_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $travelticketLivelineID = $this->input->post('travelticketLivelineID');
    $travelticketStartIndx = $this->input->post('travelticketStartIndx');
    $travelticketEndIndx = $this->input->post('travelticketEndIndx');
    $travelticketPrice = $this->input->post('travelticketPrice');
    $travelticketClientID = $this->input->post('travelticketClientID');
    $travelticketisPaid = $this->input->post('travelticketisPaid');
    $travelticketisCancelled = $this->input->post('travelticketisCancelled');


    $this->Traveltickets_model->editTravelticket($ID, $travelticketClientID, $travelticketLivelineID, $travelticketStartIndx,
                                  $travelticketEndIndx, $travelticketisCancelled, $travelticketisPaid, $travelticketPrice);

     $this->load->view('pages/traveltickets_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser('DEL');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/traveltickets_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $this->Traveltickets_model->deleteTravelticket($ID);
    $this->load->view('pages/traveltickets_redirect');

  }
}
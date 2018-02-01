<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LiveLines extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'LiveLines'){
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
      $this->load->view('pages/livelines_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }


    $data['TableData'] = $this->LiveLines_model->getLiveLines();

    $data['TableHeaders'] = array(
      'ID',
      'Line Name',
      'Driver Name',
      'Bus Type/ Bus Seat Count',
      'Start Time',
      'Canceled?',
      'Completed?',
      'Ticket Price',
      'Revenue',
      'Edit',
      'Delete'
    );

    $data['Table_Name'] = 'LiveLines';
    $data['Url_Name']   = 'livelines';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/livelines', $data);
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
      $this->load->view('pages/livelines_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $data['Drivers'] = $this->Drivers_model->getDrivers();
    $data['Lines'] = $this->Lines_model->getLines();
    $data['Buses'] = $this->Buses_model->getBuses();

    $data['LVLN_ID']      = ''              ;
    $data['LVLN_LINE_ID']    = ''              ;
    $data['LVLN_BUS_ID']    = ''              ;
    $data['LVLN_TIME']    = ''              ;
    $data['LVLN_CANC']    = ''         ;
    $data['LVLN_COMP']    = ''              ;
    $data['LVLN_TCKT_PRICE']    = ''              ;
    $data['LVLN_DRVR_ID']    = ''           ;

    $data['formURL']      = 'insertlivelines'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addliveline', $data);
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
      $this->load->view('pages/livelines_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $livelineID = $this->input->post('livelineLineID');
    $livelineBusID = $this->input->post('livelineBusID');
    $livelineRevenue = $this->input->post('livelineRevenue');
    $livelineTicketPrice = $this->input->post('livelineTicketPrice');
    $livelineDriverID = $this->input->post('livelineDriverID');
    $livelineisComplete = $this->input->post('livelineisComplete');
    $livelineisCancelled = $this->input->post('livelineisCancelled');

    $Repeated = $this->input->post('DR');
    if(!($Repeated == 1)){
      $livelineTimes = $this->input->post('livelineTime');
      $livelineTime = $livelineTimes[0];
      $this->LiveLines_model->insertLiveLine($livelineID, $livelineDriverID, $livelineTime, $livelineBusID,
                                            $livelineisComplete, $livelineisCancelled, $livelineTicketPrice, $livelineRevenue);
    }

    else{

      $Saturday = $this->input->post('d1');
      $Sunday = $this->input->post('d2');
      $Monday = $this->input->post('d3');
      $Tuesday = $this->input->post('d4');
      $Wednesday = $this->input->post('d5');
      $Thursday = $this->input->post('d6');
      $Friday = $this->input->post('d7');
      $livelineTimes = $this->input->post('livelineTime');

      if($Saturday == 1){
        $nextSat = date("Y-m-d", strtotime("next saturday"));
        $begin = new DateTime( timetostr($nextSat));
        $this->createWeeklyLiveLines($begin, $livelineTimes , $livelineID, $livelineDriverID, $livelineBusID,
                                              $livelineisComplete, $livelineisCancelled, $livelineTicketPrice, $livelineRevenue);
      }



    }



    $this->load->view('pages/livelines_redirect');

  }

  public function createWeeklyLiveLines($begin, $livelineTimes, $livelineID, $livelineDriverID, $livelineBusID,
                                        $livelineisComplete, $livelineisCancelled, $livelineTicketPrice, $livelineRevenue){

        $thisyear = date('Y');
        $end = new DateTime( $thisyear . '-12-31' );

        $interval = DateInterval::createFromDateString('7 day');
        $period = new DatePeriod($begin, $interval, $end);

        foreach ( $period as $dt ){
          foreach ($livelineTimes as $key => $value) {

            $time = date("H:i:s",strtotime($value));
            $combinedDT = date('Y-m-d H:i:s', strtotime($dt->format( " Y-m-d " ) . " $time"));

            $this->LiveLines_model->insertLiveLine($livelineID, $livelineDriverID, $combinedDT, $livelineBusID,
                                                  $livelineisComplete, $livelineisCancelled, $livelineTicketPrice, $livelineRevenue);
          }

        }

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser('EDIT');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/livelines_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $LiveLine = $this->LiveLines_model->getLiveLine_byID($ID)[0];

    $data['Drivers'] = $this->Drivers_model->getDrivers();
    $data['Buses'] = $this->Buses_model->getBuses();
    $data['Lines'] = $this->Lines_model->getLines();

    $data['LVLN_ID']      = $LiveLine['LVLN_ID']  ;
    $data['LVLN_LINE_ID']    = $LiveLine['LVLN_LINE_ID']  ;
    $data['LVLN_BUS_ID']    = $LiveLine['LVLN_BUS_ID']   ;
    $data['LVLN_TIME']    = $LiveLine['LVLN_TIME'] ;
    $data['Timestamp']   = strtotime($data['LVLN_TIME']) ;
    $data['LVLN_CANC']    = $LiveLine['LVLN_CANC']  ;
    $data['LVLN_COMP']    = $LiveLine['LVLN_COMP']  ;
    $data['LVLN_TCKT_PRICE']    = $LiveLine['LVLN_TCKT_PRICE']  ;
    $data['LVLN_REVN']    = $LiveLine['LVLN_REVN']  ;
    $data['LVLN_DRVR_ID']    = $LiveLine['LVLN_DRVR_ID'];

    $data['formURL']      = 'editlivelines/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addliveline', $data);
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
      $this->load->view('pages/livelines_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $livelineID = $this->input->post('livelineLineID');
    $livelineBusID = $this->input->post('livelineBusID');
    $livelineTime = $this->input->post('livelineTime') . ':00';
    $livelineRevenue = $this->input->post('livelineRevenue');
    $livelineDriverID = $this->input->post('livelineDriverID');
    $livelineisComplete = $this->input->post('livelineisComplete');
    $livelineisCancelled = $this->input->post('livelineisCancelled');
    $livelineTicketPrice = $this->input->post('livelineTicketPrice');


    $this->LiveLines_model->editLiveLine($ID, $livelineID, $livelineDriverID, $livelineTime, $livelineBusID,
                                         $livelineisCancelled, $livelineisComplete, $livelineTicketPrice, $livelineRevenue);

     $this->load->view('pages/livelines_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser('DEL');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/livelines_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $this->LiveLines_model->deleteLiveLine($ID);
    $this->load->view('pages/livelines_redirect');

  }
}

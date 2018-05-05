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

    $result = $this->CheckUser2('livelines');
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

    if(isset($this->session->MSGErr)){
      $data['MSGErr']     = $this->session->MSGErr ;
    }

    $this->load->view('templates/header', $header);
    $this->load->view('pages/livelines', $data);
    $this->load->view('templates/footer');

  }

  public function addpage($MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addlivelines');
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
    $data['Generate']     = true;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addliveline', $data);
    $this->load->view('templates/footer');
  }

  public function insert(){

    $result = $this->CheckUser2('addlivelines');
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

    $livelineID = $this->input->post('livelineLineID');
    $livelineBusID = $this->input->post('livelineBusID');
    $livelineRevenue = $this->input->post('livelineRevenue');
    $livelineTicketPrice = $this->input->post('livelineTicketPrice');
    $livelineisComplete = $this->input->post('livelineisComplete');
    $livelineisCancelled = $this->input->post('livelineisCancelled');
    $MsgErr = "";
    $NotRepeated = $this->input->post('DR');
    if($NotRepeated == 1){
      $livelineTimes = $this->input->post('livelineTime') ;
      $livelineDrivers = $this->input->post('livelineDriverID');
      $livelineTime = $livelineTimes[0]. ":00";
      $livelineDriverID = $livelineDrivers[0];
      $Availability = $this->checkDriverAvailability($livelineDriverID, $livelineTime);
      if($Availability == true){
        $this->LiveLines_model->insertLiveLine($livelineID, $livelineDriverID, $livelineTime, $livelineBusID,
                                              $livelineisComplete, $livelineisCancelled, $livelineRevenue, $livelineTicketPrice);
      }
      else {
        $MsgErr .= "<li>Driver already reached the limit on " . $livelineTime->format( " Y-m-d " ) . "</li>";
        echo "<br>Loading...";
      }

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
      $livelineDriverID = $this->input->post('livelineDriverID');

      $i = 0;

      if($Saturday == 1){
        $nextSat = date("Y-m-d", strtotime("next saturday"));
        $begin = new DateTime( $nextSat);

        foreach($livelineTimes as $key => $Time){

        $MsgErr .= $this->createWeeklyLiveLines($begin, $Time , $livelineID, $livelineDriverID[$key], $livelineBusID,
                                              $livelineisComplete, $livelineisCancelled, $livelineTicketPrice, $livelineRevenue);
          }
      }

      if($Sunday == 1){
        $nextSat = date("Y-m-d", strtotime("next sunday"));
        $begin = new DateTime( $nextSat);
        foreach($livelineTimes as $key => $Time){

        $MsgErr .= $this->createWeeklyLiveLines($begin, $Time , $livelineID, $livelineDriverID[$key], $livelineBusID,
                                              $livelineisComplete, $livelineisCancelled, $livelineTicketPrice, $livelineRevenue);
          }
      }

      if($Monday == 1){
        $nextSat = date("Y-m-d", strtotime("next monday"));
        $begin = new DateTime( $nextSat);
        foreach($livelineTimes as $key => $Time){

        $MsgErr .= $this->createWeeklyLiveLines($begin, $Time , $livelineID, $livelineDriverID[$key], $livelineBusID,
                                              $livelineisComplete, $livelineisCancelled, $livelineTicketPrice, $livelineRevenue);
          }
      }

      if($Tuesday == 1){
        $nextSat = date("Y-m-d", strtotime("next tuesday"));
        $begin = new DateTime( $nextSat);
        foreach($livelineTimes as $key => $Time){

          $MsgErr .= $this->createWeeklyLiveLines($begin, $Time , $livelineID, $livelineDriverID[$key], $livelineBusID,
                                              $livelineisComplete, $livelineisCancelled, $livelineTicketPrice, $livelineRevenue);
          }
      }

      if($Wednesday == 1){
        $nextSat = date("Y-m-d", strtotime("next wednesday"));
        $begin = new DateTime( $nextSat);
        foreach($livelineTimes as $key => $Time){

        $MsgErr .= $this->createWeeklyLiveLines($begin, $Time , $livelineID, $livelineDriverID[$key], $livelineBusID,
                                              $livelineisComplete, $livelineisCancelled, $livelineTicketPrice, $livelineRevenue);
          }
      }

      if($Thursday == 1){
        $nextSat = date("Y-m-d", strtotime("next thursday"));
        $begin = new DateTime( $nextSat);
        foreach($livelineTimes as $key => $Time){

        $MsgErr .= $this->createWeeklyLiveLines($begin, $Time , $livelineID, $livelineDriverID[$key], $livelineBusID,
                                              $livelineisComplete, $livelineisCancelled, $livelineTicketPrice, $livelineRevenue);
          }
      }

      if($Friday == 1){
        $nextSat = date("Y-m-d", strtotime("next friday"));
        $begin = new DateTime( $nextSat);
        foreach($livelineTimes as $key => $Time){

          $MsgErr .= $this->createWeeklyLiveLines($begin, $Time , $livelineID, $livelineDriverID[$key], $livelineBusID,
                                              $livelineisComplete, $livelineisCancelled, $livelineRevenue, $livelineTicketPrice);

          }
      }
      echo "<br>Loading...";

    }
    $data['Message'] = $MsgErr;
   $this->load->view('pages/livelines_redirect', $data);

  }

  private function checkDriverAvailability($DriverID, $Date){
    $DriverPackage = $this->Drivers_model->getDriverpackage_byID($DriverID);
    $DriverLimit  = $DriverPackage[0]['DPKG_TRIPS'];
    $DriverTrips  = $this->LiveLines_model->getDriverTripsPerDay($DriverID, $Date);

    if($DriverTrips < $DriverLimit) return true;
    else return false;

  }

  private function createWeeklyLiveLines($begin, $livelineTimes, $livelineID, $livelineDriverID, $livelineBusID,
                                        $livelineisComplete, $livelineisCancelled, $livelineTicketPrice, $livelineRevenue){

        $thisyear = date('Y');
        $end = new DateTime( $thisyear . '-12-31' );

        $interval = DateInterval::createFromDateString('7 day');
        $period = new DatePeriod($begin, $interval, $end);
        $Msg = "";

        foreach ( $period as $dt ){

            $time = date("H:i:s",strtotime($livelineTimes));
            $combinedDT = date('Y-m-d H:i:s', strtotime($dt->format( " Y-m-d " ) . " $time"));
            $Availability = $this->checkDriverAvailability($livelineDriverID, $combinedDT);
            if($Availability == true){
              $this->LiveLines_model->insertLiveLine($livelineID, $livelineDriverID, $combinedDT, $livelineBusID,
                                                     $livelineisComplete, $livelineisCancelled, $livelineTicketPrice, $livelineRevenue);
              echo "<br>Loading...";
            }
            else {
              $Msg .= "<li>Driver already reached the limit on " . $dt->format( " Y-m-d " ) . "</li>";
              echo "<br>Loading...";
            }
        }
        return $Msg;

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addlivelines');
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

    $data['Generate']     = false;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addliveline', $data);
    $this->load->view('templates/footer');

  }

  public function edit($ID){

    $result = $this->CheckUser2('addlivelines');
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

    $result = $this->CheckUser2('livelines/delete');
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

    $this->LiveLines_model->deleteLiveLine($ID);
    $this->load->view('pages/livelines_redirect');

  }
}

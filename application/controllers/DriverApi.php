<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DriverApi extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function login(){

    $driverLicense = $this->input->post('driverLicense');
    $driverPass = $this->input->post('driverPass');

    $validLicense = $this->Drivers_model->isLicenseExist($driverLicense);
    $validdriver = $this->Drivers_model->checkDriverbyLicense($driverLicense, $driverPass);

    if ($validdriver) {
      echo $validdriver;
      return;
    } //log in success

    if(!$validdriver  && $validLicense ) {
      echo 'WrongPass';
      return;
    } //wrong pass, valid mail

    if(!$validdriver  && !$validLicense ) {
      echo 'WrongDriver';
      return;
    } //wrong data


  }

  public function getDriverProfile(){
    $driverID = $this->input->post('driverID');
    echo json_encode($this->Drivers_model->getDriver_byID($driverID), JSON_UNESCAPED_UNICODE);
  }

  public function setTag(){

    $driverID = $this->input->post('driverID');
    $driverTag = $this->input->post('driverTag');

    echo $this->Drivers_model->setTag($driverID, $driverTag);
    return ;
  }

  public function setTracker(){

    $driverID = $this->input->post('driverID');
    $driverTracker = $this->input->post('driverTracker');

    echo $this->Drivers_model->setTracker($driverID, $driverTracker);
    return ;
  }

  public function change_pw(){
    $driverID = $this->input->post('driverID');
    $driverOldPass = $this->input->post('driverOldPass');
    $driverNewPass = $this->input->post('driverNewPass');

    $validuser = $this->Drivers_model->checkDriverbyID($driverID, $driverOldPass);

    if($validuser){
    echo $this->Drivers_model->changePassbyID($driverID, $driverNewPass);

    }
    else echo "WrongPass ";

  }

  public function getActiveTrips(){

    $driverID = $this->input->post('driverID');
    $Trips = $this->Drivers_model->getActiveLines_ByDriver($driverID);
    foreach($Trips as $key => $trip){
      $Lines = $this->Paths_model->getDriverPaths($trip['LVLN_LINE_ID']);
      $liveLine = $trip['LVLN_ID'];
      foreach($Lines as $key1 => $line){
        $Lines[$key1]['In_Array'] =  $this->Traveltickets_model->getInTicketsByStations($liveLine, $line['PATH_STTN_ID']);
        $Lines[$key1]['Out_Array'] = $this->Traveltickets_model->getOutTicketsByStations($liveLine, $line['PATH_STTN_ID']);
      }
      $Trips[$key]['Stations'] = $Lines;
    }

    echo json_encode($Trips, JSON_UNESCAPED_UNICODE);

  }

  public function getOldTrips(){
    $driverID = $this->input->post('driverID');
    $Trips = $this->Drivers_model->getOldLines_ByDriver($driverID);

    foreach ($Trips as $key => $line) {
      $Trips[$key]['FullLine'] = $this->Lines_model->getFullLinesByID($line['LVLN_LINE_ID']);
    }
    echo json_encode($Trips, JSON_UNESCAPED_UNICODE);
  }

  public function clientArrived(){
    $TicketID = $this->input->post('TicketID');
    $this->Traveltickets_model->setClientPaid($TicketID);
      echo 1;
  }

  public function clientUnavailable(){
    $TicketID = $this->input->post('TicketID');
    $this->Traveltickets_model->cancelTicketbyDriver($TicketID);
      echo 1;
  }

  public function completeTrip(){
    $LiveLineID = $this->input->post('LivelineID');
    $this->LiveLines_model->setTripCompleted($LiveLineID);
    echo 1;
  }

  public function startTrip(){
    $LiveLineID = $this->input->post('LivelineID');
    $this->LiveLines_model->setTripStarted($LiveLineID);
    echo 1;
  }

  public function confirmStation(){
    $TicketIDs = $this->input->post('TicketIDs');
    $TicketArr = json_decode($TicketIDs, true);
    print_r($TicketArr);

    foreach($TicketArr as $Ticket){
        $res = $this->Traveltickets_model->confirmTicketStatus($Ticket);
        if($res['sendPush'] == 1){
          $this->sendPush($res['ClientID'], 'Ticket Missed', 'We are confirming that you missed your Ticket: ' . $Ticket . '. We will decrement the ticket price from you balance. Please call us if there any inconvenience.' );
          $ArabicTitle = 'تم فوات التذكره';
          $ArabicMessage = 'لقد فات ميعاد التذكره رقم: ' . $Ticket . '.سوف نقوم بخصم سعر التذكره من حسابك لدينا. من فضلك قم بالاتصال بنا بأقرب قرصه ان كان هناك خطأ في العمليه ';
          $this->sendPush($res['ClientID'], $ArabicTitle, $ArabicMessage, true);
        }
    }

  }

  private function sendPush($ClientID, $MessageTitle, $MessageContent, $Arabic = false){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, base_url() . 'sendpushfromApi');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
                http_build_query(array('ApiPass' => 'p@ss@Pi',
                                       'ClientID'    => $ClientID,
                                       'Message'     => $MessageContent,
                                       'MsgTitle'    => $MessageTitle,
                                       'isMsgArabic' => $Arabic)));


    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec ($ch);

    curl_close ($ch);

  }


}

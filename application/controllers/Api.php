<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function register()
  {
    $clientFirstName = trim($this->input->post('clientFirstName'));
    $clientSecondName = trim($this->input->post('clientSecondName'));
    $clientName = $clientFirstName .  ' ' . $clientSecondName;
    $clientTel = trim($this->input->post('clientTel'));
    $clientEmail = $this->input->post('clientEmail');
    $clientImg = '';
    $clientDistID = $this->input->post('clientDistID');
    $clientPass = $this->input->post('clientPass');
    $clientBalance = 0;
    $clientTag = $this->input->post('clientTag');


    if(($clientName !== null) && ($clientTel !== null) && ($clientDistID !== null)
    && ($clientPass !== null) && ($clientTag !== null)) {

    $NumberTaken =   $this->Clients_model->isNumberExist($clientTel);

   if($NumberTaken) {
     echo 2;
    return;
  }

    $ID = $this->Clients_model->regClient($clientName, $clientTel, $clientEmail, $clientImg, $clientPass,
                                     $clientBalance, $clientTag, $clientDistID);

    echo json_encode(array(
      'State' => 'Success',
      'ID'    => $ID,
      'Balance' => $clientBalance
    ));

    return;
     }
     else {
       echo 0;
       return;
     }
  }


    public function login(){
      $clientTel = $this->input->post('clientTel');
      $clientPass = $this->input->post('clientPass');

      $validNumber = $this->Clients_model->isNumberExist($clientTel);
      $validuser = $this->Clients_model->checkUserbyTel($clientTel, $clientPass);

      if ($validuser) {
        echo $validuser;
        return;
      } //log in success

      if(!$validuser  && $validNumber ) {
        echo 'WrongPass';
        return;
      } //wrong pass, valid mail

      if(!$validuser  && !$validNumber ) {
        echo 'WrongUser';
        return;
      } //wrong data


  }

  public function change_pw(){
    $clientID = $this->input->post('clientID');
    $clientOldPass = $this->input->post('clientOldPass');
    $clientNewPass = $this->input->post('clientNewPass');

    $validuser = $this->Clients_model->checkUserbyID($clientID, $clientOldPass);

    if($validuser){
    echo $this->Clients_model->changePassbyID($clientID, $clientNewPass);

    }
    else echo "WrongPass ";

  }

  public function update_profile(){


    $clientFirstName = trim($this->input->post('clientFirstName'));
    $clientSecondName = trim($this->input->post('clientSecondName'));
    $clientName = $clientFirstName .  ' ' . $clientSecondName;
    $clientDistID = $this->input->post('clientDistID');
    $clientEmail = $this->input->post('clientEmail');
    $clientID = $this->input->post('clientID');

    if($this->Clients_model->editClientByUserID($clientName, $clientDistID, $clientEmail, $clientID)) echo '1';
    else echo 0;


  }

  public function set_image(){

    $clientID = $this->input->post('clientID');
    $clientImg = $this->input->post('clientImg');

    echo $this->Clients_model->setImage($clientID, $clientImg);
    return ;
  }

  public function setTag(){

    $clientID = $this->input->post('ClientID');
    $clientTag = $this->input->post('ClientTag');

    echo $this->Clients_model->setTag($clientID, $clientTag);
    return ;
  }

  public function get_profile(){
    $clientID = $this->input->post('clientID');
    $profile = $this->Clients_model->getClient_byID($clientID);
    echo json_encode($profile, JSON_UNESCAPED_UNICODE);
    return;
  }

  public function get_districts(){

    $districts = $this->Districts_model->getDistrictsOnly();
    echo json_encode($districts, JSON_UNESCAPED_UNICODE);
    return ;
  }

  public function get_districts_by_cityID($ID){

    $districts = $this->Districts_model->getDistrict_byCityID($ID);
    echo json_encode($districts, JSON_UNESCAPED_UNICODE);
    return;
  }

  public function get_cities(){

    $cities = $this->Cities_model->getCities();
    echo json_encode($cities, JSON_UNESCAPED_UNICODE);
    return;
  }

  public function get_lines_by_districts($DistrictID){

    $lines  = $this->Lines_model->getLinesByDistrict($DistrictID);
    echo json_encode($lines, JSON_UNESCAPED_UNICODE);
    return;

  }

  public function get_all_lines($AreaID){

    $lines  = $this->Lines_model->getLinesByDistrict($AreaID);
    echo json_encode($lines, JSON_UNESCAPED_UNICODE);
    return;

  }

  public function get_driver_data($ID){

    $driver = $this->Drivers_model->getDriver_byID($ID);
    echo json_encode($driver, JSON_UNESCAPED_UNICODE);
  }

  public function get_bus_data($ID){

    $bus = $this->Buses_model->getBus_byID($ID);
    echo json_encode($bus, JSON_UNESCAPED_UNICODE);
  }

  public function get_faqs(){
    $faqs = $this->Faqs_model->getFaqs();
    echo json_encode($faqs, JSON_UNESCAPED_UNICODE);
  }

  public function get_aboutus(){
    $aboutus = $this->Aboutus_model->getAboutUs();
    echo json_encode($aboutus, JSON_UNESCAPED_UNICODE);
  }

  public function get_messages($ID){
    $messages = $this->Messages_model->getMessages_byClient($ID);
    echo json_encode($messages, JSON_UNESCAPED_UNICODE);
  }

  public function post_messages(){

    $messageTitle = $this->input->post('messageTitle');
    $messageText = $this->input->post('messageText');
    $messageClientID = $this->input->post('messageClientID');

    if($this->Messages_model->insertMessage($messageTitle, $messageText, $messageClientID)) echo 1;
    else echo '0';

  }

  public function add_favourite(){

    $favourite_lineLineID = $this->input->post('favourite_lineLineID');
    $favourite_lineClientID = $this->input->post('favourite_lineClientID');

    if($this->Favourite_lines_model->insertFavourite_line($favourite_lineLineID, $favourite_lineClientID)) echo 1;
    else echo 0;
  }

  public function get_favourites($ClientID){
    echo json_encode($this->Favourite_lines_model->getFavourite_Line_byClientID($ClientID), JSON_UNESCAPED_UNICODE);
  }

  public function delete_favourite($ID){
    $this->Favourite_lines_model->deleteFavourite_line($ID);
    echo 1;
  }

  public function get_lines_summary(){
    echo json_encode($this->Lines_model->getSummarizedLines(), JSON_UNESCAPED_UNICODE);
  }

  public function get_path($LineID){
    echo json_encode($this->Paths_model->getPaths($LineID));
  }

  public function isFavourite(){
    $ClientID = $this->input->post('ClientID');
    $LineID = $this->input->post('LineID');
    echo $this->Favourite_lines_model->isFavourite($ClientID, $LineID);
 }

  public function requestSpecialBus(){

   $Seats = $this->input->post('linerequestSeats');
   $isTwoWays = $this->input->post('linerequestisTwoWays');
   $ClientID = $this->input->post('linerequestClientID');
   $BackTime = $this->input->post('linerequestBackTime');
   $StartTime= $this->input->post('linerequestStartTime');
   $Notes= $this->input->post('linerequestNotes');
   $StartStationID= $this->input->post('linerequestStrtSttnID');
   $EndStationID= $this->input->post('linerequestEndSttnID');

   if(($Seats !== null) && ($isTwoWays !== null) && ($ClientID !== null)
     && ($StartTime !== null) && ($StartStationID !== null) && ($EndStationID !== null)) {


   $this->Linerequests_model->insertLinerequest($Seats, $isTwoWays, $ClientID, $BackTime, $StartTime, $Notes, $StartStationID, $EndStationID);
   echo '1';
 }
 else echo '0';

}


  public function getNotifications(){

  echo json_encode($this->Notifications_model->getAppNotifications(), JSON_UNESCAPED_UNICODE);

  }

  public function resetUser(){
    $ClientID = $this->input->post('ClientID');
    $this->Favourite_lines_model->deleteFavourite_Client($ClientID);
    echo 1;
  }

  public function getArticle(){

    $IDs = $this->Articles_model->getArticlesID();
    $randomIndex = rand(0, sizeof($IDs)-1);
    echo json_encode($this->Articles_model->getArticle_byID($IDs[$randomIndex]), JSON_UNESCAPED_UNICODE);

  }

  public function getFreeCode(){
    $ClientID = $this->input->post('ClientID');
    echo $this->Clients_model->getFreeCode($ClientID);
  }

  public function getLineDetails(){
    $LineID = $this->input->post('LineID');
    $StartStation = $this->input->post('StartStationID');
    $EndStation = $this->input->post('EndStationID');

    $Lines = $this->LiveLines_model->getAvailableLines($LineID, $StartStation, $EndStation);
    $Indicies = $this->Paths_model->getPathIndicies($LineID, $StartStation, $EndStation);
    foreach ($Lines as $row){
      $Lines[$row['LiveLineID']]['TicketsAv'] = $this->Traveltickets_model->getSeatsAvailable($row['LiveLineID'], $Indicies);
    }

    echo json_encode($Lines, JSON_UNESCAPED_UNICODE);

  }

  public function subscribeTicket(){

    $LiveLineID  = $this->input->post('LiveLineID');
    $StartIndex  = $this->input->post('StartIndex');
    $EndIndex  = $this->input->post('EndIndex');
    $NoofTickets = $this->input->post('NoofTickets');
    $isHandi     = $this->input->post('isHandi');
    $ClientID    = $this->input->post('ClientID');
    $Price       = $this->LiveLines_model->getTicketPricebyID($LiveLineID);

    if($this->Traveltickets_model->isAvailable($LiveLineID, $StartIndex, $EndIndex, $NoofTickets)){

    $res = $this->Traveltickets_model->insertTravelTicket($ClientID, $LiveLineID, $StartIndex,
                                                   $EndIndex, 0, 0, $Price, $isHandi);

    if($res) $this->Clients_model->decrementBalance($ClientID, $Price * $NoofTickets);
    echo $res;
    }
    else echo 'NS';
  }

}

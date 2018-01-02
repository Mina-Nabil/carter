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

    $EmailTaken =   $this->Clients_model->isEmailExist($clientEmail);

    if($EmailTaken) {
      echo 2;
     return;
   } //Email Already Taken

   $TagTaken =   $this->Clients_model->isTagExist($clientTag);

   if($TagTaken) {
     echo 3;
    return;
  } //Tag Already Taken

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
      $clientEmail = $this->input->post('clientEmail');
      $clientPass = $this->input->post('clientPass');

      $validEmail = isEmailExist($clientEmail);
      $validuser = checkUser($clientEmail, $clientPass);

      if ($validuser) {
        echo 1;
        return;
      } //log in success

      if(!$validuser  && $validEmail ) {
        echo 2;
        return;
      } //wrong pass, valid mail

      if(!$validuser  && !$validEmail ) {
        echo 0;
        return;
      } //wrong data


  }

  public function set_image(){

    $clientID = $this->input->post('clientID');
    $clientImg = $this->input->post('clientImg');

    $this->Clients_model->setImage($clientID, $clientImg);
    echo 1;
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



}

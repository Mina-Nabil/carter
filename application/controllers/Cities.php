<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cities extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Cities'){
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
      $this->load->view('pages/cities_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }


    $data['TableData'] = $this->Cities_model->getCities();

    $data['TableHeaders'] = array(
      'ID',
      'Name',
      'Edit',
      'Delete'
    );

    $data['Table_Name'] = 'Cities';
    $data['Url_Name']   = 'cities';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/cities', $data);
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
      $this->load->view('pages/cities_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $data['CITY_ID']      = ''              ;
    $data['CITY_NAME']    = ''              ;

    $data['formURL']      = 'insertcities'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addcity', $data);
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
      $this->load->view('pages/cities_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $cityName = $this->input->post('cityName');
    $this->Cities_model->insertCity($cityName);

    $this->load->view('pages/cities_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser('EDIT');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/cities_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $City = $this->Cities_model->getCity_byID($ID)[0];

    $data['CITY_ID']      = $City['CITY_ID']  ;
    $data['CITY_NAME']    = $City['CITY_NAME'];

    $data['formURL']      = 'editcities/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addcity', $data);
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
      $this->load->view('pages/cities_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $cityName = $this->input->post('cityName');
    $this->Cities_model->editCity($ID, $cityName);

    $this->load->view('pages/cities_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser('DEL');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/cities_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $this->Cities_model->deleteCity($ID);
    $this->load->view('pages/cities_redirect');

  }








}

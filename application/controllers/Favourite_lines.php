<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Favourite_lines extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Favourite_lines'){
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
      $this->load->view('pages/favourite_lines_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }


    $data['TableData'] = $this->Favourite_lines_model->getFavourite_lines();

    $data['TableHeaders'] = array(
      'ID',
      'Line Name',
      'Client Name',
      'Bus Type/ Bus Seat Count',
      'Start Time',
      'Canceled?',
      'Completed?',
      'Revenue',
      'Edit',
      'Delete'
    );

    $data['Table_Name'] = 'Favourite_lines';
    $data['Url_Name']   = 'favourite_lines';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/favourite_lines', $data);
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
      $this->load->view('pages/favourite_lines_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $data['Clients'] = $this->Clients_model->getClients();
    $data['Lines'] = $this->Lines_model->getLines();
    $data['Buses'] = $this->Buses_model->getBuses();

    $data['LVLN_ID']      = ''              ;
    $data['LVLN_LINE_ID']    = ''              ;
    $data['LVLN_BUS_ID']    = ''              ;
    $data['LVLN_TIME']    = ''              ;
    $data['LVLN_CANC']    = ''         ;
    $data['LVLN_COMP']    = ''              ;
    $data['LVLN_CLNT_ID']    = ''           ;

    $data['formURL']      = 'insertfavourite_lines'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addfavourite_line', $data);
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
      $this->load->view('pages/favourite_lines_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $favourite_lineName = $this->input->post('favourite_lineName');
    $favourite_lineBusID = $this->input->post('favourite_lineBusID');
    $favourite_lineTime = $this->input->post('favourite_lineTime');
    $favourite_lineRevenue = $this->input->post('favourite_lineRevenue');
    $favourite_lineClientID = $this->input->post('favourite_lineClientID');
    $favourite_lineisComplete = $this->input->post('favourite_lineisComplete');

    $this->Favourite_lines_model->insertFavourite_line($favourite_lineName, $favourite_lineClientID, $favourite_lineBusID,
                                         $favourite_lineTime, $favourite_lineRevenue, $favourite_lineisComplete);

    $this->load->view('pages/favourite_lines_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser('EDIT');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/favourite_lines_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $Favourite_line = $this->Favourite_lines_model->getFavourite_line_byID($ID)[0];

    $data['Clients'] = $this->Clients_model->getClients();
    $data['Lines'] = $this->Lines_model->getLines();

    $data['LVLN_ID']      = $Favourite_line['LVLN_ID']  ;
    $data['LVLN_LINE_ID']    = $Favourite_line['LVLN_LINE_ID']  ;
    $data['LVLN_CLNT_ID']    = $Favourite_line['LVLN_CLNT_ID'];

    $data['formURL']      = 'editfavourite_lines/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addfavourite_line', $data);
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
      $this->load->view('pages/favourite_lines_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $favourite_lineLineID = $this->input->post('favourite_lineLineID');
    $favourite_lineClientID = $this->input->post('favourite_lineClientID');


    $this->Favourite_lines_model->editFavourite_line($ID, $favourite_lineLineID, $favourite_lineClientID);

     $this->load->view('pages/favourite_lines_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser('DEL');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/favourite_lines_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $this->Favourite_lines_model->deleteFavourite_line($ID);
    $this->load->view('pages/favourite_lines_redirect');

  }
}

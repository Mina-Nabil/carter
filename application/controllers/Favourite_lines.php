<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Favourite_lines extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Favourite_Lines'){
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
      $header['OrgArr'] = $this->Master_model->getPagesByType();
    }


    $data['TableData'] = $this->Favourite_lines_model->getFavourite_lines();

    $data['TableHeaders'] = array(
      'Client ID',
      'Client Name',
      'Line Name',
      'Edit',
      'Delete'
    );

    $data['Table_Name'] = 'Favourite lines';
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
      $header['OrgArr'] = $this->Master_model->getPagesByType();
    }

    $data['Clients'] = $this->Clients_model->getClients();
    $data['Lines'] = $this->Lines_model->getLines();

    $data['FVLN_ID']      = ''              ;
    $data['FVLN_LINE_ID']    = ''              ;
    $data['FVLN_BUS_ID']    = ''              ;
    $data['FVLN_TIME']    = ''              ;
    $data['FVLN_CANC']    = ''         ;
    $data['FVLN_COMP']    = ''              ;
    $data['FVLN_CLNT_ID']    = ''           ;

    $data['formURL']      = 'insertfavourite_lines'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addfavourite_lines', $data);
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
      $header['OrgArr'] = $this->Master_model->getPagesByType();
    }

    $favourite_lineLineID = $this->input->post('favourite_lineLineID');
    $favourite_lineClientID = $this->input->post('favourite_lineClientID');

    $this->Favourite_lines_model->insertFavourite_line($favourite_lineLineID, $favourite_lineClientID);

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
      $header['OrgArr'] = $this->Master_model->getPagesByType();
    }

    $Favourite_line = $this->Favourite_lines_model->getFavourite_line_byID($ID)[0];

    $data['Clients'] = $this->Clients_model->getClients();
    $data['Lines'] = $this->Lines_model->getLines();

    $data['FVLN_ID']      = $Favourite_line['FVLN_ID']  ;
    $data['FVLN_LINE_ID']    = $Favourite_line['FVLN_LINE_ID']  ;
    $data['FVLN_CLNT_ID']    = $Favourite_line['FVLN_CLNT_ID'];

    $data['formURL']      = 'editfavourite_lines/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addfavourite_lines', $data);
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
      $header['OrgArr'] = $this->Master_model->getPagesByType();
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
      $header['OrgArr'] = $this->Master_model->getPagesByType();
    }

    $this->Favourite_lines_model->deleteFavourite_line($ID);
    $this->load->view('pages/favourite_lines_redirect');

  }
}

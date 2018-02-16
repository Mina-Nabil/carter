<?php
defined('BASEPRVG') OR exit('No direct script access allowed');

class Privilages extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageUserID = 'Privilages'){
    //Returns header array if user is correct

    $userType = $this->session->userdata['USRTYPE'];
    $headerArr = $this->Master_model->getHeaderArr();
    if(!$headerArr[0])   return false;          // If a user is not logged in
    if (!in_array($userType . '-' . $Function, $headerArr[$PageUserID]['Permissions'] )) {
      // If logged in And not permitted type
      return 1;

    }else {
      return $headerArr;
    }

  }

  public function home($ID, $MSGErr = '', $MSGOK = '')
  {

    $result = $this->CheckUser('HOME');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/privilages_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }


    $data['TableData'] = $this->Privilages_model->getPrivilages($ID);

    $data['USR_ID']    = $ID         ;

    $data['TableHeaders'] = array(
      'Index',
      'User Name',
      'Page Type',
      'Page Name',
    );

    $data['Table_Name'] = 'Privilages';
    $data['Url_Name']   = 'privilages';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/privilages', $data);
    $this->load->view('templates/footer');

  }

  public function addpage($UserID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser('ADD');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/privilages_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $data['Users'] = $this->Users_model->getUsers();
    $data['Pages'] = $this->Pages_model->getPages();

    $data['PRVG_ID']      = ''     ;
    $data['PRVG_USR_ID']    = ''   ;
    $data['PRVG_PAGE_ID']    = ''  ;
    $data['USR_ID']    = $UserID   ;

    $data['formURL']      = 'insertprivilages'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addprivilage', $data);
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
      $this->load->view('pages/privilages_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }


    $this->Privilages_model->deletePrivilage($privilageUserID);

    $privilageUserID    =  $this->input->post('privilageUserID');
    $privilagePageID  =  $this->input->post('privilagePageID');

    $this->Privilages_model->insertPrivilage($privilageUserID, $privilagePageID);

    $data['privilageUserID'] = $privilageUserID;
    $this->load->view('pages/privilages_redirect', $data);

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser('EDIT');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/privilages_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $data['Privilage'] = $this->Privilages_model->getPrivilage_byUserID($ID);

    $data['Users']          = $this->Users_model->getUsers();
    $data['Pages']       = $this->Pages_model->getPages();
    $data['PRVG_USR_ID']   = $ID;

    $data['formURL']      = 'editprivilages/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addprivilage', $data);
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
      $this->load->view('pages/privilages_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }



    $privilageUserID    =  $this->input->post('privilageUserID');
    $privilagePages  =  $this->input->post('privilagePageID');
    $privilageRelTime   =  $this->input->post('privilageRelTime');
    $i = 0;

      $this->Privilages_model->deletePrivilage($privilageUserID);
    foreach ($privilagePages as $key => $value) {
       $this->Privilages_model->insertPrivilage($privilageUserID, $i, $privilageRelTime[$key], $value);
       $i++;
    }
    $data['privilageUserID'] = $privilageUserID;
    $this->load->view('pages/privilages_redirect', $data);


  }


  public function delete($ID){

    $result = $this->CheckUser('DEL');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/privilages_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $this->Privilages_model->deletePrivilage($ID);
    $this->load->view('pages/privilages_redirect');

  }
}

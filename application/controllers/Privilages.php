<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

  private function CheckUser2($PageURL){

    if(!isset($this->session->userdata['USRNAME'])) return false;

    $result = $this->Master_model->checkPageByUrl($PageURL);

    if($result) return 1;
    else {

      $this->load->view("home_redirect");
      return 2;
    }

  }

  public function home($ID, $MSGErr = '', $MSGOK = '')
  {

    $result = $this->CheckUser2('privilages');
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


    $data['TableData'] = $this->Privilages_model->getPrivilage_byUserID($ID);

    $data['USR_ID']    = $ID         ;

    $data['TableHeaders'] = array(
      'Page Type',
      'Page Name',
      'User Name',
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

    $result = $this->CheckUser2('privilages');
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
    $this->load->view('pages/addprivilages', $data);
    $this->load->view('templates/footer');
  }

  public function insert(){

    $result = $this->CheckUser2('privilages');
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

    $privilageUserID    =  $this->input->post('privilageUserID');
    $privilagePageID  =  $this->input->post('privilagePageID');
    $AllPriv          = $this->input->post('allPriv');

    if($AllPriv == 1){
      $this->Privilages_model->deletePrivilage_User($privilageUserID);
      $this->Privilages_model->addAllPrivilages($privilageUserID);
    }
    else {
      $this->Privilages_model->insertPrivilage($privilageUserID, $privilagePageID);
    }


    $data['privilageUserID'] = $privilageUserID;
    $this->load->view('pages/privilages_redirect', $data);

  }


  public function delete($PageID, $UserID){

    $result = $this->CheckUser2('privilages');
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

    $this->Privilages_model->deletePrivilage_PageByPageAndUser($PageID, $UserID);
    $this->load->view('pages/privilages_redirect');

  }
}

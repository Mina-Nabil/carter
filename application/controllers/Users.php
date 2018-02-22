<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Users'){
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

    $result = $this->CheckUser2('users');
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


    $data['TableData'] = $this->Users_model->getUsers();

    $data['TableHeaders'] = array(
      'ID',
      'Name',
      'Type',
      'Pass',
      'Privilages',
      'Edit',
      'Delete'
    );

    $data['Table_Name'] = 'Users';
    $data['Url_Name']   = 'users';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/users', $data);
    $this->load->view('templates/footer');

  }

  public function addpage($MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addusers');
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


    $data['USR_ID']      = ''              ;
    $data['USR_NAME']    = ''              ;
    $data['USR_TYPE']    = ''              ;
    $data['USR_PASS']    = ''              ;

    $data['formURL']      = 'insertusers'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/adduser', $data);
    $this->load->view('templates/footer');
  }

  public function insert(){

    $result = $this->CheckUser2('addusers');
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


    $userName = $this->input->post('userName');
    $userType = $this->input->post('userType');
    $userPass = $this->input->post('userPass');

    $this->Users_model->insertUser($userName, $userType, $userPass);

    $this->load->view('pages/users_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addusers');
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


    $User = $this->Users_model->getUser_byID($ID)[0];

    $data['USR_ID']      = $User['USR_ID']  ;
    $data['USR_NAME']    = $User['USR_NAME']  ;
    $data['USR_TYPE']    = $User['USR_TYPE']   ;
    $data['USR_PASS']    = 'XXXXXX' ;

    $data['formURL']      = 'editusers/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/adduser', $data);
    $this->load->view('templates/footer');

  }

  public function edit($ID){

    $result = $this->CheckUser2('addusers');
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


    $userName = $this->input->post('userName');
    $userType = $this->input->post('userType');
    $userPass = $this->input->post('userPass');

    $this->Users_model->editUser($ID, $userName, $userPass, $userType);

    $this->load->view('pages/users_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser2('users/delete');
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


    $this->Users_model->deleteUser($ID);
    $this->load->view('pages/users_redirect');

  }
}

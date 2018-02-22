<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Messages'){
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

    $result = $this->CheckUser2('messages');
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


    $data['TableData'] = $this->Messages_model->getMessages();

    $data['TableHeaders'] = array(
      'ID',
      'Message Title',
      'Message Text',
      'Client ID',
      'Client Name',
      'Show',
      'Delete'
    );

    $data['Table_Name'] = 'Messages';
    $data['Url_Name']   = 'messages';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/messages', $data);
    $this->load->view('templates/footer');

  }

  public function addpage($MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addmessages');
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


    $data['Clients']  = $this->Clients_model->getClients();

    $data['MSGS_ID']      = ''              ;
    $data['MSGS_TITLE']    = ''              ;
    $data['MSGS_TEXT']    = ''              ;
    $data['MSGS_CLNT_ID']    = ''           ;

    $data['formURL']      = 'insertmessages'  ;

    $data['disabled']     = false;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addmessage', $data);
    $this->load->view('templates/footer');
  }

  public function insert(){

    $result = $this->CheckUser2('addmessages');
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

    $messageTitle = $this->input->post('messageTitle');
    $messageText = $this->input->post('messageText');
    $messageClientID = $this->input->post('messageClientID');

    $this->Messages_model->insertMessage($messageTitle, $messageText, $messageClientID);

    $this->load->view('pages/messages_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addmessages');
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

    $Message = $this->Messages_model->getMessage_byID($ID)[0];

    $data['Clients'] = $this->Clients_model->getClients();

    $data['MSGS_ID']      = $Message['MSGS_ID']  ;
    $data['MSGS_TITLE']    = $Message['MSGS_TITLE']  ;
    $data['MSGS_TEXT']    = $Message['MSGS_TEXT']   ;
    $data['MSGS_CLNT_ID']    = $Message['MSGS_CLNT_ID'] ;
    $data['MSGS_ARBC_TITLE']    = $Message['MSGS_ARBC_TITLE']   ;

    $data['formURL']      = 'editmessages/' . $ID  ;

    $data['disabled']     = true;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addmessage', $data);
    $this->load->view('templates/footer');

  }

  public function edit($ID){

    $result = $this->CheckUser2('addmessages');
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

    $messageTitle = $this->input->post('messageTitle');
    $messageText = $this->input->post('messageText');
    $messageClientID = $this->input->post('messageClientID');

    $this->Messages_model->editMessage($ID, $messageName, $messageText, $messageClientID);

    $this->load->view('pages/messages_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser2('messages/delete');
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

    $this->Messages_model->deleteMessage($ID);
    $this->load->view('pages/messages_redirect');

  }
}

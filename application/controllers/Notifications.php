<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Notifications'){
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
      $this->load->view('pages/notifications_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }


    $data['TableData'] = $this->Notifications_model->getNotifications();

    $data['TableHeaders'] = array(
      'ID',
      'Title',
      'Arabic Title',
      'From',
      'To',
      'Edit',
      'Delete'
    );

    $data['Table_Name'] = 'Notifications';
    $data['Url_Name']   = 'notifications';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/notifications', $data);
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
      $this->load->view('pages/notifications_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }


    $data['NOTF_ID']      = '' ;
    $data['NOTF_TITLE']    = '' ;
    $data['NOTF_TEXT']    = ''  ;
    $data['NOTF_ARBC_TEXT']    = '' ;
    $data['NOTF_ARBC_TITLE']    = '' ;
    $data['NOTF_IMG']    = ''      ;
    $data['NOTF_TO']    = ''      ;
    $data['NOTF_FROM']    = ''      ;

    $data['formURL']      = 'insertnotifications'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addnotification', $data);
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
      $this->load->view('pages/notifications_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $notificationTitle = $this->input->post('notificationTitle');
    $notificationText = $this->input->post('notificationText');
    $notificationArbcTitle = $this->input->post('notificationArbcTitle');
    $notificationArbcText = $this->input->post('notificationArbcText');
    $notificationFrom = $this->input->post('notificationFrom');
    $notificationTo = $this->input->post('notificationTo');
    $notificationImage = $this->input->post('notificationImage');

    $this->Notifications_model->insertNotification($notificationTitle, $notificationText, $notificationArbcTitle, $notificationArbcText,
                                                   $notificationImage, $notificationFrom, $notificationTo);

    $this->load->view('pages/notifications_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser('EDIT');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/notifications_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $Notification = $this->Notifications_model->getNotification_byID($ID)[0];

    $data['NOTF_ID']      = $Notification['NOTF_ID']  ;
    $data['NOTF_TITLE']    = $Notification['NOTF_TITLE']  ;
    $data['NOTF_TEXT']    = $Notification['NOTF_TEXT']   ;
    $data['NOTF_ARBC_TEXT']    = $Notification['NOTF_ARBC_TEXT'] ;
    $data['NOTF_ARBC_TITLE']    = $Notification['NOTF_ARBC_TITLE']   ;
    $data['NOTF_IMG']    = $Notification['NOTF_IMG']   ;
    $data['NOTF_TO']    = $Notification['NOTF_TO']   ;
    $data['ToTimestamp']    = strtotime($Notification['NOTF_TO'])   ;
    $data['NOTF_FROM']    = $Notification['NOTF_FROM']   ;
    $data['FromTimestamp']    = strtotime($Notification['NOTF_FROM'])   ;

    $data['formURL']      = 'editnotifications/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addnotification', $data);
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
      $this->load->view('pages/notifications_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $notificationTitle = $this->input->post('notificationTitle');
    $notificationText = $this->input->post('notificationText');
    $notificationArbcTitle = $this->input->post('notificationArbcTitle');
    $notificationArbcText = $this->input->post('notificationArbcText');
    $notificationFrom = $this->input->post('notificationFrom');
    $notificationTo = $this->input->post('notificationTo');
    $notificationImage = $this->input->post('notificationImage');

    $this->Notifications_model->editNotification($ID, $notificationTitle, $notificationText, $notificationArbcTitle, $notificationArbcText,
                                                   $notificationImage, $notificationFrom, $notificationTo);

    $this->load->view('pages/notifications_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser('DEL');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/notifications_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $this->Notifications_model->deleteNotification($ID);
    $this->load->view('pages/notifications_redirect');

  }
}

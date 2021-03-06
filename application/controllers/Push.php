<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Push extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Push_Notification'){
    //Returns header array if user is correct

    $userType = $this->session->userdata['USRTYPE'];
    $headerArr = $this->Master_model->getHeaderArr();
    if(!$headerArr[0])   return false;          // If a user is not logged in
    if (!in_array($userType . '-' . $Function, $headerArr['AdminControllers'][$PageName]['Permissions'] )) {
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


  function home()
  {
    $result = $this->CheckUser2('Push/home');
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

    $data['Clients'] = $this->Clients_model->getClients();
    $data['formURL'] = "push/sendMsg";

    //Get Push Counts
    $data['AllUsersCount'] = $this->Pushlogs_model->getPushlogCount_byType(1);
    $data['TopUsersCount'] = $this->Pushlogs_model->getPushlogCount_byType(2);
    $data['SpcUsersCount'] = $this->Pushlogs_model->getPushlogCount_byType(3);

    $this->load->view('templates/header', $header);
    $this->load->view('controlpages/push', $data);
    $this->load->view('templates/footer');
  }

  public function getLogs($Type){

    $result = $this->CheckUser2('Push/home');
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

    $data['TableData'] = $this->Pushlogs_model->getPushlogsByType($Type);
    $data['Table_Name'] = 'Push History';

    $data['TableHeaders'] = array(
      'Title',
      'Text',
      'Target',
      'User Name',
      'Client Name',
      'Client Telephone',
    );

    $this->load->view('templates/header', $header);
    $this->load->view('pages/pushlogs', $data);
    $this->load->view('templates/footer');

  }


  public function initiateMsg(){

    $result = $this->CheckUser2('Push/home');
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

    $messageText = $this->input->post('messageText');
    $messageTitle = $this->input->post('messageTitle');
    $value = explode('#%', $this->input->post('messageClient'));
    $clientID = $value[0];
    $messageTarget = $value[1];

    $content = array(
      "en" => $messageText,

      );

    $title = array(
      "en" => $messageTitle
      );

    if(strcmp($messageTarget, 'All') == 0){
      $fields = array(
     'app_id' => "dadb20f9-3370-4e4d-a44f-d9f844034f0c",
     'included_segments' => array('All'),
     'contents' => $content,
     'headings' => $title
      );
      $this->Pushlogs_model->insertPushlog($messageTitle, $messageText, $this->session->userdata['USRID'], 1, NULL);

    }
    else if(strcmp($messageTarget, 'Top') == 0){


      $ClientTags = $this->Clients_model->getTopBalancedClientsTags(20);

      $fields = array(
        'app_id' => "dadb20f9-3370-4e4d-a44f-d9f844034f0c",
        'include_player_ids' => $ClientTags,
        'contents' => $content,
        'headings' => $title
      );
      $this->Pushlogs_model->insertPushlog($messageTitle, $messageText, $this->session->userdata['USRID'], 2, NULL);

    }

    else{
      $fields = array(
        'app_id' => "dadb20f9-3370-4e4d-a44f-d9f844034f0c",
        'include_player_ids' => array($messageTarget),
        'contents' => $content,
        'headings' => $title
      );

      $this->Pushlogs_model->insertPushlog($messageTitle, $messageText, $this->session->userdata['USRID'], 3, $clientID);
    }

    $this->sendData($fields);


  }


  private function sendData($fields){
		 $fields = json_encode($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                           'Authorization: Basic MDYyMDkwZGEtY2JlMC00NGRhLWE3ZjAtYWRmZjBkZGJkZTM2'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    curl_exec($ch);
    curl_close($ch);

    $this->home();
	}

  public function sendCustomData(){

    $ApiPass  = $this->input->post('ApiPass');
    $ClientID = $this->input->post('ClientID');
    $Message  = $this->input->post('Message');
    $Title    = $this->input->post('MsgTitle');
    $Arabic    = $this->input->post('isMsgArabic');

    if(strcmp($ApiPass. 'p@ss@Pi') != 0) return ;

    $messageTarget = $this->Client_model->getClientTag_byID($ClientID);

    if(!$Arabic){
      $content = array(
        "en" => $Message,
        );
      $title = array(
        "en" => $Title
        );

    } else {
      $content = array(
        "ar" => $Message,
        );
      $title = array(
        "ar" => $Title
        );
    }




    $fields = array(
      'app_id' => "dadb20f9-3370-4e4d-a44f-d9f844034f0c",
      'include_player_ids' => array($messageTarget),
      'contents' => $content,
      'headings' => $title
    );

    $this->Pushlogs_model->insertPushlog($Title, $Message, 1, 3, $ClientID);

    $fields = json_encode($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                          'Authorization: Basic MDYyMDkwZGEtY2JlMC00NGRhLWE3ZjAtYWRmZjBkZGJkZTM2'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    curl_exec($ch);
    curl_close($ch);

    return "OK";


  }

}

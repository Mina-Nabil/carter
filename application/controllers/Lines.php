<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lines extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Lines'){
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

  private function getLineIDs($array){
    $result = array();
    $result[0] = 'ID';
    foreach($array as $row){
      array_push($result, $row['LINE_ID']);
    }
  
    return $result;
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
      $this->load->view('pages/lines_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }


    $data['TableData'] = $this->Lines_model->getHomeLines();
    $Line_IDs = $this->getLineIDs($data['TableData']);

    $TempData = $this->Lines_model->getLines();
    foreach($TempData as $row){
      if(!in_array($row['LINE_ID'], $Line_IDs)){

        $temp = array(
          'LINE_ID' => $row['LINE_ID'],
          'LINE_NAME' => $row['LINE_NAME'],
          'LINE_DESC' => $row['LINE_DESC'],
          'LINE_TAGS' => $row['LINE_TAGS'],
          'START_DIST_NAME' => 'Line not set',
          'END_DIST_NAME' => 'Line not set',
          'START_CITY_NAME' => 'City not Added',
          'END_CITY_NAME' => 'City not Added',
          'START_STTN_NAME' => 'Line not set',
          'END_STTN_NAME' => 'Line not set',
        );

         array_push($data['TableData'], $temp);
      }

    }

    $data['TableHeaders'] = array(
      'ID',
      'Line Name',
      'Start Station',
      'Start District/City',
      'End Station',
      'End District/City',
      'Description',
      'Tags',
      'Path',
      'Edit',
      'Delete'
    );

    $data['Table_Name'] = 'Lines';
    $data['Url_Name']   = 'lines';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/lines', $data);
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
      $this->load->view('pages/lines_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $data['Districts'] = $this->Districts_model->getDistricts();

    $data['LINE_ID']      = ''              ;
    $data['LINE_NAME']    = ''              ;
    $data['LINE_DESC']    = ''              ;
    $data['LINE_TAGS']    = ''              ;

    $data['formURL']      = 'insertlines'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addline', $data);
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
      $this->load->view('pages/lines_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $lineName = $this->input->post('lineName');
    $lineDesc = $this->input->post('lineDesc');
    $lineTags = $this->input->post('lineTags');

    $this->Lines_model->insertLine($lineName, $lineDesc, $lineTags);

    $this->load->view('pages/lines_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser('EDIT');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/lines_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $Line = $this->Lines_model->getLine_byID($ID)[0];

    $data['Districts'] = $this->Districts_model->getDistricts();

    $data['LINE_ID']      = $Line['LINE_ID']  ;
    $data['LINE_NAME']    = $Line['LINE_NAME']  ;
    $data['LINE_DESC']    = $Line['LINE_DESC']   ;
    $data['LINE_TAGS']    = $Line['LINE_TAGS'] ;

    $data['formURL']      = 'editlines/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addline', $data);
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
      $this->load->view('pages/lines_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $lineName = $this->input->post('lineName');
    $lineDesc = $this->input->post('lineDesc');
    $lineTags = $this->input->post('lineTags');

    $this->Lines_model->editLine($ID, $lineName, $lineDesc,  $lineTags);

    $this->load->view('pages/lines_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser('DEL');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/lines_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $this->Lines_model->deleteLine($ID);
    $this->load->view('pages/lines_redirect');

  }
}

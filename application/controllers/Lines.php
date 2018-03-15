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

  private function CheckUser2($PageURL){

    if(!isset($this->session->userdata['USRNAME'])) return false;

    $result = $this->Master_model->checkPageByUrl($PageURL);

    if($result) return 1;
    else {

      $this->load->view("home_redirect");
      return 2;
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

    $result = $this->CheckUser2('lines');
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


    $data['TableData'] = $this->Lines_model->getHomeLines();
    $Line_IDs = $this->getLineIDs($data['TableData']);

    $TempData = $this->Lines_model->getLines();
    foreach($TempData as $row){
      if(!in_array($row['LINE_ID'], $Line_IDs)){

        $temp = array(
          'LINE_ID' => $row['LINE_ID'],
          'LINE_NAME' => $row['LINE_NAME'],
          'LINE_ARBC_NAME' => $row['LINE_ARBC_NAME'],
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

    $result = $this->CheckUser2('addlines');
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

    $data['Districts'] = $this->Districts_model->getDistricts();

    $data['LINE_ID']      = ''              ;
    $data['LINE_NAME']    = ''              ;
    $data['LINE_ARBC_NAME']    = ''              ;
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

    $result = $this->CheckUser2('addlines');
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

    $lineName = $this->input->post('lineName');
    $lineArbcName = $this->input->post('lineArbcName');
    $lineDesc = $this->input->post('lineDesc');
    $lineTags = $this->input->post('lineTags');

    $this->Lines_model->insertLine($lineName, $lineArbcName, $lineDesc, $lineTags);

    $this->load->view('pages/lines_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addlines');
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

    $Line = $this->Lines_model->getLine_byID($ID)[0];

    $data['Districts'] = $this->Districts_model->getDistricts();

    $data['LINE_ID']      = $Line['LINE_ID']  ;
    $data['LINE_NAME']    = $Line['LINE_NAME']  ;
    $data['LINE_ARBC_NAME']    = $Line['LINE_ARBC_NAME']  ;
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

    $result = $this->CheckUser2('addlines');
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

    $lineName = $this->input->post('lineName');
    $lineArbcName = $this->input->post('lineArbcName');
    $lineDesc = $this->input->post('lineDesc');
    $lineTags = $this->input->post('lineTags');

    $this->Lines_model->editLine($ID, $lineName, $lineArbcName, $lineDesc,  $lineTags);

    $this->load->view('pages/lines_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser2('lines/delete');
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

    $this->Lines_model->deleteLine($ID);
    $this->load->view('pages/lines_redirect');

  }
}

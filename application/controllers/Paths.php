<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paths extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageLineID = 'Paths'){
    //Returns header array if user is correct

    $userType = $this->session->userdata['USRTYPE'];
    $headerArr = $this->Master_model->getHeaderArr();
    if(!$headerArr[0])   return false;          // If a user is not logged in
    if (!in_array($userType . '-' . $Function, $headerArr[$PageLineID]['Permissions'] )) {
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

  public function pickline(){

    $result = $this->CheckUser2('paths');
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

    $data['Lines'] = $this->Lines_model->getLines();

    $this->load->view('templates/header', $header);
    $this->load->view('controlpages/pickLine', $data);
    $this->load->view('templates/footer');


  }

  public function pathredirect(){

    $result = $this->CheckUser2('paths');
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

    $this->home($this->input->post('ID'));
    return;
  }

  public function home($ID, $MSGErr = '', $MSGOK = '')
  {

    $result = $this->CheckUser2('paths');
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


    $data['TableData'] = $this->Paths_model->getPaths($ID);

    $data['LINE_ID']    = $ID         ;

    $data['TableHeaders'] = array(
      'Index',
      'District Name',
      'Line Name',
      'Station Name',
      'Station Address',
      'Relative Time from the Start'
    );

    $data['Table_Name'] = 'Paths';
    $data['Url_Name']   = 'paths';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/paths', $data);
    $this->load->view('templates/footer');

  }

  public function addpage($LineID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('paths');
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

    $data['Lines'] = $this->Lines_model->getLines();
    $data['Stations'] = $this->Stations_model->getStations();

    $data['PATH_ID']      = ''              ;
    $data['PATH_LINE_ID']    = ''              ;
    $data['PATH_STTN_ID']    = ''              ;
    $data['PATH_INDX']    = ''              ;
    $data['PATH_REL_TIME']    = ''         ;
    $data['LINE_ID']    = $LineID         ;

    $data['formURL']      = 'insertpaths'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addpath', $data);
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
      $this->load->view('pages/paths_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
      $header['OrgArr'] = $this->Master_model->getPagesByType();
    }


    $this->Paths_model->deletePath($pathLineID);

    $pathLineID    =  $this->input->post('pathLineID');
    $pathStations  =  $this->input->post('pathStationID');
    $pathRelTime   =  $this->input->post('pathRelTime');
    $i = 0;
    foreach ($pathStations as $key => $value) {
       $this->Paths_model->insertPath($pathLineID, $i, $pathRelTime[$key], $value);
       $i++;
    }
    $data['pathLineID'] = $pathLineID;
    $this->load->view('pages/paths_redirect', $data);

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('paths');
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

    $data['Path'] = $this->Paths_model->getPath_byLineID($ID);

    $data['Lines']          = $this->Lines_model->getLines();
    $data['Stations']       = $this->Stations_model->getStations();
    $data['PATH_LINE_ID']   = $ID;

    $data['formURL']      = 'editpaths/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addpath', $data);
    $this->load->view('templates/footer');

  }

  public function edit($ID){

    $result = $this->CheckUser2('paths');
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



    $pathLineID    =  $this->input->post('pathLineID');
    $pathStations  =  $this->input->post('pathStationID');
    $pathRelTime   =  $this->input->post('pathRelTime');
    $i = 0;

      $this->Paths_model->deletePath($pathLineID);
    foreach ($pathStations as $key => $value) {
       $this->Paths_model->insertPath($pathLineID, $i, $pathRelTime[$key], $value);
       $i++;
    }
    $data['pathLineID'] = $pathLineID;
    $this->load->view('pages/paths_redirect', $data);


  }


  public function delete($ID){

    $result = $this->CheckUser2('paths');
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

    $this->Paths_model->deletePath($ID);
    $this->load->view('pages/paths_redirect');

  }
}

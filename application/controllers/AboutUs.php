<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AboutUs extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'AboutUs'){
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

    $result = $this->CheckUser2('aboutus');
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


    $data['TableData'] = $this->Aboutus_model->getAboutUs();

    $data['TableHeaders'] = array(
      'ID',
      'Title',
      'Arabic Title',
      'Edit',
      'Delete'
    );

    $data['Table_Name'] = 'AboutUs';
    $data['Url_Name']   = 'aboutus';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/aboutus', $data);
    $this->load->view('templates/footer');

  }

  public function addpage($MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addaboutus');
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


    $data['ABUT_ID']      = ''              ;
    $data['ABUT_TITLE']    = ''              ;
    $data['ABUT_TEXT']    = ''              ;
    $data['ABUT_ARBC_TEXT']    = ''           ;
    $data['ABUT_ARBC_TITLE']    = ''         ;

    $data['formURL']      = 'insertaboutus'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addaboutus', $data);
    $this->load->view('templates/footer');
  }

  public function insert(){

    $result = $this->CheckUser2('addaboutus');
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

    $aboutusTitle = $this->input->post('aboutusTitle');
    $aboutusText = $this->input->post('aboutusText');
    $aboutusArbcTitle = $this->input->post('aboutusArbcTitle');
    $aboutusArbcText = $this->input->post('aboutusArbcText');

    $this->Aboutus_model->insertAboutUs($aboutusTitle, $aboutusText, $aboutusArbcTitle, $aboutusArbcText);

    $this->load->view('pages/aboutus_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addaboutus');
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

    $AboutUs = $this->Aboutus_model->getAboutUs_byID($ID)[0];

    $data['ABUT_ID']      = $AboutUs['ABUT_ID']  ;
    $data['ABUT_TITLE']    = $AboutUs['ABUT_TITLE']  ;
    $data['ABUT_TEXT']    = $AboutUs['ABUT_TEXT']   ;
    $data['ABUT_ARBC_TEXT']    = $AboutUs['ABUT_ARBC_TEXT'] ;
    $data['ABUT_ARBC_TITLE']    = $AboutUs['ABUT_ARBC_TITLE']   ;

    $data['formURL']      = 'editaboutus/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addaboutus', $data);
    $this->load->view('templates/footer');

  }

  public function edit($ID){

    $result = $this->CheckUser2('addaboutus');
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

    $aboutusTitle = $this->input->post('aboutusTitle');
    $aboutusText = $this->input->post('aboutusText');
    $aboutusArbcTitle = $this->input->post('aboutusArbcTitle');
    $aboutusArbcText = $this->input->post('aboutusArbcText');

    $this->Aboutus_model->editAboutUs($ID, $aboutusTitle, $aboutusText, $aboutusArbcTitle, $aboutusArbcText);

    $this->load->view('pages/aboutus_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser2('aboutus/delete');
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

    $this->Aboutus_model->deleteAboutUs($ID);
    $this->load->view('pages/aboutus_redirect');

  }
}

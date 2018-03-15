<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faqs extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Faqs'){
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

    $result = $this->CheckUser2('faqs');
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


    $data['TableData'] = $this->Faqs_model->getFaqs();

    $data['TableHeaders'] = array(
      'ID',
      'Title',
      'Arabic Title',
      'Edit',
      'Delete'
    );

    $data['Table_Name'] = 'Faqs';
    $data['Url_Name']   = 'faqs';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/faqs', $data);
    $this->load->view('templates/footer');

  }

  public function addpage($MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addfaqs');
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


    $data['FAQS_ID']      = ''              ;
    $data['FAQS_TITLE']    = ''              ;
    $data['FAQS_TEXT']    = ''              ;
    $data['FAQS_ARBC_TEXT']    = ''           ;
    $data['FAQS_ARBC_TITLE']    = ''         ;

    $data['formURL']      = 'insertfaqs'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addfaqs', $data);
    $this->load->view('templates/footer');
  }

  public function insert(){

    $result = $this->CheckUser2('addfaqs');
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

    $faqsTitle = $this->input->post('faqsTitle');
    $faqsText = $this->input->post('faqsText');
    $faqsArbcTitle = $this->input->post('faqsArbcTitle');
    $faqsArbcText = $this->input->post('faqsArbcText');

    $this->Faqs_model->insertFaqs($faqsTitle, $faqsText, $faqsArbcTitle, $faqsArbcText);

    $this->load->view('pages/faqs_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addfaqs');
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

    $Faqs = $this->Faqs_model->getFaqs_byID($ID)[0];

    $data['FAQS_ID']      = $Faqs['FAQS_ID']  ;
    $data['FAQS_TITLE']    = $Faqs['FAQS_TITLE']  ;
    $data['FAQS_TEXT']    = $Faqs['FAQS_TEXT']   ;
    $data['FAQS_ARBC_TEXT']    = $Faqs['FAQS_ARBC_TEXT'] ;
    $data['FAQS_ARBC_TITLE']    = $Faqs['FAQS_ARBC_TITLE']   ;

    $data['formURL']      = 'editfaqs/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addfaqs', $data);
    $this->load->view('templates/footer');

  }

  public function edit($ID){

    $result = $this->CheckUser2('addfaqs');
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

    $faqsTitle = $this->input->post('faqsTitle');
    $faqsText = $this->input->post('faqsText');
    $faqsArbcTitle = $this->input->post('faqsArbcTitle');
    $faqsArbcText = $this->input->post('faqsArbcText');

    $this->Faqs_model->editFaqs($ID, $faqsTitle, $faqsText, $faqsArbcTitle, $faqsArbcText);

    $this->load->view('pages/faqs_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser2('faqs/delete');
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

    $this->Faqs_model->deleteFaqs($ID);
    $this->load->view('pages/faqs_redirect');

  }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Articles'){
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
      $this->load->view('pages/articles_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }


    $data['TableData'] = $this->Articles_model->getArticles();

    $data['TableHeaders'] = array(
      'ID',
      'Title',
      'Arabic Title',
      'Edit',
      'Delete'
    );

    $data['Table_Name'] = 'Articles';
    $data['Url_Name']   = 'articles';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/articles', $data);
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
      $this->load->view('pages/articles_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }


    $data['RTCL_ID']      = ''              ;
    $data['RTCL_TITLE']    = ''              ;
    $data['RTCL_TEXT']    = ''              ;
    $data['RTCL_ARBC_TEXT']    = ''           ;
    $data['RTCL_ARBC_TITLE']    = ''         ;

    $data['formURL']      = 'insertarticles'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addarticle', $data);
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
      $this->load->view('pages/articles_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $articleTitle = $this->input->post('articleTitle');
    $articleText = $this->input->post('articleText');
    $articleArbcTitle = $this->input->post('articleArbcTitle');
    $articleArbcText = $this->input->post('articleArbcText');

    $this->Articles_model->insertArticle($articleTitle, $articleText, $articleArbcTitle, $articleArbcText);

    $this->load->view('pages/articles_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser('EDIT');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/articles_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $Article = $this->Articles_model->getArticle_byID($ID)[0];

    $data['Districts'] = $this->Districts_model->getDistricts();

    $data['RTCL_ID']      = $Article['RTCL_ID']  ;
    $data['RTCL_TITLE']    = $Article['RTCL_TITLE']  ;
    $data['RTCL_TEXT']    = $Article['RTCL_TEXT']   ;
    $data['RTCL_ARBC_TEXT']    = $Article['RTCL_ARBC_TEXT'] ;
    $data['RTCL_ARBC_TITLE']    = $Article['RTCL_ARBC_TITLE']   ;

    $data['formURL']      = 'editarticles/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addarticle', $data);
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
      $this->load->view('pages/articles_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $articleName = $this->input->post('articleName');
    $articleText = $this->input->post('articleText');
    $articleArbcTitle = $this->input->post('articleArbcTitle');
    $articleArbcText = $this->input->post('articleArbcText');

    $this->Articles_model->editArticle($ID, $articleName, $articleText, $articleArbcTitle, $articleArbcText);

    $this->load->view('pages/articles_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser('DEL');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/articles_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $this->Articles_model->deleteArticle($ID);
    $this->load->view('pages/articles_redirect');

  }
}

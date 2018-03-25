<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promos extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Promos'){
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
//CHeck at each function if user is permitter or no, if no send him to the home page
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

    $result = $this->CheckUser2('promos');
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


    $data['TableData'] = $this->Promos_model->getPromos();

    $data['TableHeaders'] = array(
      'Code',
      'Expiry Type',
      'Discount',
      'Expiry Date',
      'Expiry Count',
      'Edit',
      'Delete'
    );

    $data['Table_Name'] = 'Promos';
    $data['Url_Name']   = 'promos';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/promos', $data);
    $this->load->view('templates/footer');

  }

  public function addpage($MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addpromos');
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


    $data['PRMO_ID']      = ''              ;
    $data['PRMO_CODE']    = ''              ;
    $data['PRMO_EXPIRE']    = ''              ;
    $data['PRMO_CNT']    = ''              ;
    $data['PRMO_PRCNT']    = ''           ;
    $data['PRMO_TYPE']    = ''         ;

    $data['formURL']      = 'insertpromos'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addpromo', $data);
    $this->load->view('templates/footer');
  }

  public function insert(){

    $result = $this->CheckUser2('addpromos');
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

    $promoCode = $this->input->post('promoCode');
    $promoExpire = $this->input->post('promoExpire');
    $promoType = $this->input->post('promoType');
    $promoPercent = $this->input->post('promoPercent');
    $promoCount = $this->input->post('promoCount');

    $this->Promos_model->insertPromo($promoCode, $promoExpire, $promoPercent, $promoType, $promoCount);

    $this->load->view('pages/promos_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('promos/modify');
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

    $Promo = $this->Promos_model->getPromo_byID($ID)[0];

    $data['Districts'] = $this->Districts_model->getDistricts();

    $data['PRMO_ID']      = $Promo['PRMO_ID']  ;
    $data['PRMO_CODE']    = $Promo['PRMO_CODE']  ;
    $data['PRMO_EXPIRE']    = $Promo['PRMO_EXPIRE']   ;
    $data['Timestamp']    = strtotime($Promo['PRMO_EXPIRE'])   ;
    $data['PRMO_PRCNT']    = $Promo['PRMO_PRCNT'] ;
    $data['PRMO_TYPE']    = $Promo['PRMO_TYPE']   ;
    $data['PRMO_CNT']    = $Promo['PRMO_CNT'] ;

    $data['formURL']      = 'editpromos/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addpromo', $data);
    $this->load->view('templates/footer');

  }

  public function edit($ID){

    $result = $this->CheckUser2('promos/modify');
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

    $promoName = $this->input->post('promoName');
    $promoExpire = $this->input->post('promoExpire');
    $promoType = $this->input->post('promoType');
    $promoPercent = $this->input->post('promoPercent');
    $promoCount = $this->input->post('promoCount');

    $this->Promos_model->editPromo($ID, $promoName, $promoExpire, $promoPercent, $promoType, $promoCount);

    $this->load->view('pages/promos_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser2('promos/delete');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 2){
      // User not permitted
      return;
    }
    else {
      $header['ArrURL'] = $result;
      $header['OrgArr'] = $this->Master_model->getPagesByType();
    }

    $this->Promos_model->deletePromo($ID);
    $this->load->view('pages/promos_redirect');

  }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Balancelogs extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Balancelogs'){
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

    $result = $this->CheckUser2('balancelogs');
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


    $data['TableData'] = $this->Balancelogs_model->getBalancelogs();

    $data['TableHeaders'] = array(
      'ID',
      'Client Name',
      'Change',
      'Date',
      'Comment',
      'Edit',
      'Delete'
    );

    $data['Table_Name'] = 'Balancelogs';
    $data['Url_Name']   = 'balancelogs';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/balancelogs', $data);
    $this->load->view('templates/footer');

  }

  public function addpage($MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addbalancelogs');
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

    $data['BLOG_ID']      = ''              ;
    $data['BLOG_CHNG']    = ''              ;
    $data['BLOG_DATE']    = ''              ;
    $data['BLOG_CMMT']    = ''              ;
    $data['BLOG_CLNT_ID']    = ''              ;

    $data['DropdownDisabled'] = false;

    $data['formURL']      = 'insertbalancelogs'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addbalancelog', $data);
    $this->load->view('templates/footer');
  }

  public function insert(){

    $result = $this->CheckUser2('addbalancelogs');
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

    $balancelogChange = $this->input->post('balancelogChange');
    $balancelogDate = $this->input->post('balancelogDate');
    $balancelogComment = $this->input->post('balancelogComment') . ' - ' . 'Added by ' .  $this->session->userdata['USRNAME'];
    $balancelogClientID = $this->input->post('balancelogClientID');

    $this->Balancelogs_model->insertBalancelog($balancelogChange, $balancelogClientID, $balancelogDate, $balancelogComment);

    $this->load->view('pages/balancelogs_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('addbalancelogs');
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

    $Balancelog = $this->Balancelogs_model->getBalancelog_byID($ID)[0];

    $data['Clients'] = $this->Clients_model->getClients();

    $data['BLOG_ID']      = $Balancelog['BLOG_ID']  ;
    $data['BLOG_CHNG']    = $Balancelog['BLOG_CHNG']  ;
    $data['BLOG_DATE']    = $Balancelog['BLOG_DATE']   ;
    $data['Timestamp']    = strtotime($data['BLOG_DATE']);
    $data['BLOG_CMMT']    = $Balancelog['BLOG_CMMT'] ;
    $data['BLOG_CLNT_ID']    = $Balancelog['BLOG_CLNT_ID'];

    $data['DropdownDisabled'] = true;

    $data['formURL']      = 'editbalancelogs/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addbalancelog', $data);
    $this->load->view('templates/footer');

  }

  public function edit($ID){

    $result = $this->CheckUser2('addbalancelogs');
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

    $balancelogChange = $this->input->post('balancelogChange');
    $balancelogDate = $this->input->post('balancelogDate');
    $balancelogComment = $this->input->post('balancelogComment') . ' - ' . 'Modified by ' .  $this->session->userdata['USRNAME'];
    $balancelogClientID = $this->input->post('balancelogClientID');

    $this->Balancelogs_model->editBalancelog($ID, $balancelogChange, $balancelogClientID, $balancelogDate, $balancelogComment);

    $this->load->view('pages/balancelogs_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser2('balancelogs/delete');
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

    $this->Balancelogs_model->deleteBalancelog($ID);
    $this->load->view('pages/balancelogs_redirect');

  }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Clients'){
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
      $this->load->view('pages/clients_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }


    $data['TableData'] = $this->Clients_model->getClients();

    $data['TableHeaders'] = array(
      'ID',
      'Name',
      'Email',
      'Telephone',
      'City',
      'District',
      'Balance',
      'Edit',
      'Delete'
    );

    $data['Table_Name'] = 'Clients';
    $data['Url_Name']   = 'clients';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/clients', $data);
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
      $this->load->view('pages/clients_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $data['Districts'] = $this->Districts_model->getDistricts();

    $data['CLNT_ID']      = ''              ;
    $data['CLNT_NAME']    = ''              ;
    $data['CLNT_TEL']    = ''              ;
    $data['CLNT_EMAIL']    = ''              ;
    $data['CLNT_IMG']    = ''              ;
    $data['CLNT_PASS']    = ''              ;
    $data['CLNT_BLNC']    = ''              ;
    $data['CLNT_TAG']    = ''              ;
    $data['CLNT_DIST_ID']    = ''              ;

    $data['formURL']      = 'insertclients'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addclient', $data);
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
      $this->load->view('pages/clients_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $clientName = $this->input->post('clientName');
    $clientTel = $this->input->post('clientTel');
    $clientEmail = $this->input->post('clientEmail');
    $clientImg = $this->input->post('clientImg');
    $clientDistID = $this->input->post('clientDistID');
    $clientPass = $this->input->post('clientPass');
    $clientBalance = $this->input->post('clientBalance');
    $clientTag = $this->input->post('clientTag');

    $this->Clients_model->insertClient($clientName, $clientTel, $clientEmail, $clientImg, $clientPass,
                                         $clientBalance, $clientTag, $clientDistID);

    $this->load->view('pages/clients_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser('EDIT');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/clients_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $Client = $this->Clients_model->getClient_byID($ID)[0];

    $data['Districts'] = $this->Districts_model->getDistricts();

    $data['CLNT_ID']      = $Client['CLNT_ID']  ;
    $data['CLNT_NAME']    = $Client['CLNT_NAME']  ;
    $data['CLNT_TEL']    = $Client['CLNT_TEL']   ;
    $data['CLNT_EMAIL']    = $Client['CLNT_EMAIL'] ;
    $data['CLNT_IMG']    = $Client['CLNT_IMG']   ;
    $data['CLNT_PASS']    = ''  ;
    $data['CLNT_BLNC']    = $Client['CLNT_BLNC']  ;
    $data['CLNT_TAG']    = $Client['CLNT_TAG']   ;
    $data['CLNT_DIST_ID']    = $Client['CLNT_DIST_ID'];

    $data['formURL']      = 'editclients/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/addclient', $data);
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
      $this->load->view('pages/clients_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $clientName = $this->input->post('clientName');
    $clientTel = $this->input->post('clientTel');
    $clientEmail = $this->input->post('clientEmail');
    $clientImg = $this->input->post('clientImg');
    $clientDistID = $this->input->post('clientDistID');
    $clientPass = $this->input->post('clientPass');
    $clientBalance = $this->input->post('clientBalance');
    $clientTag = $this->input->post('clientTag');

    $this->Clients_model->editClient($ID, $clientName, $clientTel, $clientEmail, $clientImg,
                                         $clientBalance, $clientTag, $clientDistID);

    if(!is_null($clientPass)){
      $this-Clients_model->changePassbyID($ID, $clientPass);
    }

    $this->load->view('pages/clients_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser('DEL');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/clients_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $this->Clients_model->deleteClient($ID);
    $this->load->view('pages/clients_redirect');

  }
}

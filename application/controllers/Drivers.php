<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drivers extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function CheckUser($Function, $PageName = 'Drivers'){
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

    $result = $this->CheckUser2('drivers');
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


    $data['TableData'] = $this->Drivers_model->getDrivers();

    $data['TableHeaders'] = array(
      'License Number',
      'Name',
      'Driver Type',
      'LicenseNo',
      'Mobile',
      'Address',
      'Balance',
      'Edit',
      'Delete'
    );

    $data['Table_Name'] = 'Drivers';
    $data['Url_Name']   = 'drivers';

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/drivers', $data);
    $this->load->view('templates/footer');

  }

  public function addpage($MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('adddrivers');
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

    $data['Cities'] = $this->Cities_model->getCities();
    $data['Bustypes'] = $this->Bustypes_model->getBustypes();

    $data['DRVR_ID']      = ''              ;
    $data['DRVR_NAME']    = ''              ;
    $data['DRVR_MOB']    = ''              ;
    $data['DRVR_LICENSE_NO']    = ''              ;
    $data['DRVR_IMG']    = ''              ;
    $data['DRVR_PASS']    = ''              ;
    $data['DRVR_BLNC']    = ''              ;
    $data['DRVR_ADRS']    = ''              ;
    $data['DRVR_BSTP_ID']    = ''              ;
    $data['DRVR_UNAME']    = ''              ;

    $data['formURL']      = 'insertdrivers'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/adddriver', $data);
    $this->load->view('templates/footer');
  }

  public function insert(){

    $result = $this->CheckUser2('adddrivers');
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


    $driverImg = '';

    if (!empty($_FILES['driverImg']['name'])) {

      $config['upload_path']          = FCPATH . "uploads\\drivers\\";
      $config['allowed_types'] = 'gif|jpg|png';
      $this->upload->initialize($config);

      if ( ! $this->upload->do_upload('driverImg')){
        $error = $this->upload->display_errors();
        $this->update(   'Invalid File' . $error );
      } else {
          $imgData = $this->upload->data();
          $driverImg = $imgData['file_name'];
      }

    } else {
        $driverImg = $this->input->post('driverOldImg');
    }

    $driverName = $this->input->post('driverName');
    $driverMobile = $this->input->post('driverMobile');
    $driverLicenseNo = $this->input->post('driverLicenseNo');
    $driverPass = $this->input->post('driverPass');
    $driverBalance = $this->input->post('driverBalance');
    $driverAddress = $this->input->post('driverAddress');
    $driverBustype = $this->input->post('driverBustypeID');
    $driverUsername = $this->input->post('driverUsername');

    $this->Drivers_model->insertDriver($driverName, $driverLicenseNo, $driverMobile, $driverBustype, $driverUsername,
                                       $driverImg, $driverPass, $driverBalance, $driverAddress);

    $this->load->view('pages/drivers_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser2('adddrivers');
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

    $Driver = $this->Drivers_model->getDriver_byID($ID)[0];

    $data['Cities'] = $this->Cities_model->getCities();
    $data['Bustypes'] = $this->Bustypes_model->getBustypes();

    $data['DRVR_ID']      = $Driver['DRVR_ID']  ;
    $data['DRVR_NAME']    = $Driver['DRVR_NAME']  ;
    $data['DRVR_MOB']    = $Driver['DRVR_MOB']   ;
    $data['DRVR_LICENSE_NO']    = $Driver['DRVR_LICENSE_NO'] ;
    $data['DRVR_IMG']    = $Driver['DRVR_IMG']   ;
    $data['DRVR_PASS']    = 'Test'  ;
    $data['DRVR_BLNC']    = $Driver['DRVR_BLNC']  ;
    $data['DRVR_BSTP_ID']    = $Driver['DRVR_BSTP_ID']  ;
    $data['DRVR_ADRS']    = $Driver['DRVR_ADRS']   ;
    $data['DRVR_UNAME']    = $Driver['DRVR_UNAME']   ;

    $data['formURL']      = 'editdrivers/' . $ID  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;


    $this->load->view('templates/header', $header);
    $this->load->view('pages/adddriver', $data);
    $this->load->view('templates/footer');

  }

  public function edit($ID){

    $result = $this->CheckUser2('adddrivers');
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


    $driverImg = '';

    if (!empty($_FILES['driverImg']['name'])) {

      $config['upload_path']          = FCPATH . "uploads\\drivers\\";
      $config['allowed_types'] = 'gif|jpg|png';
      $this->upload->initialize($config);

      if ( ! $this->upload->do_upload('driverImg')){
        $error = $this->upload->display_errors();
        $this->update(   'Invalid File' . $error );
      } else {
          $imgData = $this->upload->data();
          $driverImg = $imgData['file_name'];
      }

    } else {
        $driverImg = $this->input->post('driverOldImg');
    }

    $driverName = $this->input->post('driverName');
    $driverMobile = $this->input->post('driverMobile');
    $driverLicenseNo = $this->input->post('driverLicenseNo');
    $driverUsername = $this->input->post('driverUsername');
    $driverPass = $this->input->post('driverPass');
    $driverBalance = $this->input->post('driverBalance');
    $driverAddress = $this->input->post('driverAddress');
    $driverBustype = $this->input->post('driverBustypeID');

    $this->Drivers_model->editDriver($ID, $driverName, $driverUsername, $driverMobile, $driverLicenseNo,$driverBustype,
                                    $driverImg, $driverPass, $driverBalance, $driverAddress);

    $this->load->view('pages/drivers_redirect');

  }

  public function blockActivateDriverPage(){

    $result = $this->CheckUser2('blckactvdrvr');
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

    $data['Active'] = $this->Drivers_model->getActiveDrivers();
    $data['Blocked'] = $this->Drivers_model->getBlockedDrivers();

    $this->load->view('templates/header', $header);
    $this->load->view('controlpages/blockActivateDrivers', $data);
    $this->load->view('templates/footer');

  }

  public function ActivateDriver(){

    $result = $this->CheckUser2('blckactvdrvr');
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

    $driverID = $this->input->post('driverID');
    $this->Drivers_model->activateDriver($driverID);
    $this->load->view('pages/drivers_redirect');

  }

  public function BlockDriver(){

    $result = $this->CheckUser2('blckactvdrvr');
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

    $driverID = $this->input->post('driverID');
    $this->Drivers_model->blockDriver($driverID);
    $this->load->view('pages/drivers_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser2('drivers/delete');
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

    $this->Drivers_model->deleteDriver($ID);
    $this->load->view('pages/drivers_redirect');

  }
}

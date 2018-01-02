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

  public function home($MSGErr = '', $MSGOK = '')
  {

    $result = $this->CheckUser('HOME');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/drivers_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }


    $data['TableData'] = $this->Drivers_model->getDrivers();

    $data['TableHeaders'] = array(
      'ID',
      'Name',
      'LicenseNo',
      'Mobile',
      'Address',
      'Balance',
      'License Number',
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

    $result = $this->CheckUser('ADD');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/drivers_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $data['Cities'] = $this->Cities_model->getCities();

    $data['DRVR_ID']      = ''              ;
    $data['DRVR_NAME']    = ''              ;
    $data['DRVR_MOB']    = ''              ;
    $data['DRVR_LICENSE_NO']    = ''              ;
    $data['DRVR_IMG']    = ''              ;
    $data['DRVR_PASS']    = ''              ;
    $data['DRVR_BLNC']    = ''              ;
    $data['DRVR_ADRS']    = ''              ;
    $data['DRVR_UNAME']    = ''              ;

    $data['formURL']      = 'insertdrivers'  ;

    $data['MSGOK']      = $MSGOK  ;
    $data['MSGErr']     = $MSGErr ;

    $this->load->view('templates/header', $header);
    $this->load->view('pages/adddriver', $data);
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
      $this->load->view('pages/drivers_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
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
    $driverUsername = $this->input->post('driverUsername');

    $this->Drivers_model->insertDriver($driverName, $driverLicenseNo, $driverMobile, $driverUsername, $driverImg, $driverPass,
                                         $driverBalance, $driverAddress);

    $this->load->view('pages/drivers_redirect');

  }


  public function modifypage($ID, $MSGErr = '', $MSGOK = ''){

    $result = $this->CheckUser('EDIT');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/drivers_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $Driver = $this->Drivers_model->getDriver_byID($ID)[0];

    $data['Cities'] = $this->Cities_model->getCities();

    $data['DRVR_ID']      = $Driver['DRVR_ID']  ;
    $data['DRVR_NAME']    = $Driver['DRVR_NAME']  ;
    $data['DRVR_MOB']    = $Driver['DRVR_MOB']   ;
    $data['DRVR_LICENSE_NO']    = $Driver['DRVR_LICENSE_NO'] ;
    $data['DRVR_IMG']    = $Driver['DRVR_IMG']   ;
    $data['DRVR_PASS']    = $Driver['DRVR_PASS']  ;
    $data['DRVR_BLNC']    = $Driver['DRVR_BLNC']  ;
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

    $result = $this->CheckUser('EDIT');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/drivers_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
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

    $this->Drivers_model->editDriver($ID, $driverName, $driverUsername, $driverMobile, $driverLicenseNo, $driverImg, $driverPass,
                                         $driverBalance, $driverAddress);

    $this->load->view('pages/drivers_redirect');

  }


  public function delete($ID){

    $result = $this->CheckUser('DEL');
    if($result == false){
      // User not logged in
      $this->load->view("login_redirect");
      return;
    }else if($result == 1){
      // User not permitted
      $this->load->view('pages/drivers_redirect');
      return;
    }
    else {
      $header['ArrURL'] = $result;
    }

    $this->Drivers_model->deleteDriver($ID);
    $this->load->view('pages/drivers_redirect');

  }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DriverApi extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function login(){

    $driverLicense = $this->input->post('driverLicense');
    $driverPass = $this->input->post('driverPass');

    $validLicense = $this->Drivers_model->isLicenseExist($driverLicense);
    $validdriver = $this->Drivers_model->checkDriverbyLicense($driverLicense, $driverPass);

    if ($validdriver) {
      echo $validdriver;
      return;
    } //log in success

    if(!$validdriver  && $validLicense ) {
      echo 'WrongPass';
      return;
    } //wrong pass, valid mail

    if(!$validdriver  && !$validLicense ) {
      echo 'WrongDriver';
      return;
    } //wrong data


  }

  public function setTag(){

    $driverID = $this->input->post('DriverID');
    $driverTag = $this->input->post('DriverTag');

    echo $this->Drivers_model->setTag($driverID, $driverTag);
    return ;
  }

  public function setTracker(){

    $driverID = $this->input->post('DriverID');
    $driverTracker = $this->input->post('DriverTracker');

    echo $this->Drivers_model->setTracker($driverID, $driverTracker);
    return ;
  }

  public function change_pw(){
    $driverID = $this->input->post('driverID');
    $driverOldPass = $this->input->post('driverOldPass');
    $driverNewPass = $this->input->post('driverNewPass');

    $validuser = $this->Drivers_model->checkDriverbyID($driverID, $driverOldPass);

    if($validuser){
    echo $this->Drivers_model->changePassbyID($driverID, $driverNewPass);

    }
    else echo "WrongPass ";

  }

}

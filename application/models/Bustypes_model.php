<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bustypes_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getBustypes(){

    $strSQL = "SELECT BSTP_ID, BSTP_NAME, BSTP_ARBC_NAME
                FROM Bustypes";
    $query = $this->db->query($strSQL);
    return $query->result_array();

  }

  public function getBustype_byID($ID){

    $strSQL = "SELECT BSTP_ID, BSTP_NAME, BSTP_ARBC_NAME
              FROM Bustypes WHERE BSTP_ID = {$ID}";
    $query = $this->db->query($strSQL);
    return $query->result_array();

  }


  public function insertBustype($Name, $ArbcName){

    $strSQL = "INSERT INTO `Bustypes` (`BSTP_NAME`, `BSTP_ARBC_NAME`)
               VALUES (?, ?)";
    $inputs = array ($Name, $ArbcName);
    $query = $this->db->query($strSQL, $inputs);

  }

  public function editBustype($ID, $Name, $ArbcName){

    $strSQL = "UPDATE `Bustypes`
              SET `BSTP_NAME`     = ?,
                  `BSTP_ARBC_NAME`= ? WHERE
                  `BSTP_ID`= ? ";

    $query = $this->db->query($strSQL, array ($Name, $ArbcName, $ID));

  }

  public function deleteBustype($ID){
    $strSQL = "DELETE FROM Bustypes WHERE BSTP_ID = {$ID}";
    $query = $this->db->query($strSQL);
  }

}

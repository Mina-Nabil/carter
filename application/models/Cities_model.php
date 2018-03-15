<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cities_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getCities(){

    $strSQL = "SELECT CITY_ID, CITY_NAME, CITY_ARBC_NAME
                FROM Cities";
    $query = $this->db->query($strSQL);
    return $query->result_array();

  }

  public function getCity_byID($ID){

    $strSQL = "SELECT CITY_ID, CITY_NAME, CITY_ARBC_NAME
              FROM Cities WHERE CITY_ID = {$ID}";
    $query = $this->db->query($strSQL);
    return $query->result_array();

  }


  public function insertCity($Name, $ArbcName){

    $strSQL = "INSERT INTO `Cities` (`CITY_NAME`, `CITY_ARBC_NAME`)
               VALUES (?, ?)";
    $inputs = array ($Name, $ArbcName);
    $query = $this->db->query($strSQL, $inputs);

  }

  public function editCity($ID, $Name, $ArbcName){

    $strSQL = "UPDATE `Cities`
              SET `CITY_NAME`     = ?, 
                  `CITY_ARBC_NAME`= ? WHERE
                  `CITY_ID`= ? ";

    $query = $this->db->query($strSQL, array ($Name, $ArbcName, $ID));

  }

  public function deleteCity($ID){
    $strSQL = "DELETE FROM Cities WHERE CITY_ID = {$ID}";
    $query = $this->db->query($strSQL);
  }

}

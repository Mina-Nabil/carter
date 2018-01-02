<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cities_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getCities(){

    $strSQL = "SELECT CITY_ID, CITY_NAME
                FROM Cities";
    $query = $this->db->query($strSQL);
    return $query->result_array();

  }

  public function getCity_byID($ID){

    $strSQL = "SELECT CITY_ID, CITY_NAME
              FROM Cities WHERE CITY_ID = {$ID}";
    $query = $this->db->query($strSQL);
    return $query->result_array();

  }


  public function insertCity($Name){

    $strSQL = "INSERT INTO `Cities` (`CITY_NAME`)
               VALUES ('{$Name}')";
    $query = $this->db->query($strSQL);

  }

  public function editCity($ID, $Name){

    $strSQL = "UPDATE `Cities`
              SET `CITY_NAME`='{$Name}' WHERE
                  `CITY_ID`='{$ID}'";
    $query = $this->db->query($strSQL);

  }

  public function deleteCity($ID){
    $strSQL = "DELETE FROM Cities WHERE CITY_ID = {$ID}";
    $query = $this->db->query($strSQL);
  }

}

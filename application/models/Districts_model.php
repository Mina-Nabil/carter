<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Districts_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getDistricts(){

          $strSQL = "SELECT DIST_ID, DIST_NAME, DIST_CITY_ID, CITY_NAME, DIST_ARBC_NAME
                      FROM districts, cities WHERE DIST_CITY_ID = CITY_ID";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getDistrictsOnly(){

          $strSQL = "SELECT DIST_ID, DIST_NAME, DIST_CITY_ID, CITY_NAME, DIST_ARBC_NAME
                      FROM districts, cities WHERE DIST_CITY_ID = CITY_ID";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getDistrict_byID($ID){

          $strSQL = "SELECT DIST_ID, DIST_NAME, DIST_CITY_ID, CITY_NAME, DIST_ARBC_NAME
                    FROM Districts, cities WHERE DIST_CITY_ID = CITY_ID AND DIST_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getDistrict_byCityID($ID){

          $strSQL = "SELECT DIST_ID, DIST_NAME, DIST_CITY_ID, CITY_NAME, DIST_ARBC_NAME
                    FROM Districts, cities WHERE DIST_CITY_ID = CITY_ID AND DIST_CITY_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertDistrict($Name, $ArbcName, $CityID){

          $strSQL = "INSERT INTO Districts (DIST_NAME, DIST_ARBC_NAME, DIST_CITY_ID)
                     VALUES (?, ?, ?)";

          $query = $this->db->query($strSQL, array($Name, $ArbcName, $CityID));

        }

        public function editDistrict($ID, $Name, $ArbcName, $CityID){

          $strSQL = "UPDATE Districts
                    SET DIST_NAME =  ? ,
                        DIST_ARBC_NAME = ? ,
                        DIST_CITY_ID = ?
                   WHERE
                        `DIST_ID`= ? ";
          $query = $this->db->query($strSQL, array($Name, $ArbcName, $CityID, $ID));

        }

        public function deleteDistrict($ID){
          $strSQL = "DELETE FROM Districts WHERE DIST_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

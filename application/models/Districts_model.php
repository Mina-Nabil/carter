<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Districts_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getDistricts(){

          $strSQL = "SELECT DIST_ID, DIST_NAME, DIST_CITY_ID, CITY_NAME
                      FROM districts, cities WHERE DIST_CITY_ID = CITY_ID";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getDistrictsOnly(){

          $strSQL = "SELECT DIST_ID, DIST_NAME, DIST_CITY_ID
                      FROM districts ";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getDistrict_byID($ID){

          $strSQL = "SELECT DIST_ID, DIST_NAME, DIST_CITY_ID, CITY_NAME
                    FROM Districts, cities WHERE DIST_CITY_ID = CITY_ID AND DIST_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getDistrict_byCityID($ID){

          $strSQL = "SELECT DIST_ID, DIST_NAME, DIST_CITY_ID, CITY_NAME
                    FROM Districts, cities WHERE DIST_CITY_ID = CITY_ID AND DIST_CITY_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertDistrict($Name, $CityID){

          $strSQL = "INSERT INTO Districts (DIST_NAME, DIST_CITY_ID)
                     VALUES ('{$Name}', '{$CityID}')";
          $query = $this->db->query($strSQL);

        }

        public function editDistrict($ID, $Name, $CityID){

          $strSQL = "UPDATE Districts
                    SET DIST_NAME = '{$Name}',
                        DIST_CITY_ID ='{$CityID}'
                    WHERE
                        `DIST_ID`='{$ID}'";
          $query = $this->db->query($strSQL);

        }

        public function deleteDistrict($ID){
          $strSQL = "DELETE FROM Districts WHERE DIST_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

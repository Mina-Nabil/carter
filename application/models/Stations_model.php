<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stations_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getStations(){

          $strSQL = "SELECT STTN_ID, STTN_NAME, STTN_DIST_ID, DIST_NAME, STTN_LATT, STTN_LONG, STTN_ARBC_ADRS, STTN_ADRS, STTN_ARBC_NAME
                      FROM Stations, districts WHERE STTN_DIST_ID = DIST_ID";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getStation_byID($ID){

          $strSQL = "SELECT STTN_ID, STTN_NAME, STTN_DIST_ID, DIST_NAME, STTN_LATT, STTN_LONG, STTN_ARBC_ADRS, STTN_ADRS, STTN_ARBC_NAME
                    FROM Stations, districts WHERE STTN_DIST_ID = DIST_ID AND STTN_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertStation($Name, $DistrictID, $Latitude, $Longitude, $ArbcAdrs, $Adrs, $ArbcName){
            //NN Latitude Longitude Name DistrictID
          $strSQL = "INSERT INTO Stations (STTN_NAME, STTN_DIST_ID, STTN_LATT, STTN_LONG, STTN_ARBC_ADRS, STTN_ADRS, STTN_ARBC_NAME)
                     VALUES (?, ?, ?, ?, ?, ?, ?)";

          $inputs = array($Name, $DistrictID, $Latitude, $Longitude, $ArbcAdrs, $Adrs, $ArbcName);
          $query = $this->db->query($strSQL, $inputs);

        }

        public function editStation($ID, $Name, $DistrictID, $Latitude, $Longitude, $ArbcAdrs, $Adrs, $ArbcName){
            //NN Latitude Longitude Name DistrictID
          $strSQL = "UPDATE Stations
                    SET STTN_NAME   =  ?,
                        STTN_LONG  =  ?,
                        STTN_LATT    =  ?,
                        STTN_ARBC_ADRS   =  ?,
                        STTN_ARBC_NAME   =  ?,
                        STTN_ADRS   =  ?,
                        STTN_DIST_ID = ?
                    WHERE
                        `STTN_ID`='{$ID}'";

          $inputs = array($Name, $Longitude, $Latitude, $ArbcAdrs, $ArbcName, $Adrs, $DistrictID);
          $query = $this->db->query($strSQL, $inputs);

        }

        public function deleteStation($ID){
          $strSQL = "DELETE FROM Stations WHERE STTN_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

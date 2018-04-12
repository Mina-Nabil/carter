<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Driverpackages_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getDriverpackages(){

          $strSQL = "SELECT DPKG_ID, DPKG_TRIPS, DPKG_PRICE, DPKG_NAME
                      FROM Driverpackages";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getDriverpackage_byID($ID){

          $strSQL = "SELECT DPKG_ID, DPKG_TRIPS, DPKG_PRICE, DPKG_NAME
                    FROM Driverpackages
                    WHERE DPKG_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertDriverpackage($Name, $TripsNumber, $Price){
            //NN Number Longitude Name TripsNumber
          $strSQL = "INSERT INTO Driverpackages (DPKG_NAME, DPKG_TRIPS, DPKG_PRICE)
                     VALUES (?, ?, ?, ?)";
          $query = $this->db->query($strSQL, array($Name, $TripsNumber, $Price));

        }

        public function editDriverpackage($ID, $Name, $TripsNumber, $Price){
            //NN Number Longitude Name TripsNumber
          $strSQL = "UPDATE Driverpackages
                    SET DPKG_NAME   = ?,
                        DPKG_TRIPS =?,
                        DPKG_PRICE    = ?
                    WHERE
                        `DPKG_ID`=?";
          $query = $this->db->query($strSQL, array($Name, $TripsNumber, $Price, $ID));

        }

        public function deleteDriverpackage($ID){
          $strSQL = "DELETE FROM Driverpackages WHERE DPKG_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

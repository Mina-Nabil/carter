<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buses_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getBuses(){

          $strSQL = "SELECT BUS_ID, BUS_DRVR_ID, DRVR_NAME, BUS_NUMBER, BUS_SEATS, BUS_BSTP_ID, BSTP_NAME, BSTP_ARBC_NAME, BUS_CHAR
                      FROM Buses, drivers, bustypes WHERE BUS_DRVR_ID = DRVR_ID AND BUS_BSTP_ID = BSTP_ID";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getBus_byID($ID){

          $strSQL = "SELECT BUS_ID, BUS_DRVR_ID, BUS_NUMBER, BUS_SEATS, BUS_BSTP_ID, BSTP_NAME, BSTP_ARBC_NAME, BUS_CHAR
                    FROM Buses, drivers, bustypes WHERE BUS_DRVR_ID = DRVR_ID AND BUS_BSTP_ID = BSTP_ID AND BUS_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertBus($Type, $DriverID, $Number, $seatsNo, $Char){
            //NN Number Longitude Type DriverID
          $strSQL = "INSERT INTO Buses (BUS_BSTP_ID, BUS_DRVR_ID, BUS_NUMBER, BUS_SEATS, BUS_CHAR)
                     VALUES (?, ?, ?, ?)";
          $query = $this->db->query($strSQL, array($Type, $DriverID, $Number, $seatsNo, $Char));

        }

        public function editBus($ID, $Type, $DriverID, $Number, $seatsNo, $Char){
            //NN Number Longitude Type DriverID
          $strSQL = "UPDATE Buses
                    SET BUS_BSTP_ID   = ?,
                        BUS_NUMBER    = ?,
                        BUS_SEATS   = ?,
                        BUS_DRVR_ID =?,
                        BUS_CHAR   = ?
                    WHERE
                        `BUS_ID`=?";
          $query = $this->db->query($strSQL, array($Type, $DriverID, $Number, $seatsNo, $Char, $ID));

        }

        public function deleteBus($ID){
          $strSQL = "DELETE FROM Buses WHERE BUS_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

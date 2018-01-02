<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buses_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getBuses(){

          $strSQL = "SELECT BUS_ID, BUS_TYPE, BUS_DRVR_ID, DRVR_NAME, BUS_NUMBER, BUS_SEATS
                      FROM Buses, drivers WHERE BUS_DRVR_ID = DRVR_ID";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getBus_byID($ID){

          $strSQL = "SELECT BUS_ID, BUS_TYPE, BUS_DRVR_ID, BUS_NUMBER, BUS_SEATS
                    FROM Buses, drivers WHERE BUS_DRVR_ID = DRVR_ID AND BUS_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertBus($Type, $DriverID, $Number, $seatsNo){
            //NN Number Longitude Type DriverID
          $strSQL = "INSERT INTO Buses (BUS_TYPE, BUS_DRVR_ID, BUS_NUMBER, BUS_SEATS)
                     VALUES ('{$Type}', '{$DriverID}', '{$Number}', '{$seatsNo}')";
          $query = $this->db->query($strSQL);

        }

        public function editBus($ID, $Type, $DriverID, $Number, $seatsNo){
            //NN Number Longitude Type DriverID
          $strSQL = "UPDATE Buses
                    SET BUS_TYPE   = '{$Type}',
                        BUS_NUMBER    = '{$Number}',
                        BUS_SEATS   = '{$seatsNo}',
                        BUS_DRVR_ID ='{$DriverID}'
                    WHERE
                        `BUS_ID`='{$ID}'";
          $query = $this->db->query($strSQL);

        }

        public function deleteBus($ID){
          $strSQL = "DELETE FROM Buses WHERE BUS_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

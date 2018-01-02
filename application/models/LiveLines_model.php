<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LiveLines_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getLiveLines(){

          $strSQL = "SELECT LVLN_ID, LVLN_LINE_ID, LVLN_DRVR_ID, LINE_NAME, LVLN_TIME, LVLN_BUS_ID, LVLN_CANC,
                            LVLN_COMP, LVLN_REVN, BUS_NUMBER, BUS_TYPE, DRVR_NAME
                      FROM live_lines, karter.lines, drivers, buses
                      WHERE LVLN_LINE_ID = LINE_ID
                      AND LVLN_DRVR_ID = DRVR_ID
                      AND LVLN_BUS_ID = BUS_ID  ";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getLiveLine_byID($ID){

          $strSQL = "SELECT LVLN_ID, LVLN_LINE_ID, LVLN_DRVR_ID, LINE_NAME, LVLN_TIME, LVLN_BUS_ID, LVLN_CANC, LVLN_COMP, LVLN_REVN,
                            BUS_NUMBER, BUS_TYPE, DRVR_NAME
                    FROM live_lines, karter.lines, drivers, buses
                    WHERE LVLN_LINE_ID = LINE_ID
                    AND LVLN_DRVR_ID = DRVR_ID
                    AND LVLN_BUS_ID = BUS_ID AND LVLN_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertLiveLine($LineID, $DriverID, $Time, $BusID, $isCancelled, $isCompleted, $Revn){
            //NN Time BusID Name LineID
          $strSQL = "INSERT INTO live_lines (LVLN_LINE_ID, LVLN_DRVR_ID, LVLN_TIME, LVLN_BUS_ID, LVLN_CANC, LVLN_COMP, LVLN_REVN)
                     VALUES (?, ?, ?, ?, ?, ?, ?)";

          $inputs = array($LineID, $DriverID, $Time, $BusID, $isCancelled, $isCompleted, $Revn);
          $query = $this->db->query($strSQL, $inputs);

        }

        public function editLiveLine($ID, $LineID, $DriverID, $Time, $BusID, $isCancelled, $isCompleted, $Revn){
            //NN Time BusID Name LineID
          $strSQL = "UPDATE live_lines
                    SET LVLN_LINE_ID   = ?, LVLN_DRVR_ID  = ?, LVLN_TIME = ?, LVLN_BUS_ID  = ?,
                        LVLN_CANC   = ?, LVLN_COMP   = ?, LVLN_REVN = ?
                    WHERE  `LVLN_ID`=?";

          $inputs = array($LineID, $DriverID, $Time, $BusID, $isCancelled, $isCompleted, $Revn, $ID);
          $query = $this->db->query($strSQL, $inputs);
          
        }

        public function deleteLiveLine($ID){
          $strSQL = "DELETE FROM live_lines WHERE LVLN_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

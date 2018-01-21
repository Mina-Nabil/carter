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

        public function getAvailableLines($LineID, $StartSttn, $EndSttn){
          $strSQL = "SELECT LVLN_ID, LVLN_TIME, LVLN_LINE_ID as LineID, PATH_REL_TIME, PATH_INDX, STTN_NAME
                     FROM live_lines, karter.lines, paths, stations
                     WHERE LVLN_LINE_ID = {$LineID}
                     AND LVLN_TIME > NOW()
                     AND LVLN_CANC = 0
                     AND LVLN_LINE_ID = LINE_ID
                     AND PATH_STTN_ID = STTN_NAME
                     AND LINE_ID = PATH_ID
                     AND PATH_INDX >= (SELECT PATH_INDX FROM paths WHERE PATH_LINE_ID = {$LineID} AND PATH_STTN_ID = {$StartSttn})
                     AND PATH_INDX <= (SELECT PATH_INDX FROM paths WHERE PATH_LINE_ID = {$LineID} AND PATH_STTN_ID = {$EndSttn})
                     AND LVLN_COMP = 0
                     ORDER BY LineID ASC, PATH_INDX ASC";

          $query = $this->db->query($strSQL);
          $livelines = $query->result_array();
          print_r($livelines);
          $adjustedArray = array();
          foreach ($livelines as $row) {

            if(isset($adjustedArray[$row['LVLN_ID']])){
              array_push($adjustedArray[$row['LVLN_ID']]['Lines'], array('Index' => $row['PATH_INDX'],
                                                                    'Sttn' => $row['STTN_NAME'],
                                                                    'MinutesFromStart'=>['PATH_REL_TIME']));
            }
            else {

            $obj = array(
              'LiveLineID' => $row['LVLN_ID'],
              'StartTime' => $row['LVLN_TIME'],
              'Lines' => array ('Index' => $row['PATH_INDX'],'Sttn' => $row['STTN_NAME'], 'MinutesFromStart'=>['PATH_REL_TIME']),
            );
            $adjustedArray[$row['LVLN_ID']] = $obj;
          }
        }

        return $adjustedArray;





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

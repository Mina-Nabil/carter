<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Linerequests_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getLinerequests(){

          $strSQL = "SELECT LNRQ_ID, LNRQ_SEATS, LNRQ_TWO_WAYS, LNRQ_CLNT_ID, CLNT_NAME, LNRQ_BACK_TIME,
                            LNRQ_START_TIME, LNRQ_NOTES, LNRQ_START_STTN, LNRQ_END_STTN
                      FROM Linerequests, clients
                      WHERE LNRQ_CLNT_ID = CLNT_ID
                      ORDER BY LNRQ_ID";
          $query = $this->db->query($strSQL);
          $res =  $query->result_array();

          return $res;

        }

        public function getLinerequest_byID($ID){

          $strSQL = "SELECT LNRQ_ID, LNRQ_SEATS, LNRQ_TWO_WAYS, LNRQ_CLNT_ID, CLNT_NAME, LNRQ_BACK_TIME,
                            LNRQ_START_TIME, LNRQ_NOTES, LNRQ_START_STTN, LNRQ_END_STTN
                      FROM Linerequests, clients
                      WHERE LNRQ_CLNT_ID = CLNT_ID
                      AND   LNRQ_ID = {$ID}
                      ORDER BY LNRQ_ID";
          $query = $this->db->query($strSQL);
          $res =  $query->result_array();

          return $res;


        }


        public function insertLinerequest($Seats, $isTwoWays, $ClientID, $BackTime = null, $StartTime, $Notes, $StartStationID, $EndStationID){


          $strSQL = "INSERT INTO Linerequests (LNRQ_SEATS, LNRQ_TWO_WAYS, LNRQ_CLNT_ID, LNRQ_BACK_TIME,
                            LNRQ_START_TIME, LNRQ_NOTES, LNRQ_START_STTN, LNRQ_END_STTN)
                     VALUES (?,?,?,?,?,?,?,?)";
          $inputs = array($Seats, $isTwoWays, $ClientID, $BackTime, $StartTime, $Notes, $StartStationID, $EndStationID);
          $query = $this->db->query($strSQL, $inputs);
          return $query;
        }

        public function editLinerequest($ID, $Seats, $isTwoWays, $ClientID, $BackTime = null, $StartTime, $Notes, $StartStationID, $EndStationID){
            //NN Text ArabicTitle Title DistrictID
          $strSQL = "UPDATE Linerequests
                    SET LNRQ_SEATS      = ?,
                        LNRQ_TWO_WAYS   = ?,
                        LNRQ_CLNT_ID    = ?,
                        LNRQ_BACK_TIME  = ?,
                        LNRQ_START_TIME = ?,
                        LNRQ_NOTES      = ?,
                        LNRQ_START_STTN = ?,
                        LNRQ_END_STTN   = ?,
                    WHERE
                        `LNRQ_ID`= ?";

          $inputs = array($Seats, $isTwoWays, $ClientID, $BackTime, $StartTime, $Notes, $StartStationID, $EndStationID, $ID);
          $query = $this->db->query($strSQL);
          return $query;

        }

        public function deleteLinerequest($ID){
          $strSQL = "DELETE FROM Linerequests WHERE LNRQ_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

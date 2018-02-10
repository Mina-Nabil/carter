<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pushlogs_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getPushlogs(){

          $strSQL = "SELECT PSHL_ID, PSHL_TITLE, PSHL_TEXT, PSHL_USR_ID, PSHL_TARGET, USR_NAME, CLNT_TEL, CLNT_NAME
                      FROM Pushlogs, clients, users
                      WHERE PSHL_USR_ID = USR_ID AND PSHL_CLNT_ID = CLNT_ID";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getPushlogsByType($Type){

          if($Type == 3){
            $strSQL = "SELECT PSHL_ID, PSHL_TITLE, PSHL_TEXT, PSHL_USR_ID, PSHL_TARGET, USR_NAME, CLNT_TEL, CLNT_NAME
                        FROM Pushlogs, clients, users
                        WHERE PSHL_USR_ID = USR_ID AND PSHL_CLNT_ID = CLNT_ID AND PSHL_TARGET = {$Type}";
          }else {

          $strSQL = "SELECT PSHL_ID, PSHL_TITLE, PSHL_TEXT, PSHL_USR_ID, PSHL_TARGET, USR_NAME
                      FROM Pushlogs, users
                      WHERE PSHL_USR_ID = USR_ID AND PSHL_TARGET = {$Type}";
          }

          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getPushlogsByClientIDs($ClientIDs){

          $strSQL = "SELECT PSHL_ID, PSHL_TITLE, PSHL_TEXT, PSHL_USR_ID, PSHL_TARGET
                      FROM Pushlogs, clients, users
                      WHERE PSHL_USR_ID = USR_ID AND PSHL_CLNT_ID = CLNT_ID
                      AND PSHL_CLNT_ID IN ?";
          $query = $this->db->query($strSQL, array($ClientIDs));
          return $query->result_array();

        }

        public function getSpecificPushlogs($ClientID){

          $strSQL = "SELECT PSHL_ID, PSHL_TITLE, PSHL_TEXT, PSHL_USR_ID, PSHL_TARGET
                      FROM Pushlogs, clients, users
                      WHERE PSHL_USR_ID = USR_ID AND PSHL_CLNT_ID = CLNT_ID
                      AND PSHL_CLNT_ID = ?";
          $query = $this->db->query($strSQL, array($ClientID));
          return $query->result_array();

        }
// TYPE 1 => ALL USERS / TYPE 2 => TopUsers /Type 3 => Specific Users
        public function getPushlogCount_byType($Type){

          $strSQL = "SELECT COUNT(*) AS TT
                    FROM Pushlogs WHERE PSHL_TARGET = {$Type}";
          $query = $this->db->query($strSQL);
          return $query->result_array()[0]['TT'];

        }


        public function getPushlog_byID($ID){

          $strSQL = "SELECT PSHL_ID, PSHL_TITLE, PSHL_TEXT, PSHL_USR_ID, PSHL_TARGET
                    FROM Pushlogs WHERE PSHL_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertPushlog($Title, $Text, $UserID, $Target, $ClientID){
            //NN Text ArabicTitle Title DistrictID
            if(is_null($ClientID))
          $strSQL = "INSERT INTO Pushlogs (PSHL_TITLE, PSHL_TEXT, PSHL_USR_ID, PSHL_TARGET, PSHL_CLNT_ID)
                     VALUES (?,?,?,?,?)";
          else {
            $strSQL = "INSERT INTO Pushlogs (PSHL_TITLE, PSHL_TEXT, PSHL_USR_ID, PSHL_TARGET)
                       VALUES (?,?,?,?)";
          }
          $query = $this->db->query($strSQL, array($Title, $Text, $UserID, $Target, $ClientID));

        }

        public function editPushlog($ID, $Title, $Text, $UserID, $Target, $ClientID){
            //NN Text ArabicTitle Title DistrictID
          $strSQL = "UPDATE Pushlogs
                    SET PSHL_TITLE   = ?,
                        PSHL_TEXT    = ?,
                        PSHL_USR_ID  = ?,
                        PSHL_TARGET   = ?,
                        PSHL_CLNT_ID   = ?
                    WHERE
                        `PSHL_ID`=?";
          $query = $this->db->query($strSQL, array($Title, $Text, $UserID, $Target, $ClientID, $ID));

        }

        public function deletePushlog($ID){
          $strSQL = "DELETE FROM Pushlogs WHERE PSHL_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

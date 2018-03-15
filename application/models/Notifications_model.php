<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getNotifications(){

          $strSQL = "SELECT NOTF_ID, NOTF_TITLE, NOTF_TEXT, NOTF_ARBC_TITLE, NOTF_ARBC_TEXT, NOTF_IMG, NOTF_FROM, NOTF_TO
                      FROM Notifications";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getAppNotifications(){

          $strSQL = "SELECT NOTF_ID, NOTF_TITLE, NOTF_TEXT, NOTF_ARBC_TITLE, NOTF_ARBC_TEXT, NOTF_IMG, NOTF_FROM, NOTF_TO
                      FROM Notifications WHERE NOW() > NOTF_FROM AND NOW() < NOTF_TO";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getNotification_byID($ID){

          $strSQL = "SELECT NOTF_ID, NOTF_TITLE, NOTF_TEXT, NOTF_ARBC_TITLE, NOTF_ARBC_TEXT, NOTF_IMG, NOTF_FROM, NOTF_TO
                    FROM Notifications WHERE NOTF_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertNotification($Title, $Text, $ArabicTitle, $ArbcText, $Image, $From, $To){
            //NN Text ArabicTitle Title DistrictID
          $strSQL = "INSERT INTO Notifications (NOTF_TITLE, NOTF_TEXT, NOTF_ARBC_TITLE, NOTF_ARBC_TEXT, NOTF_IMG, NOTF_FROM, NOTF_TO)
                     VALUES (?,?,?,?,?,?,?)";
          $query = $this->db->query($strSQL, array($Title, $Text, $ArabicTitle, $ArbcText, $Image, $From, $To));

        }

        public function editNotification($ID, $Title, $Text, $ArabicTitle, $ArbcText, $Image, $From, $To){
            //NN Text ArabicTitle Title DistrictID
          $strSQL = "UPDATE Notifications
                    SET NOTF_TITLE   = ?,
                        NOTF_TEXT    = ?,
                        NOTF_ARBC_TITLE  = ?,
                        NOTF_ARBC_TEXT   = ?,
                        NOTF_IMG   = ?,
                        NOTF_FROM   = ?,
                        NOTF_TO   = ?
                    WHERE
                        `NOTF_ID`= ? ";

          $query = $this->db->query($strSQL, array($Title, $Text, $ArabicTitle, $ArbcText, $Image, $From, $To, $ID));

        }

        public function deleteNotification($ID){
          $strSQL = "DELETE FROM Notifications WHERE NOTF_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

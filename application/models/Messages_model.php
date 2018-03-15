<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getMessages(){

          $strSQL = "SELECT MSGS_ID, MSGS_TITLE, MSGS_TEXT, MSGS_CLNT_ID, CLNT_NAME
                      FROM Messages, clients
                      WHERE MSGS_CLNT_ID = CLNT_ID";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getMessage_byID($ID){

          $strSQL = "SELECT MSGS_ID, MSGS_TITLE, MSGS_TEXT, MSGS_CLNT_ID, CLNT_NAME
          FROM Messages, clients
          WHERE MSGS_CLNT_ID = CLNT_ID AND MSGS_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getMessages_byClient($ID){

          $strSQL = "SELECT MSGS_ID, MSGS_TITLE, MSGS_TEXT, MSGS_CLNT_ID, CLNT_NAME
          FROM Messages, clients
          WHERE MSGS_CLNT_ID = CLNT_ID AND MSGS_CLNT_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertMessage($Title, $Text, $ClientID){
            //NN Text ArabicTitle Title DistrictID
          $strSQL = "INSERT INTO Messages (MSGS_TITLE, MSGS_TEXT, MSGS_CLNT_ID)
                     VALUES (?, ?, ?)";
          $query = $this->db->query($strSQL, array($Title, $Text, $ClientID));
          return $query;
        }

        public function editMessage($ID, $Title, $Text, $ClientID){
            //NN Text ArabicTitle Title DistrictID
          $strSQL = "UPDATE Messages
                    SET MSGS_TITLE   = ?,
                        MSGS_TEXT    = ?,
                        MSGS_CLNT_ID   = ?
                    WHERE
                        `MSGS_ID`= ?";
          $query = $this->db->query($strSQL, array($Title, $Text, $ClientID, $ID));

        }

        public function deleteMessage($ID){
          $strSQL = "DELETE FROM Messages WHERE MSGS_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

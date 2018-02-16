<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faqs_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getFaqs(){

          $strSQL = "SELECT FAQS_ID, FAQS_TITLE, FAQS_TEXT, FAQS_ARBC_TITLE, FAQS_ARBC_TEXT
                      FROM Faqs";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getFaqs_byID($ID){

          $strSQL = "SELECT FAQS_ID, FAQS_TITLE, FAQS_TEXT, FAQS_ARBC_TITLE, FAQS_ARBC_TEXT
                    FROM Faqs WHERE FAQS_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertFaqs($Title, $Text, $ArabicTitle, $ArbcText){
            //NN Text ArabicTitle Title DistrictID
          $strSQL = "INSERT INTO Faqs (FAQS_TITLE, FAQS_TEXT, FAQS_ARBC_TITLE, FAQS_ARBC_TEXT)
                     VALUES (?, ?, ?, ?)";

          $inputs = array($Title, $Text, $ArabicTitle, $ArbcText);
          $query = $this->db->query($strSQL, $inputs);

        }

        public function editFaqs($ID, $Title, $Text, $ArabicTitle, $ArbcText){
            //NN Text ArabicTitle Title DistrictID
          $strSQL = "UPDATE Faqs
                    SET FAQS_TITLE = ?,
                        FAQS_TEXT = ?,
                        FAQS_ARBC_TITLE = ?,
                        FAQS_ARBC_TEXT = ?
                    WHERE
                        `FAQS_ID`= ? ";

          $inputs = array($Title, $Text, $ArabicTitle, $ArbcText, $ID);
          $query = $this->db->query($strSQL, $inputs);

        }

        public function deleteFaqs($ID){
          $strSQL = "DELETE FROM Faqs WHERE FAQS_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

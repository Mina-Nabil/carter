<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aboutus_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getAboutUs(){

          $strSQL = "SELECT ABUT_ID, ABUT_TITLE, ABUT_TEXT, ABUT_ARBC_TITLE, ABUT_ARBC_TEXT
                      FROM Aboutus";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getAboutUs_byID($ID){

          $strSQL = "SELECT ABUT_ID, ABUT_TITLE, ABUT_TEXT, ABUT_ARBC_TITLE, ABUT_ARBC_TEXT
                    FROM Aboutus WHERE ABUT_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertAboutUs($Title, $Text, $ArabicTitle, $Arbctext){
            //NN Text ArabicTitle Title DistrictID
          $strSQL = "INSERT INTO Aboutus (ABUT_TITLE, ABUT_TEXT, ABUT_ARBC_TITLE, ABUT_ARBC_TEXT)
                     VALUES (?, ?, ?, ?)";

          $inputs = array($Title, $Text, $ArabicTitle, $Arbctext);
          $query = $this->db->query($strSQL, $inputs);

        }

        public function editAboutUs($ID, $Title, $Text, $ArabicTitle, $Arbctext){
            //NN Text ArabicTitle Title DistrictID
          $strSQL = "UPDATE Aboutus
                    SET ABUT_TITLE   = ?,
                        ABUT_TEXT    = ?,
                        ABUT_ARBC_TITLE  = ?,
                        ABUT_ARBC_TEXT   = ?
                    WHERE
                        `ABUT_ID`= ?";
          $inputs = array($Title, $Text, $ArabicTitle, $Arbctext, $ID);
          $query = $this->db->query($strSQL, $inputs);

        }

        public function deleteAboutUs($ID){
          $strSQL = "DELETE FROM Aboutus WHERE ABUT_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

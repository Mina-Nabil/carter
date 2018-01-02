<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getArticles(){

          $strSQL = "SELECT RTCL_ID, RTCL_TITLE, RTCL_TEXT, RTCL_ARBC_TITLE, RTCL_ARBC_TEXT
                      FROM Articles";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getArticle_byID($ID){

          $strSQL = "SELECT RTCL_ID, RTCL_TITLE, RTCL_TEXT, RTCL_ARBC_TITLE, RTCL_ARBC_TEXT
                    FROM Articles WHERE RTCL_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertArticle($Title, $Text, $ArabicTitle, $ArbcText){
            //NN Text ArabicTitle Title DistrictID
          $strSQL = "INSERT INTO Articles (RTCL_TITLE, RTCL_TEXT, RTCL_ARBC_TITLE, RTCL_ARBC_TEXT)
                     VALUES ('{$Title}', '{$Text}', '{$ArabicTitle}', '{$ArbcText}')";
          $query = $this->db->query($strSQL);

        }

        public function editArticle($ID, $Title, $Text, $ArabicTitle, $ArbcText){
            //NN Text ArabicTitle Title DistrictID
          $strSQL = "UPDATE Articles
                    SET RTCL_TITLE   = '{$Title}',
                        RTCL_ARBC_TITLE  = '{$ArabicTitle}',
                        RTCL_TEXT    = '{$Text}',
                        RTCL_ARBC_TEXT   = '{$ArbcText}',
                    WHERE
                        `RTCL_ID`='{$ID}'";
          $query = $this->db->query($strSQL);

        }

        public function deleteArticle($ID){
          $strSQL = "DELETE FROM Articles WHERE RTCL_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

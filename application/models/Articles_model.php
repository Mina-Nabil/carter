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

        public function getArticlesID(){

          $strSQL = "SELECT RTCL_ID
                      FROM Articles";
          $query = $this->db->query($strSQL);
          $res   =  $query->result_array();
          $ret = array();
          foreach ($res as $row) array_push($ret, $row['RTCL_ID']);
          return $ret;

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
                     VALUES (?,?,?,?)";
          $query = $this->db->query($strSQL, array($Title, $Text, $ArabicTitle, $ArbcText));

        }

        public function editArticle($ID, $Title, $Text, $ArabicTitle, $ArbcText){
            //NN Text ArabicTitle Title DistrictID
          $strSQL = "UPDATE Articles
                    SET RTCL_TITLE   = ?,
                        RTCL_TEXT    = ?,
                        RTCL_ARBC_TITLE  = ?,
                        RTCL_ARBC_TEXT   = ?
                    WHERE
                        `RTCL_ID`=?";
          $query = $this->db->query($strSQL, array($Title, $Text, $ArabicTitle, $ArbcText));

        }

        public function deleteArticle($ID){
          $strSQL = "DELETE FROM Articles WHERE RTCL_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

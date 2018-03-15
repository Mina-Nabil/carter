<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privilages_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getPrivilage_Pages(){

          $strSQL = "SELECT PRVG_PAGE_ID, PRVG_USR_ID, PAGE_NAME, USR_NAME, PAGE_URL, PAGE_TYPE
                      FROM privilages, karter.pages, users
                      WHERE PRVG_PAGE_ID = PAGE_ID
                      AND PRVG_USR_ID = USR_ID ";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getAllPageIDs(){

          $strSQL = "SELECT PAGE_ID
                      FROM karter.pages";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getPrivilage_byUserID($ID){

          $strSQL = "SELECT PRVG_PAGE_ID, PRVG_USR_ID, PAGE_NAME, USR_NAME, PAGE_URL, PAGE_TYPE
                    FROM privilages, karter.pages, users
                    WHERE PRVG_PAGE_ID = PAGE_ID AND PRVG_USR_ID = USR_ID
                    AND  PRVG_USR_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getPrivilagesByPage_byUserID($ID, $Type){

          $strSQL = "SELECT PRVG_PAGE_ID, PRVG_USR_ID, PAGE_NAME, USR_NAME, PAGE_URL, PAGE_TYPE
                    FROM privilages, karter.pages, users
                    WHERE PRVG_PAGE_ID = PAGE_ID AND PRVG_USR_ID = USR_ID AND PAGE_TYPE = ?
                    AND  PRVG_USR_ID = ?";
          $query = $this->db->query($strSQL, array($Type, $ID));
          return $query->result_array();

        }


        public function getPrivilageIDs_Page_byUserID($ID){

          $strSQL = "SELECT PAGE_ID
                    FROM privilages, karter.pages, users
                    WHERE PRVG_PAGE_ID = PAGE_ID AND PRVG_USR_ID = USR_ID
                    AND  PRVG_USR_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getPrivilageNames_PageURL_byUserID($ID){

          $strSQL = "SELECT PAGE_URL
                    FROM privilages, karter.pages, users
                    WHERE PRVG_PAGE_ID = PAGE_ID AND PRVG_USR_ID = USR_ID
                    AND  PRVG_USR_ID = {$ID}";
          $query = $this->db->query($strSQL);
          $result = $query->result_array();
          $ret = array();
          foreach ($result as $row) array_push($ret, $row['PAGE_URL']);
          return $ret;

        }


        public function isPrivilage($UserID, $PageID){
          $strSQL = "SELECT Count(*) as res FROM privilages
                     WHERE PRVG_PAGE_ID = {$PageID} AND PRVG_USR_ID = {$UserID}";
                     $query = $this->db->query($strSQL);
                     return $query->result_array()[0]['res'];
        }

        public function addAllPrivilages($User_ID){
          $IDs = $this->getAllPageIDs();
          foreach($IDs as $id){
            $this->insertPrivilage($User_ID, $id['PAGE_ID']);
          }
          return 1;
        }


        public function insertPrivilage($UserID, $PageID){
            //NN Time BusID Name PageID
          $strSQL = "INSERT INTO privilages (PRVG_PAGE_ID, PRVG_USR_ID)
                     VALUES (?, ?)";

          $inputs = array($PageID, $UserID);
          $query = $this->db->query($strSQL, $inputs);
          return $query;
        }

        public function deletePrivilage_PageByPageAndUser($UserID, $PageID){
          $strSQL = "DELETE FROM privilages WHERE PRVG_PAGE_ID = ? AND PRVG_USR_ID  = ?";
          $query = $this->db->query($strSQL, array($PageID, $UserID)) ;
        }

        public function deletePrivilage_User($ID){
          $strSQL = "DELETE FROM privilages WHERE PRVG_USR_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

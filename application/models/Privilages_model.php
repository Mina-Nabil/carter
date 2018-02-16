<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privilages_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getPrivilage_Pages(){

          $strSQL = "SELECT PRVG_ID, PRVG_PAGE_ID, PRVG_USR_ID, PAGE_NAME, USR_NAME, PAGE_URL, PAGE_TYPE
                      FROM privilages, karter.pages, users
                      WHERE PRVG_PAGE_ID = PAGE_ID
                      AND PRVG_USR_ID = USR_ID ";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getPrivilage_Page_byUserID($ID){

          $strSQL = "SELECT PRVG_ID, PRVG_PAGE_ID, PRVG_USR_ID, PAGE_NAME, USR_NAME, PAGE_URL, PAGE_TYPE
                    FROM privilages, karter.pages, users
                    WHERE PRVG_PAGE_ID = PAGE_ID AND PRVG_USR_ID = USR_ID
                    AND  PRVG_USR_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getPrivilagesByPage_byUserID($ID, $Type){

          $strSQL = "SELECT PRVG_ID, PRVG_PAGE_ID, PRVG_USR_ID, PAGE_NAME, USR_NAME, PAGE_URL, PAGE_TYPE
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


        public function isPrivilage($UserID, $PageID){
          $strSQL = "SELECT Count(*) as res FROM privilages
                     WHERE PRVG_PAGE_ID = {$PageID} AND PRVG_USR_ID = {$UserID}";
                     $query = $this->db->query($strSQL);
                     return $query->result_array()[0]['res'];
        }


        public function insertPrivilage_Page($UserID, $PageID){
            //NN Time BusID Name PageID
          $strSQL = "INSERT INTO privilages (PRVG_PAGE_ID, PRVG_USR_ID)
                     VALUES (?, ?)";

          $inputs = array($PageID, $UserID);
          $query = $this->db->query($strSQL, $inputs);
          return $query;
        }

        public function deletePrivilage_Page($ID){
          $strSQL = "DELETE FROM privilages WHERE PRVG_ID = {$ID}";
          $query = $this->db->query($strSQL);
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

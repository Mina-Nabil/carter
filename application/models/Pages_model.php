<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getPages(){

          $strSQL = "SELECT PAGE_ID, PAGE_NAME, PAGE_URL, PAGE_TYPE
                      FROM Pages";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getPagesID(){

          $strSQL = "SELECT PAGE_ID
                      FROM Pages";
          $query = $this->db->query($strSQL);
          $res   =  $query->result_array();
          $ret = array();
          foreach ($res as $row) array_push($ret, $row['PAGE_ID']);
          return $ret;

        }

        public function getPage_byID($ID){

          $strSQL = "SELECT PAGE_ID, PAGE_NAME, PAGE_URL, PAGE_TYPE
                    FROM Pages WHERE PAGE_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertPage($Name, $Url, $Type){
            //NN Url Type Name DistrictID
          $strSQL = "INSERT INTO Pages (PAGE_NAME, PAGE_URL, PAGE_TYPE)
                     VALUES (?,?,?,?)";
          $query = $this->db->query($strSQL, array($Name, $Url, $Type));

        }

        public function editPage($ID, $Name, $Url, $Type){
            //NN Url Type Name
          $strSQL = "UPDATE Pages
                    SET PAGE_NAME   = ?,
                        PAGE_URL    = ?,
                        PAGE_TYPE  = ?
                    WHERE
                        `PAGE_ID`=?";
          $query = $this->db->query($strSQL, array($Name, $Url, $Type));

        }

        public function deletePage($ID){
          $strSQL = "DELETE FROM Pages WHERE PAGE_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

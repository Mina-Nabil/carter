<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Balancelogs_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getBalancelogs(){

          $strSQL = "SELECT BLOG_ID, BLOG_CHNG, BLOG_DATE, CLNT_NAME, BLOG_CMMT, BLOG_CLNT_ID
                      FROM Balance_log, clients WHERE BLOG_CLNT_ID = CLNT_ID";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getBalancelog_byID($ID){

          $strSQL = "SELECT BLOG_ID, BLOG_CHNG, BLOG_DATE, CLNT_NAME, BLOG_CMMT, BLOG_CLNT_ID
                    FROM Balance_log, clients WHERE BLOG_CLNT_ID = CLNT_ID AND BLOG_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertBalancelog($Change, $ClientID, $Date, $Comment){
            //NN Tel Email Name CityID
          $strSQL = "INSERT INTO Balance_log (BLOG_CHNG, BLOG_DATE, BLOG_CLNT_ID, BLOG_CMMT)
                     VALUES ('{$Change}', '{$Date}', '{$ClientID}', '{$Comment}')";
          $query = $this->db->query($strSQL);

        }

        public function editBalancelog($ID, $Change, $ClientID, $Date, $Comment){
            //NN Tel Email Name CityID
          $strSQL = "UPDATE Balance_log
                    SET BLOG_CHNG   = '{$Change}',
                        BLOG_DATE  = '{$Date}',
                        BLOG_CMMT   = '{$Comment}',
                        BLOG_CLNT_ID ='{$ClientID}'
                    WHERE
                        `BLOG_ID`='{$ID}'";
          $query = $this->db->query($strSQL);

        }

        public function deleteBalancelog($ID){
          $strSQL = "DELETE FROM Balance_log WHERE BLOG_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promos_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getPromos(){

          $strSQL = "SELECT PRMO_ID, PRMO_CODE, PRMO_EXPIRE, PRMO_PRCNT, PRMO_TYPE, PRMO_CNT
                      FROM Promos";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function getPromo_byID($ID){

          $strSQL = "SELECT PRMO_ID, PRMO_CODE, PRMO_EXPIRE, PRMO_PRCNT, PRMO_TYPE, PRMO_CNT
                    FROM Promos WHERE PRMO_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertPromo($Code, $Expire, $Percent, $Type, $Count){
            //NN Expire Percent Code DistrictID
          $strSQL = "INSERT INTO Promos (PRMO_CODE, PRMO_EXPIRE, PRMO_PRCNT, PRMO_TYPE, PRMO_CNT)
                     VALUES (?,?,?,?)";
          $query = $this->db->query($strSQL, array($Code, $Expire, $Percent, $Type, $Count));

        }

        public function editPromo($ID, $Code, $Expire, $Percent, $Type, $Count){
            //NN Expire Percent Code DistrictID
          $strSQL = "UPDATE Promos
                    SET PRMO_CODE   = ?,
                        PRMO_EXPIRE    = ?,
                        PRMO_PRCNT  = ?,
                        PRMO_TYPE   = ?,
                        PRMO_CNT  = ?
                    WHERE
                        `PRMO_ID`= ?";
          $query = $this->db->query($strSQL, array($Code, $Expire, $Percent, $Type, $Count, $ID));

        }

        public function deletePromo($ID){
          $strSQL = "DELETE FROM Promos WHERE PRMO_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

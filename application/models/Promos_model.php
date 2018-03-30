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

        public function AddUsage($CodeID, $ClientID, $TicketID, $LiveLineID, $Value){
          $strSQL = "INSERT INTO promouses (PRUS_PRMO_ID, PRUS_CLNT_ID, PRUS_TCKT_ID, PRUS_LVLN_ID, PRUS_VALUE, PRUS_DATE)
                     VALUES (?,?,?,?,?,?)";
          $query = $this->db->query($strSQL, array($CodeID, $ClientID, $TicketID, $LiveLineID, $Value, date("Y-m-d H:i:s")));

        }

        public function getPromo_byCode($Code){

          $strSQL = "SELECT PRMO_ID, PRMO_CODE, PRMO_EXPIRE, PRMO_PRCNT, PRMO_TYPE, PRMO_CNT
                    FROM Promos WHERE PRMO_CODE = ?";
          $query = $this->db->query($strSQL, array($Code));
          return $query->result_array();

        }

        public function PromoUsageCount($ID, $ClntID){
          $strSQL = "SELECT COUNT(*) as cnt FROM promouses WHERE PRUS_PROMO_ID = {$ID} AND PRUS_CLNT_ID = {$ClntID}";
          $query = $this->db->query($strSQL);
          return $query->result_array()[0]['cnt'];
        }


        public function checkValidity($PromoCode, $ClientID){

          if(!isset($this->getPromo_byCode($PromoCode)[0])) return array('PromoStatus' => 0); //Wrong Code
          $PromoArr = $this->getPromo_byCode($PromoCode)[0];
          $ExpiryType = $PromoArr['PRMO_TYPE'];
          if(strcmp($ExpiryType, 'Date') == 0){ //Expires by Date
            $Expiry = strtotime($PromoArr['PRMO_EXPIRE']);
            if($Expiry > date("Y-m-d H:i:s")) return array('PromoStatus' => 2); //Code Expired
          }
          $Used = $this->PromoUsageCount($PromoArr['PRMO_ID'], $ClientID);
          if(strcmp($ExpiryType, 'Count') == 0){ //Expires by Count
            if($Used >= $PromoArr['PRMO_CNT']) return array('PromoStatus' => 3); //Code Count Surpassed
          }
          if(strcmp($ExpiryType, 'Both') == 0){ //Expires by Both Count and Date
            $Expiry = strtotime($PromoArr['PRMO_EXPIRE']);
            if($Expiry > date("Y-m-d H:i:s") || $Count >= $PromoArr['PRMO_CNT'] ) return array('PromoStatus' => 4); //Code Expired
          }
          return array('PromoStatus' => 1); //Correct Code
        }


        public function insertPromo($Code, $Expire, $Percent, $Type, $Count){
            //NN Expire Percent Code DistrictID
          $strSQL = "INSERT INTO Promos (PRMO_CODE, PRMO_EXPIRE, PRMO_PRCNT, PRMO_TYPE, PRMO_CNT)
                     VALUES (?,?,?,?,?)";
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

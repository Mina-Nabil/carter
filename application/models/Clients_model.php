<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getClients(){

          $strSQL = "SELECT CLNT_ID, CLNT_NAME, CITY_NAME, CLNT_TEL, DIST_NAME,
                            CLNT_EMAIL, CLNT_IMG, CLNT_PASS, CLNT_BLNC, CLNT_TAG, CLNT_DIST_ID
                      FROM Clients, cities, districts
                      WHERE DIST_CITY_ID = CITY_ID
                      AND   CLNT_DIST_ID = DIST_ID";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getClient_byID($ID){

          $strSQL = "SELECT CLNT_ID, CLNT_NAME, CITY_NAME, CLNT_TEL, DIST_NAME, CITY_ID,
                            Clients.CLNT_EMAIL, CLNT_IMG, CLNT_BLNC, CLNT_TAG, CLNT_DIST_ID
                      FROM Clients, cities, districts
                      WHERE DIST_CITY_ID = CITY_ID
                      AND   CLNT_DIST_ID = DIST_ID AND CLNT_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function setImage($ID, $Image){

          $strSQL = "UPDATE Clients SET CLNT_IMG = ? WHERE `CLNT_ID`= ? ";
          $query = $this->db->query($strSQL, array($Image, $ID));

        }

        public function isEmailExist($Email){

          $strSQL = "SELECT COUNT(*) AS emails from clients where CLNT_EMAIL = ?";
          $query = $this->db->query($strSQL, array($Email));
          $emailCount = $query->result_array()[0]['emails'];
          if($emailCount == 0) return false;
          else return true;
        }


        public function checkUser($Email, $Pass){
          $strSQL = "SELECT CLNT_ID from clients where CLNT_EMAIL = ? AND CLNT_PASS = ?" ;

          $query = $this->db->query($strSQL, array($Email, $Pass));
          $result = $query->result_array();
          if(isset($result[0]['CLNT_ID'])) return $result[0]['CLNT_ID'];
         else return false;


        }


        public function insertClient($Name, $Tel, $Email, $Img, $Pass, $Blnc, $Tag, $DistID){
            //NN Tel Email Name CityID
          $strSQL = "INSERT INTO Clients (CLNT_NAME, CLNT_TEL, CLNT_DIST_ID,
                                          CLNT_EMAIL, CLNT_IMG, CLNT_PASS, CLNT_BLNC, CLNT_TAG)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

          $inputs = array($Name, $Tel, $DistID, $Email, $Img, $Pass, $Blnc, $Tag);

          $query = $this->db->query($strSQL, $inputs);

        }

        public function regClient($Name, $Tel, $Email, $Img, $Pass, $Blnc, $Tag, $DistID){
            //NN Tel Email Name CityID
          $strSQL = "INSERT INTO Clients (CLNT_NAME, CLNT_TEL, CLNT_DIST_ID,
                                          CLNT_EMAIL, CLNT_IMG, CLNT_PASS, CLNT_BLNC, CLNT_TAG)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

          $inputs = array($Name, $Tel, $DistID, $Email, $Img, $Pass, $Blnc, $Tag);

          $query = $this->db->query($strSQL, $inputs);


          $strSQL = "SELECT MAX(CLNT_ID) as ID FROM clients ";
          $query = $this->db->query($strSQL);

          return $query->result_array()[0]['ID'];

        }

        public function editClient($ID, $Name, $Tel, $Email, $Img, $Pass, $Blnc, $Tag, $DistID){
            //NN Tel Email Name CityID
          $strSQL = "UPDATE Clients
                    SET CLNT_NAME = ?, CLNT_TEL = ?, CLNT_DIST_ID = ?, CLNT_EMAIL = ?,
                        CLNT_IMG   = ?, CLNT_PASS = ?, CLNT_BLNC = ?, CLNT_TAG   = ?
                    WHERE
                        `CLNT_ID`=?";

          $inputs = array($Name, $Tel, $DistID, $Email, $Img, $Pass, $Blnc, $Tag, $ID);
          $query = $this->db->query($strSQL, $inputs);

        }

        public function deleteClient($ID){
          $strSQL = "DELETE FROM Clients WHERE CLNT_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

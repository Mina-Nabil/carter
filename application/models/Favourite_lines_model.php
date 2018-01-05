<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Favourite_Lines_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getFavourite_Lines(){

          $strSQL = "SELECT FVLN_ID, FVLN_LINE_ID, FVLN_CLNT_ID, LINE_NAME, CLNT_NAME
                      FROM favourite_lines, karter.lines, clients
                      WHERE FVLN_LINE_ID = LINE_ID
                      AND FVLN_CLNT_ID = CLNT_ID ";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getFavourite_Line_byClientID($ID){

          $strSQL = "SELECT FVLN_ID, FVLN_LINE_ID, FVLN_CLNT_ID, LINE_NAME, CLNT_NAME
                    FROM favourite_lines, karter.lines, clients
                    WHERE FVLN_LINE_ID = LINE_ID AND FVLN_CLNT_ID = CLNT_ID
                    AND  FVLN_CLNT_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getFavourite_Line_byID($ID){

          $strSQL = "SELECT FVLN_ID, FVLN_LINE_ID, FVLN_CLNT_ID, LINE_NAME, CLNT_NAME
                    FROM favourite_lines, karter.lines, clients
                    WHERE FVLN_LINE_ID = LINE_ID AND FVLN_CLNT_ID = CLNT_ID
                    AND  FVLN_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function isFavourite($ClientID, $LineID){
          $strSQL = "SELECT Count(*) as res FROM favourite_lines
                     WHERE FVLN_LINE_ID = {$LineID} AND FVLN_CLNT_ID = {$ClientID}";
                     $query = $this->db->query($strSQL);
                     return $query->result_array()[0]['res'];
        }


        public function insertFavourite_Line($LineID, $ClientID){
            //NN Time BusID Name LineID
          $strSQL = "INSERT INTO favourite_lines (FVLN_LINE_ID, FVLN_CLNT_ID)
                     VALUES (?, ?)";

          $inputs = array($LineID, $ClientID);
          $query = $this->db->query($strSQL, $inputs);
          return $query;
        }

        public function editFavourite_Line($ID, $LineID, $ClientID){
            //NN Time BusID Name LineID
          $strSQL = "UPDATE favourite_lines
                    SET FVLN_LINE_ID   = ?, FVLN_CLNT_ID  = ?
                    WHERE  `FVLN_ID`=?";

          $inputs = array($LineID, $ClientID, $ID);
          $query = $this->db->query($strSQL, $inputs);

        }

        public function deleteFavourite_Line($ID){
          $strSQL = "DELETE FROM favourite_lines WHERE FVLN_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

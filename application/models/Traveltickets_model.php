<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TravelTickets_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getTravelTickets(){

          $strSQL = "SELECT TRTK_ID, TRTK_CLNT_ID, TRTK_LVLN_ID, TRTK_START_INDX, TRTK_END_INDX, TRTK_CANC, TRTK_PAID,
                            TRTK_PRICE, CLNT_NAME, LINE_NAME, LVLN_TIME
                      FROM traveltickets, live_lines, karter.lines, clients
                      WHERE TRTK_LVLN_ID = LVLN_ID
                      AND TRTK_CLNT_ID = CLNT_ID
                      AND LVLN_LINE_ID = LINE_ID ";
          $query = $this->db->query($strSQL);
          return $query->result_array();
        }

        public function getTravelTicket_byID($ID){

          $strSQL = "SELECT TRTK_ID, TRTK_CLNT_ID, TRTK_LVLN_ID, TRTK_START_INDX, TRTK_END_INDX, TRTK_CANC, TRTK_PAID,
                            TRTK_PRICE, CLNT_NAME, LINE_NAME
                    FROM traveltickets, live_lines, karter.lines, clients
                    WHERE TRTK_LVLN_ID = LVLN_ID
                    AND TRTK_CLNT_ID = CLNT_ID
                    AND LVLN_LINE_ID = LINE_ID AND TRTK_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertTravelTicket($ClientID, $LiveLineID, $StartIndx, $EndIndx, $isCancelled, $isPaid, $Price){
            //NN LiveLineID BusID Name LineID
          $strSQL = "INSERT INTO traveltickets (TRTK_CLNT_ID, TRTK_LVLN_ID, TRTK_START_INDX,
                                  TRTK_END_INDX, TRTK_CANC, TRTK_PAID, TRTK_PRICE)
                     VALUES       (?, ?, ?, ?, ?, ?, ?)";

          $inputs = array($ClientID, $LiveLineID, $StartIndx, $EndIndx, $isCancelled, $isPaid, $Price);
          $query = $this->db->query($strSQL, $inputs);

        }

        public function editTravelTicket($ID, $ClientID, $LiveLineID, $StartIndx, $EndIndx, $isCancelled, $isPaid, $Price){
            //NN LiveLineID BusID Name LineID
          $strSQL = "UPDATE traveltickets
                    SET TRTK_CLNT_ID   = ?, TRTK_LVLN_ID  = ?, TRTK_START_INDX = ?, TRTK_END_INDX  = ?,
                        TRTK_CANC   = ?, TRTK_PAID   = ?, TRTK_PRICE = ?
                    WHERE  `TRTK_ID`= ?";

          $inputs = array($ClientID, $LiveLineID, $StartIndx, $EndIndx, $isCancelled, $isPaid, $Price, $ID);
          $query = $this->db->query($strSQL, $inputs);

        }

        public function deleteTravelTicket($ID){
          $strSQL = "DELETE FROM traveltickets WHERE TRTK_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

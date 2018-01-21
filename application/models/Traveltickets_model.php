<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TravelTickets_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getTravelTickets($clientID){

          $strSQL = 'SELECT TRTK_ID FROM traveltickets WHERE TRTK_CLNT_ID = ?';
          $query = $this->db->query($strSQL, array($clientID));
          $ticketsarr = $query->result_array();
          $tickets = array();
          foreach($ticketsarr as $row){
            array_push($tickets, $row['TRTK_ID']);
          }


          $strSQL = "SELECT TRTK_ID, TRTK_CLNT_ID, TRTK_LVLN_ID, TRTK_START_INDX, TRTK_END_INDX, TRTK_CANC, TRTK_PAID,
                            TRTK_PRICE, CLNT_NAME, LINE_NAME, LVLN_TIME, STTN_NAME as START_STTN, PATH_REL_TIME
                      FROM  clients, traveltickets, live_lines, karter.lines, paths, stations
                      WHERE TRTK_CLNT_ID = CLNT_ID
                      AND TRTK_LVLN_ID = LVLN_ID
                      AND LVLN_LINE_ID = LINE_ID
                      AND LINE_ID = PATH_LINE_ID
                      AND TRTK_START_INDX = PATH_INDX
                      AND PATH_STTN_ID = STTN_ID";
          $query = $this->db->query($strSQL);
          $res1  = $query->result_array();

          $strSQL = "SELECT TRTK_ID, TRTK_CLNT_ID, TRTK_LVLN_ID, TRTK_START_INDX, TRTK_END_INDX, TRTK_CANC, TRTK_PAID,
                            TRTK_PRICE, CLNT_NAME, LINE_NAME, LVLN_TIME, STTN_NAME as END_STTN
                      FROM  clients, traveltickets, live_lines, karter.lines, paths, stations
                      WHERE TRTK_CLNT_ID = CLNT_ID
                      AND TRTK_LVLN_ID = LVLN_ID
                      AND LVLN_LINE_ID = LINE_ID
                      AND LINE_ID = PATH_LINE_ID
                      AND TRTK_END_INDX = PATH_INDX
                      AND PATH_STTN_ID = STTN_ID";
          $query2 = $this->db->query($strSQL);
          $res2  = $query2->result_array();


                    $res = array();
                    $i=0;
                    foreach($res1 as $row){
                      $res[$i] = $row;
                      $i++;
                    }
                    $i=0;
                    foreach($res2 as $row){
                      $res[$i] = array_merge($res[$i], $row);
                      $i++;
                    }
                    return $res;

          return $res2;
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
        //isAvailable
        public function isAvailable($LiveLineID, $StartIndx, $EndIndx){
          $AvailableSeats = $this->getSeatsAvailable($LiveLineID, $StartIndx, $EndIndx);
          if($AvailableSeats > 0) return $AvailableSeats;
          else return false;
        }

        //Get Seats Available
        public function getSeatsAvailable($LiveLineID, $Indicies){


          $strSQL = "SELECT MIN(X1) as tt FROM
                    (SELECT COUNT(*) as X1 FROM karter.stationtickets
						         WHERE STTK_LVLN_ID = ?
                     AND   STTK_INDX IN ? ) AS temp";

          $query = $this->db->query($strSQL, array($LiveLineID, $Indicies));
          $Seats = $query->result_array()[0]['tt'];

          $strSQL = "SELECT BUS_SEATS FROM buses, livelines
                     WHERE LVLN_BUS_ID = BUS_ID
                     AND LVLN_ID = " . $LiveLineID;

          $query = $this->db->query($strSQL);
          $MaxSeats = $query->result_array()[0]['BUS_SEATS'];

          return $MaxSeats - $Seats;
          //Test this function
        }

        public function insertTravelTicket($ClientID, $LiveLineID, $StartIndx, $EndIndx, $isCancelled, $isPaid, $Price){


          $this->db->trans_start();
          $strSQL2 = "LOCK TABLE traveltickets WRITE;";
          $query = $this->db->query($strSQL2);

          $strSQL2 = " INSERT INTO traveltickets (TRTK_CLNT_ID, TRTK_LVLN_ID, TRTK_START_INDX,
                                  TRTK_END_INDX, TRTK_CANC, TRTK_PAID, TRTK_PRICE)
                     VALUES       (?, ?, ?, ?, ?, ?, ?)";



          $inputs = array($ClientID, $LiveLineID, $StartIndx, $EndIndx, $isCancelled, $isPaid, $Price);
          $query = $this->db->query($strSQL2, $inputs);

          $strSQL =  "SELECT MAX(TRTK_ID) as maxID FROM traveltickets";
          $query = $this->db->query($strSQL);
          $TravelticketID = $query->result_array()[0]['maxID`'];

          $strSQL = 'UNLOCK TABLES; ';
          $query = $this->db->query($strSQL);

          for($i = $StartIndx ; $i <= $EndIndx ; $i++){

            $strSQL3 = 'SELECT PATH_ID, PATH_STTN_ID
                        FROM livelines, karter.lines, paths
                        WHERE LVLN_LINE_ID = LINE_ID
                        AND   PATH_LINE_ID = LINE_ID
                        AND   LVLN_ID = ' . $LiveLineID;
            $query = $this->db->query($strSQL3);
            $PathID = $query->result_array()[0]['PATH_ID'];
            $StationID = $query->result_array()[0]['PATH_STTN_ID'];

            $strSQL = "INSERT INTO stationtickets (STTK_STTN_ID, STTK_TRTK_ID, STTK_CLNT_ID,
                                                   STTK_LVLN_ID, STTK_PATH_ID, STTK_INDX)
                      VALUES ({$StationID}, {$TravelticketID}, {$ClientID},
                              {$LiveLineID}, {$PathID}, {$i}) ; ";
           $query = $this->db->query($strSQL);

          }
          $this->db->trans_complete();

//test this function
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

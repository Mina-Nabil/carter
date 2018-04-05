<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TravelTickets_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getTravelTickets($clientID){

          $strSQL = "SELECT TRTK_ID, TRTK_CLNT_ID, TRTK_LVLN_ID, TRTK_START_INDX, TRTK_SERIAL, TRTK_END_INDX, TRTK_CANC, TRTK_PAID, TRTK_ISHAND,
                            TRTK_PRICE, CLNT_NAME, LINE_NAME, LVLN_TIME, STTN_NAME as START_STTN, PATH_REL_TIME, TRTK_REG_DATE, TRTK_SEATS
                      FROM  clients, traveltickets, live_lines, karter.lines, paths, stations
                      WHERE TRTK_CLNT_ID = CLNT_ID
                      AND TRTK_LVLN_ID = LVLN_ID
                      AND LVLN_LINE_ID = LINE_ID
                      AND LINE_ID = PATH_LINE_ID
                      AND TRTK_START_INDX = PATH_INDX
                      AND PATH_STTN_ID = STTN_ID";
          $query = $this->db->query($strSQL);
          $res1  = $query->result_array();

          $strSQL = "SELECT TRTK_ID, TRTK_CLNT_ID, TRTK_LVLN_ID, TRTK_START_INDX, TRTK_SERIAL, TRTK_END_INDX, TRTK_CANC, TRTK_PAID, TRTK_ISHAND,
                            TRTK_PRICE, CLNT_NAME, LINE_NAME, LVLN_TIME, STTN_NAME as END_STTN, TRTK_REG_DATE
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

        public function getOldTravelTicketsByClient($clientID){

          $strSQL = "SELECT TRTK_ID, TRTK_CLNT_ID, TRTK_LVLN_ID, TRTK_START_INDX, TRTK_END_INDX, TRTK_SERIAL, TRTK_CANC, TRTK_PAID, TRTK_ISHAND,
                            TRTK_PRICE, CLNT_NAME, LINE_NAME, LVLN_TIME, STTN_NAME as START_STTN, PATH_REL_TIME, TRTK_REG_DATE, TRTK_SEATS, STTN_ARBC_NAME as START_STTN_ARBC_NAME
                      FROM  clients, traveltickets, live_lines, karter.lines, paths, stations
                      WHERE TRTK_CLNT_ID = CLNT_ID
                      AND TRTK_LVLN_ID = LVLN_ID
                      AND LVLN_LINE_ID = LINE_ID
                      AND LINE_ID = PATH_LINE_ID
                      AND CLNT_ID = {$clientID}
                      AND TRTK_START_INDX = PATH_INDX
                      AND LVLN_TIME < NOW()
                      AND PATH_STTN_ID = STTN_ID
                      ORDER BY LVLN_TIME DESC";
          $query = $this->db->query($strSQL);
          $res1  = $query->result_array();

          $strSQL = "SELECT TRTK_ID, TRTK_CLNT_ID, TRTK_LVLN_ID, TRTK_START_INDX, TRTK_END_INDX, TRTK_CANC, TRTK_SERIAL, TRTK_PAID, TRTK_ISHAND, LVLN_TIME,
                            TRTK_PRICE, CLNT_NAME, LINE_NAME, LVLN_TIME, STTN_NAME as END_STTN, TRTK_REG_DATE, STTN_ARBC_NAME as END_STTN_ARBC_NAME
                      FROM  clients, traveltickets, live_lines, karter.lines, paths, stations
                      WHERE TRTK_CLNT_ID = CLNT_ID
                      AND TRTK_LVLN_ID = LVLN_ID
                      AND LVLN_LINE_ID = LINE_ID
                      AND LINE_ID = PATH_LINE_ID
                      AND CLNT_ID = {$clientID}
                      AND TRTK_END_INDX = PATH_INDX
                      AND LVLN_TIME < NOW()
                      AND PATH_STTN_ID = STTN_ID
                      ORDER BY LVLN_TIME DESC";

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

        public function getNewTravelTicketsByClient($clientID){

          $strSQL = "SELECT TRTK_ID, TRTK_CLNT_ID, TRTK_LVLN_ID, TRTK_START_INDX, TRTK_END_INDX, TRTK_CANC, TRTK_PAID, TRTK_SERIAL, TRTK_ISHAND, LVLN_TIME,
                            TRTK_PRICE, CLNT_NAME, LINE_NAME, LVLN_TIME, STTN_NAME as START_STTN, PATH_REL_TIME, TRTK_REG_DATE, TRTK_SEATS, STTN_ARBC_NAME as START_STTN_ARBC_NAME
                      FROM  clients, traveltickets, live_lines, karter.lines, paths, stations
                      WHERE TRTK_CLNT_ID = CLNT_ID
                      AND TRTK_LVLN_ID = LVLN_ID
                      AND LVLN_LINE_ID = LINE_ID
                      AND LINE_ID = PATH_LINE_ID
                      AND CLNT_ID = {$clientID}
                      AND TRTK_START_INDX = PATH_INDX
                      AND LVLN_TIME > NOW()
                      AND PATH_STTN_ID = STTN_ID
                      GROUP BY TRTK_LVLN_ID
                      ORDER BY LVLN_TIME ASC";
          $query = $this->db->query($strSQL);
          $res1  = $query->result_array();

          $strSQL = "SELECT TRTK_ID, TRTK_CLNT_ID, TRTK_LVLN_ID, TRTK_START_INDX, TRTK_END_INDX, TRTK_CANC, TRTK_PAID, TRTK_SERIAL, TRTK_ISHAND, LVLN_TIME,
                            TRTK_PRICE, CLNT_NAME, LINE_NAME, LVLN_TIME, STTN_NAME as END_STTN, TRTK_REG_DATE, STTN_ARBC_NAME as END_STTN_ARBC_NAME
                      FROM  clients, traveltickets, live_lines, karter.lines, paths, stations
                      WHERE TRTK_CLNT_ID = CLNT_ID
                      AND TRTK_LVLN_ID = LVLN_ID
                      AND LVLN_LINE_ID = LINE_ID
                      AND LINE_ID = PATH_LINE_ID
                      AND CLNT_ID = {$clientID}
                      AND TRTK_END_INDX = PATH_INDX
                      AND LVLN_TIME > NOW()
                      AND PATH_STTN_ID = STTN_ID
                      GROUP BY TRTK_LVLN_ID
                      ORDER BY LVLN_TIME ASC";

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

        public function getInTicketsByStations($LiveLineID, $StationID){

          $strSQL = "SELECT TRTK_ID, TRTK_CANC, TRTK_PAID, TRTK_ISHAND,
                            TRTK_PRICE, CLNT_NAME, CLNT_TEL, TRTK_REG_DATE, TRTK_SEATS, TRTK_SERIAL
                      FROM  clients, traveltickets, live_lines
                      WHERE TRTK_CLNT_ID = CLNT_ID
                      AND TRTK_LVLN_ID = LVLN_ID
                      AND TRTK_CANC != 1
                      AND TRTK_LVLN_ID = {$LiveLineID}
                      AND TRTK_START_STTN = {$StationID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getOutTicketsByStations($LiveLineID, $StationID){

          $strSQL = "SELECT TRTK_ID, TRTK_CANC, TRTK_PAID, TRTK_ISHAND,
                            TRTK_PRICE, CLNT_NAME, CLNT_TEL, TRTK_REG_DATE, TRTK_SEATS, TRTK_SERIAL
                      FROM  clients, traveltickets, live_lines
                      WHERE TRTK_CLNT_ID = CLNT_ID
                      AND TRTK_LVLN_ID = LVLN_ID
                      AND TRTK_CANC != 1
                      AND TRTK_LVLN_ID = {$LiveLineID}
                      AND TRTK_END_STTN = {$StationID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getTravelTicket_byID($ID){

          $strSQL = "SELECT TRTK_ID, TRTK_CLNT_ID, TRTK_LVLN_ID, TRTK_START_INDX, TRTK_END_INDX, TRTK_CANC, TRTK_PAID,
                            TRTK_PRICE, CLNT_NAME, LINE_NAME, TRTK_ISHAND, TRTK_REG_DATE, TRTK_SEATS, LVLN_TIME, TRTK_SERIAL
                    FROM traveltickets, live_lines, karter.lines, clients
                    WHERE TRTK_LVLN_ID = LVLN_ID
                    AND TRTK_CLNT_ID = CLNT_ID
                    AND LVLN_LINE_ID = LINE_ID AND TRTK_ID = ?";
          $query = $this->db->query($strSQL, array($ID));
          return $query->result_array();

        }

        public function getTravelTicketPrice_byID($ID){

          $strSQL = "SELECT TRTK_PRICE
                    FROM traveltickets
                    WHERE TRTK_ID = ?";
          $query = $this->db->query($strSQL, array($ID));
          return $query->result_array();

        }
        //isAvailable
        public function isAvailable($LiveLineID, $StartIndx, $EndIndx, $NoofTickets){
          $AvailableSeats = $this->getSeatsAvailable($LiveLineID, range($StartIndx,$EndIndx,1));
          if($AvailableSeats >= $NoofTickets) return true;
          else return false;
        }

        //Get Seats Available
        public function getSeatsAvailable($LiveLineID, $Indicies){


          $strSQL = "SELECT SUM(l1.p1) as tt
                    FROM (
                    SELECT TRTK_SEATS as p1 FROM karter.stationtickets, traveltickets, live_lines
                    WHERE STTK_LVLN_ID = LVLN_ID
                    AND TRTK_LVLN_ID = LVLN_ID
                    AND TRTK_CANC = 0
                      AND TRTK_LVLN_ID = ?
                      AND   STTK_INDX IN ?
                     GROUP BY TRTK_ID
                    ) as l1
                    ";

          $query = $this->db->query($strSQL, array($LiveLineID, $Indicies));
          $Seats = $query->result_array()[0]['tt'];

          $strSQL = "SELECT BUS_SEATS FROM buses, live_lines
                     WHERE LVLN_BUS_ID = BUS_ID
                     AND LVLN_ID = " . $LiveLineID;

          $query = $this->db->query($strSQL);
          $MaxSeats = $query->result_array()[0]['BUS_SEATS'];

          return $MaxSeats - $Seats;
          //Test this function
        }

        public function setClientPaid($TravelticketID){
          $strSQL = "UPDATE traveltickets SET
                      TRTK_PAID = 1, TRTK_isARRV = 1, TRTK_PYMNTTYPE = 'Cash', TRTK_CANC = 0
                      WHERE  `TRTK_ID`= ?";

          return $this->db->query($strSQL, array($TravelticketID));
        }


        public function setClientPaidbyVisa($TravelticketID){
          $strSQL = "UPDATE traveltickets SET
                      TRTK_isARRV = 1, TRTK_PYMNTTYPE = 'Visa', TRTK_CANC = 0
                      WHERE  `TRTK_ID`= ?";

          return $this->db->query($strSQL, array($TravelticketID));

        }

        public function cancelTicketbyDriver($TicketID){
          $strSQL = "UPDATE traveltickets
                    SET TRTK_CANC   = 2, TRTK_PAID = 0, TRTK_isARRV = 0
                    WHERE  `TRTK_ID`= ?";

          $inputs = array($TicketID);
        return $this->db->query($strSQL, $inputs);
        }

        public function confirmcancelTicketbyDriver($TicketID){
          $strSQL = "UPDATE traveltickets
                    SET TRTK_CANC   = 5, TRTK_PAID = 0, TRTK_isARRV = 0
                    WHERE  `TRTK_ID`= ?";

          $inputs = array($TicketID);
        return $this->db->query($strSQL, $inputs);
        }

        public function confirmClientPaidByDriver($TravelticketID){
          $strSQL = "UPDATE traveltickets SET
                      TRTK_PAID = 1, TRTK_isARRV = 5, TRTK_PYMNTTYPE = 'Cash', TRTK_CANC = 0
                      WHERE  `TRTK_ID`= ?";

          return $this->db->query($strSQL, array($TravelticketID));
        }

        public function cancelTicket($TicketID){
          $strSQL = "UPDATE traveltickets
                    SET TRTK_CANC   = 1, TRTK_PAID = 0, TRTK_isARRV = 0
                    WHERE  `TRTK_ID`= ?";

          $inputs = array($TicketID);
          $query = $this->db->query($strSQL, $inputs);
        }

        public function confirmTicketStatus($TicketID){
          $strSQL = "SELECT TRTK_CLNT_ID, TRTK_CANC, TRTK_isARRV FROM traveltickets WHERE TRTK_ID = {$TicketID}";
          $query = $this->db->query($strSQL);
          $TicketStatus = $this->query->result_array();
          if(!isset($TicketStatus[0])) return false;
          $Canc = $TicketStatus[0]['TRTK_CANC'];
          $Arrv = $TicketStatus[0]['TRTK_isARRV'];

          if($Arrv == 1 && $Canc == 0){
            //Client Arrived
            $this->confirmClientPaidByDriver($TicketID);
            return array('sendPush' => 0);
          }
          else if($Arrv == 0 && $Canc == 2){
            //Driver Cancelled the Client
            $this->confirmcancelTicketbyDriver($TicketID);
            return array('sendPush' => 1, 'ClientID' => $TicketStatus[0]['TRTK_CLNT_ID']);
          }

          }

          public function getBusTicketChar($LiveLineID){
            $strSQL = "SELECT BUS_CHAR FROM live_lines, drivers, buses
                       WHERE BUS_DRVR_ID = DRVR_ID
                       AND   LVLN_DRVR_ID = DRVR_ID
                       AND   LVLN_ID = {$LiveLineID}";
            $query = $this->db->query($strSQL);
            return $query->result_array();
          }

        public function insertTravelTicket($ClientID, $LiveLineID, $StartIndx, $EndIndx, $isCancelled,
                                           $isPaid, $Price, $isHandi, $NoofTickets, $StartStation, $EndStation){

          $buscharRow = $this->getBusTicketChar($LiveLineID) ;
          $busChar = '';
          if(!isset($buscharRow[0])) return array('0' => false);
          else $busChar = $buscharRow[0]['BUS_CHAR'];


          $this->db->trans_start();
          $strSQL2 = "LOCK TABLE traveltickets WRITE, ticket_seq WRITE;";
          $query = $this->db->query($strSQL2);

          $strSQL = "SELECT MAX(TRSQ_TCKT_ID) as NewID FROM ticket_seq WHERE TRSQ_LVLN_ID = {$LiveLineID}";
          $query = $this->db->query($strSQL);
          $row = $query->result_array();
          if(!isset($row[0])) {
            // First Ticket
            $strSQL = "INSERT INTO ticket_seq (TRSQ_LVLN_ID, TRSQ_TCKT_ID) VALUES ({$LiveLineID}, 1)";
            $query = $this->db->query($strSQL);
            $TicketID = $busChar . '-' . $LiveLineID . '-' . '01';
            $TicketSerial = $busChar . '01';
          } else {
            $NewSerial = $row[0]['NewID']+1;
            $TicketID = $busChar . '-' . $LiveLineID . '-' . sprintf("%02d", $NewSerial);
            $TicketSerial = $busChar . sprintf("%02d", $NewSerial);
            $strSQL = "INSERT INTO ticket_seq (TRSQ_LVLN_ID, TRSQ_TCKT_ID) VALUES ({$LiveLineID}, {$NewSerial})";
            $query = $this->db->query($strSQL);
          }

          $strSQL2 = " INSERT INTO traveltickets (TRTK_ID, TRTK_CLNT_ID, TRTK_LVLN_ID, TRTK_START_INDX, TRTK_END_INDX, TRTK_CANC, TRTK_PAID,
                                                  TRTK_PRICE, TRTK_ISHAND, TRTK_REG_DATE, TRTK_SEATS, TRTK_START_STTN, TRTK_END_STTN, TRTK_SERIAL)
                     VALUES       (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?, ?)";



          $inputs = array($TicketID, $ClientID, $LiveLineID, $StartIndx, $EndIndx, $isCancelled, $isPaid, $Price, $isHandi, $NoofTickets, $StartStation, $EndStation);
          $query = $this->db->query($strSQL2, $inputs);

          $TravelticketID = $TicketID;

          $strSQL = 'UNLOCK TABLES; ';
          $query = $this->db->query($strSQL);

          for($i = $StartIndx ; $i < $EndIndx ; $i++){

            $strSQL3 = "SELECT PATH_ID, PATH_STTN_ID
                        FROM live_lines, karter.lines, paths
                        WHERE LVLN_LINE_ID = LINE_ID
                        AND   PATH_INDX = {$i}
                        AND   PATH_LINE_ID = LINE_ID
                        AND   LVLN_ID = " . $LiveLineID;
            $query = $this->db->query($strSQL3);
            $PathID = $query->result_array()[0]['PATH_ID'];
            $StationID = $query->result_array()[0]['PATH_STTN_ID'];

            $strSQL = "INSERT INTO stationtickets (STTK_STTN_ID, STTK_TRTK_ID, STTK_CLNT_ID,
                                                   STTK_LVLN_ID, STTK_PATH_ID, STTK_INDX)
                      VALUES (?,?,?,?,?,?) ; ";
           $query = $this->db->query($strSQL,array($StationID, $TravelticketID, $ClientID, $LiveLineID, $PathID, $i));

          }
          $strSQL = "INSERT INTO Balance_log (BLOG_CHNG, BLOG_DATE, BLOG_CLNT_ID, BLOG_CMMT)
                     VALUES (?, NOW() , ?, ?)";
          $query = $this->db->query($strSQL, array($Price, $ClientID, 'User subscribed Ticket ' . $TravelticketID));

          $this->db->trans_complete();
          return array ('0' => $this->db->trans_status(),  'ID' => $TravelticketID);


//test this function
        }

        public function editTravelTicket($ID, $ClientID, $LiveLineID, $StartIndx, $EndIndx, $isCancelled, $isPaid, $Price, $isHandi, $NoofTickets){
            //NN LiveLineID BusID Name LineID
          $strSQL = "UPDATE traveltickets
                    SET TRTK_CLNT_ID   = ?, TRTK_LVLN_ID  = ?, TRTK_START_INDX = ?, TRTK_END_INDX  = ?,
                        TRTK_CANC   = ?, TRTK_PAID   = ?, TRTK_PRICE = ?, TRTK_ISHAND = ?, TRTK_SEATS = ?
                    WHERE  `TRTK_ID`= ?";

          $inputs = array($ClientID, $LiveLineID, $StartIndx, $EndIndx, $isCancelled, $isPaid, $Price, $isHandi, $NoofTickets, $ID);
          $query = $this->db->query($strSQL, $inputs);

        }

        public function deleteTravelTicket($ID){
          $strSQL = "DELETE FROM traveltickets WHERE TRTK_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

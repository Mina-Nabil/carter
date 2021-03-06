<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LiveLines_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getLiveLines(){

          $strSQL = "SELECT LVLN_ID, LVLN_LINE_ID, LVLN_DRVR_ID, LINE_NAME, LVLN_TIME, LVLN_BUS_ID, LVLN_CANC, LVLN_TCKT_PRICE,
                            LVLN_COMP, LVLN_REVN, BUS_NUMBER, BSTP_NAME, DRVR_NAME
                      FROM live_lines, karter.lines, drivers, buses, bustypes
                      WHERE LVLN_LINE_ID = LINE_ID
                      AND LVLN_DRVR_ID = DRVR_ID
                      AND BUS_BSTP_ID = BSTP_ID
                      AND LVLN_TIME < DATE_ADD(NOW(), INTERVAL 2 DAY)
                      AND LVLN_TIME > DATE_ADD(NOW(), INTERVAL -1 DAY)
                      AND LVLN_BUS_ID = BUS_ID
                      ORDER BY LVLN_TIME ";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getLiveLine_byID($ID){

          $strSQL = "SELECT LVLN_ID, LVLN_LINE_ID, LVLN_DRVR_ID, LINE_NAME, LVLN_TIME, LVLN_BUS_ID, LVLN_CANC, LVLN_COMP, LVLN_REVN,
                            BUS_NUMBER, DRVR_NAME, LVLN_TCKT_PRICE, BSTP_NAME
                    FROM live_lines, karter.lines, drivers, buses, bustypes
                    WHERE LVLN_LINE_ID = LINE_ID
                    AND LVLN_DRVR_ID = DRVR_ID
                    AND DRVR_BSTP_ID = BSTP_ID
                    AND LVLN_BUS_ID = BUS_ID AND LVLN_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        private function refreshLineRevenue($LiveLineID){
          $strSQL = "UPDATE live_lines
                     SET LVLN_REVN = (SELECT SUM(TRTK_PRICE) FROM traveltickets WHERE TRTK_LVLN_ID = t1.LVLN_ID AND TRTK_isARRV = 5 AND TRTK_PAID = 1)
                     WHERE LVLN_ID = {$LiveLineID}";
          $query = $this->db->query($strSQL);
          return ;
        }


        public function setTripCompleted($LiveLineID){
          $strSQL = "UPDATE live_lines SET
                      LVLN_COMP = 1
                      WHERE  `LVLN_ID`= {$LiveLineID}";

          $query = $this->db->query($strSQL);
          $this->refreshLineRevenue($LiveLineID);
          return ;
        }

        public function setTripStarted($LiveLineID){
          $strSQL = "UPDATE live_lines SET
                      LVLN_COMP = 2
                      WHERE  `LVLN_ID`= {$LiveLineID}";

          $query = $this->db->query($strSQL);
          return;
        }

        public function getTripStatus($ID){

          $strSQL = "SELECT LVLN_COMP
                    FROM live_lines
                    WHERE LVLN_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getDriverTripsPerDay($DriverID, $Date){
          $strSQL ="SELECT Count(*) as Trips FROM live_lines
                    WHERE LVLN_DRVR_ID = ?
                    AND   DATE(?) = DATE(LVLN_TIME)";
          $query = $this->db->query($strSQL, array($DriverID, $Date));
          return $query->result_array;
        }

        public function getTicketPricebyID($ID){

          $strSQL = "SELECT LVLN_TCKT_PRICE
                    FROM live_lines
                    WHERE LVLN_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array()[0]['LVLN_TCKT_PRICE'];

        }

        public function setRevenue($ID, $Revn){
          $strSQL = "UPDATE live_lines
                    SET  LVLN_REVN = ?
                    WHERE  `LVLN_ID`=?";

          $inputs = array($Revn, $ID);
          $query = $this->db->query($strSQL, $inputs);
        }

        public function updateRevenue($LineID){
          $strSQL= "SELECT SUM(TRTK_PRICE) as tt
                    FROM traveltickets
                    WHERE TRTK_LVLN_ID = ?
                    AND TRTK_PAID = 1";

          $query = $this->db->query($strSQL, array($LineID));
          $Revn = $query->result_array()[0]['tt'];
          $this->setRevenue($LineID, $Revn);

        }

        public function getAvailableLines($LineID, $StartSttn, $EndSttn){
          $strSQL = "SELECT LVLN_ID, LVLN_TIME, LVLN_LINE_ID as LineID, PATH_REL_TIME, PATH_INDX, STTN_NAME,
                            LVLN_TCKT_PRICE, LVLN_DRVR_ID, DRVR_NAME, DRVR_IMG, BUS_NUMBER, BSTP_NAME, DRVR_MOB
                     FROM live_lines, karter.lines, paths, stations, drivers, buses, bustypes
                     WHERE LVLN_LINE_ID = {$LineID}
                     AND LVLN_TIME > NOW()
                     AND LVLN_CANC = 0
                     AND LVLN_LINE_ID = LINE_ID
                     AND LVLN_TIME < DATE_ADD(NOW(), INTERVAL 1 DAY)
                     AND LVLN_DRVR_ID = DRVR_ID
                     AND LVLN_BUS_ID = BUS_ID
                     AND PATH_STTN_ID = STTN_ID
                     AND LINE_ID = PATH_LINE_ID
                     AND DRVR_BSTP_ID = BSTP_ID
                     AND PATH_INDX >= (SELECT PATH_INDX FROM paths WHERE PATH_LINE_ID = {$LineID} AND PATH_STTN_ID = {$StartSttn})
                     AND PATH_INDX <= (SELECT PATH_INDX FROM paths WHERE PATH_LINE_ID = {$LineID} AND PATH_STTN_ID = {$EndSttn})
                     AND LVLN_COMP = 0
                     ORDER BY LineID ASC, PATH_INDX ASC, LVLN_TIME ASC";

          $query = $this->db->query($strSQL);
          $livelines = $query->result_array();
          $adjustedArray = array();
          $adjustedArray['LineIDs'] = array();
          foreach ($livelines as $row) {

            if(isset($adjustedArray['FullLines'][$row['LVLN_ID']])){
              array_push($adjustedArray['FullLines'][$row['LVLN_ID']]['Stations'], array('Index' => $row['PATH_INDX'],
                                                                    'Sttn' => $row['STTN_NAME'],
                                                                    'MinutesFromStart'=>$row['PATH_REL_TIME']));

            }
            else {

            $obj = array(
              'LiveLineID' => $row['LVLN_ID'],
              'StartTime' => $row['LVLN_TIME'],
              'DriverName' => $row['DRVR_NAME'],
              'DriverImg' => $row['DRVR_IMG'],
              'BusNumber' => $row['BUS_NUMBER'],
              'DriverMob' => $row['DRVR_MOB'],
              'DriverID' => $row['LVLN_DRVR_ID'],
              'BusType' => $row['BSTP_NAME'],
              'Price' => $row['LVLN_TCKT_PRICE'],
              'Stations' =>  array()  ,
            );

            array_push($obj['Stations'], array ('Index' => $row['PATH_INDX'],
                                                'Sttn' => $row['STTN_NAME'],
                                                'MinutesFromStart'=>$row['PATH_REL_TIME']));


            array_push($adjustedArray['LineIDs'], $row['LVLN_ID']);

            $adjustedArray['FullLines'][$row['LVLN_ID']] = $obj;
          }
        }

        return $adjustedArray;

        }

        public function getLineReport($DriverID, $StartDate, $EndDate){
          $strSQL = "SELECT t1.LVLN_ID  , LVLN_TIME, LINE_NAME, DPKG_NAME, DRVR_NAME, LVLN_TCKT_PRICE,
                        (SELECT COUNT(TRTK_ID) FROM traveltickets WHERE TRTK_LVLN_ID = t1.LVLN_ID) as Tickets,
                        (SELECT COUNT(TRTK_ID) FROM traveltickets WHERE TRTK_LVLN_ID = t1.LVLN_ID AND TRTK_CANC = 1) as Tickets_Canc,
                        (SELECT SUM(TRTK_SEATS) FROM traveltickets WHERE TRTK_LVLN_ID = t1.LVLN_ID AND TRTK_isARRV = 5) as Clients_Arr,
                        (SELECT SUM(TRTK_SEATS) FROM traveltickets WHERE TRTK_LVLN_ID = t1.LVLN_ID AND TRTK_CANC = 5) as Clients_Missed,
                        (SELECT SUM(TRTK_PRICE) FROM traveltickets WHERE TRTK_LVLN_ID = t1.LVLN_ID AND TRTK_isARRV = 5) as Paid_total,
                        (SELECT Count(PRUS_ID) FROM promouses WHERE PRUS_LVLN_ID = t1.LVLN_ID ) as Promo_Count,
                        (SELECT SUM(PRUS_VALUE) FROM promouses WHERE PRUS_LVLN_ID = t1.LVLN_ID ) as Promo_total,
                        (SELECT SUM(TRTK_PRICE) FROM traveltickets WHERE TRTK_LVLN_ID = t1.LVLN_ID AND TRTK_isARRV = 5 AND TRTK_PAID = 0) as Paid_Visa,
                        (SELECT SUM(TRTK_PRICE) FROM traveltickets WHERE TRTK_LVLN_ID = t1.LVLN_ID AND TRTK_isARRV = 5 AND TRTK_PAID = 1) as Paid_cash
                     FROM live_lines as t1, drivers, Driverpackages, karter.lines
                     WHERE LVLN_DRVR_ID = DRVR_ID
                     AND   DRVR_DPKG = DPKG_ID
                     AND   LVLN_LINE_ID = LINE_ID
                     AND   LVLN_COMP = 1
                     AND   DRVR_ID = ?
                     AND   LVLN_TIME >= ?
                     AND   LVLN_TIME <= ?";
           $inputs = array($DriverID, $StartDate, $EndDate);
           $query = $this->db->query($strSQL, $inputs);
           return $query->result_array();
        }


        public function insertLiveLine($LineID, $DriverID, $Time, $BusID, $isCancelled, $isCompleted, $Revn, $TicketPrice){
            //NN Time BusID Name LineID
          $strSQL = "INSERT INTO live_lines (LVLN_LINE_ID, LVLN_DRVR_ID, LVLN_TIME, LVLN_BUS_ID, LVLN_CANC, LVLN_COMP, LVLN_REVN, LVLN_TCKT_PRICE)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

          $inputs = array($LineID, $DriverID, $Time, $BusID, $isCancelled, $isCompleted, $Revn, $TicketPrice);
          $query = $this->db->query($strSQL, $inputs);

        }

        public function editLiveLine($ID, $LineID, $DriverID, $Time, $BusID, $isCancelled, $isCompleted, $Revn, $TicketPrice){
            //NN Time BusID Name LineID
          $strSQL = "UPDATE live_lines
                    SET LVLN_LINE_ID   = ?, LVLN_DRVR_ID  = ?, LVLN_TIME = ?, LVLN_BUS_ID  = ?,
                        LVLN_CANC   = ?, LVLN_COMP   = ?, LVLN_REVN = ?, LVLN_TCKT_PRICE = ?
                    WHERE  `LVLN_ID`=?";

          $inputs = array($LineID, $DriverID, $Time, $BusID, $isCancelled, $isCompleted, $Revn, $TicketPrice, $ID);
          $query = $this->db->query($strSQL, $inputs);

        }

        public function deleteLiveLine($ID){
          $strSQL = "DELETE FROM live_lines WHERE LVLN_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drivers_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getDrivers(){

          $strSQL = "SELECT DRVR_ID, DRVR_NAME, DRVR_LICENSE_NO, DRVR_MOB, BSTP_NAME, DRVR_TAG, DRVR_TRKR,
                            DRVR_UNAME, DRVR_IMG, DRVR_PASS, DRVR_BLNC, DRVR_ADRS, DRVR_BSTP_ID, DRVR_ACTV
                      FROM Drivers, bustypes
                      WHERE BSTP_ID = DRVR_BSTP_ID";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getActiveDrivers(){

          $strSQL = "SELECT DRVR_ID, DRVR_NAME, DRVR_LICENSE_NO, DRVR_MOB, BSTP_NAME, DRVR_TAG, DRVR_TRKR,
                            DRVR_UNAME, DRVR_IMG, DRVR_PASS, DRVR_BLNC, DRVR_ADRS, DRVR_BSTP_ID, DRVR_ACTV
                      FROM Drivers, bustypes
                      WHERE BSTP_ID = DRVR_BSTP_ID AND DRVR_ACTV = 1";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getBlockedDrivers(){

          $strSQL = "SELECT DRVR_ID, DRVR_NAME, DRVR_LICENSE_NO, DRVR_MOB, BSTP_NAME, DRVR_TAG, DRVR_TRKR,
                            DRVR_UNAME, DRVR_IMG, DRVR_PASS, DRVR_BLNC, DRVR_ADRS, DRVR_BSTP_ID, DRVR_ACTV
                      FROM Drivers, bustypes
                      WHERE BSTP_ID = DRVR_BSTP_ID AND DRVR_ACTV = 0";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getDriver_byID($ID){

          $strSQL = "SELECT DRVR_ID, DRVR_NAME, DRVR_LICENSE_NO, DRVR_MOB, BSTP_NAME, DRVR_ACTV,
                         DRVR_IMG, DRVR_BLNC, DRVR_ADRS, DRVR_BSTP_ID, DRVR_TAG, BUS_NUMBER, BUS_SEATS
                    FROM Drivers, bustypes, buses
                    WHERE BSTP_ID = DRVR_BSTP_ID
                    AND BUS_DRVR_ID = DRVR_ID
                    AND DRVR_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function setImage($ID, $Image){

          $strSQL = "UPDATE Drivers SET DRVR_IMG = ? WHERE `DRVR_ID`='{$ID}'";
          $query = $this->db->query($strSQL, array($Image));
        }

        public function isLicenseExist($License){

          $strSQL = "SELECT COUNT(*) AS numbers from drivers where DRVR_LICENSE_NO = ?";
          $query = $this->db->query($strSQL, array($License));
          $numCount = $query->result_array()[0]['numbers'];
          if($numCount == 0) return false;
          else return true;
        }

        public function changePass($Email, $Pass){

          $strSQL = "UPDATE drivers SET DRVR_PASS = ? WHERE DRVR_LICENSE_NO= ? ";
          $query = $this->db->query($strSQL, array($Pass, $Email));
          if($query) return 1;
        }

        public function changePassbyID($ID, $Pass){

          $strSQL = "UPDATE drivers SET DRVR_PASS = ? WHERE DRVR_ID = ? ";
          $query = $this->db->query($strSQL, array($Pass, $ID));
          if($query) return 1;
        }

        public function setTag($ID, $Tag){

          $strSQL = "UPDATE drivers SET DRVR_TAG = ? WHERE DRVR_ID = ? ";
          return $this->db->query($strSQL, array($Tag, $ID));

        }

        public function setTracker($ID, $Tracker){

          $strSQL = "UPDATE drivers SET DRVR_TRKR = ? WHERE `DRVR_ID`= ? ";
          return $this->db->query($strSQL, array($Tracker, $ID));

        }


        public function checkDriverbyLicense($License, $Pass){
          $strSQL = "SELECT DRVR_ID from drivers where DRVR_LICENSE_NO = ? AND DRVR_PASS = ?" ;

          $query = $this->db->query($strSQL, array($License, $Pass));
          $result = $query->result_array();
          if(isset($result[0]['DRVR_ID'])) return $result[0]['DRVR_ID'];
         else return false;


        }

        public function checkDriverbyID($ID, $Pass){
          $strSQL = "SELECT DRVR_ID from drivers where DRVR_ID = ? AND DRVR_PASS = ?" ;

          $query = $this->db->query($strSQL, array($ID, $Pass));
          $result = $query->result_array();
          if(isset($result[0]['DRVR_ID'])) return $result[0]['DRVR_ID'];
         else return false;


        }



        public function insertDriver($Name, $LicenseNo, $Mobile, $BustypeID, $DriverName, $Img, $Pass, $Blnc, $Address){

          $strSQL = "INSERT INTO Drivers (DRVR_NAME, DRVR_LICENSE_NO, DRVR_MOB, DRVR_BSTP_ID,
                                          DRVR_UNAME, DRVR_IMG, DRVR_PASS, DRVR_BLNC, DRVR_ADRS)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
          $query = $this->db->query($strSQL, array($Name, $LicenseNo, $Mobile, $BustypeID, $DriverName,
                                                   $Img, $Pass, $Blnc, $Address));

        }

        public function editDriver($ID, $Name, $LicenseNo, $Mobile, $BustypeID, $DriverName, $Img, $Pass, $Blnc, $Address){

          $strSQL = "UPDATE Drivers
                    SET DRVR_NAME   =   ?,
                        DRVR_UNAME  =   ?,
                        DRVR_MOB    =   ?,
                        DRVR_IMG   =   ?,
                        DRVR_PASS   =   ?,
                        DRVR_ADRS   =   ?,
                        DRVR_BLNC   =   ?,
                        DRVR_LICENSE_NO = ?
                    WHERE
                        `DRVR_ID`= ?";
          $query = $this->db->query($strSQL, array($Name, $LicenseNo, $Mobile, $BustypeID, $DriverName,
                                                    $Img, $Pass, $Blnc, $Address, $ID));

        }

        public function blockDriver($ID){
          $strSQL = "UPDATE Drivers
                    SET DRVR_ACTV = 0
                    WHERE
                        `DRVR_ID`= {$ID}";
          $query = $this->db->query($strSQL);
        }

        public function activateDriver($ID){
          $strSQL = "UPDATE Drivers
                    SET DRVR_ACTV = 1
                    WHERE
                        `DRVR_ID`= {$ID}";
          $query = $this->db->query($strSQL);
        }

        public function getActiveLines_ByDriver($DriverID){
          $strSQL = "SELECT LVLN_ID, LVLN_LINE_ID, LVLN_DRVR_ID, LINE_NAME, LINE_ARBC_NAME, LVLN_TIME,
                            LVLN_BUS_ID, LVLN_CANC, LVLN_COMP, DRVR_NAME
                            FROM live_lines, karter.lines, drivers
                            WHERE LVLN_LINE_ID = LINE_ID
                            AND LVLN_DRVR_ID = DRVR_ID
                            AND LVLN_COMP = 0
                            AND LVLN_TIME < DATE_ADD(NOW(), INTERVAL 1 DAY)
                            AND LVLN_TIME > DATE_ADD(NOW(), INTERVAL -1 HOUR)
                            AND DRVR_ID = {$DriverID}
                            ORDER BY LVLN_TIME ";

          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getOldLines_ByDriver($DriverID){
          $strSQL = "SELECT LVLN_ID, LVLN_LINE_ID, LVLN_DRVR_ID, LINE_NAME, LINE_ARBC_NAME, LVLN_TIME,
                            LVLN_BUS_ID, LVLN_CANC, LVLN_COMP, DRVR_NAME
                            FROM live_lines, karter.lines, drivers
                            WHERE LVLN_LINE_ID = LINE_ID
                            AND LVLN_DRVR_ID = DRVR_ID
                            AND LVLN_COMP = 1
                            AND LVLN_TIME > DATE_ADD(NOW(), INTERVAL -14 DAY)
                            AND LVLN_TIME <= NOW()
                            AND DRVR_ID = {$DriverID}
                            ORDER BY LVLN_TIME ";

          $query = $this->db->query($strSQL);
          return $query->result_array();


        }

        public function deleteDriver($ID){
          $strSQL = "DELETE FROM Drivers WHERE DRVR_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

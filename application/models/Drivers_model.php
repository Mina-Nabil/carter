<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drivers_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getDrivers(){

          $strSQL = "SELECT DRVR_ID, DRVR_NAME, DRVR_LICENSE_NO, DRVR_MOB, BSTP_NAME,
                            DRVR_UNAME, DRVR_IMG, DRVR_PASS, DRVR_BLNC, DRVR_ADRS, DRVR_BSTP_ID, DRVR_ACTV
                      FROM Drivers, bustypes
                      WHERE BSTP_ID = DRVR_BSTP_ID";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getActiveDrivers(){

          $strSQL = "SELECT DRVR_ID, DRVR_NAME, DRVR_LICENSE_NO, DRVR_MOB, BSTP_NAME,
                            DRVR_UNAME, DRVR_IMG, DRVR_PASS, DRVR_BLNC, DRVR_ADRS, DRVR_BSTP_ID, DRVR_ACTV
                      FROM Drivers, bustypes
                      WHERE BSTP_ID = DRVR_BSTP_ID AND DRVR_ACTV = 1";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getBlockedDrivers(){

          $strSQL = "SELECT DRVR_ID, DRVR_NAME, DRVR_LICENSE_NO, DRVR_MOB, BSTP_NAME,
                            DRVR_UNAME, DRVR_IMG, DRVR_PASS, DRVR_BLNC, DRVR_ADRS, DRVR_BSTP_ID, DRVR_ACTV
                      FROM Drivers, bustypes
                      WHERE BSTP_ID = DRVR_BSTP_ID AND DRVR_ACTV = 0";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getDriver_byID($ID){

          $strSQL = "SELECT DRVR_ID, DRVR_NAME, DRVR_LICENSE_NO, DRVR_MOB, BSTP_NAME, DRVR_ACTV,
                            DRVR_UNAME, DRVR_IMG, DRVR_PASS, DRVR_BLNC, DRVR_ADRS, DRVR_BSTP_ID
                    FROM Driversbustypes
                    WHERE BSTP_ID = DRVR_BSTP_ID AND DRVR_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function setImage($ID, $Image){

          $strSQL = "UPDATE Drivers SET DRVR_IMG = '{$Image}' WHERE `DRVR_ID`='{$ID}'";
          $query = $this->db->query($strSQL);
        }


        public function insertDriver($Name, $LicenseNo, $Mobile, $BustypeID, $UserName, $Img, $Pass, $Blnc, $Address){

          $strSQL = "INSERT INTO Drivers (DRVR_NAME, DRVR_LICENSE_NO, DRVR_MOB, DRVR_BSTP_ID,
                                          DRVR_UNAME, DRVR_IMG, DRVR_PASS, DRVR_BLNC, DRVR_ADRS)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
          $query = $this->db->query($strSQL, array($Name, $LicenseNo, $Mobile, $BustypeID, $UserName,
                                                   $Img, $Pass, $Blnc, $Address));

        }

        public function editDriver($ID, $Name, $LicenseNo, $Mobile, $BustypeID, $UserName, $Img, $Pass, $Blnc, $Address){

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
          $query = $this->db->query($strSQL, array($Name, $LicenseNo, $Mobile, $BustypeID, $UserName,
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

        public function deleteDriver($ID){
          $strSQL = "DELETE FROM Drivers WHERE DRVR_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drivers_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getDrivers(){

          $strSQL = "SELECT DRVR_ID, DRVR_NAME, DRVR_LICENSE_NO, DRVR_MOB,
                            DRVR_UNAME, DRVR_IMG, DRVR_PASS, DRVR_BLNC, DRVR_ADRS
                      FROM Drivers";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getDriver_byID($ID){

          $strSQL = "SELECT DRVR_ID, DRVR_NAME, DRVR_LICENSE_NO, DRVR_MOB,
                            DRVR_UNAME, DRVR_IMG, DRVR_PASS, DRVR_BLNC, DRVR_ADRS
                    FROM Drivers WHERE DRVR_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function setImage($ID, $Image){

          $strSQL = "UPDATE Drivers SET DRVR_IMG = '{$Image}' WHERE `DRVR_ID`='{$ID}'";
          $query = $this->db->query($strSQL);
        }


        public function insertDriver($Name, $LicenseNo, $Mobile, $UserName, $Img, $Pass, $Blnc, $Address){

          $strSQL = "INSERT INTO Drivers (DRVR_NAME, DRVR_LICENSE_NO, DRVR_MOB,
                                          DRVR_UNAME, DRVR_IMG, DRVR_PASS, DRVR_BLNC, DRVR_ADRS)
                     VALUES ('{$Name}', '{$LicenseNo}', '{$Mobile}', '{$UserName}', '{$Img}', '{$Pass}', '{$Blnc}', '{$Address}')";
          $query = $this->db->query($strSQL);

        }

        public function editDriver($ID, $Name, $LicenseNo, $Mobile, $UserName, $Img, $Pass, $Blnc, $Address){

          $strSQL = "UPDATE Drivers
                    SET DRVR_NAME   = '{$Name}',
                        DRVR_UNAME  = '{$UserName}',
                        DRVR_MOB    = '{$Mobile}',
                        DRVR_IMG   = '{$Img}',
                        DRVR_PASS   = '{$Pass}',
                        DRVR_ADRS   = '{$Address}',
                        DRVR_BLNC   = '{$Blnc}',
                        DRVR_LICENSE_NO ='{$LicenseNo}'
                    WHERE
                        `DRVR_ID`='{$ID}'";
          $query = $this->db->query($strSQL);

        }

        public function deleteDriver($ID){
          $strSQL = "DELETE FROM Drivers WHERE DRVR_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

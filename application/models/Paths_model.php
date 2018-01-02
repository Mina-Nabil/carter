<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paths_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getPaths($LineID){

          $strSQL = "SELECT PATH_ID, PATH_LINE_ID, PATH_INDX, PATH_REL_TIME, PATH_STTN_ID, DIST_NAME,
                            LINE_NAME, STTN_ADRS, STTN_NAME
                      FROM Paths, karter.lines, stations, districts
                      WHERE PATH_LINE_ID = LINE_ID AND STTN_ID = PATH_STTN_ID AND STTN_DIST_ID = DIST_ID
                      AND LINE_ID = {$LineID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getPath_byLineID($LineID){

          $strSQL = "SELECT PATH_ID, PATH_LINE_ID, PATH_INDX, PATH_REL_TIME, PATH_STTN_ID
                    FROM Paths WHERE PATH_LINE_ID = {$LineID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertPath($LineID, $Index, $RelativeTime, $StationID){
            //NN Index RelativeTime Name LineID
          $strSQL = "INSERT INTO Paths (PATH_LINE_ID, PATH_INDX, PATH_REL_TIME, PATH_STTN_ID)
                     VALUES ( '{$LineID}', '{$Index}', '{$RelativeTime}', '{$StationID}')";
          $query = $this->db->query($strSQL);

        }


        public function deletePath($ID){
          $strSQL = "DELETE FROM Paths WHERE PATH_LINE_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

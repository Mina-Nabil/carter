<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lines_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getLines(){

          $strSQL = "SELECT LINE_ID, LINE_NAME, LINE_DESC, LINE_TAGS
                      FROM karter.lines";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getLinesByDistrict($DistrictID){

          $strSQL = "SELECT LINE_ID, LINE_NAME, LINE_DESC, LINE_TAGS,
                            DIST_NAME AS START_DIST_NAME,
                            STTN_NAME AS START_STTN_NAME
                      FROM karter.lines, districts, paths, stations
                      WHERE PATH_LINE_ID = LINE_ID
                      AND PATH_STTN_ID = STTN_ID
                      AND STTN_DIST_ID = DIST_ID
                      AND DIST_ID      = " . $DistrictID;

          $query = $this->db->query($strSQL);
          $res1  = $query->result_array();

          $strSQL = "SELECT l1.LINE_ID,
                            DIST_NAME as END_DIST_NAME, CITY_NAME as END_CITY_NAME,
                            STTN_NAME as END_STTN_NAME
                      FROM karter.lines as l1, districts, cities, paths, stations
                      WHERE PATH_LINE_ID = LINE_ID
                      AND PATH_STTN_ID = STTN_ID
                      AND STTN_DIST_ID = DIST_ID
                      AND DIST_CITY_ID = CITY_ID
                      AND PATH_INDX = (SELECT MAX(PATH_INDX) FROM paths, karter.lines
                                       WHERE PATH_LINE_ID = LINE_ID
                                       AND LINE_ID = l1.LINE_ID);";

          $query2 = $this->db->query($strSQL);
          $res2   = $query2->result_array();

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

        }

        public function getHomeLines(){

          $strSQL = "SELECT LINE_ID, LINE_NAME, LINE_DESC, LINE_TAGS,
                            DIST_NAME AS START_DIST_NAME, CITY_NAME AS START_CITY_NAME,
                            STTN_NAME AS START_STTN_NAME
                      FROM karter.lines, districts, cities, paths, stations
                      WHERE PATH_LINE_ID = LINE_ID
                      AND PATH_STTN_ID = STTN_ID
                      AND STTN_DIST_ID = DIST_ID
                      AND DIST_CITY_ID = CITY_ID
                      AND PATH_INDX = 0";
          $query = $this->db->query($strSQL);
          $res1  = $query->result_array();

          $strSQL = "SELECT l1.LINE_ID,
                            DIST_NAME as END_DIST_NAME, CITY_NAME as END_CITY_NAME,
                            STTN_NAME as END_STTN_NAME
                      FROM karter.lines as l1, districts, cities, paths, stations
                      WHERE PATH_LINE_ID = LINE_ID
                      AND PATH_STTN_ID = STTN_ID
                      AND STTN_DIST_ID = DIST_ID
                      AND DIST_CITY_ID = CITY_ID
                      AND PATH_INDX = (SELECT MAX(PATH_INDX) FROM paths, karter.lines
                                       WHERE PATH_LINE_ID = LINE_ID
                                       AND LINE_ID = l1.LINE_ID);";

          $query2 = $this->db->query($strSQL);
          $res2   = $query2->result_array();

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

        }

        public function getLine_byID($ID){

          $strSQL = "SELECT LINE_ID, LINE_NAME, LINE_DESC, LINE_TAGS
                    FROM karter.lines
                    WHERE LINE_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertLine($Name, $Desc, $Tags ){
            //NN Latitude Longitude Name DistrictID
          $strSQL = "INSERT INTO karter.lines (LINE_NAME, LINE_DESC, LINE_TAGS)
                     VALUES ('{$Name}', '{$Desc}', '{$Tags}')";
          $query = $this->db->query($strSQL);

        }

        public function editLine($ID, $Name, $Desc, $Tags){
            //NN Latitude Longitude Name DistrictID
          $strSQL = "UPDATE karter.lines
                    SET LINE_NAME         = '{$Name}',
                        LINE_DESC         = '{$Desc}',
                        LINE_TAGS         ='{$Tags}'
                    WHERE
                        `LINE_ID`='{$ID}'";
          $query = $this->db->query($strSQL);

        }

        public function deleteLine($ID){
          $strSQL = "DELETE FROM Lines WHERE LINE_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

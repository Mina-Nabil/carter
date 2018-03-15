<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lines_model extends CI_Model{

        public function __construct()
        {
          parent::__construct();
          //Codeigniter : Write Less Do More
        }

        public function getLines(){

          $strSQL = "SELECT LINE_ID, LINE_NAME, LINE_ARBC_NAME, LINE_DESC, LINE_TAGS
                      FROM karter.lines";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getSummarizedLines(){

          $strSQL = "SELECT LINE_ID, LINE_NAME, LINE_ARBC_NAME, LINE_TAGS
                      FROM karter.lines";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }

        public function getLinesByDistrict($DistrictID){



          $strSQL = "SELECT LINE_ID
                      FROM karter.lines, districts, paths, stations
                      WHERE DIST_ID = {$DistrictID}
                      AND PATH_STTN_ID = STTN_ID
                      AND STTN_DIST_ID = DIST_ID
                      AND PATH_LINE_ID = LINE_ID
                      ORDER BY LINE_ID;";

          $query = $this->db->query($strSQL);
          $lineres  = $query->result_array();
          $lines = array();
          foreach($lineres as $row){
            array_push($lines, $row['LINE_ID']);
          }

          $strSQL = "SELECT LINE_ID, LINE_NAME, LINE_ARBC_NAME, LINE_DESC, LINE_TAGS,
                            DIST_NAME AS START_DIST_NAME, CITY_NAME AS START_CITY_NAME,
                            STTN_NAME AS START_STTN_NAME, STTN_ADRS as START_STTN_ADRS
                      FROM karter.lines, districts, cities, paths, stations
                      WHERE PATH_LINE_ID = LINE_ID
                      AND PATH_STTN_ID = STTN_ID
                      AND STTN_DIST_ID = DIST_ID
                      AND DIST_CITY_ID = CITY_ID
                      AND LINE_ID IN ?
                      AND PATH_INDX = 0
                      ORDER BY LINE_ID;";
          $query = $this->db->query($strSQL, array($lines));
          $res1  = $query->result_array();

          $strSQL = "SELECT l1.LINE_ID,
                            DIST_NAME as END_DIST_NAME, CITY_NAME as END_CITY_NAME,
                            STTN_NAME as END_STTN_NAME,
                            STTN_ADRS as END_STTN_ADRS
                      FROM karter.lines as l1, districts, cities, paths, stations
                      WHERE PATH_LINE_ID = LINE_ID
                      AND PATH_STTN_ID = STTN_ID
                      AND STTN_DIST_ID = DIST_ID
                      AND LINE_ID IN ?
                      AND DIST_CITY_ID = CITY_ID
                      AND PATH_INDX = (SELECT MAX(PATH_INDX) FROM paths, karter.lines
                                       WHERE PATH_LINE_ID = LINE_ID
                                       AND LINE_ID = l1.LINE_ID)
                       ORDER BY LINE_ID;";

          $query2 = $this->db->query($strSQL, array($lines));
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

        public function getFullLinesByID($LineID){

          $strSQL = "SELECT LINE_ID, LINE_NAME, LINE_ARBC_NAME, LINE_DESC,
                            DIST_NAME AS START_DIST_NAME, CITY_NAME AS START_CITY_NAME,
                            STTN_NAME AS START_STTN_NAME, STTN_ADRS as START_STTN_ADRS
                      FROM karter.lines, districts, cities, paths, stations
                      WHERE PATH_LINE_ID = LINE_ID
                      AND PATH_STTN_ID = STTN_ID
                      AND STTN_DIST_ID = DIST_ID
                      AND DIST_CITY_ID = CITY_ID
                      AND LINE_ID = ?
                      AND PATH_INDX = 0
                      ORDER BY LINE_ID;";
          $query = $this->db->query($strSQL, array($LineID));
          $res1  = $query->result_array();

          $strSQL = "SELECT l1.LINE_ID,
                            DIST_NAME as END_DIST_NAME, CITY_NAME as END_CITY_NAME,
                            STTN_NAME as END_STTN_NAME,
                            STTN_ADRS as END_STTN_ADRS
                      FROM karter.lines as l1, districts, cities, paths, stations
                      WHERE PATH_LINE_ID = LINE_ID
                      AND PATH_STTN_ID = STTN_ID
                      AND STTN_DIST_ID = DIST_ID
                      AND LINE_ID = ?
                      AND DIST_CITY_ID = CITY_ID
                      AND PATH_INDX = (SELECT MAX(PATH_INDX) FROM paths, karter.lines
                                       WHERE PATH_LINE_ID = LINE_ID
                                       AND LINE_ID = l1.LINE_ID)
                       ORDER BY LINE_ID;";

          $query2 = $this->db->query($strSQL, array($LineID));
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

        public function getLinesByArray($LinesArray){

          $IDs = array();

          foreach($LinesArray as $row){
            array_push($IDs, $row['LINE_ID']);
          }

          if(sizeof($IDs) == 0){
            return array();
          }

          $strSQL = "SELECT LINE_ID, LINE_NAME, LINE_ARBC_NAME, LINE_DESC, LINE_TAGS,
                            DIST_NAME AS START_DIST_NAME, CITY_NAME AS START_CITY_NAME,
                            STTN_NAME AS START_STTN_NAME, STTN_ADRS as START_STTN_ADRS
                      FROM karter.lines, districts, cities, paths, stations
                      WHERE PATH_LINE_ID = LINE_ID
                      AND PATH_STTN_ID = STTN_ID
                      AND STTN_DIST_ID = DIST_ID
                      AND DIST_CITY_ID = CITY_ID
                      AND LINE_ID IN ?
                      AND PATH_INDX = 0
                      ORDER BY LINE_ID;";
          $query = $this->db->query($strSQL, array($IDs));
          $res1  = $query->result_array();

          $strSQL = "SELECT l1.LINE_ID,
                            DIST_NAME as END_DIST_NAME, CITY_NAME as END_CITY_NAME,
                            STTN_NAME as END_STTN_NAME,
                            STTN_ADRS as END_STTN_ADRS
                      FROM karter.lines as l1, districts, cities, paths, stations
                      WHERE PATH_LINE_ID = LINE_ID
                      AND PATH_STTN_ID = STTN_ID
                      AND STTN_DIST_ID = DIST_ID
                      AND LINE_ID IN ?
                      AND DIST_CITY_ID = CITY_ID
                      AND PATH_INDX = (SELECT MAX(PATH_INDX) FROM paths, karter.lines
                                       WHERE PATH_LINE_ID = LINE_ID
                                       AND LINE_ID = l1.LINE_ID)
                       ORDER BY LINE_ID;";

          $query2 = $this->db->query($strSQL, array($IDs));
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

          $strSQL = "SELECT l1.LINE_ID, LINE_NAME, LINE_ARBC_NAME, LINE_DESC, LINE_TAGS,
                            DIST_NAME AS START_DIST_NAME, CITY_NAME AS START_CITY_NAME,
                            STTN_NAME AS START_STTN_NAME
                      FROM karter.lines as l1, districts, cities, paths, stations
                      WHERE PATH_LINE_ID = LINE_ID
                      AND PATH_STTN_ID = STTN_ID
                      AND STTN_DIST_ID = DIST_ID
                      AND DIST_CITY_ID = CITY_ID
                      AND PATH_INDX = (SELECT MIN(PATH_INDX) FROM paths, karter.lines
                                       WHERE PATH_LINE_ID = LINE_ID
                                       AND LINE_ID = l1.LINE_ID)
                       ORDER BY LINE_ID;";

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
                                       AND LINE_ID = l1.LINE_ID)
                      ORDER BY LINE_ID;";

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

          $strSQL = "SELECT LINE_ID, LINE_NAME, LINE_ARBC_NAME, LINE_DESC, LINE_TAGS
                    FROM karter.lines
                    WHERE LINE_ID = {$ID}";
          $query = $this->db->query($strSQL);
          return $query->result_array();

        }


        public function insertLine($Name, $ArbcName, $Desc, $Tags ){
            //NN Latitude Longitude Name DistrictID
          $strSQL = "INSERT INTO karter.lines (LINE_NAME, LINE_ARBC_NAME, LINE_DESC, LINE_TAGS)
                     VALUES (?, ?, ?, ?)";

          $query = $this->db->query($strSQL, array($Name, $ArbcName, $Desc, $Tags));

        }

        public function editLine($ID, $Name, $ArbcName, $Desc, $Tags){
            //NN Latitude Longitude Name DistrictID
          $strSQL = "UPDATE karter.lines
                    SET LINE_NAME         = ?,
                        LINE_ARBC_NAME    = ?,
                        LINE_DESC         = ?,
                        LINE_TAGS         =?
                    WHERE
                        `LINE_ID`=?";

          $query = $this->db->query($strSQL, array($Name, $ArbcName, $Desc, $Tags, $ID));

        }

        public function deleteLine($ID){
          $strSQL = "DELETE FROM Lines WHERE LINE_ID = {$ID}";
          $query = $this->db->query($strSQL);
        }

}

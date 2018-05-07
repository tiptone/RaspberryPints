<?php
require_once __DIR__.'/../models/beerStyle.php';

class BeerStyleManager{
    var $db;
    
    function __construct()
    {
        global $rplink;
        
        $this->db = $rplink;
    }

	function GetAll(){
		$sql="SELECT * FROM beerStyles ORDER BY name";
		$result = mysqli_query($this->db, $sql);
		
		$beerStyles = array();
		//while($i = mysql_fetch_array($qry)){
		while ($i = $result->fetch_array(MYSQLI_ASSOC)) {
			$beerStyle = new beerStyle();
			$beerStyle->setFromArray($i);
			$beerStyles[$beerStyle->get_id()] = $beerStyle;		
		}
		
		return $beerStyles;
	}
	
	
		
	function GetById($id){
		$sql="SELECT * FROM beerStyles WHERE id = $id";
		$result = mysqli_query($this->db, $sql);
		
		//if( $i = mysql_fetch_array($qry) ){
		if ($i = $result->fetch_array(MYSQLI_ASSOC)) {
			$beerStyle = new beerStyle();
			$beerStyle->setFromArray($i);
			return $beerStyle;
		}

		return null;
	}
}
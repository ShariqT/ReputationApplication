<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}


	public function deleteHotel($id)
	{
		$this->db->delete('hotel', array('id' => $id));
		return true;
	}


	public function getHotelRSS($id)
	{
		$this->db->select('hotel_rss');
		$this->db->from('hotel');
		$this->db->where('id', $id);
		$query = $this->db->get();
		foreach($query->result() as $obj){
			$returnedValue = $obj->hotel_rss;
		}
		
		return $returnedValue;
	}
	
	
	public function getOrbitzRSS($id)
	{
		$this->db->select('orbitz_url');
		$this->db->from('hotel');
		$this->db->where('id', $id);
		$query = $this->db->get();
		foreach($query->result() as $obj){
			$returnedValue = $obj->orbitz_url;
		}
		
		return $returnedValue;
	}
	
	
	public function getPricelineRSS($id)
	{
		$this->db->select('priceline_url');
		$this->db->from('hotel');
		$this->db->where('id', $id);
		$query = $this->db->get();
		foreach($query->result() as $obj){
			$returnedValue = $obj->priceline_url;
		}
		
		return $returnedValue;
	}
	
	
	
	
	
	
	public function getHotelList()
	{
		$this->db->select('hotel.id, hotel_name, mgt_name');
		$this->db->from('hotel');
		$this->db->join('mgtcompany', 'mgtcompany.id = hotel.mgt_id');
		$query = $this->db->get();
		$i = 0;
		foreach($query->result() as $obj){
			$returnedArray[$i]['hotel_name'] = $obj->hotel_name;
			$returnedArray[$i]['id'] = $obj->id;
			$returnedArray[$i]['mgt_name'] = $obj->mgt_name;
			$i++;
		}
		
		return $returnedArray;
	}
	
	public function parseHotelInfo($url)
	{
		$doc = simplexml_load_file($url);
		$returnedArray['title'] = str_replace(' Feed', ' Reviews', substr($doc->channel->title, 22));
		$returnedArray['link'] = $doc->channel->link;
		
		return $returnedArray;
	}
	
	
	public function parseHotelReviews($url)
	{
		$doc = simplexml_load_file($url);
		$doc->registerXPathNamespace('dc', 'http://purl.org/dc/elements/1.1/');
		$i = 0;
		foreach($doc->channel->item as $review){
			$returnedArray[$i]['title'] = $review->title;
			$returnedArray[$i]['description'] = substr($review->description, 52);
			$returnedArray[$i]['link'] = $review->link;
			preg_match('/(?P<name>\w+)\_(?P<last>\w+)/',$review->link, $match);
			$returnedArray[$i]['hotelname'] = str_replace('_', ' ', $match['name']). " " .$match['last'];
			preg_match('/(?P<rating>\d+)/', $review->description, $match2);
			$returnedArray[$i]['rating'] = $match2[0];
			$date = $review->xpath('dc:date');
			$returnedArray[$i]['date'] = substr($date[0], 0, 10);
			$i++;
		}
		
		return $returnedArray;
	}
	
	
	
	public function getOrbitzURLInfo($hotel_url)
	{
		$r = array();
		$contents = file_get_contents($hotel_url);
		$hotelData = mb_convert_encoding($contents, 'HTML-ENTITIES','UTF-8');
		libxml_use_internal_errors(true);
		
		$doc = new DOMDocument();
		$doc->loadHTML($hotelData);
		$xpath = new DOMXPath($doc);
		$reviews = $xpath->query("//*[@class='userReview hreview ']");
		$i = 0;
		foreach($reviews as $review){
			$r[$i]['hotel_name'] = $xpath->query("div[@class='offscreen item']/span[@class='fn']", $review)->item(0)->nodeValue;
			$r[$i]['summary'] = $xpath->query("div[@class='review']/p", $review)->item(0)->nodeValue;
			$r[$i]['title'] = $xpath->query("h3", $review)->item(0)->nodeValue;
			$r[$i]['score'] = trim($xpath->query("div[@class='reviewDetails']/div[@class='userReviewScore']", $review)->item(0)->nodeValue);
			$r[$i]['recommended'] = trim($xpath->query("div[@class='reviewDetails']/div[@class='recommended']/p", $review)->item(0)->nodeValue);
			$r[$i]['date'] = $xpath->query("div[@class='reviewDetails']/abbr", $review)->item(0)->getAttribute('title');
			$i++;
		}
		
		return $r;
	}
	
	
	
	public function getPricelineURLInfo($hotel_url)
	{
		
		
		$r = array();
		//these two lines take out the jsk url parameter; this makes the url ever greena not tied to a session
		preg_match('/&jsk=(?P<c>\w+)/', $hotel_url, $matches);
		$hotel_url = str_replace($matches[0], '', $hotel_url);
		
		$contents = file_get_contents($hotel_url);
		$hotelData = mb_convert_encoding($contents, 'HTML-ENTITIES','UTF-8');
		libxml_use_internal_errors(true);
		
		$doc = new DOMDocument();
		$doc->loadHTML($hotelData);
		$xpath = new DOMXPath($doc);
		$review = $xpath->query("//div[@class='review']");
		$i = 0;
		foreach($review as $rev){
			$a = $xpath->query("div[@class='reviewer_info']", $rev);
			foreach ($a as $b){
				$innerHtml = '';
				$children = $b->childNodes;
				foreach ($children as $child){
					$tmp_doc = new DOMDocument();
					$tmp_doc->appendChild($tmp_doc->importNode($child, true));
					$innerHtml .= $tmp_doc->saveHTML();
				}
			}
			
			preg_match('/(?P<month>\w+) (?P<day>\d+), (?P<year>\d+)/', $innerHtml, $matches2);
			preg_match('/[A-Za-z]+ from [A-Za-z ]+, [A-Za-z]+/', $innerHtml, $matches3);
			preg_match_all('/[A-Za-z]+ [a-z]+ [A-Za-z]+/', $innerHtml, $matches4);
			$r[$i]['review_name'] = $matches3[0];
			$r[$i]['review_travel_type'] = $matches4;
			$r[$i]['reviewer'] = trim($innerHtml);
			$r[$i]['date'] = $this->formatTheDate($matches2);
			$score_string = $xpath->query("div[@class='reviewer_score']", $rev)->item(0)->nodeValue;
			 $dot_position = strrpos($score_string, ".");
			$r[$i]['review_score'] = substr_replace($score_string, '', $dot_position);
			$testPos = $xpath->query("div[@class='review_positive']", $rev);
			
			if($testPos != NULL || $testPos != FALSE ){
				$r[$i]['review_positive'] = $xpath->query("div[@class='review_positive']", $rev)->item(0)->nodeValue;
			}else{
				$r[$i]['review_positive'] = 'No positive comments.';
			}
			
			$testNeg = $xpath->query("div[@class='review_negative']", $rev);
			
			if($testNeg !== NULL || $testNeg !== FALSE ){
				$r[$i]['review_negative'] = $xpath->query("div[@class='review_negative']", $rev)->item(0)->nodeValue;
			}else{
				$r[$i]['review_negative'] = 'No negative comments.';
			}
			
			$i++;
		}
	
		return $r;
	}
	
	
	
	public function getTripAdvisorURLInfo($hotel_url)
	{
		$contents = file_get_contents($hotel_url);
		$hotelData = mb_convert_encoding($contents, 'HTML-ENTITIES','UTF-8');
		libxml_use_internal_errors(true);
		
		$doc = new DOMDocument();
		$doc->loadHTML($hotelData);
		$xpath = new DOMXPath($doc);
		$hotel_rss = $xpath->query("//head/link[2]");
		$hotel_name = $xpath->query("//h1[@id='HEADING']");
		$url =  $hotel_rss->item(0)->getAttribute('href');
		$name = $hotel_name->item(0)->nodeValue;
		$returnedArray['url'] = $url;
		$returnedArray['name'] = $name;
		return $returnedArray;
	
	}
	
	public function getExpediaURLInfo($hotel_url)
	{
		$r = array();
		$contents = file_get_contents($hotel_url);
		$hotelData = mb_convert_encoding($contents, 'HTML-ENTITIES','UTF-8');
		libxml_use_internal_errors(true);
		
		$doc = new DOMDocument();
		$doc->loadHTML($hotelData);
		$xpath = new DOMXPath($doc);
		$reviews_text = $xpath->query("//div[@id='hotel-infosite-reviews']/div[2]/div/div/div[2]/p[2]");
		$reviews_title = $xpath->query("//div[@id='hotel-infosite-reviews']/div[2]/div/div/div[2]/p[1]");
		
		for($i = 0; $i < $reviews_title->length; $i++){
			$r[$i]['text'] = $reviews_text->item($i)->nodeValue;
			$r[$i]['title'] = $reviews_title->item($i)->nodeValue;
		}	
		
		return $r;
	}
	
	
	
	
	
	public function getTodaysReviews()
	{
		$data = array();
		$todayReviews = array();
		$TA_Reviews = array();//'<h4>Trip Adivsor Reviews</h4>';
		$Orbitz_Reviews = array(); //'<h4>Orbitz</h4>';
		$hotelIDs = $this->Hotel->getHotelIDs();
		
		
		
		for($i = 0;$i < count($hotelIDs); $i++){
			$data['tripAdvisor'] =  $this->parseHotelReviews( $this->getHotelRSS($hotelIDs[$i]) );
			for($a=0; $a < count($data['tripAdvisor']); $a++){
				if($data['tripAdvisor'][$a]['date'] == date('Y-m-d')){
					array_push($TA_Reviews, $data['tripAdvisor'][$a]);
				}
			}
			
			
			
			$data['Orbitz'] = $this->getOrbitzURLInfo( $this->getOrbitzRSS($hotelIDs[$i]) );
			for($b=0; $b < count($data['Orbitz']); $b++){
				if($data['Orbitz'][$b]['date'] == '2011-06-04'){
					array_push($Orbitz_Reviews, $data['Orbitz'][$b]);
				}
			}
			
		}
		
		
		/*for($i = 0;$i < count($hotelIDs); $i++){
			$data['Orbitz'] = $this->getOrbitzURLInfo( $this->getOrbitzRSS($hotelIDs[$i]) );
			for($b=0; $b < count($data['Orbitz']); $b++){
				if($data['Orbitz'][$b]['date'] == '2011-06-04'){
					array_push($Orbitz_Reviews, $data['Orbitz'][$b]);
				}
			}
		}*/
		
		$todayReviews['trip'] = $TA_Reviews;
		$todayReviews['orb'] = $Orbitz_Reviews;
		return $todayReviews;
	}
	
	
	
	public function formatTheDate($date)
	{
		$month = $date['month'];
		$day = $date['day'];
		$year = $date['year'];
		
		switch($month){
			case "January":
			$formattedMonth = "01";
			break;
			case "February":
			$formattedMonth = "02";
			break;
			case "March":
			$formattedMonth = "03";
			break;
			case "April":
			$formattedMonth = "04";
			break;
			case "May":
			$formattedMonth = "05";
			break;
			case "June":
			$formattedMonth = "06";
			break;
			case "July":
			$formattedMonth = "07";
			break;
			case "August":
			$formattedMonth = "08";
			break;
			case "September":
			$formattedMonth = "09";
			break;
			case "October":
			$formattedMonth = "10";
			break;
			case "November":
			$formattedMonth = "11";
			break;
			case "December":
			$formattedMonth = "12";
			break;
		}
		
		if($date['day'] > 10){
			$formattedDay = $date['day'];
		}else{
			$formattedDay = "0".$date['day'];
		}
		
		return $date['year']."-".$formattedMonth."-".$formattedDay;
	}
	
	public function getHotelIDs()
	{
		$returnedArray = array();
		$this->db->select('id');
		$this->db->from('hotel');
		$query = $this->db->get();
		foreach($query->result() as $obj){
			array_push($returnedArray, $obj->id);
		}
		
		return $returnedArray;
	}
	
	public function insertNewHotel($spec)
	{
		$data = array(
					  'hotel_name'=>$spec['name'],
					  'hotel_rss'=>'http://www.tripadvisor.com'.$spec['url'],
					  'mgt_id' => $spec['mgt'],
					  'orbitz_url'=> $spec['orbitz'],
					  'priceline_url'=> $spec['priceline']
					  );
		
		$this->db->insert('hotel', $data);
		return $this->db->insert_id();
	}
	
	public function getManagementList()
	{
		$query = $this->db->get('mgtcompany');
		$i = 0;
		foreach($query->result() as $obj){
			$returnedArray[$i]['id'] = $obj->id;
			$returnedArray[$i]['name'] = $obj->mgt_name;
			$i++;
		}
		
		return $returnedArray;
	}
	
	
	public function insertCompetitor($id, $competitor_of)
	{
		$data = array(
					  'hotel_id'=>$id,
					  'competitor_id'=>$competitor_of
					  );
		$this->db->insert('hotel_competitors', $data);
		return true;
	}
	
	
	public function getCompetitors($hotelID)
	{
		$returnedArray = array();
		$this->db->select('competitor_id');
		$this->db->from('hotel_competitors');
		$this->db->where('hotel_id', $hotelID);
		$query = $this->db->get();
		if($query->num_rows() != 0){
			$i = 0;
			foreach($query->result() as $obj){
				$returnedArray[$i]['competitor_id'] = $obj->competitor_id;
				$returnedArray[$i]['hotel_name'] = $this->getHotelName($obj->competitor_id);
				$i++;
			}
		}
		return $returnedArray;
	}
	
	
	public function getHotelName($hotel_id)
	{
		$this->db->select('hotel_name');
		$this->db->from('hotel');
		$this->db->where('id', $hotel_id);
		$query = $this->db->get();
		foreach ($query->result() as $obj){
			$returnedValue = $obj->hotel_name;
		}
		
		return $returnedValue;
	}

}







/* End of file hotel.php */
/* Location: ./application/mdoels/hotel.php */
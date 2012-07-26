<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Hotel','',TRUE);
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('email');
		$config['protocol'] = 'sendmail';
		$config['mailtype'] = 'html';
		$config['mailpath'] =  '/usr/sbin/sendmail'; 
		$this->email->initialize($config);
	}
	
	
	public function index()
	{
		$response_array['hotels'] = $this->Hotel->getHotelList();
		$response_array['management'] = $this->Hotel->getManagementList();
		$this->load->view('review/header');
		$this->load->view('review/home', $response_array);
		$this->load->view('review/footer');
	}
	
	public function hotel($id)
	{
		
		$response_array['metadata'] = $this->Hotel->parseHotelInfo( $this->Hotel->getHotelRSS($id) );
		$response_array['reviews'] = $this->Hotel->parseHotelReviews( $this->Hotel->getHotelRSS($id) );
		$response_array['hotelID'] = $id;
		$response_array['allHotels'] = $this->Hotel->getHotelList();
		$response_array['competitors'] = $this->Hotel->getCompetitors($id);
		//$response_array['expedia'] = $this->Hotel->getExpediaURLInfo( $this->Hotel->getHotelRSS($id) );
		$response_array['priceline'] = $this->Hotel->getPricelineURLInfo( $this->Hotel->getPricelineRSS($id) );
		$response_array['orbitz'] = $this->Hotel->getOrbitzURLInfo( $this->Hotel->getOrbitzRSS($id) );
		$this->load->view('review/header');
		$this->load->view('review/start', $response_array);
		$this->load->view('review/footer');
	}
	
	
	public function email()
	{
		/*$response_array['metadata'] = $this->Hotel->parseHotelInfo( $this->Hotel->getHotelRSS(1) );
		$response_array['reviews'] = $this->Hotel->getTodaysReviews(1, $this->Hotel->getHotelRSS(1) );*/
		
		$todaysReviews = array();
		$todaysReviews = $this->Hotel->getTodaysReviews();
		$response_array['data'] = $todaysReviews;
		$message = $this->load->view('review/email', $response_array, TRUE);
		$this->email->from('tripreviewer@appleseedinteractive.com');
		$this->email->to('shariq.torres@gmail.com, price@applereit.com');
		$this->email->subject('New Hotel Reviews');
		$this->email->message($message);
		$this->email->send();
		
		
		
	}
	
	public function add()
	{
		$mgt_company = $_POST['management'];
		$hotel_url = $_POST['hotel_url'];
		$orbitz_url = $_POST['orbitz_url'];
		$priceline_url = $_POST['priceline_url'];
		$info = $this->Hotel->getTripAdvisorURLInfo($hotel_url);
		$specs  = array(
			  'url' => $info['url'],
			  'name' => $info['name'],
			  'mgt' => $mgt_company,
			  'orbitz' => $orbitz_url,
			  'priceline' => $priceline_url
			  );
		$this->Hotel->insertNewHotel($specs);
		$response_array['success'] = TRUE;
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode(array('result'=>true)));
		
	}
	
	public function comp()
	{
		$hotel_id = $_POST['hotel_id'];
		$competitor_id = $_POST['comp'];
		
		echo $competitor_id;
		$this->Hotel->insertCompetitor($hotel_id, $competitor_id);
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode(array('result'=>true)));
		
	}
	
	
	public function delete($id)
	{
		$this->Hotel->deleteHotel($id);
		
	}
	
	
}

/* End of file review.php */
/* Location: ./application/controllers/review.php */
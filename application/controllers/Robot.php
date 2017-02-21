<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Robot extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->compass = array('NORTH', 'EAST', 'SOUTH', 'WEST');
		$this->move = array('MOVE', 'LEFT', 'RIGHT');
	}
	
	public function index()
	{
		$data['output'] = '';
		$data['validation'] = '';
		$post = $this->input->post();
		
		if($post):
			$this->form_validation->set_rules('position', 'Position', 'trim|required');
			
			if($this->form_validation->run() !== FALSE):
				$data['output'] = $this->hasBeenPlaced($this->input->post('position'), $this->input->post('movement'));
			endif;
		endif;
		
		$this->load->view('robot_view', $data);
	}
	
	function place($x, $y, $f){
		$f = strtoupper($f);
		$robot_direction = array_search($f, $this->compass);
		
		if($x >= '5' || $y >= '5'):
			return false;
		else:
			if($f !== FALSE):
				return true;
			else:
				return false;
			endif;
		endif;
	}
	
	function move($movement){
		if(empty(array_filter($movement))):
			return true;
		else:
			$count = 0;
			
			foreach($movement as $key=>$value):
				if(strtoupper($value) === "MOVE"):
					$count = 0;
				elseif(strtoupper($value) === "LEFT"):
					$count = 0;
				elseif(strtoupper($value) === "RIGHT"):
					$count = 0;
				else:
					$count++;
				endif;
			endforeach;
			
			if($count === 0):
				return true;
			else:
				return false;
			endif;
		endif;
	}
	
	function hasBeenPlaced($place, $movement){
		$place 		= explode(',', $place);
		$movement 	= explode(',', $movement);
		
		$x = $place[0];
		$y = $place[1];
		$f = $place[2];
		
		if(empty(array_filter($movement))):
			$place_result 	= $this->place($x, $y, $f);
			
			if($place_result == FALSE):
				$output = 'Invalid parameter/direction.';
			else:
				$output = '<strong>Output:</strong> '
                    . $x . ', '
                    . $y . ', '
                    . $f;
			endif;
			
			return $output;
		else:
			$move_result = $this->move($movement);
			
			if($move_result == FALSE):
				$output = 'Invalid move/rotation.';
				
				return $output;
			else:
				foreach($movement as $key=>$value):
					if(strtoupper($value) === "MOVE"):
						if(strtoupper($f) == "NORTH"):
							$y += 1;
						elseif(strtoupper($f) == "EAST"):
							$x += 1;
						elseif(strtoupper($f) == "SOUTH"):
							$y -= 1;
						elseif(strtoupper($f) == "WEST"):
							$x -= 1;
						endif;
					elseif(strtoupper($value) === "LEFT"):
						if(strtoupper($f) == "NORTH"):
							$f = "WEST";
						elseif(strtoupper($f) == "EAST"):
							$f = "NORTH";
						elseif(strtoupper($f) == "SOUTH"):
							$f = "EAST";
						elseif(strtoupper($f) == "WEST"):
							$f = "SOUTH";
						endif;
					elseif(strtoupper($value) === "RIGHT"):
						if(strtoupper($f) == "NORTH"):
							$f = "EAST";
						elseif(strtoupper($f) == "EAST"):
							$f = "SOUTH";
						elseif(strtoupper($f) == "SOUTH"):
							$f = "WEST";
						elseif(strtoupper($f) == "WEST"):
							$f = "NORTH";
						endif;
					endif;
				endforeach;
				
				$place_result = $this->place($x, $x, $f);
				
				if($place_result == FALSE):
					$output = 'Invalid parameter/direction.';
					
					return $output;
				else:
					$output = '<strong>Output:</strong> '
						. $x . ', '
						. $y . ', '
						. $f;
					
					return $output;
				endif;
			endif;
		endif;
	}
}

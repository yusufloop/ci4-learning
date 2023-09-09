<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EventModel;

class FullcalendarController extends BaseController
{
	public function __construct()
	{
		helper(["html"]);
	}
	public function index()
	{
		return view('fullcalendar');
	}

	public function loadData()
	{
		$event = new EventModel();
		// on page load this ajax code block will be run
		$data = $event->where([
			'start >=' => $this->request->getVar('start'),
			'end <='=> $this->request->getVar('end')
		])->findAll();

		return json_encode($data);
	}

	public function ajax()
	{
		$event = new EventModel();

		switch ($this->request->getVar('type')) {

				// For add EventModel
			case 'add':
				$data = [
					'title' => $this->request->getVar('title'),
					'start' => $this->request->getVar('start'),
					'end' => $this->request->getVar('end'),
				];
				$event->insert($data);
				return json_encode($event);
				break;

				// For update EventModel        
			case 'update':
				$data = [
					'title' => $this->request->getVar('title'),
					'start' => $this->request->getVar('start'),
					'end' => $this->request->getVar('end'),
				];

				$event_id = $this->request->getVar('id');
				
				$event->update($event_id, $data);

				return json_encode($event);
				break;

				// For delete EventModel    
			case 'delete':

				$event_id = $this->request->getVar('id');

				$event->delete($event_id);

				return json_encode($event);
				break;

			default:
				break;
		}
	}
}

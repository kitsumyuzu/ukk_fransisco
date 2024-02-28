<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Schema;

class Content extends BaseController {
	
	public function index() {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			echo view('pages/login');

		} else if (session() -> get('id') > 0) {

			echo view('_layout/header');
			echo view('_layout/menu');
			echo view('pages/upload_image');
			echo view('_layout/footer');

		}
		
	}

	public function upload_image() {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			return redirect() -> to('/Home/');

		} else if (session() -> get('id') > 0 && in_array(session() -> get('level'), [1])) {



		}
        
	}

}
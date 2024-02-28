<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Schema;

class User extends BaseController {
	
	public function index() {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			echo view('pages/login');

		} else if (session() -> get('id') > 0) {

			echo view('pages/userData');

		}
		
	}

	public function create_user() {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			echo view('pages/login');

		} else if (session() -> get('id') > 0) {

			return redirect() -> to('/Home/dashboard');

		}
	}

}
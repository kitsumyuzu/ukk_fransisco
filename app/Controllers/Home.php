<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Schema;

class Home extends BaseController {
	
	public function index() {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			echo view('pages/login');

		} else if (session() -> get('id') > 0) {

			return redirect() -> to('/Home/dashboard');

		}
		
	}

	public function dashboard() {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			return redirect() -> to('/Home/');

		} else if (session() -> get('id') > 0) {

			$Schema = new Schema();

			$setting['data_setting'] = $Schema -> getWhere2('user', ['UserID' => session() -> get('id')]);

			echo view('_layout/header');
			echo view('_layout/menu', $setting);
			echo view('pages/dashboard');
			echo view('_layout/footer');

		}

	}

	// Login, Logout, & Register

		public function auth_login() {
			
			$Schema = new Schema();
			
			$username = $this -> request -> getPost('username');
			$password = $this -> request -> getPost('password');

			if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
				
				$_data = array('Email' => $username, 'Password' => md5($password));

			} else {

				$_data = array('Username' => $username, 'Password' => md5($password));

			}
			
			$data_filter = $Schema -> getWhere2('user', $_data);

			if ($data_filter > 0) {

				session() -> set('id', $data_filter['UserID']);
				session() -> set('username', $data_filter['Username']);
				session() -> set('email', $data_filter['Email']);
				session() -> set('level', $data_filter['_level']);

				return redirect() -> to('/Home/dashboard');

			} else {

				return redirect() -> to('/Home/');

			};

		}

		public function auth_logout() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

				return redirect() -> to('/Home/');

			} else if (session() -> get('id') > 0) {

				session() -> destroy();

				return redirect() -> to('/Home/');

			}

		}

		public function auth_register() {

			$Schema = new Schema();

			$username = $this -> request -> getPost('username');
			$email = $this -> request -> getPost('email');
			$password = $this -> request -> getPost('password');
			$nama_lengkap = $this -> request -> getPost('nama_lengkap');
			$alamat = $this -> request -> getPost('alamat');

			if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

				$Schema -> create_data('user', [
					'Username' => $username,
					'Email' => $email,
					'Password' => md5($password),
					'NamaLengkap' => $nama_lengkap,
					'Alamat' => $alamat
				]);

			} else if (session() -> get('id') > 0) {

				return redirect() -> to('/Home/');

			}

		}

}
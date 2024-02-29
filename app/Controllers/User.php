<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Schema;

class User extends BaseController {
	
	public function index() {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			echo view('pages/login');

		} else if (session() -> get('id') > 0) {

			$Schema = new Schema();

			$fetch['data_user'] = $Schema -> visual_table('user');

			echo view('_layout/header');
			echo view('_layout/menu');
			echo view('pages/user', $fetch);
			echo view('_layout/footer');

		}
		
	}

	public function create_user() {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			echo view('pages/login');

		} else if (session() -> get('id') > 0) {

			return redirect() -> to('/Home/dashboard');

		}
	}

	public function view_register() {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			echo view('pages/register');
			
		} else if (session() -> get('id') > 0) {
			
			return redirect() -> to('/Home/dashboard');

		}

	}

	public function auth_register() {

		$Schema = new Schema();

		$username = $this -> request -> getPost('username');
		$email = $this -> request -> getPost('email');
		$password = $this -> request -> getPost('password');
		$nama_lengkap = $this -> request -> getPost('nama_lengkap');
		$alamat = $this -> request -> getPost('alamat');
		$foto = $this -> request -> getPost('foto');

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			if ($foto && $foto -> isValid() && ! $foto -> hasMoved()) {
                    
				if ($foto == 'default-profile.png' || NULL) {

					$images = $foto -> getRandomName();
					$foto -> move('assets/src/stored_profile/', $images);

				} else {

					$images = $foto -> getRandomName();
					$foto -> move('assets/src/stored_profile/', $images);

				}

			} else {

				$images = 'default-profile.png';

			}

			$Schema -> create_data('user', [
				'Username' => $username,
				'Email' => $email,
				'Password' => md5($password),
				'NamaLengkap' => $nama_lengkap,
				'Alamat' => $alamat,
				'_level' => '2',
				'_profile' => $images
			]);
			
			return redirect() -> to('/Home/');

		} else if (session() -> get('id') > 0) {

			return redirect() -> to('/Home/');

		}

	}

}
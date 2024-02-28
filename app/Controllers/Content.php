<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Schema;

class Content extends BaseController {
	
	public function index() {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			echo view('pages/login');

		} else if (session() -> get('id') > 0) {

			$Schema = new Schema();

			$fetch['data_album'] = $Schema -> visual_table('album');

			echo view('_layout/header');
			echo view('_layout/menu');
			echo view('pages/upload_image', $fetch);
			echo view('_layout/footer');

		}
		
	}

	public function album_foto() {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			echo view('pages/login');

		} else if (session() -> get('id') > 0) {

			$Schema = new Schema();

			$fetch['data_album'] = $Schema -> visual_table('album');

			echo view('_layout/header');
			echo view('_layout/menu');
			echo view('pages/album', $fetch);
			echo view('_layout/footer');

		}

	}

	// CRUD

	public function create_album() {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			return redirect() -> to('/Home/');

		} else if (session() -> get('id') > 0 && in_array(session() -> get('level'), [1])) {
			
			$Schema = new Schema();

			$judul_album = $this -> request -> getPost('nama_album');
			$deskripsi_album = $this -> request -> getPost('deskripsi_album');

			$Schema -> create_data('album', [
				'NamaAlbum' => $judul_album,
				'Deskripsi' => $deskripsi_album,
				'TanggalDibuat' => date('Y-m-d'),
				'UserID' => session() -> get('id')
			]); 
			
			return redirect() -> to('/Content/album_foto');

		}

	}

	public function upload_image() {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			return redirect() -> to('/Home/');

		} else if (session() -> get('id') > 0 && in_array(session() -> get('level'), [1])) {
			
			$Schema = new Schema();

			$foto = $this -> request -> getFile('foto');
			$judul_foto = $this -> request -> getPost('judul_foto');
			$album_foto = $this -> request -> getPost('album_foto');
			$deskripsi_foto = $this -> request -> getPost('deskripsi_foto');

			if ($foto && $foto -> isValid() && ! $foto -> hasMoved()) {

				$images = $foto -> getRandomName();
				$foto -> move('assets/src/stored_images/', $images);

			}

			$Schema -> create_data('foto', [
				'JudulFoto' => $judul_foto,
				'DeskripsiFoto' => $deskripsi_foto,
				'TanggalUnggah' => date('Y-m-d'),
				'LokasiFile' => $images,
				'AlbumID' => $album_foto,
				'UserID' => session() -> get('id')
			]); 
			
			return redirect() -> to('/Home/dashboard');

		}
        
	}

}
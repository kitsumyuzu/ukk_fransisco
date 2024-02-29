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

	public function update_image($id) {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			echo view('pages/login');

		} else if (session() -> get('id') > 0) {

			$Schema = new Schema();

			$on = 'album.UserID = user.UserID';

			$fetch['data_foto'] = $Schema -> getWhere2('foto', ['FotoID' => $id]);
			$fetch['data_album'] = $Schema -> visual_table_join2('album', 'user', $on);

			echo view('_layout/header');
			echo view('_layout/menu');
			echo view('pages/update_image', $fetch);
			echo view('_layout/footer');

		}

	}

	public function view_comment($id) {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			echo view('pages/login');

		} else if (session() -> get('id') > 0) {

			$Schema = new Schema();

			$on = 'komentarfoto.UserID = user.UserID';

			$fetch['data_foto'] = $Schema -> getWhere2('foto', ['FotoID' => $id]);
			$fetch['data_komen'] = $Schema -> visual_table_join2('komentarfoto', 'user', $on);

			echo view('_layout/header');
			echo view('_layout/menu');
			echo view('pages/view_comment', $fetch);
			echo view('_layout/footer');

		}

	}

	public function view_album($id) {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			echo view('pages/login');

		} else if (session() -> get('id') > 0) {

			$Schema = new Schema();

			$on = 'album.AlbumID = foto.AlbumID';
			$on2 = 'foto.UserID = user.UserID';
			$fetch['filter_album'] = $Schema -> getWhere_table_join_3('foto', 'album', 'user', $on, $on2, ['AlbumID' => $id]);
			$fetch['data_foto'] = $Schema -> visual_table('foto');

			echo view('_layout/header');
			echo view('_layout/menu');
			echo view('pages/view_folder', $fetch);
			echo view('_layout/footer');

		}

	}

	// CRUD

	public function create_album() {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			return redirect() -> to('/Home/');

		} else if (session() -> get('id') > 0) {
			
			$Schema = new Schema();

			$judul_album = $this -> request -> getPost('nama_album');
			$deskripsi_album = $this -> request -> getPost('deskripsi_album');

			$Schema -> create_data('album', [
				'NamaAlbum' => $judul_album,
				'Deskripsi' => $deskripsi_album,
				'TanggalDibuat' => date('Y-m-d'),
				'UserID' => session() -> get('id')
			]); 
			
			return redirect() -> to('/Home/dashboard');

		}

	}

	public function create_comment() {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			return redirect() -> to('/Home/');

		} else if (session() -> get('id') > 0) {
			
			$Schema = new Schema();

			$id = $this -> request -> getPost('id');
			$comment = $this -> request -> getPost('comment');

			$Schema -> create_data('komentarfoto', [
				'FotoID' => $id,
				'UserID' => session() -> get('id'),
				'IsiKomentar' => $comment,
				'TanggalKomentar' => date('Y-m-d')
			]); 
			
			return redirect() -> to('/Content/view_comment/'.$id);

		}

	}

	public function upload_image() {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			return redirect() -> to('/Home/');

		} else if (session() -> get('id') > 0) {
			
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

	public function action_update_image() {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			return redirect() -> to('/Home/');

		} else if (session() -> get('id') > 0) {
			
			$Schema = new Schema();

			$ids = $this -> request -> getPost('id');
			$oldfoto = $this -> request -> getPost('oldfoto');
			$foto = $this -> request -> getFile('foto');
			$judul_foto = $this -> request -> getPost('judul_foto');
			$album_foto = $this -> request -> getPost('album_foto');
			$deskripsi_foto = $this -> request -> getPost('deskripsi_foto');

			if ($foto && $foto -> isValid() && ! $foto -> hasMoved()) {

				if ($foto == 'no-image.jpg' || NULL || ' ') {

					$images = $foto -> getRandomName();
					$foto -> move('assets/src/stored_images/', $images);

				} else {

					if (file_exists('assets/src/stored_images/'.$foto)) {

						unlink('assets/src/stored_images/'.$oldfoto);

					} else {

						$images = $foto -> getRandomName();
						$foto -> move('assets/src/stored_images/', $images);

					}

				}

			} else {

				if ($oldfoto == 'no-image.jpg' || NULL || ' ') {

					$images = 'no-image.jpg';

				} else {

					$images = $oldfoto;

				}

			}

			$Schema -> update_data('foto', [
				'JudulFoto' => $judul_foto,
				'DeskripsiFoto' => $deskripsi_foto,
				'LokasiFile' => $images,
				'AlbumID' => $album_foto,
			], ['FotoID' => $ids]);
			
			return redirect() -> to('/Home/dashboard');

		}

	}

	public function action_delete_image($id) {

		if (session() -> get('id') == NULL || session() -> get('id') < 0 || session() -> get('id') == ' ') {

			return redirect() -> to('/Home/');

		} else if (session() -> get('id') > 0 && in_array(session() -> get('level'), [1])) {
			
			$Schema = new Schema();

				$foto = $Schema->getWhere2('foto', ['FotoID' => $id]);

				if ($foto) {
					
					$imagePath = 'assets/src/stored_images/'.$foto['LokasiFile'];
					
					if (file_exists($imagePath) && $foto['LokasiFile'] !== 'no-image.jpg') {
						unlink($imagePath);
					}

					$Schema->delete_data('foto', ['FotoID' => $id]);
				}

				$Schema -> delete_data('foto', array('FotoID' => $id));
			
			return redirect() -> to('/Home/dashboard');

		}

	}

	// Ajax Request Handler

	public function toggleLike()
	{
		$Schema = new Schema();

		$fotoID = $this->request->getPost('fotoID');
		$userID = $this->request->getPost('userID');

		$isLiked = $Schema->checkLike($fotoID, $userID);

		if ($isLiked) {
			$Schema->removeLike($fotoID, $userID);
		} else {
			$Schema->addLike($fotoID, $userID);
		}

		$likeCount = $Schema->countLikes($fotoID);

		$response = [
			'likeCount' => $likeCount,
			'liked' => !$isLiked,
		];

		return $this->response->setJSON($response);
	}

}
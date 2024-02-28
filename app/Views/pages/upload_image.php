                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-12 grid-margin">
                                <div class="row">
                                    <div class="col-4">
                                        <h3 class="font-weight-bold">Upload Content</h3>
                                    </div>
                                    <div class="col-8">
                                        <div class="justify-content-end d-flex">
                                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                                <button class="btn btn-sm btn-light bg-white" type="button">
                                                    <i class="icon-globe"></i> <?php $date = new DateTime('now', new DateTimeZone('Asia/Jakarta')) ?> <?php echo  $date -> format('Y-m-d'); ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-title">
                                        <div class="row">
                                            <img class="ml-4 mr-2 mt-3" src="<?php echo base_url('assets/src/stored_profile') ?>/default-profile.png" alt="avatar" style="width: 30px; height: 30px;">
                                            <p class="username-upload mt-3"><?php echo ucwords(session() -> username) ?></p>
                                        </div>
                                    </div>
                                    <img class="card-img-top" id="image_preview" src="<?php echo base_url('assets/src/stored_images') ?>/doraemon.jpg" style="height: 250px; object-fit:cover;" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Title</h5>
                                        <p class="card-text" style="font-size:12px;">Description</p>
                                        <div class="container logo mt-3 d-flex justify-content-end">
                                            <i class="mdi mdi-heart-outline" style="color:red;"></i><p class="ml-1">0</p>
                                            <i class="mdi mdi-comment-outline ml-2" style="color:aquamarine;"></i><p class="ml-1">0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="<?= base_url('/Content/upload_image') ?>" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <title for="">Foto</title>
                                                <input class="form-control" type="file" id="image_input" name="foto">
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <input class="form-control" type="text" name="judul_foto" placeholder="Judul Foto">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <select class="form-control" name="album_foto">
                                                        <option selected disabled>Pilih Album</option>
                                                        <?php foreach($data_album as $data) { ?>
                                                            <option value="<?php echo $data['AlbumID'] ?>"><?php echo ucwords($data['NamaAlbum']) ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" type="text" name="deskripsi_foto" placeholder="Deskripsi" rows="10"></textarea>
                                                </div>

                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="btn btn-success">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>

                            document.getElementById("image_input").onchange = function() {
    
                                document.getElementById("image_preview").src = URL.createObjectURL(image_input.files[0]);
    
                            }

                        </script>


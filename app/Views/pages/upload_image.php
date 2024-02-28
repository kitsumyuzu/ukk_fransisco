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
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="<?php echo base_url('assets/src/stored_images') ?>/doraemon.jpg" alt="preview-upload" id="image_preview" style="width:350px; height:350px; object-fit:cover;">
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-md-6">
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
                                                    <input class="form-control" type="text" name="deskripsi_foto" placeholder="Deskripsi">
                                                </div>
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


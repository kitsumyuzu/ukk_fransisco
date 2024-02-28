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

                            <div class="col-md-12">
                                <div class="d-flex justify-content-end mb-3">
                                    <a href="" style="text-decoration: none;" data-toggle="modal" data-target="#create_album_modals">
                                        <p>Create Folder</p>
                                    </a>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <?php foreach($data_album as $data) { ?>

                                <div class="col-md-2 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <a href="#" class="card-title" id="folder"><i class="mdi mdi-folder mr-2"></i><?php echo $data['NamaAlbum'] ?></a>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                        </div>

                        <!-- Start: Modals -->

                            <div class="modal" tabindex="-1" role="dialog" id="create_album_modals">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambahkan Album</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        
                                        <form action="<?= base_url('/Content/create_album/?') ?>" method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="nama_album" placeholder="nama album">
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" type="text" name="deskripsi_album" placeholder="Deskripsi" rows="10"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
                                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        <!-- END: Modals -->

                        <style>

                            * #folder {
                                cursor: pointer;
                                text-decoration: none;
                            }

                            * #folder:hover {
                                color: #248afd;
                            }

                        </style>
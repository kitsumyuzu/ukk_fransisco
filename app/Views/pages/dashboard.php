                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-12 grid-margin">
                                <div class="row">
                                    <div class="col-4">
                                        <h3 class="font-weight-bold">Welcome <?php echo ucwords(session() -> username) ?></h3>
                                        <h6 class="font-weight-normal mb-0">All systems are running smoothly!</h6>
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

                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <div class="card-title">
                                    <div class="row">
                                        <img class="ml-4 mr-2 mt-3" src="<?php echo base_url('assets/src/stored_profile') ?>/default-profile.png" alt="avatar" style="width: 30px; height: 30px;">
                                        <p class="username-upload mt-3">Kitsumyuzu</p>
                                    </div>
                                </div>
                                <img class="card-img-top" src="<?php echo base_url('assets/src/stored_images') ?>/doraemon.jpg" style="height: 250px; object-fit:cover;" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Doraemon</h5>
                                    <p class="card-text" style="font-size:12px;">Doraemon adalah ...</p>
                                    <div class="container logo mt-3 d-flex justify-content-end">
                                        <i class="btn-like mdi mdi-heart-outline"></i><p class="like-count ml-1">0</p>
                                        <i class="btn-comment mdi mdi-comment-outline ml-2"></i><p class="comment-count ml-1">0</p>
                                    </div>
                                </div>
                            </div>
                        </div>
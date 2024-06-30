<?php $this->load->view('_global/head'); ?>
    <div id="page-contents" class="container-fluid">
        <div class="clearfix" style="height: 2vh;"></div>
        <div class="row mt-2">
            <div class="col-lg-4 mx-auto content-center">
                <form class="form" method="post" action="">
                    <div class="card">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                        <img class="card-img-top" src="https://blueskyva.com/disposable/theme_logo_big.png">
                        <div class="card-body p-1">
                            <?=$this->Msg->get()?>
                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text" id="email"><i class="fas fa-user" aria-hidden="true"></i></span>
                                <input class="form-control" type="text" name="email" aria-label="email" aria-describedby="email" placeholder="Email" required="">
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text" id="password"><i class="fas fa-key" aria-hidden="true"></i></span>
                                <input class="form-control" type="password" name="password" aria-label="password" aria-describedby="password" placeholder="Password" required="">
                            </div>
                        </div>
                        <div class="card-footer p-1 text-center d-grid">
                            <div class="row">
                                <div class="col d-grid">
                                    <button class="btn btn-primary btn-sm"><i class="fas fa-sign-in-alt mx-1" aria-hidden="true"></i>Log In</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer p-1 text-end">
                            <span class="float-start"><a target="_blank" href="https://blueskyva.com/register">Create Account</a></span>
                            <span class="float-end"><a target="_blank" href="https://blueskyva.com/password/reset">Forgot Password?</a></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $this->load->view('_global/foot'); ?>
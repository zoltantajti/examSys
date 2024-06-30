<nav id="Dispo_NavBar" class="navbar navbar-expand-lg mt-0 pt-0 pb-1">
    <div class="container-fluid">
        <a class="navbar-brand my-0" href="<?=base_url()?>"><img class="img-mh30" src="https://blueskyva.com/disposable/theme_logo.png"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle Main Menu">
            <i class="fas fa-compass" title="Main Menu" aria-hidden="true"></i><span class="sr-only">Main Menu</span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav ms-auto">
                <li class="nav-item" style="pointer-events: none">
                    <a class="nav-link" href="#">
                        <i class="fas fa-clock float-start m-1 me-2" aria-hidden="true"></i>
                        <span id="utc_clock" class="me-1"></span>
                    </a>
                </li>    
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">
                        <i class="fas fa-laptop-house float-start m-1 me-2" aria-hidden="true"></i>
                        Dashboard
                    </a>
                </li>
                <?php if($this->Sess->getChain("permission","user") == "admin"){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="/admin">
                        <i class="fas fa-cogs float-start m-1 me-2" aria-hidden="true"></i>
                        Admin
                    </a>
                </li>
                <?php }; ?>
                <li class="nav-item">
                    <hr class="dropdown-divider">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">
                        <i class="fas fa-sign-out-alt float-start m-1 me-2" aria-hidden="true"></i>
                        Log Out
                    </a>
                </li>
            </div>
        </div>
    </div>
</nav>
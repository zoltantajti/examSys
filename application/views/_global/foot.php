    <div id="footer" class="container-fluid">
        <div class="card my-1 px-1">
          <div class="row row-cols-3">
            <div class="col text-start">All rights reserved ©  2024 <a href="https://blueskyva.com">bluesky</a> </div>
            <div class="col text-center">
            
            </div>
            <div class="col text-end">
                Exam center by <a href="https://tajtizoltan.hu" target="_blank">Tajti Zoltán</a>
            </div>
          </div>
        </div>
    </div>
    <?php $this->load->view('_global/modals');?>
    <script src="https://blueskyva.com/assets/global/js/vendor.js"></script>
    <script src="https://blueskyva.com/assets/frontend/js/vendor.js"></script>
    <script src="https://blueskyva.com/assets/frontend/js/app.js"></script>
    <script src="https://blueskyva.com/disposable/js/darkmode/dark-mode-switch.min.js"></script>
    <script>window.addEventListener("load", function () {window.cookieconsent.initialise({palette: {popup: {background: "#edeff5",text: "#838391"},button: {"background": "#067ec1"}},position: "top",})});</script>
    <script type="text/javascript">var timeInterval = setInterval(display_ct, 500);function display_ct() {var Now = new Date();var Local_Clock = ('0' + Now.getHours()).slice(-2) + ':' +  ("0" + Now.getMinutes()).slice(-2);var UTC_Clock = ('0' + Now.getUTCHours()).slice(-2) + ':' +  ("0" + Now.getUTCMinutes()).slice(-2);document.getElementById('utc_clock').innerHTML = Local_Clock + ' LMT, ' + UTC_Clock + ' UTC';}</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-2">
            <div class="card-header p-1">
                <div class="row">
                    <div class="col-6">
                        <h5 class="m-1">Exam: <b><?=$exam['exam']['name']?></b></h5>
                    </div>
                </div>
            </div>
            <div class="card-body text-center p-1">
                <div class="row">
                    <div class="col-12">
                        Exam filled: <b><?=$exam['result']['completedAt']?></b><br/>
                        Percent: <b><?=$exam['result']['result']?>%</b><br/>
                        <br/>
                        <br/>
                        <div class="alert alert-<?=($exam['result']['resultString'] == "passed") ? "success" : "danger"?>">
                            <?=($exam['result']['resultString'] == "passed") ? "PASSED" : "FAILED"?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-header p-1">
                <div class="row">
                    <div class="col-6">
                        <h5 class="m-1">Ansvers</h5>
                    </div>
                </div>
            </div>
            <div class="card-body p-1">
                <div class="row">
                    <div class="col-12">
                        <ul class="list-group">
                            <?php foreach(json_decode($exam['result']['ansvers'], true) as $k=>$v){ $q = $this->Exams->getQuestionByID($k)['questionText'];?>
                            <li class="list-group-item <?=($v[1]) ? "list-group-item-success" : "list-group-item-danger"?>">
                                <div class="row">
                                    <div class="col-1">
                                        <i class="fa fa-fw fa-3x fa-<?=($v[1]) ? "check" : "times"?>"></i>
                                    </div>
                                    <div class="col-10">
                                        <b><?=$q?></b><br/>
                                        <?=$v[0]?>
                                    </div>
                                    <div class="col-1">
                                        <?=($v[1]) ? "2p" : "0p"?>
                                    </div>
                                </div>
                            </li>
                            <?php }; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
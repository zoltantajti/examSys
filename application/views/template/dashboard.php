    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-2">
                <div class="card-header p-1">
                    <h5 class="m-1">
                        Available Exams
                        <a href="exams/"><i class="fas fa-folder-open float-end"></i></a>
                    </h5>
                </div>
                <div class="card-body p-1">
                    <?php foreach($availableExams as $exam){ ?>
                        <div class="row">
                            <div class="col">
                                <h5 class="my-1">
                                    <?=$exam['name']?>
                                    
                                </h5>                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>Available between <b><?=$exam['startTime']?> - <?=$exam['endTime']?></b></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <?php if($this->Exams->countResultById($exam['id']) < $exam['maxAttempts']){ ?>
                                    <?php if($this->Exams->requested($exam['examID']) == 0){ ?>
                                    <a href="request/<?=$exam['examID']?>" class="btn btn-sm btn-warning m-0 mx-1 p-0 px-1" type="button">Request exam</a>
                                    <?php }elseif($this->Exams->approved($exam['examID']) == 1){ ?>
                                    <a href="exam/<?=$exam['examID']?>" class="btn btn-sm btn-success m-0 mx-1 p-0 px-1" type="button">Complete exam</a>
                                    <?php }else{ ?>
                                    <a href="javascript:;" class="btn btn-sm btn-warning m-0 mx-1 p-0 px-1" type="button">Request pending...</a>
                                    <?php }; ?>
                                <?php }else{ ?>
                                    <a href="javascript:;" class="btn btn-sm btn-danger m-0 mx-1 p-0 px-1" type="button">Max attempt reached!</a>
                                <?php }; ?>
                            </div>
                        </div>
                        <hr class="m-0 p-0">
                    <?php }; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card mb-2">
                <div class="card-header p-1">
                    <h5 class="m-1">
                        Completed Exams
                        <a href="results/"><i class="fas fa-folder-open float-end"></i></a>
                    </h5>
                </div>
                <div class="card-body p-1">
                    <?php foreach($completedExams as $exam){ ?>
                        <div class="row">
                            <div class="col">
                                <h5 class="my-1">
                                    <?=$exam['name']?>:
                                    <span class="text-end small">Completed at <b><?=$exam['completedAt']?></b></span>
                                    <a style="position:relative;top:-3px;" href="result/<?=$exam['fill_id']?>" class="btn btn-sm btn-<?=($exam['resultString'] == "passed") ? "success" : "danger"?> m-0 mx-1 p-0 px-1" type="button">Result <?=$exam['result']?>%</a>
                                </h5>
                            </div>
                        </div>
                        <hr class="m-0 p-0">
                    <?php }; ?>
                </div>
            </div>
        </div>
    </div>
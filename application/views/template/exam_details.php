<div class="row">
        <div class="col-lg-12">
            <div class="card mb-2">
                <div class="card-header p-1">
                    <h5 class="m-1">
                        Exam: <b><?=$exam['name']?></b>
                    </h5>
                </div>
                <div class="card-body p-1">
                    <div class="row">
                        <div class="col-12">
                            <p>Time limit: <b><?=$this->Misc->minutesToTime($exam['timeLimit'])?></b></p>
                            <p>Passed: <b><?=$this->Exams->printPassedLimits($exam['passedLimit'])?></b></p>
                            <p><?=$exam['description']?></p>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-1">
                    <a href="doexam/<?=$exam['examID']?>" class="btn btn-sm btn-success m-0 mx-1 p-0 px-1" type="button">Start Exam</a>
                </div>
            </div>
        </div>
    </div>
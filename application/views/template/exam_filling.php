<div class="row">
    <div class="col-lg-12">
        <div class="card mb-2">
            <form method="POST" action="" id="examForm">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                <input type="hidden" name="fillingID" value="<?=uniqid()?>" />
                <div class="card-header p-1">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="m-1">Exam: <b><?=$exam['name']?></b></h5>
                        </div>
                        <div class="col-6 text-end">
                            <h5 class="m-1">Time remaining: <b><span id="remaining"><?=$this->Misc->minutesToTime($exam['timeLimit'],'short')?></span></b></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <progress style="width:100% !important; height:20px; border-radius:0px;" min="0" max="0" value="0" id="pbar"></progress>
                        </div>
                    </div>
                </div>
                <div class="card-body p-1">
                    <?php foreach($this->Exams->getQuestions($exam['examID']) as $q){ ?>
                    <p id="question" style="font-weight: bold;"><?=$q['questionText']?></p>
                    <div class="row">
                        <?php foreach($this->Exams->handleAnswers($q['answers']) as $a){ ?>
                        <div class="col-4">
                            <input type="radio" name="q_<?=$q['id']?>" value="<?=$a[0]?>" id="q_<?=$q['id']?>_a_<?=$a[0]?>"> <label for="q_<?=$q['id']?>_a_<?=$a[0]?>"><?=$a[0]?></label>
                        </div>
                        <?php }; ?>
                    </div>
                    <?php }; ?>
                </div>
                <div class="card-footer p-1">
                    <button class="btn btn-sm btn-success m-0 mx-1 p-0 px-1" type="submit">Complete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
const countdown=()=>{let e=<?=$exam['timeLimit']?>,t=1;var l=new Date().getTime(),r=new Date(l+6e4*e);let a=setInterval(()=>{t++;let l=new Date().getTime();var i,m=r-l,n=Math.floor(m%36e5/6e4),o=Math.floor(m%6e4/1e3),c=("0"+Math.floor(m%864e5/36e5)).slice(-2),s=("0"+n).slice(-2),g=("0"+o).slice(-2);$("#remaining").html(c+":"+s+":"+g),$("#pbar").attr("min",0).attr("max",60*e).attr("value",t),m<=0&&(clearInterval(a),$("#remaining").html("00:00:00"),$("#examForm").submit())},1e3)};
$(document).ready(function(){countdown();})
</script>
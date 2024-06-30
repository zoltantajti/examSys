<?php
class Exams extends CI_Model {
    public function __construct(){ parent::__construct(); }

    /*lists*/
    public function listAvailable($limit = 5)
    {
        $id = $this->Sess->getChain('id','user');
        $result = $this->db->select('exam_exams.*')
            ->from('exam_exams')
            ->join('exam_results','exam_exams.id = exam_results.exam_id AND exam_results.user_id='.$id.'', 'left')
            ->where('exam_results.exam_id IS NULL')
            ->or_where('exam_results.resultString = "failed"')
            ->limit($limit, 0)
            ->get()
            ->result_array();
        return $result;
    }
    public function listCompleted($limit = 5)
    {
        $id = $this->Sess->getChain('id','user');
        $result = $this->db->select('exam_exams.*, exam_results.*')
            ->from('exam_exams')
            ->join('exam_results','exam_exams.id = exam_results.exam_id AND exam_results.user_id='.$id.'', 'left')
            ->where('exam_results.user_id = ' . $id . '')
            ->limit($limit, 0)
            ->get()
            ->result_array();
        return $result;
    }

    /*Count*/
    public function countResultById($id)
    {
        return $this->db->select('id')->from('exam_results')->where('exam_id',$id)->where('user_id',$this->Sess->getChain('id','user'))->count_all_results();
    }

    /*Get*/
    public function getById($id){
        return $this->db->select('*')->from('exam_exams')->where('examID',$id)->get()->result_array()[0];
    }
    public function getQuestions($id)
    {
        return $this->db->select('*')->from('exam_questions')->where('examID',$id)->where_not_in('answers','NULL')->order_by('RAND()')->get()->result_array();
    }
    public function getQuestionByID($id)
    {
        return $this->db->select('*')->from('exam_questions')->where('id',$id)->get()->result_array()[0];
    }
    public function getResultById($id)
    {
        $result = $this->db->select("*")->from("exam_results")->where("fill_id",$id)->get()->result_array()[0];
        $exam = $this->db->select("*")->from("exam_exams")->where("id",$result['exam_id'])->get()->result_array()[0];
        return array('exam' => $exam,'result' => $result);
    }
    public function requested($examID){
        return $this->db->select('id')
            ->from('exam_requests')
            ->where('exam_id',$examID)
            ->where('user_id',$this->Sess->getChain('id','user'))
            ->where('chained_result', null)
            ->count_all_results();
    }
    public function approved($examID){
        return $this->db->select('approved')
            ->from('exam_requests')
            ->where('exam_id',$examID)
            ->where('user_id',$this->Sess->getChain('id','user'))
            ->where('chained_result', null)
            ->get()
            ->result_array()[0]['approved'];
    }
    public function getPrevResults($examID){}

    /*Answers*/
    public function handleAnswers($ans)
    {
        $ans = json_decode($ans);
        return $ans;
    }


    /*Post exam*/
    public function saveExam($p, $eID){
        $exam = $this->getById($eID);
        
        $pts = 0;
        $correct = 0;
        $q = 0;
        $ansvers = [];
        if($p['csrf']){unset($p['csrf']);};
        $id = $p['fillingID'];
        unset($p['fillingID']);
        foreach($p as $k=>$v){
            $q++;
            $qID = explode("_",$k)[1];
            $question = $this->getQuestionByID($qID);
            foreach(json_decode($question['answers'],true) as $ans){
                if($v == $ans[0]){
                    if($ans[1]){
                        $correct++;
                        $pts += 2;
                    };
                    $ansvers[$qID] = array($v, $ans[1]);
                };
            };
        };

        $percent = ($correct / $q) * 100;
        $passLimit = ($exam['passedLimit'] != null) ? $exam['passedLimit'] : $this->Settings->get('passPercent');
        $result = ($percent >= $passLimit) ? "passed" : "failed";

        $data = array(
            "fill_id" => $id,
            "exam_id" => $exam['id'],
            "user_id" => $this->Sess->getChain("id","user"),
            "result" => $percent,
            "resultString" => $result,
            "completedAt" => date("Y-m-d H:i:s"),
            "ansvers" => json_encode($ansvers, JSON_UNESCAPED_UNICODE)
        );

        $this->db->insert('exam_results',$data);

        $this->db->set('chained_result', $id)
            ->where('exam_id', $eID)
            ->where('user_id',$this->Sess->getChain('id','user'))
            ->update('exam_requests');
        redirect('result/' . $id);
    }

    /*Miscs*/
    public function printPassedLimits($limit = null)
    {
        return ($limit) ? $limit."%" : $this->Settings->get('passPercent')."%";
    }
}
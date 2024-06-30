<?php
class Epub extends CI_Controller {

    protected $data;
    protected $err = array();

    public function __construct(){
        parent::__construct();
    }

    public function index() {
        if(!$this->User->checkLogin()){
            redirect('login');
        }else{
            redirect('dashboard');
        }
    }

    public function login()
    {
        if($this->User->checkLogin()) redirect('dashboard');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email');
        $this->form_validation->set_rules('password','Password','required|trim');
        if($this->form_validation->run() == false){
            $this->load->view('login', $this->data);
        }else{
            $this->User->doLogin($this->input->post());
        }
    }
    public function logout()
    {
        $this->User->doLogout();
    }
    public function dashboard()
    {
        $this->data['p'] = 'dashboard';
        $this->data['availableExams'] = $this->Exams->listAvailable(5);
        $this->data['completedExams'] = $this->Exams->listCompleted(5);
        $this->load->view('dashboard', $this->data);
    }
    public function request($id, $redirect = "dashboard")
    {
        $data = array(
            "exam_id" => $id,
            "user_id" => $this->Sess->getChain('id','user'),
            "requested" => date("Y-m-d H:i:s"),
            "approved" => 0
        );
        $this->db->insert('exam_requests',$data);
        redirect('/' . $redirect);
    }
    public function exam($id = null){
        if($id == null){
            //list
        }else{
            $this->data['p'] = 'exam_details';
            $this->data['exam'] = $this->Exams->getById($id);
            $this->load->view('dashboard', $this->data);
        }
    }
    public function doExam($id)
    {
        $this->data['p'] = 'exam_filling';
        $this->data['exam'] = $this->Exams->getById($id);

        $this->form_validation->set_rules('fillingID','Filling id','required');

        if($this->form_validation->run() == false){
            $this->load->view('dashboard', $this->data);
        }else{
            $this->Exams->saveExam($this->input->post(), $id);
        }
    }

    public function result($id)
    {
        if($id == null){
            //list
        }else{
            $this->data['p'] = 'result_details';
            $this->data['exam'] = $this->Exams->getResultById($id);
            $this->load->view('dashboard', $this->data);
        }
    }
}
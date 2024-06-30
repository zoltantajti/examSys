<?php class Settings extends CI_Model {
    public function __construct(){ parent::__construct();}

    public function get($key){
        return $this->db->select('_value')->from('exam_settings')->where('_key',$key)->get()->result_array()[0]['_value'];
    }
}
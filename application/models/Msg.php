<?php
class Msg extends CI_Model {
    protected $pattern = "<div class='alert alert-{class} mb-1 p-1 px-2 fw-bold' role='alert' onClick='$(this).hide();'>{msg}</div>";

    public function __construct(){ parent::__construct(); }

    public function set($msg, $class = "info"){
        $this->Sess->set("msg", array('msg'=>$msg,'class'=>$class));        
    }

    public function get(){
        if($this->Sess->has("msg")){
            $msg = str_replace(array("{msg}","{class}"), array($this->Sess->get("msg")['msg'],$this->Sess->get("msg")['class']), $this->pattern);
            $this->Sess->rem("msg");
            return $msg;
        };
    }
}
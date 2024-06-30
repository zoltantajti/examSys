<?php
class User extends CI_Model {

    /*methods*/
    public function doLogin(array $p){
        if(isset($p[$this->security->get_csrf_token_name()])){ unset($p[$this->security->get_csrf_token_name()]); };
        $response = $this->Curl->post("http://vms.local/api/auth", array("user" => $p['email'], "password" => $p['password']));
        $response = (array)json_decode($response);
        if(@isset($response['error']) && isset($response['code']) && isset($response['msg']) && $response['code'] > 1000 && !isset($response['data'])){
            switch($response['msg']){
                case "user-not-found":
                    $this->Msg->set("These credentials do not match our records.", "danger");
                    redirect('/login');
                    break;
            }
        }else{
            $_user = (array)$response['data'];
            $user = array(
                "id" => $_user['id'],
                "pilot_id" => $_user['pilot_id'],
                "ident" => $_user['ident'],
                "name" => $_user['name'],
                "avatar" => $_user['avatar'],
                "pilotRank" => $_user['rank']->name,
                "login" => true,
                "permission" => $this->getRoles($_user['id'])
            );
            $this->Sess->set("user",$user);
            redirect('/dashboard');
        };
    }
    public function doLogout()
    {
        $this->Sess->rem("user");
        redirect('/login');
    }


    /*Checkers*/
    public function checkLogin()
    {
        return $this->Sess->getChain("login", "user");
    }
    public function checkIsAdmin()
    {
        return ($this->Sess->getChain("permission", "user") == "admin") ? true : false;
    }

    /*private functions*/
    public function getRoles($userID)
    {
        $result = $this->db->select('core_roles.name as name')
            ->from('core_roles')
            ->join('core_role_user', 'core_role_user.role_id = core_roles.id', 'left')
            ->where('core_role_user.user_id', $userID)
            ->get()
            ->result_array();
        return $result[0]['name'];
    }
}
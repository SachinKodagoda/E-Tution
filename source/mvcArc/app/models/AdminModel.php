<?php
class AdminModel
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    // GET USERS -----------------------------------------------
    public function get_users($usertype)
    {
        $this->db->query("SELECT * FROM users WHERE userType=:usertype ORDER BY created_at ");
        $this->db->bind(':usertype', $usertype);
        return $this->db->resultset();
    }

    // GET A USER -----------------------------------------------
    public function get_a_user($id, $usertype)
    {
        $this->db->query("SELECT * FROM users WHERE userType=:usertype && id= :id ORDER BY id");
        $this->db->bind(':id', $id);
        $this->db->bind(':usertype', $usertype);
        return $this->db->single();
    }

    // DELETE A USER -----------------------------------------------
    public function delete_a_user($id)
    {
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // ACTIVATE A USER -----------------------------------------------
    public function activate_a_user($id, $active_status)
    {
        $this->db->query("UPDATE users SET active_status =:active_status WHERE id = :id");
        $this->db->bind(':active_status', $active_status);
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // UPDATE USER IMAGE PATH -----------------------------------------------
    public function update_a_user_img_path($id, $img_name)
    {
        $this->db->query("UPDATE users SET img_name=:img_name WHERE id = :id");
        $this->db->bind(':img_name', $img_name);
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

        // UPDATE USER ONLINE STATUS -----------------------------------------------
        public function update_a_user_onlineStatus($id, $online_status)
        {
            $this->db->query("UPDATE users SET online_status=:online_status WHERE id = :id");
            $this->db->bind(':online_status', $online_status);
            $this->db->bind(':id', $id);
            if ($this->db->execute()) {
                $_SESSION['online_status'] = $online_status;
                return true;
            } else {
                return false;
            }
        }

    // UPDATE A USER -----------------------------------------------
    public function update_a_user($data)
    {

        // echo $data['password'];
        // die();
        if (empty($data['password'])) {
            $this->db->query("UPDATE users SET name =:name, email=:email , userType =:userType , country =:country WHERE id = :id");
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':userType', $data['type']);
            $this->db->bind(':id', $data['member_id']);
            $this->db->bind(':country', $data['country']);
        } else {
            $this->db->query("UPDATE users SET name =:name, email=:email , userType =:userType , password=:password , country =:country WHERE id = :id");
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':userType', $data['type']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':id', $data['member_id']);
            $this->db->bind(':country', $data['country']);
        }

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

<?php
class account_model extends CI_Model
{
    function _construct()
    {
        parent::_construct();
    }

    /*  @function verify_Email_Student
     *  @params email String
     *  @description Function that verify the email in account existence
     *  @return boolean
     * */
    public function verify_Email_Student($email){
        $this->db->where('student.Email',$email);
        $query = $this->db->get('student');
        if($query->num_rows() == 1)
            return true;
        else
            return false;
    }

    /*  @function verify_Email_Teacher
     *  @params email String
     *  @description Function that verify the email in account existence
     *  @return boolean
     * */
    public function verify_Email_Teacher($email){
        $this->db->where('teacher.Email',$email);
        $query = $this->db->get('teacher');
        if($query->num_rows() == 1)
            return true;
        else
            return false;
    }

    /*  @function verify_Student_Account
     *  @params email String, password String
     *  @description Function that verify if the account login is correct
     *  @return std_class
     * */
    public function verify_Student_Account($email, $password){
        $this->db->where('student.Email',$email);
        $this->db->where('student.Password',$password);
        $query = $this->db->get('student');
        return $query->row();
    }

    /*  @function verify_Teacher_Account
     *  @params email String, password String
     *  @description Function that verify if the account login is correct
     *  @return std_class
     * */
    public function verify_Teacher_Account($email){
        $this->db->where('teacher.Email',$email);
        $query = $this->db->get('teacher');
        return $query->row();
    }

    /*  @function register_Teacher_Account
     *  @params fname String, lname String, email String, password String
     *  @description Function that register a new Instructor Account
     *  @return null
     * */
    public function register_Teacher_Account($fname,$lname,$email,$password){
        $this->db->insert('teacher',array('Names'=>$fname,'Surnames'=>$lname, 'Email'=>$email, 'Password'=>$password));
    }

    /*  @function update_Token_Student_Account
     *  @params String email, String token
     *  @description Function that updates the token from account
     *  @return null
     * */
    public function update_Token_Student_Account($email,$token){
        $this->db->where('Email',$email);
        $this->db->update('student', array('Token' => $token));
    }

    /*  @function verify_Token_Student_Account
     *  @params String email, String token
     *  @description Function that verifies the token from account
     *  @return null
     * */
    public function verify_Token_Student_Account($email, $token){
        $this->db->where('student.Email',$email);
        $this->db->where('student.Token',$token);
        $query = $this->db->get('student');
        if($query->num_rows() == 1)
            return true;
        else
            return false;
    }

    /*  @function change_Password_Student_Account
     *  @params String email, String password
     *  @description Function that updates the password from account
     *  @return null
     * */
    public function change_Password_Student_Account($email, $password){
        $this->db->where('Email',$email);
        $this->db->update('student', array('Token' => NULL, 'Password'=>sha1($password)));
    }

    public function get_universities()
    {
        return $this->db->get('universities');
    }
}
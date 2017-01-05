<?php
class student_model extends CI_Model
{

    function _construct()
    {
        parent::_construct();
    }

    /*  @function get_student_evaluations
     *  @params $course_id string, $registration_number integer
     *  @description Function that returns available evaluations of a student
     *  @return array
     * */
    function get_student_evaluations($course_id,$registration_number){
        $this->db->from('evaluation_student');
        $this->db->join('evaluation','evaluation.Evaluation_id=evaluation_student.Evaluation_id');
        $this->db->where('evaluation.Course_id',$course_id);
        $this->db->where('evaluation_student.Registration_number',$registration_number);
        $query = $this->db->get();
        return $query->result();
    }

    function get_avg($evaluation_student_id){
        $this->db->from('evaluation_student');
        $this->db->where('evaluation_student.Evaluation_student_id',$evaluation_student_id);
        $query = $this->db->get();
        return $query->result();
    }

    function get_team_evaluation($evaluation_student_id){
        $this->db->from('team_evaluation');
        $this->db->where('team_evaluation.Evaluation_student_id',$evaluation_student_id);
        $query = $this->db->get();
        return $query->result();
    }

    function get_peer_evaluation($evaluation_student_id,$respondent){
        $this->db->from('peer_evaluation');
        $this->db->where('peer_evaluation.Evaluation_student_id',$evaluation_student_id);
        $this->db->where('peer_evaluation.Respondent',$respondent);
        $query = $this->db->get();
        return $query->result();
    }
    function preview_peer_evaluation($evaluation_student_id){
        $this->db->from('peer_evaluation');
        $this->db->where('peer_evaluation.Evaluation_student_id',$evaluation_student_id);
        $query = $this->db->get();
        return $query->result();
    }
    function preview_homework_evaluation($evaluation_student_id){
        $this->db->from('homework_evaluation');
        $this->db->where('homework_evaluation.Evaluation_student_id',$evaluation_student_id);
        $query = $this->db->get();
        return $query->result();
    }
}
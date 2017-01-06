<?php
class Evaluation_model extends CI_Model
{
    function _construct()
    {
        parent::_construct();
    }

    /*  @function get_evaluation_number
     *  @params course_id string, $project int
     *  @description Function that get the total evaluations for project given.
     *  @return integer
     * */
    public function get_evaluation_number($course_id, $project){
        $this->db->from('evaluation');
        $this->db->where('evaluation.Course_id',$course_id);
        $this->db->where('evaluation.Project',$project);
        return $this->db->count_all_results();
    }

    /*  @function get_evaluation_id
     *  @params course_id string, evaluation_number integer
     *  @description Function that get evaluation id from course_id and evaluation_number.
     *  @return integer
     * */
    public function get_evaluation_id($course_id, $evaluation_number, $project){
        $this->db->from('evaluation');
        $this->db->where('evaluation.Course_id',$course_id);
        $this->db->where('evaluation.Evaluation_number',$evaluation_number);
        $this->db->where('evaluation.Project',$project);
        $query= $this->db->get();
        return $query->result();
    }

    /*  @function get_evaluation_student_id
     *  @params evaluation_id string, registration_number integer
     *  @description Function that get evaluation info of a student
     *  @return array
     * */
    public function get_evaluation_student_id($evaluation_id, $registration_number){
        $this->db->from('evaluation_student');
        $this->db->where('evaluation_student.Evaluation_id',$evaluation_id);
        $this->db->where('evaluation_student.Registration_number',$registration_number);
        $query= $this->db->get();
        return $query->result();
    }

    /*  @function register_evaluation
     *  @params course_id string, evaluation_number integer, partial integer, date_start date, date_end date, type string, format string
     *  @description Function that register a new evaluation from course_id.
     *  @return null
     * */
    public function register_evaluation($course_id,$evaluation_number,$project,$date_start, $date_end, $type, $format){
        $this->db->insert('evaluation',array('Course_id'=>$course_id,'Evaluation_number'=>$evaluation_number,'Project'=>$project,'Evaluation_start'=>$date_start, 'Evaluation_end'=>$date_end, 'Type'=>$type, 'Format'=>$format));
    }

    /*  @function register_evaluation_student
     *  @params evaluation_id integer, registration_number integer, group_number integer
     *  @description Function that register a new evaluation student.
     *  @return null
     * */
    public function register_evaluation_student($evaluation_id, $registration_number, $group_number){
        $this->db->insert('evaluation_student', array('Evaluation_id'=>$evaluation_id, 'Registration_number'=>$registration_number, 'Group_number'=>$group_number));
    }

    /*  @function getEvaluations
     *  @params course_id string
     *  @description Function that get all evaluations from given course
     *  @return array
     * */
    public function getEvaluations($course_id){
        $this->db->from('evaluation');
        $this->db->where('evaluation.Course_id',$course_id);
        $this->db->order_by('evaluation.Evaluation_number','asc');
        $query= $this->db->get();
        return $query->result();
    }

    /*  @function register_peer_assessment
     *  @params evaluation_student_id integer, respondent integer
     *  @description Function that register a new peer assessment.
     *  @return null
     * */
    public function register_peer_assessment($evaluation_student_id, $respondent){
        $this->db->insert('peer_evaluation', array('Evaluation_student_id'=>$evaluation_student_id, 'Respondent'=>$respondent));
    }

    /*  @function register_homework_assessment
     *  @params evaluation_student_id integer, respondent integer
     *  @description Function that register a new homework assessment.
     *  @return null
     * */
    public function register_homework_assessment($evaluation_student_id, $respondent){
        $this->db->insert('homework_evaluation', array('Evaluation_student_id'=>$evaluation_student_id, 'Respondent'=>$respondent));
    }

    /*  @function register_team_assessment
     *  @params evaluation_student_id integer
     *  @description Function that register a new team assessment.
     *  @return null
     * */
    public function register_team_assessment($evaluation_student_id){
        $this->db->insert('team_evaluation', array('Evaluation_student_id'=>$evaluation_student_id));
    }

    /*  @function register_self_assessment
     *  @params evaluation_student_id integer
     *  @description Function that register a new self assessment.
     *  @return null
     * */
    public function register_self_assessment($evaluation_student_id){
        $this->db->insert('self_evaluation', array('Evaluation_student_id'=>$evaluation_student_id));
    }

    /*  @function get_evaluation_student_list
     *  @params evaluation_number integer
     *  @description Function that shows the students list per evaluation.
     *  @return array
     * */
    public function get_evaluation_student_list($evaluation_id){
        $this->db->from('evaluation_student');
        $this->db->join('student','student.Registration_number = evaluation_student.Registration_number','INNER');
        $this->db->where('evaluation_student.Evaluation_id',$evaluation_id);
        $this->db->order_by("student.Surnames", "asc");
        $query= $this->db->get();
        return $query->result();
    }
    /*  @function get_student_evaluation
     *  @params course_id string, evaluation_number integer, $registration_number
     *  @description Function that retrieves data from evaluations
     *  @return array
     * */
    public function get_student_evaluation($course_id, $project_number, $evaluation_number,$registration_number){
        $this->db->from('evaluation_student');
        $this->db->join('evaluation','evaluation.Evaluation_id = evaluation_student.Evaluation_id');
        $this->db->where('evaluation.Course_id',$course_id);
        $this->db->where('evaluation.Evaluation_number',$evaluation_number);
        $this->db->where('evaluation.Project',$project_number);
        $this->db->where('evaluation_student.Registration_number',$registration_number);
        $query= $this->db->get();
        return $query->result();
    }
    /*  @function get_peer_list
     *  @params evaluation_student_id integer
     *  @description Function that retrieves peer_evaluations from student
     *  @return array
     * */
    public function get_peer_list($evaluation_student_id){
        $this->db->from('peer_evaluation');
        $this->db->join('student','student.Registration_number = peer_evaluation.Respondent');
        $this->db->where('peer_evaluation.Evaluation_student_id',$evaluation_student_id);
        $query= $this->db->get();
        return $query->result();
    }

    /*  @function get_homework_list
     *  @params evaluation_student_id integer
     *  @description Function that retrieves homework_evaluations from student
     *  @return array
     * */
    public function get_homework_list($evaluation_student_id){
        $this->db->from('homework_evaluation');
        $this->db->join('student','student.Registration_number = homework_evaluation.Respondent');
        $this->db->where('homework_evaluation.Evaluation_student_id',$evaluation_student_id);
        $query= $this->db->get();
        return $query->result();
    }

    /*  @function register_team_assessment_score
     *  @params evaluation_student_id integer, score integer, feedback text
     *  @description Function that updates team assessment with the score of the student and commentary
     *  @return null
     * */
    public function register_team_assessment_score($evaluation_student_id, $score, $feedback){
        $current_date = date('Y/m/d');
        $data = array('Score'=>round(($score/5), 2), 'Team_took'=>1, 'Team_evaluation_date'=>$current_date, 'Commentary'=>$feedback);
        $this->db->where('Evaluation_student_id',$evaluation_student_id);
        $this->db->update('team_evaluation', $data);
    }

    /*  @function verify_team_took
     *  @params evaluation_student_id integer
     *  @description Function that verifies if the team assessment has been taken
     *  @return boolean
     * */
    public function verify_team_took($evaluation_student_id){
        $this->db->where('team_evaluation.Evaluation_student_id',$evaluation_student_id);
        $this->db->where('team_evaluation.Team_took =',1);
        $query = $this->db->get('team_evaluation');
        if($query->num_rows() == 1)
            return true;
        else
            return false;
    }

    /*  @function verify_self_took
     *  @params evaluation_student_id integer
     *  @description Function that verifies if the self assessment has been taken
     *  @return boolean
     * */
    public function verify_self_took($evaluation_student_id){
        $this->db->where('self_evaluation.Evaluation_student_id',$evaluation_student_id);
        $this->db->where('self_evaluation.Self_took',1);
        $query = $this->db->get('self_evaluation');
        if($query->num_rows() == 1)
            return true;
        else
            return false;
    }

    /*  @function get_avg_team_assessment_score
     *  @params evaluation_student_id integer, group integer
     *  @description Function that calculates the average of team assessments of given evaluation number
     *  @return null
     * */
    public function get_avg_team_assessment_score($evaluation_id, $group){
        $this->db->from('evaluation_student');
        $this->db->join('team_evaluation','team_evaluation.Evaluation_student_id = evaluation_student.Evaluation_student_id');
        $this->db->where('evaluation_student.Evaluation_id',$evaluation_id);
        $this->db->where('evaluation_student.Group_number',$group);
        $this->db->where('team_evaluation.Score !=',0);
        $this->db->select_avg('team_evaluation.Score');
        $query= $this->db->get();
        return $query->result();
    }

    /*  @function register_student_avg_team_score
     *  @params evaluation_id integer, group integer, AVGScore float
     *  @description Function that updates the team score of all students of the group
     *  @return null
     * */
    public function register_student_avg_team_score($evaluation_id,$group, $AVGScore){
        $this->db->from('evaluation_student');
        $this->db->where('evaluation_student.Evaluation_id',$evaluation_id);
        $this->db->where('evaluation_student.Group_number',$group);
        $data = array('Avg_Team'=>$AVGScore);
        $this->db->update('evaluation_student', $data);
    }

    /*  @function verify_peer_took
     *  @params evaluation_student_id integer, registration_number integer
     *  @description Function that verifies if the peer/self assessment has been taken
     *  @return boolean
     * */
    public function verify_peer_took($evaluation_student_id, $registration_number){
        $this->db->where('peer_evaluation.Evaluation_student_id',$evaluation_student_id);
        $this->db->where('peer_evaluation.Respondent',$registration_number);
        $this->db->where('peer_evaluation.Peer_took =',1);
        $query = $this->db->get('peer_evaluation');
        if($query->num_rows() == 1)
            return true;
        else
            return false;
    }

    /*  @function verify_homework_took
     *  @params evaluation_student_id integer, registration_number integer
     *  @description Function that verifies if the homework assessment has been taken
     *  @return boolean
     * */
    public function verify_homework_took($evaluation_student_id, $registration_number){
        $this->db->where('homework_evaluation.Evaluation_student_id',$evaluation_student_id);
        $this->db->where('homework_evaluation.Respondent',$registration_number);
        $this->db->where('homework_evaluation.Homework_took =',1);
        $query = $this->db->get('homework_evaluation');
        if($query->num_rows() == 1)
            return true;
        else
            return false;
    }

    /*  @function update_student_avg_self_score
     *  @params evaluation_student_id integer, AVGScore float
     *  @description Function that updates the self score of the student
     *  @return null
     * */
    public function update_student_avg_self_score($evaluation_student_id, $AVGScore){
        $this->db->from('evaluation_student');
        $this->db->where('evaluation_student.Evaluation_student_id',$evaluation_student_id);
        $data = array('Avg_Self'=>$AVGScore/5);
        $this->db->update('evaluation_student', $data);
    }

    /*  @function update_student_self_evaluation
     *  @params evaluation_student_id integer, score integer
     *  @description Function that updates self evaluation with the score
     *  @return null
     * */
    public function update_student_self_evaluation($evaluation_student_id, $score){
        $current_date = date('Y/m/d');
        $this->db->from('self_evaluation');
        $this->db->where('self_evaluation.Evaluation_student_id',$evaluation_student_id);
        $data = array('Score'=>$score/5, 'Self_took'=>1, 'Self_evaluation_date'=>$current_date);
        $this->db->update('self_evaluation', $data);
    }

    /*  @function update_student_peer_evaluation
     *  @params evaluation_student_id integer, registration_number integer, score integer, feedback text, suggestion text
     *  @description Function that updates peer evaluation with the score, feedback and suggestion
     *  @return null
     * */
    public function update_student_peer_evaluation($evaluation_student_id, $registration_number, $score, $feedback, $suggestion){
        $current_date = date('Y/m/d');
        $this->db->from('peer_evaluation');
        $this->db->where('peer_evaluation.Evaluation_student_id',$evaluation_student_id);
        $this->db->where('peer_evaluation.Respondent',$registration_number);
        $data = array('Score'=>$score, 'Peer_took'=>1, 'Peer_evaluation_date'=>$current_date, 'Feedback'=>$feedback, 'Suggestion'=>$suggestion);
        $this->db->update('peer_evaluation', $data);
    }

    /*  @function update_student_homework_evaluation
     *  @params evaluation_student_id integer, registration_number integer, score integer, feedback text, suggestion text
     *  @description Function that updates homework evaluation with the score
     *  @return null
     * */
    public function update_student_homework_evaluation($evaluation_student_id, $registration_number, $score ){
        $current_date = date('Y/m/d');
        $this->db->from('homework_evaluation');
        $this->db->where('homework_evaluation.Evaluation_student_id',$evaluation_student_id);
        $this->db->where('homework_evaluation.Respondent',$registration_number);
        $data = array('Score'=>$score, 'Homework_took'=>1, 'Homework_evaluation_date'=>$current_date);
        $this->db->update('homework_evaluation', $data);
    }

    /*  @function verify_peer_student
     *  @params evaluation_student_id integer, registration_number integer
     *  @description Function that verify if respondent is in the team
     *  @return integer
     * */
    public function verify_peer_student($evaluation_student_id, $registration_number)
    {
        $this->db->where('peer_evaluation.Evaluation_student_id', $evaluation_student_id);
        $this->db->where('peer_evaluation.Respondent', $registration_number);
        $query = $this->db->get('peer_evaluation');
        if($query->num_rows() == 1)
            return true;
        else
            return false;
    }

    /*  @function verify_homework_student
     *  @params evaluation_student_id integer, registration_number integer
     *  @description Function that verify if respondent is in the team
     *  @return integer
     * */
    public function verify_homework_student($evaluation_student_id, $registration_number)
    {
        $this->db->where('homework_evaluation.Evaluation_student_id', $evaluation_student_id);
        $this->db->where('homework_evaluation.Respondent', $registration_number);
        $query = $this->db->get('homework_evaluation');
        if($query->num_rows() == 1)
            return true;
        else
            return false;
    }

    /*  @function get_avg_peer_assessment_score
     *  @params evaluation_id integer, evaluation_student_id integer, respondent_registration_number integer
     *  @description Function that obtains the avg score of peer assessment of the given student
     *  @return array
     * */
    public function get_avg_peer_assessment_score($evaluation_id, $respondent_registration_number){
        $this->db->from('peer_evaluation');
        $this->db->join('evaluation_student','evaluation_student.Evaluation_student_id = peer_evaluation.Evaluation_student_id');
        $this->db->where('evaluation_student.Evaluation_id',$evaluation_id);
        $this->db->where('peer_evaluation.Respondent',$respondent_registration_number);
        $this->db->where('evaluation_student.Took !=',0);
        $this->db->select_avg('peer_evaluation.Score');
        $query= $this->db->get();
        return $query->result();
    }

    /*  @function get_avg_homework_assessment_score
     *  @params evaluation_id integer, evaluation_student_id integer, respondent_registration_number integer
     *  @description Function that obtains the avg score of homework assessment of the given student
     *  @return array
     * */
    public function get_avg_homework_assessment_score($evaluation_id, $respondent_registration_number){
        $this->db->from('homework_evaluation');
        $this->db->join('evaluation_student','evaluation_student.Evaluation_student_id = homework_evaluation.Evaluation_student_id');
        $this->db->where('evaluation_student.Evaluation_id',$evaluation_id);
        $this->db->where('homework_evaluation.Respondent',$respondent_registration_number);
        $this->db->where('evaluation_student.Took !=',0);
        $this->db->select_avg('homework_evaluation.Score');
        $query= $this->db->get();
        return $query->result();
    }

    /*  @function register_student_avg_peer_score
     *  @params respondent_evaluation_id integer, AVGScore float
     *  @description Function that updates the peer score of the respondent
     *  @return null
     * */
    public function register_student_avg_peer_score($respondent_evaluation_student_id,$AVGScore){
        $this->db->from('evaluation_student');
        $this->db->where('evaluation_student.Evaluation_student_id',$respondent_evaluation_student_id);
        $data = array('Avg_Peer'=>$AVGScore);
        $this->db->update('evaluation_student',$data);
    }

    /*  @function register_student_avg_homework_score
     *  @params respondent_evaluation_id integer, AVGScore float
     *  @description Function that updates the homework score of the respondent
     *  @return null
     * */
    public function register_student_avg_homework_score($respondent_evaluation_student_id,$AVGScore){
        $this->db->from('evaluation_student');
        $this->db->where('evaluation_student.Evaluation_student_id',$respondent_evaluation_student_id);
        $data = array('Avg_Homework'=>$AVGScore);
        $this->db->update('evaluation_student',$data);
    }

    /*  @function get_avg_PA
     *  @params evaluation_id integer, group number integer
     *  @description Function that get the average of PA to calculate de WF
     *  @return array
     * */
    public function get_avg_PA($evaluation_id, $group_number){
        $this->db->from('evaluation_student');
        $this->db->where('evaluation_student.Evaluation_id',$evaluation_id);
        $this->db->where('evaluation_student.Group_number',$group_number);
        $this->db->where('evaluation_student.Took !=',0);
        $this->db->select_avg('evaluation_student.Avg_Peer');
        $query= $this->db->get();
        return $query->result();
    }

    /*  @function get_avg_HW
     *  @params evaluation_id integer, group number integer
     *  @description Function that get the average of HW to calculate de WF
     *  @return array
     * */
    public function get_avg_HW($evaluation_id, $group_number){
        $this->db->from('evaluation_student');
        $this->db->where('evaluation_student.Evaluation_id',$evaluation_id);
        $this->db->where('evaluation_student.Group_number',$group_number);
        $this->db->where('evaluation_student.Took !=',0);
        $this->db->select_avg('evaluation_student.Avg_Homework');
        $query= $this->db->get();
        return $query->result();
    }

    /*  @function get_evaluation_team_list
     *  @params evaluation_id integer, group_number integer
     *  @description Function that obtains the list of students of a group in a evaluation
     *  @return array
     * */
    public function get_evaluation_team_list($evaluation_id, $group_number){
        $this->db->from('evaluation_student');
        $this->db->where('evaluation_student.Evaluation_id',$evaluation_id);
        $this->db->where('evaluation_student.Group_number',$group_number);
        $query = $this->db->get();
        return $query->result();
    }

    /*  @function register_student_evaluation_WF
     *  @params respondent_evaluation_id integer, AVGScore float
     *  @description Function that updates the evaluation WF of the respondent
     *  @return null
     * */
    public function register_student_evaluation_WF($respondent_evaluation_student_id,$evaluation_WF){
        $this->db->from('evaluation_student');
        $this->db->where('evaluation_student.Evaluation_student_id',$respondent_evaluation_student_id);
        $data = array('Evaluation_WF'=>$evaluation_WF);
        $this->db->update('evaluation_student',$data);
    }

    /*  @function register_student_evaluation_WF_HW
     *  @params respondent_evaluation_id integer, AVGScore float
     *  @description Function that updates the evaluation WF of the respondent
     *  @return null
     * */
    public function register_student_evaluation_WF_HW($respondent_evaluation_student_id,$evaluation_WF){
        $this->db->from('evaluation_student');
        $this->db->where('evaluation_student.Evaluation_student_id',$respondent_evaluation_student_id);
        $data = array('Evaluation_WF_HW'=>$evaluation_WF);
        $this->db->update('evaluation_student',$data);
    }

    /*  @function get_Total_WF_per_Partial
     *  @params respondent_registration_number integer, course_id String
     *  @description Function that obtains the average WF of the student per Partial given
     *  @return array
     * */
    public function get_Total_WF_per_Partial($respondent_registration_number, $course_id, $partial){
        $this->db->from('evaluation_student');
        $this->db->join('evaluation','evaluation.Evaluation_id= evaluation_student.Evaluation_id');
        $this->db->where('evaluation_student.Registration_number',$respondent_registration_number);
        $this->db->where('evaluation.Course_id',$course_id);
        $this->db->where('evaluation.Partial',$partial);
        $this->db->where('evaluation_student.Evaluation_WF !=',0);
        $this->db->select_avg('evaluation_student.Evaluation_WF');
        $query = $this->db->get();
        return $query->result();
    }

    /*  @function verify_student_evaluation_peer_took
     *  @params evaluation_student_id integer
     *  @description Function that verify if all peer assessment have been taken
     *  @return boolean
     * */
    public function verify_student_evaluation_peer_took($evaluation_student_id){
        $this->db->where('peer_evaluation.Evaluation_student_id',$evaluation_student_id);
        $this->db->where('peer_evaluation.Peer_took',0);
        $query = $this->db->get('peer_evaluation');
        if($query->num_rows() != 0)
            return true;
        else
            return false;
    }

    /*  @function verify_student_evaluation_homework_took
     *  @params evaluation_student_id integer
     *  @description Function that verify if all homework assessment have been taken
     *  @return boolean
     * */
    public function verify_student_evaluation_homework_took($evaluation_student_id){
        $this->db->where('homework_evaluation.Evaluation_student_id',$evaluation_student_id);
        $this->db->where('homework_evaluation.Homework_took',0);
        $query = $this->db->get('homework_evaluation');
        if($query->num_rows() != 0)
            return true;
        else
            return false;
    }

    /*  @function update_student_evaluations_took
     *  @params evaluation_student_id integer
     *  @description Function that mark as took the evaluations
     *  @return null
     * */
    public function update_student_evaluations_took($evaluation_student_id){
        $data = array('Took'=>1);
        $this->db->where('evaluation_student.Evaluation_student_id',$evaluation_student_id);
        $this->db->update('evaluation_student',$data);
    }

}
?>
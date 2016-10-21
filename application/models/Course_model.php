<?php
class Course_model extends CI_Model{
    function _construct(){
        parent::_construct();
    }
    /*  @function getCourses
     *  @params $instructor_id
     *  @description Function that returns all available courses from the teacher.
     *  @return array
     * */
    public function getCourses($instructor_id){
        $this->db->from('course');
        $this->db->where('course.Teacher_id',$instructor_id);
        $query= $this->db->get();
        return $query->result();
    }

    /*  @function courseValidator
     *  @params $course_id string,$instructor_id int
     *  @description Function that validates if the course is from the teacher
     *  @return boolean
     * */
    public function courseValidator($course_id, $instructor_id){
        $this->db->where('course.Teacher_id',$instructor_id);
        $this->db->where('course.Course_id',$course_id);
        $query = $this->db->get('course');
        if($query->num_rows() == 1)
            return true;
        else
            return false;
    }

    /*  @function courseValidatorStudent
     *  @params $course_id string,$student_id string
     *  @description Function that validates if the course is from the student
     *  @return boolean
     * */
    public function courseValidatorStudent($course_id, $student_id){
        $this->db->where('registration.Registration_number',$student_id);
        $this->db->where('registration.Course_id',$course_id);
        $query = $this->db->get('registration');
        if($query->num_rows() == 1)
            return true;
        else
            return false;
    }

    /*  @function getStudent_by_id
     *  @params registration_number integer
     *  @description Function that returns the information of the student.
     *  @return array
     * */
    public function getStudent_by_id($registration_number){
        $this->db->from('student');
        $this->db->where('student.Registration_number',$registration_number);
        $query = $this->db->get();
        return $query->result();
    }

    /*  @function getInstructor_by_id
     *  @params instructor_id integer
     *  @description Function that returns the information of the instructor.
     *  @return array
     * */
    public function getInstructor_by_id($instructor_id){
        $this->db->from('teacher');
        $this->db->where('teacher.Teacher_id',$instructor_id);
        $query = $this->db->get();
        return $query->result();
    }

    /*  @function getCourses_by_student
     *  @params registration_number integer
     *  @description Function that returns all available courses of the student.
     *  @return array
     * */
    public function getCourses_by_student($registration_number){
        $this->db->from('registration');
        $this->db->join('course','course.Course_id = registration.Course_id');
        $this->db->where('registration.Registration_number',$registration_number);
        $this->db->order_by('course.Course_name','asc');
        $query= $this->db->get();
        return $query->result();
    }

    /*  @function getCourse_byId
     *  @params course_id string
     *  @description Function that returns course with the course_id.
     *  @return array
     * */
    public function getCourse_byId($course_id){
        $this->db->from('course');
        $this->db->where('course.Course_id',$course_id);
        $query= $this->db->get();
        return $query->result();
    }

    /*  @function course_register
     *  @params $course_id string, $course_name string, $teacher_id int
     *  @description Function that register in the database a new course with the teacher.
     *  @return null
     * */

    public function course_register($course_id,$course_name,$teacher_id){
        $this->db->insert('course',array('Course_id'=>$course_id,'Course_Name'=>$course_name, 'Teacher_id'=>$teacher_id));
    }

    /*  @function course_checker
     *  @params $course_id string
     *  @description Function that check if course is already registered and return count number.
     *  @return integer
     * */

    public function course_checker($course_id){
        $this->db->from('course');
        $this->db->where('course.Course_id',$course_id);
        return $this->db->count_all_results();
    }

    /*  @function student_checker
     *  @params $student_id string, email string
     *  @description Function that check student email or id existence.
     *  @return boolean
     * */

    public function student_checker($student_id,$student_email){
        $this->db->where('student.Registration_number',$student_id);
        $this->db->or_where('student.Email',$student_email);
        $query = $this->db->get('student');
        if($query->num_rows() == 0)
            return false;
        else
            return true;
    }

    /*  @function student_course_registration_checker
     *  @params $student_id string, email string
     *  @description Function that check both student email and id in existence.
     *  @return boolean
     * */

    public function student_course_registration_checker($student_id,$student_email){
        $this->db->where('student.Registration_number',$student_id);
        $this->db->where('student.Email',$student_email);
        $query = $this->db->get('student');
        if($query->num_rows() == 1)
            return true;
        else
            return false;
    }


    /*  @function student_registration_checker
     *  @params $student_id string, $course_id string
     *  @description Function that check if student is registered in the course.
     *  @return boolean
     * */

    public function student_registration_checker($student_id, $course_id){
        $this->db->where('registration.Registration_number',$student_id);
        $this->db->where('registration.Course_id',$course_id);
        $query = $this->db->get('registration');
        if($query->num_rows() == 1)
            return true;
        else
            return false;
    }


    /*  @function student_register
     *  @params $identifier integer, $names string, $family_names string, $email string
     *  @description Function that register in the database a new student.
     *  @return null
     * */

    public function student_register($identifier,$names,$surnames,$email,$password){
        $this->db->insert('student',array('Registration_number'=>$identifier, 'Names'=>$names, 'Surnames'=>$surnames, 'Email'=>$email, 'Password'=>$password));
    }

    /*  @function getStudentperCourse
     *  @params $course_id string
     *  @description Function that returns all the students in a course.
     *  @return array
     * */
    public function getStudentsperCourse($course_id){
        $this->db->select('*');
        $this->db->from('student');
        $this->db->join('registration','registration.Registration_number=student.Registration_number');
        $this->db->where('registration.Course_id',$course_id);
        $this->db->order_by("student.Surnames", "asc");
        $query= $this->db->get();
        return $query->result();
    }

    /*  @function student_registration
     *  @params $course_id string, $student_id integer
     *  @description Function that register in the database a the student with the course he is taking.
     *  @return null
     * */

    public function student_registration($course_id,$student_id){
        $this->db->insert('registration',array('Course_id'=>$course_id, 'Registration_number'=>$student_id));
    }

    /*  @function get_student_registration_id
     *  @params  $course_id string, $student_id integer
     *  @description Function that gets the registration_id from the selected course and student
     *  @return integer
     * */

    public function get_student_registration_id($course_id,$student_id){
        $this->db->from('registration');
        $this->db->where('registration.Course_id',$course_id);
        $this->db->where('registration.Registration_number',$student_id);
        $query= $this->db->get();
        return $query->result();
    }

    /*  @function get_student_group
     *  @params  $registration
     *  @description Function that gets the student group from the given registration
     *  @return integer
     * */

    public function get_student_group($registration){
        $this->db->from('groups');
        $this->db->where('groups.Registration_id',$registration);
        $query= $this->db->get();
        return $query->result();
    }

    /*  @function get_student_groups
     *  @params  $course_id string
     *  @description Function that gets the entire list of students with their groups
     *  @return array
     * */

    public function get_student_groups($course_id){
        $this->db->from('groups');
        $this->db->join('registration','registration.Registration_id = groups.Registration_id', 'INNER');
        $this->db->join('student','student.Registration_number=registration.Registration_number', 'INNER');
        $this->db->where('registration.Course_id',$course_id);
        $this->db->order_by("student.Surnames", "asc");
        $query= $this->db->get();
        return $query->result();
    }

    /*  @function get_student_by_group
     *  @params  $course_id string, $group_number
     *  @description Function that gets the entire list of students by the group selected
     *  @return array
     * */
    public function get_student_by_group($course_id, $group_number){
        $this->db->from('groups');
        $this->db->join('registration','groups.Registration_id = registration.Registration_id', 'INNER');
        $this->db->join('student','student.Registration_number=registration.Registration_number', 'INNER');
        $this->db->where('registration.Course_id',$course_id);
        $this->db->where('groups.Group_number',$group_number);
        $query= $this->db->get();
        return $query->result();
    }

    /*  @function group_member_register
     *  @params $group_number integer, $registration_id integer
     *  @description Function that register in the database a new group member.
     *  @return null
     * */

    public function group_member_register($group_number,$registration_id){
        $this->db->insert('groups',array('Group_Number'=>$group_number,'Registration_id'=>$registration_id));
    }

    /*  @function group_modify
     *  @params $group_number integer, $registration_id
     *  @description Function that modify in the database the group number.
     *  @return null
     * */

    public function group_modify($group_number, $registration_id){
        $this->db->where('Registration_id',$registration_id);
        $this->db->update('groups', array('Group_number' => $group_number));
    }


    /*  @function get_group_max
     *  @params $course_id string
     *  @description Function that returns the max of group number
     *  @return integer
     * */

    public function get_group_max($course_id){
        $this->db->select_max('Group_number');
        $this->db->join('registration','groups.Registration_id = registration.Registration_id', 'INNER');
        $this->db->where('registration.Course_id',$course_id);
        $query= $this->db->get('groups');
        return $query->result();
    }

//    /*  @function get_student_evaluation_info
//     *  @params $course_id string, $registration_id string
//     *  @description Function that get evaluation_student_id from given course and registration ID
//     *  @return array
//     * */
//    public function get_student_evaluation_info($course_id, $registration_id){
//        $this->db->from('evaluation_student');
//        $this->db->join('evaluation','evaluation.Evaluation_id = evaluation_student.Evaluation_id');
//        $this->db->where('evaluation.Course_id',$course_id);
//        $this->db->where('evaluation_student.Registration_number',$registration_id);
//        $query = $this->db->get();
//        return $query->result();
//    }

//    /*  @function removeEvaluations
//     *  @params $evaluation_student_id integer
//     *  @description Function that remove evaluations from student
//     *  @return null
//     * */
//    public function removeEvaluations($evaluation_student_id){
//        $tables = array('peer_evaluation','team_evaluation','self_evaluation','evaluation_student');
//        $this->db->where('Evaluation_student_id',$evaluation_student_id);
//        $this->db->delete($tables);
//    }

    /*  @function removeStudent
     *  @params $registration_id integer
     *  @description Function that remove student registration.
     *  @return null
     * */
    function removeStudent($registration_id){
        $tables = array('registration');
        $this->db->where('Registration_id', $registration_id);
        $this->db->delete($tables);
    }

//    /*  @function get_student_evaluation_info
//     *  @params $course_id string, $registration_id string
//     *  @description Function that get evaluation_student_id from given course and registration ID
//     *  @return array
//     * */
//    public function get_evaluator_respondent($course_id, $registration_id){
//        $this->db->from('evaluation_student');
//        $this->db->join('evaluation','evaluation.Evaluation_id = evaluation_student.Evaluation_id');
//        $this->db->join('peer_evaluation','peer_evaluation.Evaluation_student_id = evaluation_student.Evaluation_student_id');
//        $this->db->where('evaluation.Course_id',$course_id);
//        $this->db->where('peer_evaluation.Respondent',$registration_id);
//        $query = $this->db->get();
//        return $query->result();
//    }

//    /*  @function removeStudentRespondent
//     *  @params $evaluator_student_id, $respondent_id
//     *  @description Function that remove student as respondent in peer evaluation.
//     *  @return null
//     * */
//    function removeStudentRespondent($evaluator_student_id, $respondent_id){
//        $tables = array('peer_evaluation');
//        $this->db->where('Evaluation_student_id', $evaluator_student_id);
//        $this->db->where('Respondent',$respondent_id);
//        $this->db->delete($tables);
//    }

    /*  @function update_student_password
     *  @params $registration_id string, $new_password string
     *  @description Function that modify in the current password of the student.
     *  @return null
     * */

    public function update_student_password($registration_id, $new_password){
        $this->db->where('Registration_number',$registration_id);
        $this->db->update('student', array('Password' => $new_password));
    }

    /*  @function update_instructor_password
     *  @params $instructor_id integer, $new_password string
     *  @description Function that modify in the current password of the instructor.
     *  @return null
     * */

    public function update_instructor_password($instructor_id, $new_password){
        $this->db->where('Teacher_id',$instructor_id);
        $this->db->update('teacher', array('Password' => $new_password));
    }
}
?>
<?php
class Home_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    public function get_total_videos($idmodulo)
    {
        $this->db->where('idmodulo', $idmodulo);
        $this->db->from('videos');
        return $this->db->count_all_results();

    //public function get_total_videos($modulo)
    //{
    //    $this->db->where('modulo',$modulo);
    //    return $this->db->count_all_results('videos');

    }

    public function get_videos($offset, $idmodulo)
    {

        $query = $this->db->get_where('videos', array('idmodulo' => $idmodulo), 5, $offset);

        $query = $this->db->get_where('videos',array('idmodulo' => $idmodulo), 5, $offset);

        return $query->result();
    }

    public function get_modulos()
    {
        $this->db->distinct('modulo');
        $this->db->select('modulo,idmodulo');
        $query = $this->db->get('videos');
        return $query->result();
    }

    public function get_modulo($idmodulo)
    {
        $this->db->distinct('modulo');

        $this->db->where('idmodulo', $idmodulo);

        $this->db->where('idmodulo',$idmodulo);

        $this->db->select('modulo');
        $query = $this->db->get('videos');
        return $query->first_row();
    }
}
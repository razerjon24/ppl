<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Video extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index($idmodulo = null){
        $user = $this->session->userdata('user');
        if(!empty($user)){
            $name = $this->session->userdata('user_name');
            $this->load->model('home_model');
            $data['video'] = True;
            if($user == 'student'){
                $head = 'student_head';
                $data['student_name'] = $name;
            }
            else{
                $head = 'admin_head';
                $data['instructor_name'] = $name;
            }
            if($idmodulo){
                $idmodulo = explode("modulo",$idmodulo)[1];
                $modulo = $this->home_model->get_modulo($idmodulo);
                $data['modulo'] = $modulo->modulo;
                $this->load->library('pagination');
                $page = $this->input->get('per_page');
                if(!$page){
                    $videos = $this->home_model->get_videos(0,$idmodulo);
                }
                else{
                    $videos = $this->home_model->get_videos((intval($page)-1)*5,$idmodulo);
                }
                $count_result = $this->home_model->get_total_videos($idmodulo);
                $config['per_page'] = 5;
                $config['num_links']=10;
                $config['page_query_string'] = TRUE;
                $config['total_rows'] = $count_result;
                $config['full_tag_open'] = "<ul class='pagination'>";
                $config['full_tag_close'] ="</ul>";
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a>";
                $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
                $config['next_tag_open'] = "<li>";
                $config['next_tagl_close'] = "</li>";
                $config['prev_tag_open'] = "<li>";
                $config['prev_tagl_close'] = "</li>";
                $config['first_tag_open'] = "<li>";
                $config['first_tagl_close'] = "</li>";
                $config['last_tag_open'] = "<li>";
                $config['last_tagl_close'] = "</li>";
                $config['first_link'] = FALSE;
                $config['last_link'] = FALSE;
                $config['use_page_numbers'] = TRUE;


                $config['first_url'] = base_url().'/index.php/video/index/modulo'.$idmodulo;

                $config['first_url'] = base_url().'/index.php/video';


                $config['first_url'] = base_url().'/index.php/video/index/modulo'.$idmodulo;

                $this->pagination->initialize($config);
                $data['links'] = $this->pagination->create_links();
                $data['videos'] = $videos;
            }
            else{
                $data['modulos'] = $this->home_model->get_modulos();
            }
            $this->load->view($head,$data);
            $this->load->view('videos',$data);
            $this->load->view('home_footer');
        }
        else{
            $this->load->view('index.html');
        }
    }
}
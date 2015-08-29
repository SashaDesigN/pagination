<?php
class Album extends CI_Controller {

  public function __construct(){
    parent::__construct();
  }

  /* render view with our handlebars */
  public function index(){
    $this->load->library('View');
    $this->view->renderView('album/index');
  }

  /* AJAX server for our data */
  public function paginate(){
    // $this->ajax its my library and it check is it AJAX request
    // you can use your own check or delete line of code below
    if(!$this->ajax->isAjax()) exit;
    // model :)
    $this->load->model('Album_model');
    // check paginate number for make next iteration
    $n = $this->input->post('n') !='null' ? (int)$this->input->post('n') : 0;
    // limit type - I use it for create differend limits if you need
    $limit = $this->input->post('limit') !='null' ? (string)$this->input->post('limit') : 'basic';
    // AJAX response
    echo json_encode($this->Album_model->get_albums($n,$limit));
  }
}
?>

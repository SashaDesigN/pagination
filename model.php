<?
class Album_model extends MY_Model {

  function __construct(){
    parent::__construct();
  }

  public $limit_type = [
    'mini'=>3,
    'basic'=>6,
    'list'=>10,
    'big'=>15,
    'max'=>20
  ];

  /*
  example of use when work pagination:
  get_content(0,'mini')
  get_content(1,'mini')
  get_content(2,'mini')
  */

  public function get_content($start=0,$num='mini'){
    // check limit type
    $num = in_array($num,$this->limit_type) ? $this->limit_type[$num] ? 3;
    // get content list
    // in my case this is list of images from table Album
    $this->db->select()->from('Albums')->order_by('id', 'desc')->limit($num,$start*$num);
    $query=$this->db->get();
    return $query->result_array();
  }
}
?>

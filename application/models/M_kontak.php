<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_kontak extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function show() {
        return $this->db->get('kontak')->result_array();
    }

    public function get_by_id($id) {
        $this->db->where('kontak_id', $id);
        return $this->db->get('kontak')->row_array();
    }

}

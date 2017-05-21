<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_kontak');
    }

    public function index() {
        $data['show'] = $this->m_kontak->show();
        $this->load->view('kontak/index', $data);
    }

    public function editor($mode, $id = null) {
        /* validasi dari ajax */
        if (!$this->input->is_ajax_request()) {
            return;
        }
        $data['mode'] = $mode;

        if ($id != '') {
            $data['show'] = $this->m_kontak->get_by_id($id);
        }
        $this->load->view('kontak/editor', $data);
    }

    public function save() {
        /* validasi dari ajax */
        if (!$this->input->is_ajax_request()) {
            return;
        }

        $this->load->library('form_validation');
        if ($this->input->post('mode') == 'edit') {
            $this->form_validation->set_rules('kontak_id', 'Nama Barang', 'required');
        }
        $this->form_validation->set_rules('kontak_nama', 'Nama Barang', 'required');
        $this->form_validation->set_rules('kontak_phone', 'Nama Barang', 'required');


        if ($this->form_validation->run() === false) {
            $result['status'] = false;
            $result['pesan'] = validation_errors();

            /*
             * Jika validasi gagal maka akan mengeluarkan informasi data dari array result 
             * Array result sebagai informasi apa yang error
             */
            return $this->output->set_output(json_encode($result));
        } else {
            $data_post['kontak_id'] = $this->input->post('kontak_id');
            $data_post['kontak_nama'] = $this->input->post('kontak_nama');
            $data_post['kontak_phone'] = $this->input->post('kontak_phone');

            if ($this->input->post('mode') == 'add') {
                unset($data_post['kontak_id']);

                if ($this->db->insert('kontak', $data_post)) {
                    $result['status'] = true;
                    $result['pesan'] = 'Data berhasil ditambahkan';
                } else {
                    $result['status'] = false;
                    $result['pesan'] = 'Data gagal ditambahkan';
                }
            } else {
                if ($this->db->update('kontak', $data_post, array('kontak_id' => $data_post['kontak_id']))) {
                    $result['status'] = true;
                    $result['pesan'] = 'Data berhasil diubah';
                } else {
                    $result['status'] = false;
                    $result['pesan'] = 'Data gagal diubah';
                }
            }
            return $this->output->set_output(json_encode($result));
        }
    }

    public function delete() {
        /* validasi dari ajax */
        if (!$this->input->is_ajax_request() && empty($this->input->post('kontak_id'))) {
            return;
        }
        if ($this->db->delete('kontak', array('kontak_id' => $this->input->post('kontak_id')))) {
            $result['status'] = true;
            $result['pesan'] = 'Data berhasil dihapus';
        } else {
            $result['status'] = false;
            $result['pesan'] = 'Data gagal dihapus';
        }
        return $this->output->set_output(json_encode($result));
    }

}

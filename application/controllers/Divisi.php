<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Divisi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth');
        }
        $this->load->model('Divisi_model');
        $this->load->library('form_validation');
        $this->user = $this->ion_auth->user()->row();
    }

    public function messageAlert($type, $title)
    {
        $messageAlert = "
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });

        Toast.fire({
            type: '" . $type . "',
            title: '" . $title . "'
        });
        ";
        return $messageAlert;
    }

    public function index()
    {
        $chek = $this->ion_auth->is_admin();

        if (!$chek) {
            $hasil = 0;
        } else {
            $hasil = 1;
        }
        $user = $this->user;
        $divisi = $this->Divisi_model->get_all();

        $data = array(
            'divisi_data' => $divisi,
            'user' => $user,
            'users'     => $this->ion_auth->user()->row(),
            'result' => $hasil,

        );
        $this->template->load('template/template', 'divisi/divisi_list', $data);
        $this->load->view('template/datatables');
    }


    public function rd($id)
    {
        $user = $this->user;
        $divisi = $this->Divisi_model->get_by_id_q($id);

        $data = array(
            'divisi_data' => $divisi,
            'user' => $user,
            'users'     => $this->ion_auth->user()->row(),

        );
        $this->template->load('template/template', 'divisi/divisi_read', $data);
        $this->load->view('template/datatables');
    }

    public function read($id)
    {

        $user = $this->user;
        $divisi = $this->Divisi_model->get_by_id_q($id);
        $data = array(
            'divisi_data' => $divisi,
            'user' => $user,
            'users'     => $this->ion_auth->user()->row(),
        );
        $this->template->load('template/template', 'divisi/divisi_read', $data);
    }

    public function create()
    {
        if (!$this->ion_auth->is_admin()) {
            show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $user = $this->user;
        $data = array(
            'box' => 'info',
            'button' => 'Create',
            'action' => site_url('divisi/create_action'),
            'id_divisi' => set_value('id_divisi'),
            'nama_divisi' => set_value('nama_divisi'),
            'user' => $user, 'users'     => $this->ion_auth->user()->row(), 'users'     => $this->ion_auth->user()->row(),
        );
        $this->template->load('template/template', 'divisi/divisi_form', $data);
    }

    public function create_action()
    {
        if (!$this->ion_auth->is_admin()) {
            show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_divisi' => strtoupper($this->input->post('nama_divisi', TRUE)),
            );
            $this->Divisi_model->insert($data);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Berhasil menambahkan Divisi'));
            redirect(site_url('divisi'));
        }
    }

    public function update($id)
    {
        if (!$this->ion_auth->is_admin()) {
            show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $user = $this->user;
        $row = $this->Divisi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'box' => 'warning',
                'button' => 'Update',
                'action' => site_url('divisi/update_action'),
                'id_divisi' => set_value('id_divisi', $row->id_divisi),
                'nama_divisi' => set_value('nama_divisi', $row->nama_divisi),
                'user' => $user,
                'users'     => $this->ion_auth->user()->row(),
            );
            $this->template->load('template/template', 'divisi/divisi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('divisi'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_divisi', TRUE));
        } else {
            $data = array(
                'nama_divisi' => strtoupper($this->input->post('nama_divisi', TRUE)),
            );
            $this->Divisi_model->update($this->input->post('id_divisi', TRUE), $data);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Berhasil merubah data divisi'));
            redirect(site_url('divisi'));
        }
    }

    public function delete($id)
    {
        if (!$this->ion_auth->is_admin()) {
            show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $row = $this->Divisi_model->get_by_id($id);

        if ($row) {
            $this->Divisi_model->delete($id);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Berhasil menghapus data divisi'));
            redirect(site_url('divisi'));
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('danger', 'data divisi tidak ditemukan'));
            redirect(site_url('divisi'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_divisi', 'nama divisi', 'trim|required');
        $this->form_validation->set_rules('id_divisi', 'id_divisi', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

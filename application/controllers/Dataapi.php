<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// Include Libraries Rest API
require APPPATH . '/libraries/REST_Controller.php';

class Dataapi extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // Data Pedagang by NPWRD
    function pedagang_get() {
        $id = $this->get('id');

        $Data_Pedagang = array();

        if ($id == '') { // Jika ID NPWRD Kosong
            $Data_Pedagang[] = array(  'resp_code'  => 'S5', 
                                       'resp_desc'  => 'Data hasn’t registered',
                                       'nama'       => '',
                                        'pasar'      => '',
                                        'tempat'     => '',
                                        'hp'         => ''
                                    );

            $this->response($Data_Pedagang, 400);
        } else { // Jika NPWRD Ada
            $this->db->select('r.pasar_nama, LEFT(p.penduduk_nama, 30) AS nama, t.tempat_nama, d.dasar_blok, d.dasar_nomor');
            $this->db->from('sipp_dasar d');
            $this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
            $this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
            $this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
            $this->db->where('d.dasar_npwrd', $id);

            $data = $this->db->get()->row();
            if  (count($data) > 0) { 
                $Data_Pedagang[] = array(  'resp_code'  => '00', 
                                           'resp_desc'  => 'Success',
                                           'nama'       => $data->nama,
                                           'pasar'      => $data->pasar_nama,
                                           'tempat'     => $data->tempat_nama.' '.$data->dasar_blok.' NO. '.$data->dasar_nomor,
                                           'hp'         => ''
                                        );
                $this->response($Data_Pedagang, 200);
            } else {
                $Data_Pedagang[] = array(  'resp_code'  => 'S3',
                                           'resp_desc'  => 'Data Not Found',
                                           'nama'       => '',
                                           'pasar'      => '',
                                           'tempat'     => '',
                                           'hp'         => ''
                                        );

                $this->response($Data_Pedagang, 200);
            }
        }
    }

    // Total Tagihan by NPWRD
    function tagihantotal_get() {
        $id = $this->get('id');

        $Data_Tagihan = array();

        if ($id == '') { // Jika ID NPWRD Kosong
            $Data_Tagihan[] = array(    'resp_code'  => 'S5', 
                                        'resp_desc'  => 'Data hasn’t registered',
                                        'amount'     => 0,
                                        'data'       => ''
                                    );
            $this->response($Data_Tagihan, 400);
        } else { // Cek Data Pedagang
            $this->db->select('p.penduduk_nama');
            $this->db->from('sipp_dasar d');
            $this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
            $this->db->where('d.dasar_npwrd', $id);

            $data = $this->db->get()->row();
            if (count($data) > 0) { // Jika Data Pedagang Ada, Cek Total Tagihan
                $this->db->select('p.penduduk_nama, SUM(s.skrd_total) AS total, t.tempat_nama, d.dasar_blok, d.dasar_nomor');
                $this->db->from('sipp_skrd s');
                $this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
                $this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
                $this->db->join('sipp_tempat t', 'd.tempat_id = t.tempat_id');
                $this->db->join('sipp_pasar r', 'd.pasar_id = r.pasar_id');
                $this->db->where('d.dasar_npwrd', $id);
                $this->db->where('s.skrd_status', 1);
                $this->db->group_by('d.dasar_npwrd');

                $dataTagihan = $this->db->get()->row();
                if (count($dataTagihan) > 0) {
                    $Data_Tagihan[] = array(    'resp_code'  => '00',
                                                'resp_desc'  => 'Success',
                                                'amount'     => (int)$dataTagihan->total,
                                                'data'       => $dataTagihan->tempat_nama.' '.$dataTagihan->dasar_blok.' NO. '.$dataTagihan->dasar_nomor
                                            );

                    $this->response($Data_Tagihan, 200);
                } else {
                    $Data_Tagihan[] = array(    'resp_code'  => 'S4',
                                                'resp_desc'  => 'Paid',
                                                'amount'     => 0,
                                                'data'       => '' 
                                            );
                    $this->response($Data_Tagihan, 200);
                }
            } else {
                $Data_Tagihan[] = array(    'resp_code'  => 'S3',
                                            'resp_desc'  => 'Data Not Found',
                                            'amount'     => 0,
                                            'data'       => ''
                                        );

                $this->response($Data_Tagihan, 200);
            }
        }
    }

    // Update Tagihan by NPWRD
    function payment_put() {
        $id    = $this->put('id');

        $Data_Tagihan = array();
        if ($id == '') { // Jika ID NPWRD Kosong
            $Data_Tagihan[] = array(    'resp_code'  => 'S5', 
                                        'resp_desc'  => 'Data hasn’t registered'
                                    );

            $this->response($Data_Tagihan, 400);
        } else { 
            // Cek Data Pedagang
            $this->db->select('p.penduduk_nama');
            $this->db->from('sipp_dasar d');
            $this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
            $this->db->where('d.dasar_npwrd', $id);

            $data = $this->db->get()->row();
            if (count($data) > 0) { // Jika Data Pedagang Ada, Cek Total Tagihan
                // Query untuk Data SKRD yang belum dibayar
                $this->db->select('s.skrd_id, s.skrd_total, s.skrd_tgl_bayar, s.skrd_status, s.skrd_bayar, 
                                    s.skrd_kembali, d.dasar_npwrd');
                $this->db->from('sipp_skrd s');
                $this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
                $this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
                $this->db->where('d.dasar_npwrd', $id);
                $this->db->where('s.skrd_status', 1);

                $ListTagihan    = $this->db->get()->result();
                if (count($ListTagihan) > 0) {
                    foreach($ListTagihan as $row) {
                        $skrd_id = $row->skrd_id;
                        $data = array(
                                        'skrd_tgl_bayar'    => date('Y-m-d'),
                                        'skrd_status'       => 2,
                                        'skrd_bayar'        => $row->skrd_total,
                                        'skrd_kembali'      => 0,
                                        'skrd_date_update'  => date('Y-m-d'),
                                        'skrd_time_update'  => date('Y-m-d H:i:s')
                                    );
                        
                        $this->db->where('skrd_id', $skrd_id);
                        $update = $this->db->update('sipp_skrd', $data);
                    }
                    
                    if ($update) {
                        $Data_Tagihan[] = array('resp_code' => '00', 'resp_desc' => 'Success' );
                    } else {
                        $Data_Tagihan[] = array('resp_code' => 'S1', 'resp_desc' => 'Mailfunction System' );
                    }
                } else {
                    $Data_Tagihan[] = array('resp_code' => 'S4', 'resp_desc' => 'Paid');
                }
            } else {
                $Data_Tagihan[] = array('resp_code' => 'S3', 'resp_desc' => 'Data Not Found');
            }

            $this->response($Data_Tagihan, 200);
        }
    }

    // Update Tagihan by NPWRD
    function reversal_put() {
        $id    = $this->put('id');

        $Data_Tagihan = array();

        if ($id == '') { // Jika ID NPWRD Kosong
            $Data_Tagihan[] = array(    'resp_code'  => 'S5', 
                                        'resp_desc'  => 'Data hasn’t registered'
                                    );

            $this->response($Data_Tagihan, 400);
        } else { 
            // Cek Data Pedagang
            $this->db->select('p.penduduk_nama');
            $this->db->from('sipp_dasar d');
            $this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
            $this->db->where('d.dasar_npwrd', $id);

            $data = $this->db->get()->row();
            if (count($data) > 0) { // Jika Data Pedagang Ada, Cek Total Tagihan
                // Query untuk Data SKRD yang belum dibayar
                $this->db->select('s.skrd_id, s.skrd_total, s.skrd_tgl_bayar, s.skrd_status, s.skrd_bayar, 
                                    s.skrd_kembali, d.dasar_npwrd');
                $this->db->from('sipp_skrd s');
                $this->db->join('sipp_dasar d', 's.dasar_id = d.dasar_id');
                $this->db->join('sipp_penduduk p', 'd.penduduk_id = p.penduduk_id');
                $this->db->where('d.dasar_npwrd', $id);
                $this->db->where('s.skrd_status', 2);

                $ListTagihan    = $this->db->get()->result();
                if (count($ListTagihan) > 0) {
                    foreach($ListTagihan as $row) {
                        $skrd_id = $row->skrd_id;
                        $data = array(
                                        'skrd_tgl_bayar'    => '',
                                        'skrd_status'       => 1,
                                        'skrd_bayar'        => 0,
                                        'skrd_kembali'      => 0,
                                        'skrd_date_update'  => date('Y-m-d'),
                                        'skrd_time_update'  => date('Y-m-d H:i:s')
                                    );
                        
                        $this->db->where('skrd_id', $skrd_id);
                        $update = $this->db->update('sipp_skrd', $data);
                    }

                    if ($update) {
                        $Data_Tagihan[] = array('resp_code' => '00', 'resp_desc' => 'Success' );
                    } else {
                        $Data_Tagihan[] = array('resp_code' => 'S1', 'resp_desc' => 'Mailfunction System' );
                    }
                } else {
                    $Data_Tagihan[] = array('resp_code' => 'S6', 'resp_desc' => 'Data Expired');
                }
            } else {
                $Data_Tagihan[] = array('resp_code' => 'S3', 'resp_desc' => 'Data Not Found');
            }

            $this->response($Data_Tagihan, 200);
        }
    }
}

/* Location: ./application/controllers/Dataapi.php */
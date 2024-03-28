<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_beranda extends CI_Model
    {
        public function get_data()
        {

            $query = $this->db->get('laporan');
            return $query->result(); 
        }
        public function get_data_by_status($status)
        {
            $this->db->where('status', $status);
            $query = $this->db->get('laporan');

            return $query->result();
        }
        public function update_laporan($id_laporan)
        {
            $data = array(
                'status' => 'setuju'
            );

            $this->db->where('id_laporan', $id_laporan);
            $this->db->update('laporan', $data);
        }
        public function update_laporan_tolak($id_laporan)
        {
            $data = array(
                'status' => 'tolak',
                'catatan' => $this->input->post('catatan')
            );


            $this->db->where('id_laporan', $id_laporan);
            $this->db->update('laporan', $data);
        }
        public function update_laporan_edit($id_laporan)
        {
            $data = array(
                'status' => 'tolak'
            );

            $this->db->where('id_laporan', $id_laporan);
            $this->db->update('laporan', $data);
        }
        public function search($search)
        {
            $this->db->like('nama', $search);
            $this->db->or_like('type', $search);
            $query = $this->db->get('laporan');
            return $query->result();
        }
        public function tambah_data($data)
        {
            $this->db->insert('laporan', $data);
        }
        public function get_laporan_by_id($id)
        {
            $this->db->select('laporan.*, soal.soal');
            $this->db->from('laporan');
            $this->db->join('soal', 'soal.cabang = laporan.cabang');
            $this->db->where('laporan.id_laporan', $id);
            $query = $this->db->get();
            return $query->result(); 
        }
        function count($journey, $id, $today, $end_value , $id_pelabuhan, $id_kapal, $id_journey) {
            $this->db->select_sum('laporan.poin');
            $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
            $this->db->where('journey.journey', $journey);
            if($id != null){
                $this->db->where('laporan.id_cabang', $id);
            }
            
            if($id_journey != null){
                $this->db->where('laporan.id_journey', $id_journey);
            }
            if ($end_value != null){
                $this->db->where('laporan.tanggal >=', $today);
                $this->db->where('laporan.tanggal <=', $end_value);
            }else {
                $this->db->where('laporan.tanggal', $today);
            }
            if ($id_kapal != null) {
                $this->db->where('laporan.id_kapal', $id_kapal);
            }
            if ($id_pelabuhan != null) {
                $this->db->where('laporan.id_pelabuhan', $id_pelabuhan);
            }

            $this->db->where('laporan.status', 'setuju');
            $query = $this->db->get('laporan');
        
            // if ($query->num_rows() > 0) {
            //     $row = $query->row();
            //     $total_points = $row->poin;
        
            //     $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            //     $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
            //     $this->db->where('journey.journey', $journey);
            //     if($id != null){
            //         $this->db->where('laporan.id_cabang', $id);
            //     }
                 
                 
            //     if ($end_value != null){
            //         $this->db->where('laporan.tanggal >=', $today);
            //         $this->db->where('laporan.tanggal <=', $end_value);
            //     }else {
            //         $this->db->where('laporan.tanggal', $today);
            //     }
            //      if ($id_kapal != null) {
            //         $this->db->where('laporan.id_kapal', $id_kapal);
            //     }
            //     if($id_journey != null){
            //         $this->db->where('laporan.id_journey', $id_journey);
            //     }
            //     if ($id_pelabuhan != null) {
            //        $this->db->where('laporan.id_pelabuhan', $id_pelabuhan);
            //    }
            //     $this->db->where('laporan.status', 'setuju');
            //     $count = $this->db->count_all_results('laporan');
        
            //     if ($count > 0) {
            //         $average_points = $total_points / $count;
            //         $rounded_average = round($average_points);
            //         return $rounded_average;
            //     }
            // }
            // if ($query->num_rows() > 0) {
            //     $row = $query->row();
            //     $total_points = $row->poin;
            
            //     $this->db->select_sum('laporan.poin');
            //     $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            //     $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
            //     $this->db->where('journey.journey', $journey);
            //     if($id != null){
            //         $this->db->where('laporan.id_cabang', $id);
            //     }
                
            //     if ($end_value != null){
            //         $this->db->where('laporan.tanggal >=', $today);
            //         $this->db->where('laporan.tanggal <=', $end_value);
            //     } else {
            //         $this->db->where('laporan.tanggal', $today);
            //     }
                
            //     if ($id_kapal != null) {
            //         $this->db->where('laporan.id_kapal', $id_kapal);
            //     }
            //     if($id_journey != null){
            //         $this->db->where('laporan.id_journey', $id_journey);
            //     }
            //     if ($id_pelabuhan != null) {
            //         $this->db->where('laporan.id_pelabuhan', $id_pelabuhan);
            //     }
            //     $this->db->where('laporan.status', 'setuju');
            //     $query = $this->db->get('laporan');
            //     $result = $query->row();
                
            //     if ($result) {
            //         $rounded_points = round($result->poin);
            //         return $rounded_points;
            //     }
            // }
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $total_points = $row->poin;
            
                $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
                $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
                $this->db->where('journey.journey', $journey);
                if($id != null){
                    $this->db->where('laporan.id_cabang', $id);
                }
                         
                if ($end_value != null){
                    $this->db->where('laporan.tanggal >=', $today);
                    $this->db->where('laporan.tanggal <=', $end_value);
                } else {
                    $this->db->where('laporan.tanggal', $today);
                }
                if ($id_kapal != null) {
                    $this->db->where('laporan.id_kapal', $id_kapal);
                }
                if($id_journey != null){
                    $this->db->where('laporan.id_journey', $id_journey);
                }
                if ($id_pelabuhan != null) {
                   $this->db->where('laporan.id_pelabuhan', $id_pelabuhan);
                }
                $this->db->where('laporan.status', 'setuju');
                $this->db->group_by('laporan.id_type_option'); // Group by id_type_option
                
                $query = $this->db->get('laporan');
                $result = $query->result();
            
                $rounded_points = 0;
            
                if ($result) {
                    // Hitung jumlah data yang sesuai dengan kriteria
                    $this->db->from('type_option');
                    $this->db->join('journey', 'journey.id_journey = type_option.id_journey');
                    if($id != null){
                    $this->db->where('type_option.id_cabang', $id);
                    }
                    $this->db->where('journey.journey', $journey);
                    $count = $this->db->count_all_results();
            
                    foreach ($result as $row) {
                        // if( $count != 0){
                        //     $average_points = $row->poin / $count;
                        // }else{
                        //     $average_points = $row->poin ;
                        // }
                        $average_points = $row->poin / $count;
                         // Hitung rata-rata per id_type_option
                        $rounded_points += round($average_points);
                    }
                } else {
                    $rounded_points = round($total_points);
                }
            
                return $rounded_points;
            }
            
            
        
            return 0;
        }
        function count_pre($id, $today, $end_value , $id_kapal) {
            $this->db->select_sum('laporan.poin');
            $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
            $this->db->where('journey.journey', 'Pre Journey');
             $this->db->where('laporan.id_cabang', $id);

            if ($end_value === null){
                $this->db->where('laporan.tanggal', $today);
            }else {
                $this->db->where('tanggal >=', $today);
                $this->db->where('tanggal <=', $end_value);
            }
            if ($id_kapal != null) {
                $this->db->where('laporan.id_kapal', $id_kapal);
            }

            $this->db->where('laporan.status', 'setuju');
            $query = $this->db->get('laporan');
        
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $total_points = $row->poin;
        
                $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
                $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
                $this->db->where('journey.journey', 'Pre Journey');
                 $this->db->where('laporan.id_cabang', $id);
                 if ($end_value === null){
                    $this->db->where('laporan.tanggal', $today);
                 }else {
                    $this->db->where('tanggal >=', $today);
                    $this->db->where('tanggal <=', $end_value);
                 }
                 if ($id_kapal != null) {
                    $this->db->where('laporan.id_kapal', $id_kapal);
                }
                $this->db->where('laporan.status', 'setuju');
                $count = $this->db->count_all_results('laporan');
        
                if ($count > 0) {
                    $average_points = $total_points / $count;
                    $rounded_average = round($average_points);
                    return $rounded_average;
                }
            }
        
            return 0;
        }
        function count_port($id, $today, $end_value, $id_kapal){
            $this->db->select_sum('laporan.poin');
            $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
            $this->db->where('journey.journey', 'Port Journey');
             $this->db->where('laporan.id_cabang', $id);
             if ($end_value === null){
                $this->db->where('laporan.tanggal', $today);
             }else {
                $this->db->where('tanggal >=', $today);
                $this->db->where('tanggal <=', $end_value);
             }
             if ($id_kapal != null) {
                $this->db->where('laporan.id_kapal', $id_kapal);
            }
            $this->db->where('laporan.status', 'setuju');
            $query = $this->db->get('laporan');
        
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $total_points = $row->poin;
        
                $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
                $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
                $this->db->where('journey.journey', 'Port Journey');
                 $this->db->where('laporan.id_cabang', $id);
                 if ($end_value === null){
                $this->db->where('laporan.tanggal', $today);
                }else {
                    $this->db->where('tanggal >=', $today);
                    $this->db->where('tanggal <=', $end_value);
                }
                if ($id_kapal != null) {
                    $this->db->where('laporan.id_kapal', $id_kapal);
                }
                $this->db->where('laporan.status', 'setuju');
                $count = $this->db->count_all_results('laporan');
        
                if ($count > 0) {
                    $average_points = $total_points / $count;
                    $rounded_average = round($average_points);
                    return $rounded_average;
                }
            }
        
            return 0;
        }
        function count_on($id, $today, $end_value, $id_kapal){
            $this->db->select_sum('laporan.poin');
            $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
            $this->db->where('journey.journey', 'On Board Journey');
             $this->db->where('laporan.id_cabang', $id);
             if ($end_value === null){
                $this->db->where('laporan.tanggal', $today);
                }else {
                    $this->db->where('tanggal >=', $today);
                    $this->db->where('tanggal <=', $end_value);
                }
                if ($id_kapal != null) {
                    $this->db->where('laporan.id_kapal', $id_kapal);
                }
            $this->db->where('laporan.status', 'setuju');
            $query = $this->db->get('laporan');
        
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $total_points = $row->poin;
        
                $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
                $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
                $this->db->where('journey.journey', 'On Board Journey');
                 $this->db->where('laporan.id_cabang', $id);
                 if ($end_value === null){
                $this->db->where('laporan.tanggal', $today);
                }else {
                    $this->db->where('tanggal >=', $today);
                    $this->db->where('tanggal <=', $end_value);
                }
                if ($id_kapal != null) {
                    $this->db->where('laporan.id_kapal', $id_kapal);
                }
                $this->db->where('laporan.status', 'setuju');
                $count = $this->db->count_all_results('laporan');
        
                if ($count > 0) {
                    $average_points = $total_points / $count;
                    $rounded_average = round($average_points);
                    return $rounded_average;
                }
            }
        
            return 0;
        }
        function count_post($id, $today, $end_value, $id_kapal){
            $this->db->select_sum('laporan.poin');
            $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
            $this->db->where('journey.journey', 'Post Journey');
             $this->db->where('laporan.id_cabang', $id);
             if ($end_value === null){
                $this->db->where('laporan.tanggal', $today);
                }else {
                    $this->db->where('tanggal >=', $today);
                    $this->db->where('tanggal <=', $end_value);
                }
                if ($id_kapal != null) {
                    $this->db->where('laporan.id_kapal', $id_kapal);
                }
            $this->db->where('laporan.status', 'setuju');
            $query = $this->db->get('laporan');
        
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $total_points = $row->poin;
        
                $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
                $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
                $this->db->where('journey.journey', 'Post Journey');
                 $this->db->where('laporan.id_cabang', $id);
                 if ($end_value === null){
                $this->db->where('laporan.tanggal', $today);
                }else {
                    $this->db->where('tanggal >=', $today);
                    $this->db->where('tanggal <=', $end_value);
                }
                if ($id_kapal != null) {
                    $this->db->where('laporan.id_kapal', $id_kapal);
                }
                $this->db->where('laporan.status', 'setuju');
                $count = $this->db->count_all_results('laporan');
        
                if ($count > 0) {
                    $average_points = $total_points / $count;
                    $rounded_average = round($average_points);
                    return $rounded_average;
                }
            }
        
            return 0;
        }
        function count_all($id, $today, $end_value , $id_pelabuhan, $id_kapal, $id_journey)
        {
            $this->db->select_sum('laporan.poin');
            $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
             $this->db->where('laporan.id_cabang', $id);
             if($id_journey != null){
                $this->db->where('laporan.id_journey', $id_journey);
            }
             if ($end_value === null){
                $this->db->where('laporan.tanggal', $today);
                }else {
                    $this->db->where('tanggal >=', $today);
                    $this->db->where('tanggal <=', $end_value);
                }
                if ($id_kapal != null) {
                    $this->db->where('laporan.id_kapal', $id_kapal);
                }
                if ($id_pelabuhan != null) {
                   $this->db->where('laporan.id_pelabuhan', $id_pelabuhan);
               }
            $this->db->where('laporan.status', 'setuju');
            $query = $this->db->get('laporan');
        
            if ($query->num_rows() > 0) {
                
                $row = $query->row();
                $total_points = $row->poin;
                $this->db->select_sum('laporan.poin');
                $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
                $this->db->where('laporan.id_cabang', $id);
                if($id_journey != null){
                    $this->db->where('laporan.id_journey', $id_journey);
                }
                if ($end_value === null){
                $this->db->where('laporan.tanggal', $today);
                }else {
                    $this->db->where('tanggal >=', $today);
                    $this->db->where('tanggal <=', $end_value);
                }
                if ($id_kapal != null) {
                    $this->db->where('laporan.id_kapal', $id_kapal);
                }
                if ($id_pelabuhan != null) {
                   $this->db->where('laporan.id_pelabuhan', $id_pelabuhan);
               }
                $this->db->where('laporan.status', 'setuju');
                $count = $this->db->count_all_results('laporan');
                
                if ($count > 0) {
                    $average_points = $total_points / $count;
                    $rounded_average = round($average_points);
                    return $rounded_average;
                }
            } else {
                // Jika tidak ada data yang sesuai dengan kondisi
                return 0;
            }
        }
        function count_all_admin($today)
        {
            $this->db->select_sum('laporan.poin');
            $this->db->where('laporan.tanggal', $today);
            $this->db->where('laporan.status', 'setuju');
            $query = $this->db->get('laporan');

            if ($query->num_rows() > 0) {
                // Jika ada data yang sesuai dengan kondisi
                $result = $query->row_array();
                return $result['poin'];
            } else {
                // Jika tidak ada data yang sesuai dengan kondisi
                return 0;
            }
        }

        
        public function count_item($id, $type_journey)
        {
            $this->db->from('type_option');
            $this->db->join('journey', 'journey.id_journey = type_option.id_journey');
            $this->db->where('type_option.id_cabang', $id);
            $this->db->where('journey.journey', $type_journey);
            $count = $this->db->count_all_results(); // Menghitung jumlah data

            return $count;
        }
        public function count_item_admin($type_journey)
        {
            $this->db->from('type_option');
            $this->db->join('journey', 'journey.id_journey = type_option.id_journey');
            $this->db->where('journey.journey', $type_journey);
            $count = $this->db->count_all_results(); // Menghitung jumlah data

            return $count;
        }
        // public function count_item_admin_null($journey)
        // {
        //     $this->db->from('type_option');
        //     $this->db->where('id_journey', $journey);
        //     $count = $this->db->count_all_results(); // Menghitung jumlah data

        //     return $count;
        // }
        public function count_done($id, $type_journey, $today)
        {
            $this->db->from('laporan');
            $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            $this->db->where('laporan.id_cabang', $id);
            $this->db->where('journey.journey', $type_journey);
            $this->db->where('laporan.tanggal', $today);
            $this->db->where('laporan.status', 'setuju');
            $count = $this->db->count_all_results(); // Menghitung jumlah data

            return $count;
        }
        public function count_done_admin( $type_journey, $today)
        {
            $this->db->from('laporan');
            $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            $this->db->where('journey.journey', $type_journey);
            $this->db->where('laporan.tanggal', $today);
            $this->db->where('laporan.status', 'setuju');
            $count = $this->db->count_all_results(); // Menghitung jumlah data

            return $count;
        }
        public function count_item_item($id, $journey)
        {
            $this->db->from('type_option');
            $this->db->where('type_option.id_cabang', $id);
            $this->db->where('type_option.id_journey', $journey);
            $count = $this->db->count_all_results(); // Menghitung jumlah data

            return $count;
        }
        public function count_item_item_null($journey)
        {
            $this->db->from('type_option');
            $this->db->join('journey', 'journey.id_journey = type_option.id_journey');
            $this->db->where('journey.journey', $journey);
            $count = $this->db->count_all_results(); // Menghitung jumlah data

            return $count;
        }
        public function count_done_item($id, $journey, $today)
        {
            $this->db->from('laporan');
            $this->db->where('laporan.id_cabang', $id);
            $this->db->where('laporan.id_journey', $journey);
            $this->db->where('laporan.tanggal', $today);
            $this->db->where('laporan.status', 'setuju');
            $count = $this->db->count_all_results(); // Menghitung jumlah data

            return $count;
        }
        public function count_done_item_null($journey, $today)
        {
            $this->db->from('laporan');
            $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            $this->db->where('journey.journey', $journey);
            $this->db->where('laporan.tanggal', $today);
            $this->db->where('laporan.status', 'setuju');
            $count = $this->db->count_all_results(); // Menghitung jumlah data

            return $count;
        }
        public function item($id)
        {
            
            // $this->db->join('laporan', 'laporan.id_journey = journey.id_journey');
            $this->db->where('journey.id_cabang', $id);
            $query = $this->db->get('journey');
        
            return $query->result();
        }
        
        public function item_barchart($id)
        {
            $this->db->where('journey.id_cabang', $id);
            $query = $this->db->get('journey');

            return $query->result_array();
        }



        public function item_admin()
        {
            $query = $this->db->get('journey');
            if ($query->num_rows() > 0) {
                // Jika data ada, kembalikan hasilnya
                return $query->result();
            } else {
                return array(); // Kembalikan array kosong jika tidak ada data
            }
            
        }
        public function item_admin_next($journey)
        {
            $this->db->where('journey.journey', $journey);
            $this->db->where('id_cabang', '1');
            $query = $this->db->get('journey');
            
            return $query->row();
        }

        public function item_journey($id, $id_journey)
        {
            
            if($id_journey != null){
                $this->db->where('type_option.id_journey', $id_journey);
            }
            $this->db->where('type_option.id_cabang', $id);
            $query = $this->db->get('type_option');
            
        
            return $query->result();
        }
        
        public function item_journey_null($journey)
        {
            $this->db->select('type_option.*'); // Select columns from type_option
            $this->db->from('type_option');
            $this->db->join('journey', 'journey.id_journey = type_option.id_journey');
            
            // Decode the URL-encoded $journey parameter to restore spaces
            $decoded_journey = urldecode($journey);
            
            $this->db->where('journey.journey', $decoded_journey);
            
            $query = $this->db->get();
            
            if ($query) {
                return $query->result();
            } else {
                // Handle the error, you can return an empty array or handle it as needed
                return array();
            }
        }

        public function item_journey_nama($id, $journey)
        {
            $this->db->select('type_option.*'); // Select columns from type_option
            $this->db->from('type_option');
            $this->db->join('journey', 'journey.id_journey = type_option.id_journey');
            
            // Decode the URL-encoded $journey parameter to restore spaces
            $decoded_journey = urldecode($journey);
            
            $this->db->where('journey.journey', $decoded_journey);
            $this->db->where('type_option.id_cabang', $id);
          
            $query = $this->db->get();
            
            if ($query) {
                return $query->result();
            } else {
                // Handle the error, you can return an empty array or handle it as needed
                return array();
            }
        }
        public function item_journey_id_cabang($id, $journey)
        {
            $this->db->select('type_option.*'); // Select columns from type_option
            $this->db->from('type_option');
            $this->db->join('journey', 'journey.id_journey = type_option.id_journey');
            
            // Decode the URL-encoded $journey parameter to restore spaces
            $decoded_journey = urldecode($journey);
            
            $this->db->where('journey.journey', $decoded_journey);
            $this->db->where('type_option.id_cabang', $id);
          
            $query = $this->db->get();
            
            if ($query) {
                return $query->row();
            } else {
                // Handle the error, you can return an empty array or handle it as needed
                return array();
            }
        }
        public function item_journey_id($journey)
        {
            $this->db->select('type_option.*'); // Select columns from type_option
            $this->db->from('type_option');
            $this->db->join('journey', 'journey.id_journey = type_option.id_journey');
            
            // Decode the URL-encoded $journey parameter to restore spaces
            $decoded_journey = urldecode($journey);
            
            $this->db->where('journey.journey', $decoded_journey);
          
            $query = $this->db->get();
            
            if ($query) {
                return $query->row();
            } else {
                // Handle the error, you can return an empty array or handle it as needed
                return array();
            }
        }
        public function item_journey_nama_no_cabang($journey)
        {
            $this->db->select('type_option.*'); // Select columns from type_option
            $this->db->from('type_option');
            $this->db->join('journey', 'journey.id_journey = type_option.id_journey');
            
            // Decode the URL-encoded $journey parameter to restore spaces
            $decoded_journey = urldecode($journey);
            
            $this->db->where('journey.journey', $decoded_journey);
          
            $query = $this->db->get();
            
            if ($query) {
                return $query->result();
            } else {
                // Handle the error, you can return an empty array or handle it as needed
                return array();
            }
        }
        public function item_journey_pelabuhan($id, $id_pelabuhan)
        {
            $this->db->select('type_option.*'); // Select columns from type_option
            $this->db->from('type_option');
            $this->db->where('type_option.id_pelabuhan', $id_pelabuhan);
            $this->db->where('type_option.id_cabang', $id);
          
            $query = $this->db->get();
            
            if ($query) {
                return $query->result();
            } else {
                // Handle the error, you can return an empty array or handle it as needed
                return array();
            }
        }
        public function item_journey_kapal($id, $id_kapal)
        {
            $this->db->select('type_option.*'); // Select columns from type_option
            $this->db->from('type_option');
            $this->db->where('type_option.id_kapal', $id_kapal);
            $this->db->where('type_option.id_cabang', $id);
          
            $query = $this->db->get();
            
            if ($query) {
                return $query->result();
            } else {
                // Handle the error, you can return an empty array or handle it as needed
                return array();
            }
        }
        



        public function nama_journey($id, $journey)
        {
            $this->db->select('journey');
            $this->db->where('journey.id_journey', $journey);
            $this->db->where('journey.id_cabang', $id);
            $query = $this->db->get('journey');
            return $query->row()->journey;
        }
        
        
        public function nama_journey_null($journey)
        {
            $this->db->select('journey');
            $this->db->where('journey.id_journey', $journey);
            $query = $this->db->get('journey');
            return $query->row()->journey;
        }
        

        public function count_item_all($id)
        {
            $this->db->from('type_option');
            $this->db->where('type_option.id_cabang', $id);
            $count = $this->db->count_all_results(); // Menghitung jumlah data

            return $count;
        }
        public function count_item_all_admin()
        {
            $this->db->from('type_option');
            $count = $this->db->count_all_results(); // Menghitung jumlah data

            return $count;
        }
        public function count_done_all($id, $today)
        {
            $this->db->from('laporan');
            $this->db->where('laporan.id_cabang', $id);
            $this->db->where('laporan.tanggal', $today);
            $count = $this->db->count_all_results(); // Menghitung jumlah data

            return $count;
        }
        public function count_done_all_admin( $today)
        {
            $this->db->from('laporan');
            $this->db->where('laporan.tanggal', $today);
            $count = $this->db->count_all_results(); // Menghitung jumlah data

            return $count;
        }
        
        public function getJourneyData($id, $type_journey, $today, $end_value)
        {
            $this->db->select_sum('poin_kendaraan');
            $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            $this->db->where('laporan.id_cabang', $id);
            $this->db->where('journey.journey', $type_journey);
            if ($end_value === null){
                $this->db->where('laporan.tanggal', $today);
             }else {
                $this->db->where('tanggal >=', $today);
                $this->db->where('tanggal <=', $end_value);
             }
            $this->db->where('laporan.status', 'setuju');
            $query = $this->db->get('laporan');

            return $query->row()->poin_kendaraan;
        }
        public function getJourneyData_admin($type_journey, $today)
        {
            $this->db->select_sum('poin_kendaraan');
            $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            $this->db->where('journey.journey', $type_journey);
            $this->db->where('laporan.tanggal', $today);
            $this->db->where('laporan.status', 'setuju');
            $query = $this->db->get('laporan');

            return $query->row()->poin_kendaraan;
        }

        public function getJourneyData_pej($id, $type_journey, $today, $end_value)
        {
            $this->db->select_sum('laporan.poin_pejalan_kaki'); 
            $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            // $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
             $this->db->where('laporan.id_cabang', $id);
            $this->db->where('journey.journey', $type_journey);
            if ($end_value === null){
                $this->db->where('laporan.tanggal', $today);
             }else {
                $this->db->where('tanggal >=', $today);
                $this->db->where('tanggal <=', $end_value);
             }
            $this->db->where('laporan.status', 'setuju');
            $query = $this->db->get('laporan');

            return $query->row()->poin_pejalan_kaki;
        }
        public function getJourneyData_pej_admin( $type_journey, $today)
        {
            $this->db->select_sum('laporan.poin_pejalan_kaki');
            $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            // $this->db->join('cabang', 'cabang.id_cabang = laporan.id_cabang');
            $this->db->where('journey.journey', $type_journey);
            $this->db->where('laporan.tanggal', $today);
            $this->db->where('laporan.status', 'setuju');
            $query = $this->db->get('laporan');

            return $query->row()->poin_pejalan_kaki;
        }
        public function getJourneyItem($id, $journey, $today)
        {
            $this->db->select_sum('poin');
            $this->db->where('laporan.id_cabang', $id);
            $this->db->where('laporan.id_journey', $journey);
            $this->db->where('laporan.tanggal', $today);
            $this->db->where('laporan.status', 'setuju');
            $query = $this->db->get('laporan');

            return $query->row()->poin;
        }
        public function getJourneyItem_null($journey, $today)
        {
            $this->db->select_sum('poin');
            $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            $this->db->where('journey.journey', $journey);
            $this->db->where('laporan.tanggal', $today);
            $this->db->where('laporan.status', 'setuju');
            $query = $this->db->get('laporan');

            return $query->row()->poin;
        }

        // ALL
	function count_pre_all($today){
		$this->db->select_sum('poin'); // Menghitung jumlah total pada kolom 'poin'
		$this->db->join('journey', 'journey.id_journey = laporan.id_journey');
        $this->db->where('journey.journey', 'Pre Journey');
		$this->db->where('tanggal', $today);
		$this->db->where('status', 'setuju');
		$query = $this->db->get('laporan'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai

		if ($query->num_rows() > 0) { 
			$row = $query->row();
			$total_points = $row->poin;

			$this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            $this->db->where('journey.journey', 'Pre Journey');
			$this->db->where('tanggal', $today);
			$this->db->where('status', 'setuju');
			$count = $this->db->count_all_results('laporan'); // Menghitung jumlah data dengan kondisi yang sama

			if ($count > 0) {
				$average_points = $total_points / $count;
				$rounded_average = round($average_points); // Membulatkan hasil rata-rata
				return $rounded_average;
			}
		}

		return 0;
	}
	
	function count_port_all($today){
		$this->db->select_sum('poin'); // Menghitung jumlah total pada kolom 'poin'
		$this->db->join('journey', 'journey.id_journey = laporan.id_journey');
        $this->db->where('journey.journey', 'Port Journey');
		$this->db->where('tanggal', $today);
		$this->db->where('status', 'setuju');
		$query = $this->db->get('laporan'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai

		if ($query->num_rows() > 0) {
			$row = $query->row();
			$total_points = $row->poin;

			$this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            $this->db->where('journey.journey', 'Port Journey');
			$this->db->where('tanggal', $today);
			$this->db->where('status', 'setuju');
			$count = $this->db->count_all_results('laporan'); // Menghitung jumlah data dengan kondisi yang sama

			if ($count > 0) {
				$average_points = $total_points / $count;
				$rounded_average = round($average_points); // Membulatkan hasil rata-rata
				return $rounded_average;
			}
		}

		return 0;
	}
	function count_on_all($today){
		$this->db->select_sum('poin'); // Menghitung jumlah total pada kolom 'poin'
		$this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            $this->db->where('journey.journey', 'On Board Journey');
		$this->db->where('tanggal', $today);
		$this->db->where('status', 'setuju');
		$query = $this->db->get('laporan'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai

		if ($query->num_rows() > 0) {
			$row = $query->row();
			$total_points = $row->poin;

			$this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            $this->db->where('journey.journey', 'On Board Journey');
			$this->db->where('tanggal', $today);
			$this->db->where('status', 'setuju');
			$count = $this->db->count_all_results('laporan'); // Menghitung jumlah data dengan kondisi yang sama

			if ($count > 0) {
				$average_points = $total_points / $count;
				$rounded_average = round($average_points); // Membulatkan hasil rata-rata
				return $rounded_average;
			}
		}

		return 0;
	}
	function count_post_all($today){
		$this->db->select_sum('poin'); // Menghitung jumlah total pada kolom 'poin'
		$this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            $this->db->where('journey.journey', 'Post Journey');
		$this->db->where('tanggal', $today);
		$this->db->where('status', 'setuju');
		$query = $this->db->get('laporan'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai

		if ($query->num_rows() > 0) {
			$row = $query->row();
			$total_points = $row->poin;

			$this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            $this->db->where('journey.journey', 'Post Journey');
			$this->db->where('tanggal', $today);
			$this->db->where('status', 'setuju');
			$count = $this->db->count_all_results('laporan'); // Menghitung jumlah data dengan kondisi yang sama

			if ($count > 0) {
				$average_points = $total_points / $count;
				$rounded_average = round($average_points); // Membulatkan hasil rata-rata
				return $rounded_average;
			}
		}

		return 0;
	}
	function count_allpoint($today)
        {
            $this->db->select_sum('poin'); // Menghitung jumlah total pada kolom 'poin'
            $this->db->where('tanggal', $today); // Menambahkan kondisi tanggal = tanggal hari ini
            $this->db->where('status', 'setuju');
            $query = $this->db->get('laporan'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai

            if ($query->num_rows() > 0) {
                $row = $query->row();
                $total_points = $row->poin;
                
                $this->db->where('tanggal', $today); // Menambahkan kondisi tanggal = tanggal hari ini
                $this->db->where('status', 'setuju');
                $count = $this->db->count_all_results('laporan'); // Menghitung jumlah data dengan kondisi yang sama

                if ($count > 0) {
                    $average_points = $total_points / $count;
                    $rounded_average = round($average_points); // Membulatkan hasil rata-rata
                    return $rounded_average;
                }
            }

            return 0;
        }
		public function getJourneyDataall($type, $type_journey, $today)
        {
            $this->db->select_sum('poin');
            $this->db->where('type', $type);
            $this->db->where('type_journey', $type_journey);
            $this->db->where('tanggal', $today);
            $query = $this->db->get('laporan'); // Ganti "laporan" dengan nama tabel yang sesuai di database Anda

            return $query->row()->poin;
        }
        public function getCabangData()
        {
            // Query untuk mengambil data cabang dari tabel laporan
            $query = $this->db->select('cabang')->get('laporan');
            
            // Mengambil hasil query dalam bentuk array
            $results = $query->result_array();
            
            // Mengubah array hasil query menjadi array cabang
            $cabangData = array_column($results, 'cabang');
            
            return $cabangData;
        }

        public function getTypeJourneyData()
        {
            // Query untuk mengambil data type_journey dari tabel laporan
            $query = $this->db->select('type_journey')->get('laporan');
            
            // Mengambil hasil query dalam bentuk array
            $results = $query->result_array();
            
            // Mengubah array hasil query menjadi array type_journey
            $typeJourneyData = array_column($results, 'type_journey');
            
            return $typeJourneyData;
        }

        function countKendaraanRows($id)
        {
            $this->db->from('soal');
            $this->db->where('type', 'Kendaraan');
            $this->db->where('id_cabang', $id);
            $query = $this->db->get();
            
            return $query->num_rows();
        }
        function countKendaraanRows_admin_all($id, $journey)
        {
            $this->db->from('soal');
            $this->db->where('type', 'Kendaraan');
            $this->db->where('id_cabang', $id);
            $this->db->where('id_journey', $journey);
            $query = $this->db->get();
            
            return $query->num_rows();
        }
        function countKendaraanRows_admin()
        {
            $this->db->from('soal');
            $this->db->where('type', 'Kendaraan');
            $query = $this->db->get();
            
            return $query->num_rows();
        }
        function countKendaraanRows_admin_item($journey)
        {
            $this->db->from('soal');
            $this->db->join('journey', 'journey.id_journey = soal.id_journey');
            $this->db->where('journey.journey', $journey);
            $this->db->where('soal.type', 'Kendaraan');
            $query = $this->db->get();
            
            return $query->num_rows();
        }
        function countKendaraanRows_item($id, $journey)
        {
            $this->db->from('soal');
            $this->db->where('type', 'Kendaraan');
            $this->db->where('id_cabang', $id);
            $this->db->where('id_journey', $journey);
            $query = $this->db->get();
            
            return $query->num_rows();
        }

        function countKendaraanOccurrences($id, $today)
        {
            $this->db->select('type');
            $this->db->where('id_cabang', $id);
            $this->db->where('tanggal', $today);
            $this->db->where('status', 'setuju');
            $query = $this->db->get('laporan');
            $kendaraanCount = 0;

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $types = explode(',', $row->type);
                    foreach ($types as $type) {
                        if (trim($type) === 'Kendaraan') {
                            $kendaraanCount++;
                        }
                    }
                }
            }

            return $kendaraanCount;
        }
        function countKendaraanOccurrences_admin_all($id, $today, $journey)
        {
            $this->db->select('type');
            $this->db->where('id_cabang', $id);
            $this->db->where('tanggal', $today);
            $this->db->where('id_journey', $journey);
            $this->db->where('laporan.status', 'setuju');
            $query = $this->db->get('laporan');
            $kendaraanCount = 0;

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $types = explode(',', $row->type);
                    foreach ($types as $type) {
                        if (trim($type) === 'Kendaraan') {
                            $kendaraanCount++;
                        }
                    }
                }
            }

            return $kendaraanCount;
        }

        function countKendaraanOccurrences_admin($today)
        {
            $this->db->select('type');
            $this->db->where('tanggal', $today);
            $this->db->where('status', 'setuju');
            $query = $this->db->get('laporan');
            $kendaraanCount = 0;

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $types = explode(',', $row->type);
                    foreach ($types as $type) {
                        if (trim($type) === 'Kendaraan') {
                            $kendaraanCount++;
                        }
                    }
                }
            }

            return $kendaraanCount;
        }
        function countKendaraanOccurrences_admin_item($journey, $today)
        {
            $this->db->select('type');
            $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            $this->db->where('journey.journey', $journey);
            $this->db->where('tanggal', $today);
            $this->db->where('laporan.status', 'setuju');
            $query = $this->db->get('laporan');
            $kendaraanCount = 0;

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $types = explode(',', $row->type);
                    foreach ($types as $type) {
                        if (trim($type) === 'Kendaraan') {
                            $kendaraanCount++;
                        }
                    }
                }
            }

            return $kendaraanCount;
        }

        function countKendaraanOccurrences_item($id, $today, $journey)
        {
            $this->db->select('type');
            $this->db->where('id_cabang', $id);
            $this->db->where('tanggal', $today);
            $this->db->where('id_journey', $journey);
            $query = $this->db->get('laporan');
            $kendaraanCount = 0;

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $types = explode(',', $row->type);
                    foreach ($types as $type) {
                        if (trim($type) === 'Kendaraan') {
                            $kendaraanCount++;
                        }
                    }
                }
            }

            return $kendaraanCount;
        }

        function countpejalankakiRows($id)
        {
            $this->db->from('soal');
            $this->db->where('type', 'Pejalan Kaki');
            $this->db->where('id_cabang', $id);
            $query = $this->db->get();
            
            return $query->num_rows();
        }
        function countpejalankakiRows_admin_all($id, $journey)
        {
            $this->db->from('soal');
            $this->db->where('type', 'Pejalan Kaki');
            $this->db->where('id_cabang', $id);
            $this->db->where('id_journey', $journey);
            $query = $this->db->get();
            
            return $query->num_rows();
        }
        function countpejalankakiRows_admin()
        {
            $this->db->from('soal');
            $this->db->where('type', 'Pejalan Kaki');
            $query = $this->db->get();
            
            return $query->num_rows();
        }
        function countpejalankakiRows_admin_item($journey)
        {
            $this->db->from('soal');
            $this->db->join('journey', 'journey.id_journey = soal.id_journey');
            $this->db->where('journey.journey', $journey);
            $this->db->where('type', 'Pejalan Kaki');
            $query = $this->db->get();
            
            return $query->num_rows();
        }

        function countpejalankakiRows_item($id, $journey)
        {
            $this->db->from('soal');
            $this->db->where('type', 'Pejalan Kaki');
            $this->db->where('id_cabang', $id);
            $this->db->where('id_journey', $journey);
            $query = $this->db->get();
            
            return $query->num_rows();
        }
        function countpejalankakiOccurrences($id, $today)
        {
            $this->db->select('type');
            $this->db->where('id_cabang', $id);
            $this->db->where('tanggal', $today);
            $this->db->where('status', 'setuju');
            $query = $this->db->get('laporan');
            $pejalankakiCount = 0;

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $types = explode(',', $row->type);
                    foreach ($types as $type) {
                        if (trim($type) === 'Pejalan Kaki') {
                            $pejalankakiCount++;
                        }
                    }
                }
            }

            return $pejalankakiCount;
        }
        function countpejalankakiOccurrences_admin_all($id, $today, $journey)
        {
            $this->db->select('type');
            $this->db->where('id_cabang', $id);
            $this->db->where('tanggal', $today);
            $this->db->where('id_journey', $journey);
            $this->db->where('laporan.status', 'setuju');
            $query = $this->db->get('laporan');
            $pejalankakiCount = 0;

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $types = explode(',', $row->type);
                    foreach ($types as $type) {
                        if (trim($type) === 'Pejalan Kaki') {
                            $pejalankakiCount++;
                        }
                    }
                }
            }

            return $pejalankakiCount;
        }
        function countpejalankakiOccurrences_admin($today)
        {
            $this->db->select('type');
            $this->db->where('tanggal', $today);
            $this->db->where('status', 'setuju');
            $query = $this->db->get('laporan');
            $pejalankakiCount = 0;

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $types = explode(',', $row->type);
                    foreach ($types as $type) {
                        if (trim($type) === 'Pejalan Kaki') {
                            $pejalankakiCount++;
                        }
                    }
                }
            }

            return $pejalankakiCount;
        }
        function countpejalankakiOccurrences_admin_item($today, $journey)
        {
            $this->db->select('type');
            $this->db->where('tanggal', $today);
            $this->db->join('journey', 'journey.id_journey = laporan.id_journey');
            $this->db->where('journey.journey', $journey);
            $this->db->where('laporan.status', 'setuju');
            $query = $this->db->get('laporan');
            $pejalankakiCount = 0;

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $types = explode(',', $row->type);
                    foreach ($types as $type) {
                        if (trim($type) === 'Pejalan Kaki') {
                            $pejalankakiCount++;
                        }
                    }
                }
            }

            return $pejalankakiCount;
        }
        function countpejalankakiOccurrences_item($id, $today, $journey)
        {
            $this->db->select('type');
            $this->db->where('id_cabang', $id);
            $this->db->where('tanggal', $today);
            $this->db->where('id_journey', $journey);
            $query = $this->db->get('laporan');
            $pejalankakiCount = 0;

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $types = explode(',', $row->type);
                    foreach ($types as $type) {
                        if (trim($type) === 'Pejalan Kaki') {
                            $pejalankakiCount++;
                        }
                    }
                }
            }

            return $pejalankakiCount;
        }

    } 

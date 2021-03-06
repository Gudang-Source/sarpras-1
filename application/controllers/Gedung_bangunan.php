<?php

class Gedung_bangunan extends CI_Controller {
	function __construct(){

		parent::__construct();
		$this->load->helper('url');
		$config['tag_open'] = '<ul class="breadcrumb">';
		$config['tag_close'] = '</ul>';
		$config['li_open'] = '<li>';
		$config['li_close'] = '</li>';
		$config['divider'] = '<span class="divider"> » </span>';
		$this->breadcrumb->initialize($config);
		$this->load->model(array('M_peralatan_mesin','M_input','M_merk','M_pegawai','M_lokasi','M_bidang_barang','M_tanah','M_gedung_bangunan'));
		no_access();
	}
	public function index()
	{
		$id="03";
		$data=array(
			"title"=>'Gedung Bangunan||SIBASWA',
			"menu"=>"menu.php",
			"content"=>"Gedung_bangunan/index.php",
			"aktifmenu"=>"output",
			"aktifsubmenu"=>"gedung",
			"all"=>$this->M_gedung_bangunan->allsub($id)->result(),
			"id"=>$id
		);
		$this->breadcrumb->append_crumb('Output', site_url('output'));
		$this->breadcrumb->append_crumb('Gedung dan Bangunan', site_url('Gedung_bangunan'));
		$this->load->view('admin/template',$data);
	}
	public function detail($id)
	{
		$id=$this->uri->segment(3);
		$data=array(
			"title"=>'Detail||Gedung Bangunan||SIMBABA',
			"menu"=>"menu.php",
			"content"=>"Gedung_bangunan/detail.php",
			"aktifmenu"=>"output",
			"aktifsubmenu"=>"gedung",
			"allbar"=>$this->M_gedung_bangunan->getCount($id)->result(),
			"id"=>$id
		);
		$this->breadcrumb->append_crumb('Output', site_url('output'));
		$this->breadcrumb->append_crumb('Gedung dan Bangunan', site_url('Gedung_bangunan'));
		$this->breadcrumb->append_crumb('Detail Barang', site_url(''));
		$this->load->view('admin/template_full',$data);
	}
    function hapus($id,$id_barang)
    {
         $info=array(
         	"status"=>0
        );
        $this->M_gedung_bangunan->update_proses($info,$id_barang);
        $this->session->set_flashdata('sukses','Data Berhasil Di Nonaktifkan');
        redirect('Gedung_bangunan/detail/'.$id);
    }
    function aktifkan($id,$id_barang)
    {
         $info=array(
         	"status"=>1
        );
        $this->M_gedung_bangunan->update_proses($info,$id_barang);
        $this->session->set_flashdata('sukses','Data Berhasil Di Aktifkan');
        redirect('Gedung_bangunan/detail/'.$id);
    }
   public function edit($subbid,$id)
	{
		$id_bidang='03';
		$sub=$this->M_bidang_barang->getNamaSub($subbid)->row_array();
		$data=array(
			"title"=>'Edit||Detail||SIMBABA',
			"menu"=>"menu.php",
			"content"=>"Gedung_bangunan/edit.php",
			"aktifmenu"=>"output",
			"aktifsubmenu"=>"gedung",
			"id"=>$id,
			"subbid"=>$subbid,
			"barang"=>$this->M_tanah->getBarang($subbid)->result(),
			"getrow"=>$this->M_gedung_bangunan->cekid($id)->row_array(),
			"bidrang"=>$this->M_input->getbidrang($id_bidang)->result(),
		);
		$this->breadcrumb->append_crumb('Output', site_url('output'));
		$this->breadcrumb->append_crumb('Gedung Dan Bangunan', site_url('Gedung_bangunan'));
		$this->breadcrumb->append_crumb('Detail Barang Di <i><strong>'.$sub['nama_subbid_barang'].'</strong></i>', site_url('Gedung_bangunan/detail/'.$subbid));
		$this->breadcrumb->append_crumb('Edit Data', site_url('Gedung_bangunan/detail/'.$subbid));
		$this->load->view('admin/template_full',$data);
	}
	public function update()
	{
		$kode1=$this->input->post('kode1', TRUE);
		if($_FILES['gambar']['name']!=""){
			$file='gambar'; //name pada input type file
			$filename 	= $_FILES['gambar']['name'];
			$dir		= "upload/";
			$dir1		= "uploads/";
			$dirs		= "uploads/";
			$file		= 'gambar';
			$new_name	='updatebangunan'.date('YmdHis').$this->input->post('id_barang'); //name pada input type file
			$tipe 		= $_FILES['gambar']['type'];
			$ukuran 	= $_FILES['gambar']['size'];
			$vdir_upload	= $dir;
			$file_name		= $_FILES[''.$file.'']["name"];
			$vfile_upload	= $vdir_upload.$file;
			$tmp_file		= $_FILES[''.$file.'']["tmp_name"];
			move_uploaded_file ($tmp_file, $dir.$file_name);
			date_default_timezone_get('Asia/Jakarta');
			$source_url=$dir.$file_name;
			$info=getimagesize($source_url);
			if ($ukuran < 300000 and $ukuran > 10000) {	
				$quality=100;// anda bisa menysesuaikan dengan mengganti valuenya
			}
			elseif ($ukuran < 1000000 and $ukuran > 300000) {	
				$quality=70;// anda bisa menysesuaikan dengan mengganti valuenya
			}
			elseif ($ukuran < 1500000 and $ukuran > 1000000) {	
				$quality=50;// anda bisa menysesuaikan dengan mengganti valuenya
			}
			elseif ($ukuran < 2000000 and $ukuran > 1000000) {	
				$quality=40;// anda bisa menysesuaikan dengan mengganti valuenya
			}
			elseif ($ukuran < 2500000 and $ukuran > 2000000) {	
				$quality=30;// anda bisa menysesuaikan dengan mengganti valuenya
			}
			elseif ($ukuran < 3000000 and $ukuran > 2500000) {	
				$quality=20;// anda bisa menysesuaikan dengan mengganti valuenya
			}
			elseif ($ukuran > 3000000) {	
				$quality=10;// anda bisa menysesuaikan dengan mengganti valuenya
			}
			$gambar = imagecreatefromjpeg($source_url);
			$ext='.jpeg';
			if (imagejpeg($gambar, $dir1.$new_name.$ext, $quality)){
				unlink($source_url);
			}else{
				unlink($source_url);
			}
		}else{
			$new_name=$this->input->post('scan_foto_lama', TRUE);
			$ext="";
		}
		$data=array(
			"kode_barang"=>$kode1,
			"nama_barang"=>$this->input->post('nama_barang', TRUE),
			"no_reg"=>$this->input->post('no_reg', TRUE),
			"kondisi"=>$this->input->post('kondisi', TRUE),
			"tingkat"=>$this->input->post('tingkat', TRUE),
			"beton"=>$this->input->post('beton', TRUE),
			"luas_lantai"=>$this->input->post('luas', TRUE),
			"letak"=>$this->input->post('letak', TRUE),
			"tanggal_dokumen"=>$this->input->post('tanggal_dokumen', TRUE),
			"nomor_dokumen"=>$this->input->post('no_dokumen', TRUE),
			"luas"=>$this->input->post('luas_tanah', TRUE),
			"status_tanah"=>$this->input->post('status_tanah', TRUE),
			"nomor_kode_tanah"=>$this->input->post('no_kode_tanah', TRUE),
			"asal"=>$this->input->post('asal', TRUE),
			"harga"=>$this->input->post('harga', TRUE),
			"keterangan"=>$this->input->post('keterangan', TRUE),
			"foto"=>$new_name.$ext,
			"status"=>1,
			"id_subbid_barang"=>$this->input->post('id_bidang_barang', TRUE),
			"tanggal"=>$this->input->post('tanggal_aset')
		);
		$this->db->where('id_bangunan',$this->input->post('id_barang'));
		$this->db->update('bangunan',$data);
		$this->session->set_flashdata('sukses','Data Berhasil Di Edit');
		redirect('gedung_bangunan/edit/'.$this->input->post('id_bidang_barang').'/'.$this->input->post('id_barang'));
	}
}

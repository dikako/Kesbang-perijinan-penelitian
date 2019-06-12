<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model{

    public function GetDtlp($where = ''){
        return $this->db->query('select * from laporan '.$where);
    }

    public function GetTotDtlp($where = ''){
        return $this->db->query('select *, pendanaan.pendanaan_name, years.years_name from laporan LEFT JOIN pendanaan 
                  ON laporan.pendanaan = pendanaan.code_pendanaan LEFT JOIN years ON laporan.tahun_penelitian = years.code_years '.$where);
    }

    public function GetYears($where ='')
    {
        $data = $this->db->query('select * from years '.$where);
        return $data;
    }
    public function GetPendanaan($where = ''){
        $data = $this->db->query('select * from pendanaan '.$where);
        return $data;
    }

    public function GetUser($where = ''){
        return $this->db->query('select * from user '.$where);
    }

    public function LikeDtlp($like1,$like2,$like3,$like4){
        return $this->db->query("select *, pendanaan.pendanaan_name, years.years_name from laporan LEFT JOIN pendanaan 
                  ON laporan.pendanaan = pendanaan.code_pendanaan LEFT JOIN years ON laporan.tahun_penelitian = years.code_years WHERE 
                  kode_penelitian LIKE '%$like1%' and npj LIKE '%$like2%' and tahun_penelitian LIKE '%$like3%' and pendanaan LIKE '%$like4%'");
    }

    public function Simpan($table, $data){
        return $this->db->insert($table, $data);
    }

    public function Update($table,$data,$where){
        return $this->db->update($table,$data,$where);
    }

    public function Hapus($table,$where){
        return $this->db->delete($table,$where);
    }

}
?>
<?php

Class Global_model extends CI_Model {

    public function add($table, $data) {
        return $this->db->insert($table, $data);
    }

    public function delete($table, $where) {
        return $this->db
                        ->delete($table, $where);
    }

    public function update($table, $where, $data) {
        $this->db
                ->where($where)
                ->update($table, $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function select_single($table, $where) {
        $q = $this->db
                ->where($where)
                ->get($table);
        return $q->row_array();
    }

    public function select_all($table, $where = array(), $limit = False, $offset = False) {
        $q = $this->db
                ->where($where)
                ->limit($limit, $offset)
                ->get($table);
        return $q->result_array();
    }

    public function search($table, $where = array(), $like = array(), $or_where = array(), $or_like = array(), $limit = False, $offset = False) {
        $q = $this->db
                ->where($where)
                ->or_where($or_where)
                ->like($like)
                ->or_like($or_like)
                ->limit($limit, $offset)
                ->get($table);
        return $q->result_array();
    }

    public function count_rows($table, $where = array(), $like = array()) {
        $q = $this->db
                ->where($where)
                ->like($like)
                ->get($table);
        return $q->num_rows();
    }

    public function join_2table($table1, $table2, $join_str, $where = array()) {
     $q= $this->db
                ->where($where)
                ->from($table1)
                ->join($table2, $join_str,'INNER')
                ->get();
//        print_r($this->db->last_query()); exit;
        return $q->result_array();
    }
    public function join_3table($table1, $table2,$table3, $join_str1,$join_str2, $where = array()) {
     $q= $this->db
                ->where($where)
                ->from($table1)
                ->join($table2, $join_str1,'INNER')
                ->join($table3, $join_str2,'INNER')
                ->get();
//        print_r($this->db->last_query()); exit;
        return $q->result_array();
    }

public function join_table3($school_id){
    $this->db->select ( '*' ); 
    $this->db->from ( 'complaint' );
    $this->db->join ( 'student', 'student.student_id= complaint.student_id' , 'left' );
    $this->db->where ( 'complaint.school_id', $school_id);
    $query = $this->db->get ();
    return $query->result_array();
}

}

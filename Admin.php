<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function insert($table = '', $data = '')
    {
        $this->db->insert($table, $data);
    }

    function get_all($table)
    {
        $this->db->from($table);

        return $this->db->get();
    }

    function get_all_order($table, $field, $order)
    {
        $this->db->from($table);
        $this->db->order_by($field, $order);

        return $this->db->get();
    }

    function get_by_id($table, $id)
    {
        $this->db->from($table);
        $this->db->where('id', $id);

        return $this->db->get();
    }

    function get_where($table = null, $where = null)
    {
        $this->db->from($table);
        $this->db->where($where);

        return $this->db->get();
    }

    function select_where($select, $table, $where)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);

        return $this->db->get();
    }

    function get_where_order($table = null, $where = null, $field, $order)
    {
        $this->db->from($table);
        $this->db->where($where);
        $this->db->order_by($field, $order);
        return $this->db->get();
    }

    function update($table = null, $data = null, $where = null)
    {
        $this->db->update($table, $data, $where);
    }

    function count($table)
    {
        $this->db->from($table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $hasil = $query->num_rows();
        } else {
            $hasil = 0;
        }
        return $hasil;
    }

    function _count_where($table, $where)
    {
        $query = $this->get_where($table, $where);
        if ($query->num_rows() > 0) {
            $hasil = $query->num_rows();
        } else {
            $hasil = 0;
        }
        return $hasil;
    }

    function get_all_group_by($table, $field)
    {
        $this->db->from($table);
        $this->db->group_by($field);
        $this->db->order_by('id', 'asc');

        return $this->db->get();
    }

    function get_where_group($table, $where, $field)
    {
        $this->db->from($table);
        $this->db->where($where);
        $this->db->group_by($field);
        $this->db->order_by('id', 'asc');

        return $this->db->get();
    }

    function _delete($table, $id)
    {
        return $this->db->delete($table, array('id' => $id));
    }
}

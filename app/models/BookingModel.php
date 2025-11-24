<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primary_key = 'id';

    public function page($q = '', $records_per_page = 10, $page = 1, $user_id = null, $is_admin = false)
    {
        $query = $this->db->table($this->table);

        if (!$is_admin && $user_id !== null) {
            $query->where('user_id', $user_id);
        }

        if (!empty($q)) {
            $query->like('id', '%'.$q.'%')
                  ->or_like('type', '%'.$q.'%')
                  ->or_like('date', '%'.$q.'%')
                  ->or_like('service', '%'.$q.'%')
                  ->or_like('status', '%'.$q.'%');
        }

        $countQuery = clone $query;
        $result = $countQuery->select_count('*', 'count')->get();

        $total_rows = isset($result->count) ? $result->count : 0;

        $records = $query->pagination($records_per_page, $page)->get_all();

        return [
            'records' => $records,
            'total_rows' => $total_rows
        ];
    }

    public function insert($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function update($id, $data)
    {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->update($data);
    }

    public function delete($id)
    {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->delete();
    }

    public function find($id, $with_deleted = false)
    {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->get();
    }
}

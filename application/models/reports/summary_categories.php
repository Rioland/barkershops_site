<?php
require_once("report.php");
class Summary_categories extends Report
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function getDataColumns()
	{
		$columns = array();
		
		$columns[] = array('data'=>lang('reports_category'), 'align'=> 'left');
		$columns[] = array('data'=>lang('reports_subtotal'), 'align'=> 'right');
		$columns[] = array('data'=>lang('reports_total'), 'align'=> 'right');
		$columns[] = array('data'=>lang('reports_tax'), 'align'=> 'right');

		if($this->Employee->has_module_action_permission('reports','show_profit',$this->Employee->get_logged_in_employee_info()->person_id))
		{
			$columns[] = array('data'=>lang('reports_profit'), 'align'=> 'right');
		}
		
		return $columns;		
	}
	
	public function getData()
	{
		$this->db->select('category, sum(subtotal) as subtotal, sum(total) as total, sum(tax) as tax, sum(profit) as profit', false);
		$this->db->from('sales_items_temp');
		if ($this->params['sale_type'] == 'sales')
		{
			$this->db->where('quantity_purchased > 0');
		}
		elseif ($this->params['sale_type'] == 'returns')
		{
			$this->db->where('quantity_purchased < 0');
		}
		
		$this->db->where($this->db->dbprefix('sales_items_temp').'.deleted', 0);
		$this->db->group_by('category');
		$this->db->order_by('category');
		//If we are exporting NOT exporting to excel make sure to use offset and limit
		if (isset($this->params['export_excel']) && !$this->params['export_excel'])
		{
			$this->db->limit($this->report_limit);
			$this->db->offset($this->params['offset']);
		}
		

		return $this->db->get()->result_array();		
	}
	
	public function getSummaryData()
	{
		$this->db->select('sum(subtotal) as subtotal, sum(total) as total, sum(tax) as tax, sum(profit) as profit', false);
		$this->db->from('sales_items_temp');
		if ($this->params['sale_type'] == 'sales')
		{
			$this->db->where('quantity_purchased > 0');
		}
		elseif ($this->params['sale_type'] == 'returns')
		{
			$this->db->where('quantity_purchased < 0');
		}
		
		$this->db->where($this->db->dbprefix('sales_items_temp').'.deleted', 0);

		$return = $this->db->get()->row_array();
		if(!$this->Employee->has_module_action_permission('reports','show_profit',$this->Employee->get_logged_in_employee_info()->person_id))
		{
			unset($return['profit']);
		}
		return $return;
	}
	
	function getTotalRows()
	{
		$this->db->select('COUNT(DISTINCT(category)) as category_count');
		$this->db->from('sales_items_temp');
		if ($this->params['sale_type'] == 'sales')
		{
			$this->db->where('quantity_purchased > 0');
		}
		elseif ($this->params['sale_type'] == 'returns')
		{
			$this->db->where('quantity_purchased < 0');
		}
		
		$this->db->where($this->db->dbprefix('sales_items_temp').'.deleted', 0);
		
		$ret = $this->db->get()->row_array();
		return $ret['category_count'];
	}
}
?>
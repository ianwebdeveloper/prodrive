<?php
class mdl_dcr extends CI_Model{
	
	function hasCurrentDCR(&$dcrNo = null) {
		global $almd_db;
		global $almd_userid;
		global $almd_username;
		$curdate = curdate();

		$currentUser = $almd_userid;
// 		$strQry = sprintf("SELECT * FROM %s WHERE trnxdate='%s' AND cashier=%d", $almd_db->dcr, $curdate, $currentUser);
		$strQry = sprintf("SELECT d.dcr_id, d.trnxdate, d.begbal, d.cashier, d.`status`, u.username FROM dcr d LEFT JOIN users u ON d.cashier=u.u_id WHERE (d.trnxdate='%s' AND d.cashier=%d AND d.`status`='1')", $curdate, $currentUser);
		$record = $this->db->query($strQry);
		if($record->num_rows < 1)
			return FALSE;
		
		$dcrNo = $record->result();
		
		return TRUE;
	}
	
	public function newDCR(&$dcrNo = null) {
		global $almd_db;
		$currentDate = $this->input->post('trnxdate');
		$currentUser = $this->input->post('cashierid');
		$begbal = $this->input->post('begbal');
		
		$strQry = sprintf('CALL sp_newdcr("%s", %s, %d, %s, @id)', $currentDate, $begbal, $currentUser, '1'); //CALL sp_newdcr('2013-05-06', 50000, 4, '1', @id);
		$this->db->query($strQry);
		
		// gets the assigned id
// 		$id = $this->db->query('SELECT @id AS id')->result();
// 		$id = (count($id)>0) ? $id[0]->id : 0;
		
// 		$currentRecord = array('dcr_id' => $id, 'trnxdate' => $currentDate, 'begbal' => $begbal, 'cashier' => $currentUser, 'status ' => 1);
// 		arrayToDBOjbect($currentRecord);
// 		$dcrNo = $currentRecord;

	}

}
<?php	
	class PageNumber{
		var $limit;
		var $query;
		var $page;
		var $start;
		var $TotalRecord;
		var $TotalPage;
		var $TotalPageNumber;
		var $FirstPageNumber;
		var $LastPageNumber;
		var $FirstRecordPos;
		var $LastRecordPos;
		var $next;
		var $prev;
		function GetJmlHal(){
			$hasil = $this->TotalRecord/$this->limit;
			if(($temp = (int)$hasil)<$hasil) $hasil = $temp + 1;
			return($hasil);
		}
		function GetStart(){
			if($this->page > 1){
				return ($this->page-1)*$this->limit;
			}
			return(0);
		}
		function GetFirstNumber(){
			$temp = $this->page % $this->TotalPageNumber;
			if($temp){
				$result = $this->page-$temp+1;
				if($result==$this->TotalPage){
					$result = $this->page-$this->TotalPageNumber;
				}
			}else{
				$result = $this->page-$this->TotalPageNumber+1;
			}
			return($result);
		}
		function GetLastNumber(){
			$result = $this->FirstPageNumber+($this->TotalPageNumber-1);
			if($result > $this->TotalPage || ($this->TotalPage-$result == 1)){
				$result = $this->TotalPage;
			}
			return($result);
		}
		function GetFirstRecordPos(){
			return($this->start+1);
		}
		function GetLastRecordPos(){
			$result = $this->start+$this->limit;
			if($result > $this->TotalRecord) $result = $this->TotalRecord;
			return($result);
		}
		function GenerateAll(){
			$result = mysql_query($this->query);
			$row	= mysql_fetch_array($result);
			$this->TotalRecord 	= $row[0];
			$this->TotalPage	= $this->GetJmlHal();
			if($this->page > $this->TotalPage) $this->page = $this->TotalPage;
			$this->start		= $this->GetStart();
			$this->FirstPageNumber = $this->GetFirstNumber();
			$this->LastPageNumber  = $this->GetLastNumber();
			$this->next 		   = $this->page+1;
			$this->prev			   = $this->page-1;
			$this->FirstRecordPos  = $this->GetFirstRecordPos();
			$this->LastRecordPos   = $this->GetLastRecordPos();
			mysql_free_result($result);
		}
	}
?>
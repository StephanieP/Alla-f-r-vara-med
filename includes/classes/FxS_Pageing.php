<?php
// Kan enbart köras som FxS_core.php är inkluderad före.
if (!defined("_EXECUTE")) {
	echo "Not allowed";
	exit;
}
class FxS_Pageing {
	public $total;
	public $per_page;
	public $total_pages;
	public $start_page;
	public $start;
	
	public function __construct($total_count, $per_page, $start) {
		$this->total 		= $total_count;
		$this->per_page 	= intval($per_page);
		$this->total_pages 	= (int)((($total_count-1) / $per_page) + 1);
		$this->start_page 	= intval($start);
		$this->start 		= $start * $this->per_page;
	}

	public function prev_page () {
		$prev_page = $this->start_page - 1;
		if ($prev_page < 0) {
			return null;	
		}
		return $prev_page;
	}

	public function next_page() {
		$next_page = $this->start_page + 1;
		if ($next_page >= $this->total_pages) {
			return null;	
		}
		return $next_page;
	}
	
	public function generate_links($link_style) {
		if ($this->total_pages == 1) {
			return "";
		}
		
		$page_col = strrpos($link_style, ":page");
		$num_col = strrpos($link_style, ":num");
		$link_fore = substr($link_style, 0, $page_col);
		$link_after = substr($link_style, $page_col+5, $num_col-$page_col-5);
		$link_end = substr($link_style, $num_col+4);
		$links = "";
		$dotts = false;
		
		for ($i = 0; $i < $this->total_pages; $i++) {
			if ($i > 2 && $i < $this->start_page-5 || 
			  $i < $this->total_pages-3 && 
			  $i > $this->start_page+5) {
				if (!$dotts) {
					$links .= '...';
					$dotts = true;
				}
				continue;
			}
			$dotts = false;
			$link = $i+1;
			if ($i == $this->start_page) {
				$link = "<strong>".($i+1)."</strong>";
			}
			$links .= $link_fore.$i.$link_after.$link.$link_end;
		}
		return $links;
	}
}

?>
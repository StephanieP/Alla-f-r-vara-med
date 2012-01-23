<?php
// Kan enbart k�ras som FxS_core.php �r inkluderad f�re.
if (!defined("_EXECUTE")) {echo "Not allowed"; exit;}

/*****************************************************************************************
 *
 **F�rfattare
 *	Denna fil �r skapad av Felix Stridsberg, Link�ping, 2011-08-18. Denna fil och 
 *	tillh�rande filer f�r fritt anv�ndas f�r privat bruk.
 *	Utf�rliga guider f�r anv�ndning finns p�: http://webbprogrammering.ifokus.se
 *
 *
 **INFO
 *	Denna fil inneh�ller FxS_Pageing. G�r det m�jligt att dela upp databasresultat �ver 
 *	flera numrerade sidor.
 *
 *
 **FUNKTIONER f�r FxS_Pageing
 *	__construct($total_count,	- Heltal x Heltal x Heltal -> 
 *				$per_page,		  $total_count  - Totalt antal poster att lista
 *				$page)	      	  $per_page		- Antal poster per sida
 *								  $page		- Vilken sida vi vill visa
 *
 * prev_page()				- -> Heltal/null
 *							 Retunerar nummer p� f�reg�ende sida, null om vi st�r p� f�rsta sidan.
 *
 * next_page()				- -> Heltal/null
 *							 Retunerar nummer p� n�sta sida, null om vi st�r p� sista sidan.
 *
 * generate_links($style)	- Str�ng -> Str�ng
 *							  Skicka in en l�nkstil som t.ex: <a href="/sida/:num/">:page</a>
 *							  Och f� tillbaka en str�ng med alla l�nkar till alla sidor.
 *							  :num - Byts mot sidnummer f�r adress och $page
 *							  :page - Byts mot det synliga sidnumret
 *															
 *
 ******************************************************************************************/
class FxS_Pageing {
	public $total;
	public $per_page;
	public $total_pages;
	public $start_page;
	public $start;
	
	public function __construct($total_count, $per_page, $page) {
		$this->total 		= $total_count;
		$this->per_page 	= intval($per_page);
		$this->total_pages 	= (int)((($total_count-1) / $per_page) + 1);
		$this->start_page 	= intval($page);
		$this->start 		= $page * $this->per_page;
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
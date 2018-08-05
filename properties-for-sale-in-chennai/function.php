<?php
/********************************************

	For More Detail please Visit: 
	
	http://www.discussdesk.com/download-pagination-in-php-and-mysql-with-example.htm

	************************************************/
   function displayPaginationBelow($per_page,$page,$cnt){
	   $page_url="?";
    	$total = $cnt;
        $adjacents = "2"; 

    	$page = ($page == 0 ? 1 : $page);  
    	$start = ($page - 1) * $per_page;								
		
    	$prev = $page - 1;							
    	$next = $page + 1;
        $setLastpage = ceil($total/$per_page);
    	$lpm1 = $setLastpage - 1;
    	
    	$setPaginate = "";
    	if($setLastpage > 1)
    	{	
    		$setPaginate .= "<nav><ul class='pagination pg-purple'>";
            if ($page > 1){ 
                $setPaginate.= "<li class='page-item'><a class='page-link' href='{$page_url}page=$prev' aria-label='Previous'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
            }else{
                $setPaginate.= "<li class='page-item'><a class='page-link' aria-label='Previous'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
            }

    		if ($setLastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $setLastpage; $counter++)
    			{
    				if ($counter == $page)
    					$setPaginate.= "<li class='page-item active'><a class='page-link'>$counter</a></li>";
    				else
    					$setPaginate.= "<li class='page-item'><a class='page-link' href='{$page_url}page=$counter'>$counter</a></li>";					
    			}
    		}
    		elseif($setLastpage > 5 + ($adjacents * 2))
    		{
    			if($page < 1 + ($adjacents * 2))		
    			{
    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li class='page-item active'><a class='page-link'>$counter</a></li>";
    					else
    						$setPaginate.= "<li class='page-item'><a class='page-link' href='{$page_url}page=$counter'>$counter</a></li>";					
    				}
    				$setPaginate.= "<li class='disabled'>...</li>";
    				$setPaginate.= "<li class='page-item'><a class='page-link' href='{$page_url}page=$lpm1'>$lpm1</a></li>";
    				$setPaginate.= "<li class='page-item'><a class='page-link' href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";		
    			}
    			elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$setPaginate.= "<li class='page-item'><a class='page-link' href='{$page_url}page=1'>1</a></li>";
    				$setPaginate.= "<li class='page-item'><a class='page-link' href='{$page_url}page=2'>2</a></li>";
    				$setPaginate.= "<li class='disabled'>...</li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li class='page-item active'><a class='page-link'>$counter</a></li>";
    					else
    						$setPaginate.= "<li class='page-item'><a class='page-link' href='{$page_url}page=$counter'>$counter</a></li>";					
    				}
    				$setPaginate.= "<li class='disabled'>..</li>";
    				$setPaginate.= "<li class='page-item'><a class='page-link' href='{$page_url}page=$lpm1'>$lpm1</a></li>";
    				$setPaginate.= "<li class='page-item'><a class='page-link' href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";		
    			}
    			else
    			{
    				$setPaginate.= "<li class='page-item'><a class='page-link' href='{$page_url}page=1'>1</a></li>";
    				$setPaginate.= "<li class='page-item'><a class='page-link' href='{$page_url}page=2'>2</a></li>";
    				$setPaginate.= "<li class='disabled'>..</li>";
    				for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li class='page-item active'><a class='page-link'>$counter</a></li>";
    					else
    						$setPaginate.= "<li class='page-item'><a class='page-link' href='{$page_url}page=$counter'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$setPaginate.= "<li class='page-item'><a class='page-link' href='{$page_url}page=$next' aria-label='Next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";
    		}else{
    			$setPaginate.= "<li class='page-item'><a class='page-link' aria-label='Next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";
            }

    		$setPaginate.= "</ul></nav>\n";		
    	}
    
    
        return $setPaginate;
    } 
?>
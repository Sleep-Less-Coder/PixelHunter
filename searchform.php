<form action="<?php bloginfo('siteurl'); ?>" id="searchform" method="get">
     <fieldset>
         <label for="s" class="screen-reader-text">Search for:</label>
         <input type="search" id="s" name="s" placeholder="Enter keywords" required /><!-- remove gap here
         --><button type="submit" class="search-submit">
                <i class="fa fa-search"></i>
         </button>
     </fieldset>
</form>
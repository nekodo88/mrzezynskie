<form role="search" method="get"  class="searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div class="search-form woosearch-search">
        <div class="woosearch-input-box">		
			<input class="product-search" type="text" name="s"  placeholder="<?php echo esc_html__("Type your search here", "beer_pub") ?>"/>
        </div>
		<button type="submit" class="searchsubmit woosearch-submit submit btn-search">
			<i class="fa fa-search"></i>
		</button>      
    </div>
</form>
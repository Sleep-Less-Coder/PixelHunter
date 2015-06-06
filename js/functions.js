jQuery(function($) {
	
	//srcolling to top function

	//should be hidden at first and displayed when scrolled over 200
	$('.scroll-top').hide(); 
	$(window).scroll(function() {
	    if ($(this).scrollTop() > 200) {
	        $('.scroll-top').fadeIn('slow');
	    } else {
	        $('.scroll-top').fadeOut('slow');
	    }
	});
  
	$('.scroll-top').click(function() {
		$('html,body').animate({
		    scrollTop: 0
		}, 300);
		return false;
	});

	//search box toggler
	$('#search-icon').click(function(){
		$('.search-box').toggle(300);
	});

	//Off-canvas navigation toggler
	$('.toggle').click(function(){
		$('.sidebar').toggleClass('sidebar-is-displayed');

		//push the toggler menu to the left as menu is revealed from left
		$(this).toggleClass('toggle-shift');

		//change the menu icon to close icon when menu is open
		$(this).find($('.fa')).toggleClass('fa-bars').toggleClass('fa-times');
	});

	//sidebar toggler
	$('#sidebar-icon').click(function(){
		
		//shift the icons on the right to show the sidebar

		$('.right-icons').toggleClass('right-icons-shift');

		//show the sidebar 

		$('.widget-area').toggleClass('widget-area-display');	

		//rotate the pull icon to push icon
		
		$(this).toggleClass('rotate-sidebar-icon');
	});

	//changing the color of menu icon when it is scrolled below the header
	$(window).scroll(function(){
		if($(this).scrollTop() > 272){
			$('.toggle').addClass('menu-color');
		}else{
			$('.toggle').removeClass('menu-color');
		}
	});


	//Navigation
	//expanding and contacting the navigation when clicked on the plus button
	
	$('ul.menu li.menu-item-has-children ul.sub-menu').hide();
	$('ul.menu > li.menu-item-has-children').append(' <i class="fa fa-plus-circle"></i>');
	$('ul.menu > li.menu-item-has-children').on('click', function(){
		$(this).find($(".fa")).toggleClass('fa-minus-circle');
		$(this).children('ul.sub-menu').toggle('slow');
	});
	
	//when no menu is selected wp_page_nav fallback has different markup
	// and different css classes so targeting that
	
	$('div.menu ul li.page_item_has_children ul.children').hide();
	$('div.menu > ul > li.page_item_has_children').append(' <i class="fa fa-plus-circle"></i>');	
	$('div.menu > ul > li.page_item_has_children').on('click', function(){
		$(this).find($(".fa")).toggleClass('fa-minus-circle');
		$(this).children('ul.children').toggle('slow');
	});


	//removing the thumbnail empty divs when there is no thumbnail
	var removeEmptyDivs = function(){

		//remove empty thumbnail divs
		
		$('div.post-content-wrapper div.post-thumbnail').each(function(){
	    	if($.trim($(this).html()) == ''){
	    		$(this).remove();
	    		$('a').remove();
	    	}
		});

		//if there is no thumbnail then space for it should be removed
		//and post should go full width

		$('div.post-content-wrapper').each(function(){
			if($(this).find('div.post-thumbnail').length){

			}else{
	    		$(this).children('div.post-content').css('width','100%');
			}
		});
	}

	removeEmptyDivs();
	
	//re executing the function as JetPack loads new posts
	$(document.body).on('post-load', function () {
		removeEmptyDivs();
	});
});
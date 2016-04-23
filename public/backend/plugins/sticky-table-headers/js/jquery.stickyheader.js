/*
 * jQuery throttle / debounce - v1.1 - 3/7/2010
 * http://benalman.com/projects/jquery-throttle-debounce-plugin/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function(b,c){var $=b.jQuery||b.Cowboy||(b.Cowboy={}),a;$.throttle=a=function(e,f,j,i){var h,d=0;if(typeof f!=="boolean"){i=j;j=f;f=c}function g(){var o=this,m=+new Date()-d,n=arguments;function l(){d=+new Date();j.apply(o,n)}function k(){h=c}if(i&&!h){l()}h&&clearTimeout(h);if(i===c&&m>e){l()}else{if(f!==true){h=setTimeout(i?k:l,i===c?e-m:e)}}}if($.guid){g.guid=j.guid=j.guid||$.guid++}return g};$.debounce=function(d,e,f){return f===c?a(d,e,false):a(d,f,e!==false)}})(this);

$(function(){
	$('.datatables').each(function() {
		if($(this).find('thead').length > 0 && $(this).find('th').length > 0) {
			// Clone <thead>
			var $w	   = $(window),
				$t	   = $(this),
				$thead = $t.find('thead').clone(),
				$col   = $t.find('thead, tbody').clone();

			// Add class, remove margins, reset width and wrap table
			$t
			.addClass('sticky-enabled')
			.css({
				margin: 0,
				width: '100%'
			}).wrap('<div class="sticky-wrap" />');

			if($t.hasClass('overflow-y')) $t.removeClass('overflow-y').parent().addClass('overflow-y');

			// Create new sticky table head (basic)
			$t.after('<table class="sticky-thead" />');

			// If <tbody> contains <th>, then we create sticky column and intersect (advanced)
			if($t.find('tbody th').length > 0) {
				$t.after('<table class="sticky-col" /><table class="sticky-intersect" />');
			}

			// Create shorthand for things
			var $stickyHead  = $(this).siblings('.sticky-thead'),
				$stickyCol   = $(this).siblings('.sticky-col'),
				$stickyInsct = $(this).siblings('.sticky-intersect'),
				$stickyWrap  = $(this).parent('.sticky-wrap');

			$stickyHead.append($thead);

			$stickyCol
			.append($col)
				.find('thead th:gt(0)').remove()
				.end()
				.find('tbody td').remove();

			$stickyInsct.html('<thead><tr><th>'+$t.find('thead th:first-child').html()+'</th></tr></thead>');
			
			// Set widths
			var setWidths = function () {
					$t
					.find('thead th').each(function (i) {
						$stickyHead.find('th').eq(i).width($(this).width());
					})
					.end()
					.find('tr').each(function (i) {
						$stickyCol.find('tr').eq(i).height($(this).height());
					});

					// Set width of sticky table head
					$stickyHead.width($t.width());

					// Set width of sticky table col
					$stickyCol.find('th').add($stickyInsct.find('th')).width($t.find('thead th').width())
				},
				repositionStickyHead = function () {
					// Return value of calculated allowance
					var allowance = calcAllowance();
				
					// Check if wrapper parent is overflowing along the y-axis
					if($t.height() > $stickyWrap.height()) {
						// If it is overflowing (advanced layout)
						// Position sticky header based on wrapper scrollTop()
						if($stickyWrap.scrollTop() > 0) {
							// When top of wrapping parent is out of view
							$stickyHead.add($stickyInsct).css({
								opacity: 1,
								top: $stickyWrap.scrollTop(),
								'z-index': 100
							});
						} else {
							// When top of wrapping parent is in view
							$stickyHead.add($stickyInsct).css({
								opacity: 0,
								top: 0,
								'z-index': -2
							});
						}
					} else {
						// If it is not overflowing (basic layout)
						// Position sticky header based on viewport scrollTop
						if($w.scrollTop() > $t.offset().top && $w.scrollTop() < $t.offset().top + $t.outerHeight() - allowance) {
							// When top of viewport is in the table itself
							$stickyHead.add($stickyInsct).css({
								opacity: 1,
								top: $w.scrollTop() - $t.offset().top + $stickyHead.height() + ($('body').width() < 760 ? $stickyHead.height() : 0) ,
								'z-index': 100
							});
						} else {
							// When top of viewport is above or below table
							$stickyHead.add($stickyInsct).css({
								opacity: 0,
								top: 0,
								'z-index': -2
							});
						}
					}
				},
				repositionStickyCol = function () {
					if($stickyWrap.scrollLeft() > 0) {
						// When left of wrapping parent is out of view
						$stickyCol.add($stickyInsct).css({
							opacity: 1,
							left: $stickyWrap.scrollLeft()
						});
					} else {
						// When left of wrapping parent is in view
						$stickyCol
						.css({ opacity: 0 })
						.add($stickyInsct).css({ left: 0 });
					}
				},
				calcAllowance = function () {
					var a = 0;
					// Calculate allowance
					$t.find('tbody tr:lt(3)').each(function () {
						a += $(this).height();
					});
					
					// Set fail safe limit (last three row might be too tall)
					// Set arbitrary limit at 0.25 of viewport height, or you can use an arbitrary pixel value
					if(a > $w.height()*0.25) {
						a = $w.height()*0.25;
					}
					
					// Add the height of sticky header
					a += $stickyHead.height();
					return a;
				};

			setWidths();

			$t.parent('.sticky-wrap').scroll($.throttle(250, function() {
				repositionStickyHead();
				repositionStickyCol();
			}));

			$w
			.load(setWidths)
			.resize($.debounce(250, function () {
				setWidths();
				repositionStickyHead();
				repositionStickyCol();
			}))
			.scroll($.throttle(250, repositionStickyHead));
		}
	});
});
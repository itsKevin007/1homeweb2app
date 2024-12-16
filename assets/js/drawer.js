$(function() {
    var $document = $(document),
        $body = $(document.body),
        $header = {
            drawerToggle: $('.header-drawer-toggle')
        },
        $drawer = {
            this: $('.layout-drawer'),
            dropdownToggle: $('.drawer-dropdown-toggle')
        };

    // Ensure the drawer is closed on page load
    $drawer.this.removeClass('is-open');
    $('.layout-dim').hide(); // Hide the overlay if it exists
    $body.css('overflow', 'auto'); // Reset body overflow

    // Button which opens the drawer on click
    $header.drawerToggle.click(function() {
        $drawer.this.toggleClass('is-open');
        if ($drawer.this.hasClass('is-open')) {
            $('.layout-dim').fadeIn(300);
            $body.css('overflow', 'hidden');
        } else {
            $('.layout-dim').fadeOut(100);
            $body.css('overflow', 'auto');
        }
    });

    // When the user presses the 'escape' key
    $document.keyup(function(e) {
        if (e.keyCode == 27) {
            if ($drawer.this.hasClass('is-open')) {
                $drawer.this.removeClass('is-open');
                $('.layout-dim').fadeOut(100);
                $body.css('overflow', 'auto');
            }
        }
    });

    // When the user clicks outside the drawer
    $document.mouseup(function(e) {
        if (!$drawer.this.is(e.target) &&
            !$drawer.this.has(e.target).length) {
            if ($drawer.this.hasClass('is-open')) {
                $drawer.this.removeClass('is-open');
                $('.layout-dim').fadeOut(100);
                $body.css('overflow', 'auto');
            }
        }
    });

    // Using jQuery slideToggle() for dropdowns
    $drawer.dropdownToggle.each(function() {
        var target = $(this).data('target');
        $(this).click(function() {
            $(target).slideToggle(300);
        });
    });

    // Ensure overlay element exists
    if (!$('.layout-dim').length) {
        $drawer.this.before($('<div class="layout-dim"/>'));
    }
});

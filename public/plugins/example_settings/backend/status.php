<?php

// We want to display the error message, but keep the UI of the admin panel
// consistent. We will do this with a little bit of Javascript
// This solution has been modified from the GetSimple wiki:
// http://get-simple.info/wiki/plugins:tips

?>
<script type="text/javascript">
  // When the document is ready:
  $(function() {
    // Create a div and give it the correct css class and the error message
    var $statusupdate = $('<div></div>').html(<?php echo $msg; ?>).addClass(<?php echo $css; ?>);

    // Prepend it into the bodycontent div (near the top of the admin panel)
    $('div.bodycontent').prepend($statusupdate);

    // Give it a nice fade out and fade in (like the success/error message
    // when a page is saved)
    $statusupdate.fadeOut(500).fadeIn(500);
  });
</script>

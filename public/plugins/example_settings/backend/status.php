<script type="text/javascript">
  $(function() {
    var $statusupdate = $('<div></div>').html(<?php echo $msg; ?>).addClass(<?php echo $css; ?>);
    $('div.bodycontent').prepend($statusupdate);
    $statusupdate.fadeOut(500).fadeIn(500);
  });
</script>

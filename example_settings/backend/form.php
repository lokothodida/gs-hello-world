<?php

// Given the settings $data, we will now display a form for that data
// This example illustrates how to set out some of the common admin panel
// elements in raw HTML
// Note that the method parameter is set to post: this means that when the
// admin submits the form, the data will be available on the $_POST array
// Also, no action parameter has been set, meaning that the query will be sent
// to the same page (this page)

?>

<form method="post">
  <!--title field-->
  <p>
    <input name="title" value="<?php echo $data['title']; ?>" class="text title"/>
  </p>


  <!--left/right sections-->
  <div class="leftsec">
    <p>
      <label><?php echo $i18n('SETTING_2'); ?> :</label>
      <input name="text1" value="<?php echo $data['text1']; ?>" class="text"/>
    </p>
  </div>
  <div class="rightsec">
    <p>
      <label><?php echo $i18n('SETTING_3'); ?> :</label>
      <input name="text2" value="<?php echo $data['text2']; ?>" class="text"/>
    </p>
  </div>
  <div class="clear"></div>

  <!--html editor-->
  <textarea name="html" class="htmleditor"><?php echo $data['html']; ?></textarea>
  <script src="template/js/ckeditor/ckeditor.js"></script>
  <script>
    $(function () {
      var htmleditor = $('.htmleditor')[0];
      CKEDITOR.replace(htmleditor, <?php echo json_encode($htmlconfig); ?>);
    });
  </script>

  <!--code editor-->
  <textarea name="code" class="codeeditor"><?php echo $data['code']; ?></textarea>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.5.0/codemirror.css">
  <style>
    .CodeMirror { border: 1px solid #ccc; margin: 10px 0; }
  </style>
  <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.5.0/codemirror.js"></script>
  <script>
    $(function() {
      var codeeditor = $('.codeeditor')[0];
      CodeMirror.fromTextArea(codeeditor, <?php echo json_encode($codeconfig); ?>);
    });
  </script>

  <!--submit button - crucial for sending the query! -->
  <input type="submit" value="<?php i18n('BTN_SAVECHANGES'); ?>" class="submit"/>
</form>

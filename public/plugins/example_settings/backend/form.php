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
  <script src="//cdn.ckeditor.com/4.5.2/standard/ckeditor.js"></script>
  <script>
    $(function () {
      var htmleditor = $('.htmleditor')[0];
      CKEDITOR.replace(htmleditor);
    });
  </script>

  <!--code editor-->
  <textarea name="code" style="display: none;"><?php echo $data['code']; ?></textarea>
  <div class="codeeditor" style="height: 500px; width: 100%; border: 1px solid #ccc; margin: 10px 0 10px 0;"></div>
  <script src="//cdnjs.cloudflare.com/ajax/libs/ace/1.2.0/ace.js" type="text/javascript" charset="utf-8"></script>
  <script>
    $(function() {
      var editor = ace.edit($('.codeeditor')[0]);
      var textarea = $('textarea[name="code"]');
      var session = editor.getSession();

      editor.setTheme("ace/theme/chrome");
      session.setMode("ace/mode/php");
      session.setValue(textarea.val());

      $(document).submit(function() {
        textarea.val(session.getValue());
      });
    });
  </script>

  <!--submit button - crucial for sending the query! -->
  <input type="submit" value="<?php i18n('BTN_SAVECHANGES'); ?>" class="submit"/>
</form>

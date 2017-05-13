<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>elFinder 2.0</title>

		<!-- jQuery and jQuery UI (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

		<!-- elFinder CSS (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>assets/elfinders/css/elfinder.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>assets/elfinders/css/theme.css">

<script src="<?php echo base_url() ?>assets/tinymce/tinymce.min.js"></script>
		<!-- elFinder JS (REQUIRED) -->
		<script type="text/javascript" src="<?php echo base_url() ?>assets/elfinders/js/elfinder.min.js"></script>



		<script type="text/javascript">
  var FileBrowserDialogue = {
    init: function() {
      // Here goes your code for setting your custom things onLoad.
    },
    mySubmit: function (URL) {
      // pass selected file path to TinyMCE
      parent.tinymce.activeEditor.windowManager.getParams().setUrl(URL);

      // close popup window
      parent.tinymce.activeEditor.windowManager.close();
    }
  }

  $().ready(function() {
    var elf = $('#elfinder').elfinder({
      // set your elFinder options here
      url: '<?php echo base_url("elfinders/init") ?>',  // connector URL
      getFileCallback: function(file) { // editor callback
// actually file.url - doesnt work for me, but file does. (elfinder 2.0-rc1)
        FileBrowserDialogue.mySubmit(file); // pass selected file path to TinyMCE
      }
    }).elfinder('instance');
  });
</script>
	</head>
	<body>

		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>

	</body>
</html>

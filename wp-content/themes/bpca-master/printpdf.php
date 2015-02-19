<?php
  $file = $_GET['url'];
  $filename = 'filename.pdf';
  header('Content-type: application/pdf');
  header('Content-Disposition: inline; filename="' . $filename . '"');
  header('Content-Transfer-Encoding: binary');
  header('Accept-Ranges: bytes');
  @readfile($file);
?>

<script type="text/javascript">
$(document).ready(function() {
    window.print();
});    
</script>


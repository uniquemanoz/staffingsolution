<html>
<?php
   $this->load->view('admin/adminlte/header');
   $this->load->view('admin/adminlte/main_sidebar');
   //$this->load->view('admin/adminlte/content_wrapper');
   $this->load->view($view_page);
   $this->load->view('admin/adminlte/footer');
   
?>
</html>

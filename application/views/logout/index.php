<?php
	$ci = &get_instance();
	$ci->load->library('session');
	$this->session->sess_destroy();
	redirect('login/index');
?>
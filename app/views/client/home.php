<?php 
  $this->render(CLIENT_COMPONENTS_DIR . "/slider");
  $this->render(CLIENT_COMPONENTS_DIR . "/popularProducts", ["popularProducts" => $popularProducts]);
  $this->render(CLIENT_COMPONENTS_DIR . "/weHelpSession");
?>
<?php
  header('HTTP/1.1 403 Forbidden');
  echo json_encode(['errorMessage' => 'Access denied']);
  exit();

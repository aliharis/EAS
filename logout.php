<?php

require 'common.php';

session_destroy();

// Redirect back to index after logging-out
header("Location: index.php");
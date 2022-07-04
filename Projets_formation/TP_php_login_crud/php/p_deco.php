<?php

session_start();

session_destroy();

header('Location: ../html/p_accueil.html');

?>
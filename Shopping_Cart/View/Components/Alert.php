<?php

function successAlert($msg)
{
    echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>'.$msg.'</strong>
						</div>';
}

function faildAlert($msg)
{
    echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>'.$msg.'</strong>
						</div>';
}


?>
<?php

function alert($msg,$redirect)
{
    echo "
    <script>
    alert('$msg');
    window.location.href='$redirect';
    </script>
    ";
}

?>
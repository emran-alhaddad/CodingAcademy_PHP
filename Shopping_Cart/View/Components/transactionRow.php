<?php
function showTransactionRow($value)
{
    echo  
        "
            <tr>
            <td>$value[0]</td>
            <td>$value[1]</td>
            <td>$value[2]</td>
            <td>$value[3]</td>
            </tr>
        ";
}

<?php

require_once('./User.php');

function getUser($user)
{
    echo "
    <tr>
        <td>
            <span class='custom-checkbox'>
                <input type='checkbox' id='checkbox1' name='options[]' value='1'>
                <label for='checkbox1'></label>
            </span>
        </td>
        <td>$user->name</td>
        <td>$user->email</td>
        <td>$user->address</td>
        <td>$user->phone</td>
        <td>
            <a href='#editEmployeeModal' onclick='linkEdit(this,$user->id);' class='edit' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>
            <a href='#deleteEmployeeModal' onclick='linkDelete($user->id);' class='delete' data-toggle='modal' ><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i></a>
        </td>
    </tr>
    ";
}

?>
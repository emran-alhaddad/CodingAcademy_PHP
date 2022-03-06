<html>
    <body>
        <!--name.php to be called on form submission-->
        <form method = 'post'>
            <h4>SELECT SUBJECTS</h4>
             
            <select name = 'subject[]' multiple size = 6> 
                <option value = 'english'>ENGLISH</option>
                <option value = 'maths'>MATHS</option>
                <option value = 'computer'>COMPUTER</option>
                <option value = 'physics'>PHYSICS</option>
                <option value = 'chemistry'>CHEMISTRY</option>
                <option value = 'hindi'>HINDI</option>
            </select>
            <input type = 'submit' name = 'submit' value = Submit>
        </form>
    </body>
</html>
<?php
     
    // Check if form is submitted successfully
    if(isset($_POST["submit"]))
    {
        // Check if any option is selected
        if(isset($_POST["subject"]))
        {
            // Retrieving each selected option
            foreach ($_POST['subject'] as $subject)
                print "You selected $subject<br/>";
        }
    else
        echo "Select an option first !!";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>

    <section>
        <div class="container my-5 text-end">
            <a href="register" class="btn btn-secondary">Add New Product</a>
        </div>
    </section>

    <main>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">status</th>

                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>

              <?php
        foreach($data as $user){?>

            <tr>
            <th scope="row">#</th>
            <td><?php echo $user->name; ?></td>
            <td><?php echo $user->email; ?></td>
            <td><?php if($user->is_active==1) echo "<span class='alert alert-success'>active</span>"; else  echo "<span class='alert alert-danger'>disabled</span>";;
            
            ?></td>
            <td>
                <a href="#" class="btn btn-success mx-3">Update</a>
                <a href="status/<?php echo $user->id; ?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
       <?php }
              ?>

            </tbody>
        </table>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
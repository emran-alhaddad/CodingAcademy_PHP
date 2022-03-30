<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Query Builder</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        i {
            color: #708;
            font-style: normal;
            font-weight: bold;
        }

        .query {
            color: #05a;
            background-color: #fff;
            box-shadow: 0 0 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        require_once('QueryBulider.php');



        $query = new QueryBuilder("blog");

        // $result = $query
        // ->where()
        // ->select("id","username","password","email")
        // ->from("user")
        // ->execute();

        // $result = $query
        //     ->from("article")
        //     ->innerJoin("author", on: "author.author_id = article.id_author")
        //     ->where('article.article_id>5')
        //     ->or()
        //     ->where('article.article_id<100')
        //     ->leftJoin("category", on: "category.category_id = article.id_categorie")
        //     ->distinct()
        //     ->select("article.article_id", "article.article_title", "category.category_name", "author.author_fullname")
        //     ->sort(ORDERBY::DESC)
        //     ->orderBy("article.article_id")
        //     ->sort(ORDERBY::ASC)
        //     ->orderBy("article.id_categorie")
        //     ->execute();

        // $query = new QueryBuilder();
        // $result = $query
        // ->fields('username','password','email')
        // ->insertInto('user')
        // ->values("'EmranCo'","'EmranCo'","'alhaddademran@gmail.com'")
        // ->or()
        // ->execute();

        $query = new QueryBuilder("test");
        $result = $query
        ->update('user')
        ->set('username',"'EmranCo'")
        ->set('password',"'EmranCo'")
        ->where('id=2')
        ->execute();

        // $query = new QueryBuilder();
        // $result = $query
        // ->where('id=2')
        // ->delete('user')
        // ->and()
        // ->insertInto('user')
        // ->execute();

        ?>

        <p class="text-justify m-5 fs-3 p-3  rounded text-light bg-success" style="word-spacing: 5px;">
            Simple Query Builder: By Emran Al-Haddad
        </p>
        <p class="query text-justify m-5 fs-3 p-3  rounded" style="word-spacing: 5px;">
            <?= $query->styledQuery; ?>
        </p>

        <table class='table table-dark table-hover'>
            <thead>
                <tr>
                    <th>#</th>
                    <?php
                    foreach ($result as $index => $row) {
                        if ($index == 0)
                            foreach ($row as $head => $_)
                                echo "<th>$head</th>";

                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<td>$index</td>";

                        foreach ($row as $key => $value)
                            echo "<td>$value</td>";

                        echo "</tr>";
                    }
                    ?>
                    </tbody>
        </table>
    </div>
</body>

</html>
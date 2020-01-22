<?php session_start(); ?>
<html lang="fr">
<?php include_once 'head.php' ?>

<body>
    <?php
    if ($_SESSION["is_admin"]) {
        require_once '../common/post.php';
    ?>
    <h1 class="text-center bg-dark text-white p-3"> Bonjour <?= $_SESSION['username'] . ' ' . $_SESSION['pseudo']; ?>
    </h1>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // The request is using the POST method
            set_post($_POST['titre'], $_POST['body']);
        }
        ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 border p-3  bg-dark">
                <form action="posts.php" method="POST">
                    <h3 class="text-center text-danger border p-2">Nouveau post</h3>
                    <div class="form-group">
                        <input id="titre" class="form-control" type="text" name="titre" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <textarea name="body" id="body" class="form-control" rows="5" placeholder="Contenu"></textarea>
                    </div>
                    <div class="text-center">
                       <button type="submit" class="btn btn-success">Ajouter</button>  
                    </div>
                </form>
                <hr>
                <div>
                    <h3 class="text-center text-danger border p-2">Liste des posts</h3>
                    <?php
                    $array = get_posts("/data/posts.json");
                    $myvar = 0;
                    foreach ($array as $value) { ?>

                    <div class="list-group my-2">
                        <button class="btn btn-primary" type="button" data-toggle="collapse"
                            data-target="<?= '#collapseExample' . $myvar ?>" aria-expanded="false"
                            aria-controls="collapseExample">
                            <?= $value['title']; ?>
                        </button>
                        <div class="collapse" id="<?= "collapseExample" . $myvar ?>">
                            <div class="card card-body  bg-light">
                                <form action="posts.php" method="POST">
                                    <div class="form-group">
                                        <input type="text" name="id" value="<?= $myvar; ?>" hidden>
                                        <input class="w-100 m-1" type="text" name="title"
                                            value="<?= $value['title']; ?>">
                                        <textarea name="body" id="body" class="form-control"
                                            rows="5"> <?= $value['body']; ?> </textarea>
                                        <input class="w-100 m-1" type="submit" name="change" value="Modifier">
                                    </div>
                                </form>
                                <form action="login.php" method="POST">
                                    <input type="text" name="id" value="<?= $myvar; ?>" hidden>
                                    <input class="w-100 m-1" type="submit" name="del" value="Supprimer">
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                        $myvar++;
                    } ?>
                </div>
            </div>
            <div class="col-6">
            <h3 class="text-center bg-dark text-danger border p-2">Liste des utilisateurs</h3>
                <?php
                $array = get_posts("/data/user.json");
                $myuser = 0;
                ?>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Rôle</th>
                            <td>Delete</td>
                        </tr>
                    </thead>
                    <?php
                foreach ($array as $value) {
                     ?>

                    <tbody>
                        <tr>
                            <th scope="row"><?= $myuser ?></th>
                            <td><?= $value["username"] ?></td>
                            <td><?= $value["role"] ?></td>
                            <td>
                                <a href="#"><i class="fas fa-trash text-info"></i></a>
                            </td>

                        </tr>
                    </tbody>


                    <!-- <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2 w-100" role="group" aria-label="First group">
                        <button type="button" class="btn btn-outline-dark"><?= $myuser ?></button>
                        <button type="button" class="btn btn-outline-dark"><?= $value["username"] ?></button>
                        <button type="button" class="btn btn-outline-dark"><?= $value["role"] ?></button>
                        <button type="button" class="btn btn-outline-dark">Delete</button>
                    </div>
                </div> -->

                    <?php
                $myuser++;
                } ?>
                </table>
            </div>
        </div>
    </div>
    <?php
    } else {
        echo "Ta mère t'es pas Admin !";
    }
    include_once 'bootstrap.php'
    ?>
</body>
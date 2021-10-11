<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="dicoding:email" content="tara02zadlyka@gmail.com">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/style.css'); ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/avatar.svg'); ?>" type="image/svg">
    <script src="https://kit.fontawesome.com/33ff0546ef.js" crossorigin="anonymous"></script>

    <title>Onas System</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a class="navbar-brand" href="<?= base_url('home'); ?>"><img height="30px" src="<?= base_url('assets/logo.png'); ?>" alt=""></a>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link 
                                <?php
                                if ($active_menu == 'home') {
                                    echo 'active';
                                }
                                ?>
                            " aria-current="page" href="<?= base_url('home'); ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link 
                                <?php
                                if ($active_menu == 'assign') {
                                    echo 'active';
                                }
                                ?>
                            " href="<?= base_url('assign'); ?>">Assignments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link
                                <?php
                                if ($active_menu == 'room') {
                                    echo 'active';
                                }
                                ?>
                            " href="<?= base_url('room'); ?>">Room</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('assign/downloadpetunjuk'); ?>">Instruction</a>
                        </li>
                    </ul>

                    <div class="d-flex btn_nav">
                        <?php if ($statuslogin == '') {
                            echo '
                            <button type="button" class="btn btn-outline-light me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#signupModal">Sign-up</button>
                            ';
                        } else {
                            echo '
                            <div class="dropdown">
                                <a href="" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="' . base_url("assets/avatar.svg") . '" alt="mdo" width="32" height="32" class="rounded-circle">
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editprofilModal" type="button">Edit Profile.</a></li>
                                    <li><a class="dropdown-item" href="' . base_url("user/logout") . '">Logout</a></li>
                                </ul>
                            </div>
                            ';
                        }
                        ?>
                    </div>

                </div>
            </div>
        </nav>

        <?php if (session()->getFlashData('alert')) {
            echo session()->getFlashData('alert');
        } ?>

        <!-- Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('user/login'); ?>" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="email_login" class="form-label">Email address</label>
                                <input name="email" type="email" class="form-control" id="email_login" placeholder="name@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="password_login" class="form-label">Password</label>
                                <input name="password" type="password" class="form-control" id="password_login" placeholder="********">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('user/signup'); ?>" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama_signup" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama_signup" placeholder="name">
                            </div>
                            <div class="mb-3">
                                <label for="email_signup" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="email_signup" placeholder="name@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="password_signup" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password_signup" placeholder="********">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="createroomModal" tabindex="-1" aria-labelledby="createroomModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createroomModalLabel">Create Room</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('room/create'); ?>" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="createnamaroom" class="form-label">Nama Room</label>
                                <input type="text" class="form-control" name="nama" id="createnamaroom" placeholder="Nama Room">
                            </div>
                            <div class="mb-3">
                                <label for="createketeranganroom" class="form-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="createketeranganroom" placeholder="Isi Keterangan"></textarea>
                            </div>

                            <?php if ($statuslogin == 'login') {
                                echo '<input type="hidden" name="userid" value="' . $user['userid'] . '">
                                <input type="hidden" name="pembuat" value="' . $user['nama'] . '">';
                            } ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="createassignModal" tabindex="-1" aria-labelledby="createassignModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createassignModalLabel">Create Assignment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('assign/create'); ?>" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="createnamaassign" class="form-label">Nama Assignment</label>
                                <input type="text" name="nama" class="form-control" id="createnamaassign" placeholder="Nama Assignment">
                            </div>
                            <div class="mb-3">
                                <label for="createketeranganassign" class="form-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="createketeranganassign" placeholder="Isi Keterangan"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="createcoderoom" class="form-label">Code Room</label>
                                <input type="text" name="code" class="form-control" id="createcoderoom" placeholder="********">
                            </div>

                            <?php if ($statuslogin == 'login') {
                                echo '<input type="hidden" name="userid" value="' . $user['userid'] . '">
                                <input type="hidden" name="pengirim" value="' . $user['nama'] . '">';
                            } ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <?php if ($statuslogin == 'login') {
            echo '
            <div class="modal fade" id="editprofilModal" tabindex="-1" aria-labelledby="editprofilModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editprofilModalLabel">Edit Profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="' . base_url('user/edit/' . $user['userid']) . '" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="namaeditprofil" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" id="namaeditprofil" placeholder="Nama Assignment" value="' . $user["nama"] . '">
                            </div>
                            <div class="mb-3">
                                <label for="emaileditprofil" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="emaileditprofil" placeholder="nama@example.com" value="' . $user["email"] . '">
                            </div>
                            <div class="mb-3">
                                <label for="passwordeditprofil" class="form-label">Password</label>
                                <input required type="password" name="password" class="form-control" id="passwordeditprofil" placeholder="********">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            ';
        }
        ?>
    </header>

    <!-- Begin page content -->
    <main class="p-4">

        <?= $this->renderSection('content'); ?>

    </main>

    <footer>
        <div class="container">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="<?= base_url('home'); ?>" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="<?= base_url('assign'); ?>" class="nav-link px-2 text-muted">Assignments</a></li>
                <li class="nav-item"><a href="<?= base_url('room'); ?>" class="nav-link px-2 text-muted">Room</a></li>
                <li class="nav-item"><a href="<?= base_url('assign/downloadpetunjuk'); ?>" class="nav-link px-2 text-muted">Instruction</a></li>
            </ul>
            <p class="text-center text-muted">&copy; 2021 Zadlyka</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/script.js'); ?>"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css" />
    <link rel="stylesheet" href="../includes/css/styles.css" />
    <?php
        require_once(__DIR__ . "/../includes/CRUD/crud.php");
        $session = new sessionManager();
        $auth = new auth($session);
    ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg user-select-none">
        <div class="container  d-flex justify-content-center mt-1 mb-4">
            <div class="mt-5 text-center">
                <h2 class="navbar-brand text-black d-flex justify-content-center align-items-center gap-1 m-0" style="font-size: 32px;" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z" />
                        <path d="M14 3v5h5M16 13H8M16 17H8M10 9H8" />
                    </svg><span>You<span class="p-0"
                            style="color: #020887; font-family: 'Allerta Stencil'">Article</span></span>
                </h2>
            </div>
        </div>
    </nav>
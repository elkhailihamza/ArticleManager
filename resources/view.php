<?php
require_once(__DIR__ . '/../config/db.php');
require_once(__DIR__ . '/../includes/CRUD/crud.php');
include(__DIR__ . "/../includes/header.php");
?>
<main class="d-flex flex-column align-items-center justify-content-center gap-3" style="height: 80vh;">
    <div>
        <h2>Contacts</h2>
        <hr>
    </div>
    <div class="container d-flex justify-content-end">
        <button type="button"
            class="btn btn-primary text-white mb-1 ml-3 py-2 px-4 border-0 d-flex justify-content-center align-items-center"
            data-bs-toggle="modal" style="background: #FF6700;" data-bs-target="#exampleModal"">Add<svg axmlns="
            http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
        </button>
    </div>
    <div class="container d-flex justify-content-center p-0"
        style="height: 325px; overflow: auto; padding: 0 28px; width: 100%;">
        <table class="table table-bordered w-100 container">
            <thead class="thead text-white" style=" background: #004E98; position: sticky; top: 0px;">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Contents</th>
                    <th scope="col">Created on</th>
                    <th scope="col">Created by</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $crud = new crud();
                $crud->getArticles();
                ?>
            </tbody>
        </table>
    </div>
    </div>
    </div>
    </div>
</main>
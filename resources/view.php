<?php
include(__DIR__ . "/../includes/header.php");
?>
<main class="d-flex flex-column align-items-center justify-content-center gap-3" style="height: 80vh;">
    <div>
        <h2>Articles</h2>
        <hr>
    </div>
    <div class="container d-flex justify-content-center p-0"
        style="height: 325px; overflow: auto; padding: 0 28px; width: 100%;">
        <table class="table table-bordered w-100 container user-select-none ">
            <thead class="thead text-white" style=" background: #004E98; position: sticky; top: 0px;">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Contents</th>
                    <th scope="col">Created on</th>
                    <th scope="col">Created by</th>
                    <th class="col-2" scope="col">Upd&Del</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $crudObj->getArticles();
                ?>
            </tbody>
        </table>
    </div>
    </div>
    </div>
    </div>
</main>
<?php
include (__DIR__ . "/../includes/footer.php");
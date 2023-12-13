<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>article</title>
</head>

<body>
    <main class="container-fluid d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
        <div class="container col-6 d-grid gap-5">
            <div class="text-center">
                <h2>
                    Create an article
                </h2>
            </div>
            <form action="" class="form-group d-flex flex-column justify-content-center gap-4">
                <div class="form-floating">
                    <input class="form-control" placeholder="Leave a comment here" maxlength="125"></input>
                    <label>Title</label>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" style="resize: none; height: 250px;"
                        placeholder="Leave a comment here" maxlength="4200  "></textarea>
                    <label>Content</label>
                </div>
                <div class="container d-flex justify-content-center align-items-center">
                    <button class="btn btn-primary px-4" style="width: 200px;" type="submit" value="Submit">Submit</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
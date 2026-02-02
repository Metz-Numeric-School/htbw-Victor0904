<?php $layout = 'admin/base.html.php'; ?>
<div class="container">

    <div class="row align-items-center">
        <div class="col">
            <h1>Nouvel habitudes</h1>
        </div>
        <div class="col-auto">
            <a href="/admin/habits" class="btn btn-outline-secondary">Annuler</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 col-lg-4">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form action="/admin/habits/new" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="habit[name]" id="name" aria-describedby="nameHelp" placeholder="ex: Manger des fruits">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">description</label>
                    <input type="text" class="form-control" name="habit[description]" id="description" aria-describedby="descriptionHelp" placeholder="ex: description de l'habitude">
                </div>
               
                
                </div>
                <button type="submit" class="btn btn-primary w-100">Envoyer</button>
            </form>
        </div>
    </div>




</div>
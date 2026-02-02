<?php $layout = 'admin/base.html.php'; ?>

<div class="container py-5">

    <div class="row align-items-center">
        <div class="col">
            <h1>Habitudes</h1>
        </div>
        <div class="col-auto">
            <a href="/admin/habits/new" class="btn btn-primary">Nouveau</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($habits as $habits): ?>
                        <tr>
                            <td><?php echo $habitsuser->getId() ?></td>
                            <td><?php echo $habits->getName() ?></td>
                            <td><?php echo $habits->getDescription() ?></td>
                          
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    
</div>
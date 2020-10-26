<?php
/**
 * @var array $companies
 */
?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Date</th>
        <th scope="col">VAT</th>
    </tr>
    </thead>
    <tbody>
    <?php
        if (!empty($companies)) :
            foreach ($companies as $key => $company) : ?>
            <tr>
                <td><?= ($key + 1); ?></td>
                <td><?= $company['name'] ;?></td>
                <td><?= $company['date'] ;?></td>
                <td><?= $company['vat'] ;?></td>
            </tr>
        <?php endforeach;
        else : ?>
            <tr>
                <td>Empty</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<a class="btn btn-primary" href="/home/add">Add new company</a>

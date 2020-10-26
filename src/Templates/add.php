<?php

use App\Model\Company;

/**
 * @var Company $comapny
 */
?>
<form action="" method="post">
    <div class="form-group">
        <label>Name</label>
        <input type="text"
               class="form-control <?= !empty($company->errors['name']) ? 'is-invalid' : ''; ?>"
               name="data[Company][name]"
               placeholder="Enter company name"
               value="<?php echo $company->getName() ?>"
        />
        <?php  if (!empty($company->errors['name'])) : ?>
            <p class="error"><?= $company->errors['name']; ?></p>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label>Date</label>
        <input type="date"
               class="form-control <?= !empty($company->errors['date']) ? 'is-invalid' : ''; ?>"
               name="data[Company][date]"
               value="<?php echo $company->getDate() ?>"
        />
        <?php  if (!empty($company->errors['date'])) : ?>
            <p class="error"><?= $company->errors['date']; ?></p>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label>Vat</label>
        <input type="text"
               class="form-control <?= !empty($company->errors['vat']) ? 'is-invalid' : ''; ?>"
               name="data[Company][vat]"
               placeholder="Enter vat"
               value="<?php echo $company->getVat() ?>"
        />
        <?php  if (!empty($company->errors['vat'])) : ?>
            <p class="error"><?= $company->errors['vat']; ?></p>
        <?php endif; ?>
    </div>
    <a class="btn btn-secondary" href="/">
        Back
    </a>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
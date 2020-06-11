<div class="form-group">
    <a href="<?php echo request()->url('cars/create'); ?>" class="btn btn-sm btn-primary">Add new car</a>
</div>
<?php if (!isset($cars)) { ?>
    <div class="alert alert-warning" role="alert">
        No added cars
    </div>
<?php } else { ?>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>#Id</th>
            <th>Created At</th>
            <th>Created By</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Issue Year</th>
            <th>Options</th>
        </tr>
        </thead>


        <tbody>
        <?php foreach ($cars as $car) { ?>
            <tr>
                <td><?php echo $car->id; ?></td>
                <td><?php echo $car->created_at; ?></td>
                <td><?php echo $car->created_by; ?></td>
                <td><?php echo $car->brand; ?></td>
                <td><?php echo $car->model; ?></td>
                <td><?php echo $car->issueYear; ?></td>
                <td>
                    <?php if ($this->hasPermission('cars.update')) { ?>
                        <a href="<?php echo request()->url('cars/edit/' . $car->id); ?>" class="btn btn-sm btn-primary">
                            <i class="fa fa-edit"></i>
                        </a>
                    <?php } ?>

                    <?php if ($this->hasPermission('cars.delete')) { ?>
                        <a href="<?php echo request()->url('cars/delete/' . $car->id); ?>"
                           class="btn btn-sm btn-danger">
                            <i class="fa fa-trash-o"></i>
                        </a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>
<?php if (isset($car)) { ?>
    <div class="form-group">
        <h3 class="">Edit car form</h3>
    </div>
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Car brand</label>
                    <input type="text" name="brand" required="required" class="form-control"
                           value="<?php echo $car->brand; ?>"
                    />
                </div><!-- End ./form-group -->

                <div class="form-group">
                    <label for="">Car model</label>
                    <input type="text" name="model" required="required" class="form-control"
                           value="<?php echo $car->model; ?>"
                    />
                </div><!-- End ./form-group -->

                <div class="form-group">
                    <label for="">Issue year</label>
                    <input type="date" name="issueYear" required="required" class="form-control"
                           value="<?php echo $car->issueYear; ?>"
                    />
                </div><!-- End ./form-group -->

                <div class="form-group">
                    <label for="">Equipment</label>
                    <input type="text" name="equipment" required="required" class="form-control"
                           value="<?php echo $car->equipment; ?>"
                    />
                </div><!-- End ./form-group -->

                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" class="form-control">
                        <option value="instock" <?php if ($carStore->status == 'instock') { ?> selected="selected" <?php } ?>>
                            instock
                        </option>
                        <option value="sold" <?php if ($carStore->status == 'sold') { ?> selected="selected" <?php } ?>>
                            sold
                        </option>
                        <option value="waitingDelivery" <?php if ($carStore->status == 'waitingDelivery') { ?> selected="selected" <?php } ?>>
                            waitingDelivery
                        </option>
                    </select>
                </div><!-- End ./form-group -->

                <div class="form-group">
                    <label for="">AvailableCount</label>
                    <input type="number" name="availableCount" required="required" class="form-control"
                           value="<?php echo $carStore->availableCount; ?>"
                    />
                </div><!-- End ./form-group -->

                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Save car</button>
                </div><!-- End ./form-group -->
            </div><!-- End ./col-lg-6 -->

            <div class="col-lg-6">
                <div class="form-group">
                    <?php
                    $technicalSpecifications = json_decode($car->technicalSpecifications);
                    ?>
                    <h4>TechnicalSpecifications(Performance)</h4>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Engine</span>
                                </div>
                                <input type="text" class="form-control" name="technicalSpecifications[engine]"
                                       required="required"
                                       value="<?php echo $technicalSpecifications->engine; ?>"
                                />
                            </div>
                        </div><!-- End ./col-2 -->

                        <div class="col-lg-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Doors</span>
                                </div>
                                <input type="text" class="form-control" name="technicalSpecifications[doors]"
                                       required="required"
                                       value="<?php echo $technicalSpecifications->doors; ?>"
                                />
                            </div>
                        </div><!-- End ./col-2 -->

                        <div class="col-lg-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Power</span>
                                </div>
                                <input type="text" class="form-control" name="technicalSpecifications[power]"
                                       required="required"
                                       value="<?php echo $technicalSpecifications->power; ?>"
                                />
                            </div>
                        </div><!-- End ./col-2 -->
                    </div><!-- End ./row -->
                </div><!-- End ./form-group -->

                <div class="form-group">
                    <h4>TechnicalSpecifications(Engine)</h4>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">MAxPower</span>
                                </div>
                                <input type="text" class="form-control" name="technicalSpecifications[maxPower]"
                                       required="required"
                                       value="<?php echo $technicalSpecifications->maxPower; ?>"
                                />
                            </div>
                        </div><!-- End ./col-2 -->

                        <div class="col-lg-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Torque</span>
                                </div>
                                <input type="text" class="form-control" name="technicalSpecifications[torque]"
                                       required="required"
                                       value="<?php echo $technicalSpecifications->torque; ?>"
                                />
                            </div>
                        </div><!-- End ./col-2 -->

                        <div class="col-lg-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Fuel System</span>
                                </div>
                                <input type="text" class="form-control" name="technicalSpecifications[fuelSystem]"
                                       required="required"
                                       value="<?php echo $technicalSpecifications->fuelSystem; ?>"
                                />
                            </div>
                        </div><!-- End ./col-2 -->
                    </div><!-- End ./row -->
                </div><!-- End ./form-group -->

            </div><!-- End ./col-lg-6 -->

        </div><!-- End ./row -->

    </form>
<?php } ?>
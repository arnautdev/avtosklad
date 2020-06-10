<div class="form-group">
    <h3 class="">Create car form</h3>
</div>
<form action="" method="post">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="">Car brand</label>
                <input type="text" name="brand" required="required" class="form-control"/>
            </div><!-- End ./form-group -->

            <div class="form-group">
                <label for="">Car model</label>
                <input type="text" name="model" required="required" class="form-control"/>
            </div><!-- End ./form-group -->

            <div class="form-group">
                <label for="">Issue year</label>
                <input type="date" name="issueYear" required="required" class="form-control"/>
            </div><!-- End ./form-group -->

            <div class="form-group">
                <label for="">Equipment</label>
                <input type="text" name="equipment" required="required" class="form-control"/>
            </div><!-- End ./form-group -->

            <div class="form-group">
                <label for="">Status</label>
                <select name="status" class="form-control">
                    <option value="instock">instock</option>
                    <option value="sold">sold</option>
                    <option value="waitingDelivery">waitingDelivery</option>
                </select>
            </div><!-- End ./form-group -->

            <div class="form-group">
                <label for="">AvailableCount</label>
                <input type="number" value="1" name="availableCount" required="required" class="form-control"/>
            </div><!-- End ./form-group -->

            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-primary">Add car</button>
            </div><!-- End ./form-group -->
        </div><!-- End ./col-lg-6 -->

        <div class="col-lg-6">
            <div class="form-group">
                <h4>TechnicalSpecifications(Performance)</h4>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Engine</span>
                            </div>
                            <input type="text" class="form-control" name="technicalSpecifications[engine]" required="required"/>
                        </div>
                    </div><!-- End ./col-2 -->

                    <div class="col-lg-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Doors</span>
                            </div>
                            <input type="text" class="form-control" name="technicalSpecifications[doors]" required="required"/>
                        </div>
                    </div><!-- End ./col-2 -->

                    <div class="col-lg-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Power</span>
                            </div>
                            <input type="text" class="form-control" name="technicalSpecifications[power]" required="required"/>
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
                            <input type="text" class="form-control" name="technicalSpecifications[maxPower]" required="required"/>
                        </div>
                    </div><!-- End ./col-2 -->

                    <div class="col-lg-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Torque</span>
                            </div>
                            <input type="text" class="form-control" name="technicalSpecifications[torque]" required="required"/>
                        </div>
                    </div><!-- End ./col-2 -->

                    <div class="col-lg-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Fuel System</span>
                            </div>
                            <input type="text" class="form-control" name="technicalSpecifications[fuelSystem]" required="required"/>
                        </div>
                    </div><!-- End ./col-2 -->
                </div><!-- End ./row -->
            </div><!-- End ./form-group -->

        </div><!-- End ./col-lg-6 -->

    </div><!-- End ./row -->

</form>
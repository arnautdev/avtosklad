<div class="row">

    <div class="col-lg-6">
        <h3>Login form</h3>
        <form action="<?php echo request()->url('user/login'); ?>" method="post">
            <div class="form-group">
                <label for="">E-mail</label>
                <input type="email" name="email" required="required" class="form-control"/>
            </div><!-- End ./form-group -->

            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" required="required" class="form-control"/>
            </div><!-- End ./form-group -->

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Sign in
                </button>
            </div><!-- End ./form-group -->
        </form>
    </div><!-- End ./col-lg-6 -->

    <div class="col-lg-6">
        <h3>Register form</h3>
        <form action="<?php echo request()->url('register/create'); ?>" method="post">
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" required="required" class="form-control"/>
            </div><!-- End ./form-group -->

            <div class="form-group">
                <label for="">E-mail</label>
                <input type="email" name="email" required="required" class="form-control"/>
            </div><!-- End ./form-group -->

            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" required="required" class="form-control"/>
            </div><!-- End ./form-group -->

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Sign in
                </button>
            </div><!-- End ./form-group -->
        </form>
    </div>

</div><!-- End ./row -->
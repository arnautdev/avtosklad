<div class="mg-auto">

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

</div><!-- End ./row -->
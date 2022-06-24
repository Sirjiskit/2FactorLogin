
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title><?php echo ESTABLISHMENT . ' :: ' . $this->title ?></title>
        <link rel="stylesheet" href="<?php echo ASSETS_URL ?>style.css">
        <link rel="stylesheet" href="<?php echo VENDORS_URL ?>fontawesome-free/css/all.min.css">
        <script>window.siteurl = '<?php echo URL; ?>';</script>
    </head>
    <body>
        <!-- partial:index.partial.html -->
        <div id="container" class="container">
            <!-- FORM SECTION -->
            <div class="row">
                <!-- SIGN UP -->
                <div class="col align-items-center flex-col sign-up">
                    <div class="form-wrapper align-items-center">
                        <form>
                            <div class="form sign-up" id="signUpPanel">
                                <div class="input-group">
                                    <i class="fa fa-user"></i>
                                    <input type="text" name="name" required="" placeholder="Name">
                                </div>
                                <div class="input-group">
                                    <i class="fa fa-envelope"></i>
                                    <input type="email" name="email" required="" placeholder="Email">
                                </div>
                                <div class="input-group">
                                    <i class="fa fa-phone"></i>
                                    <input type="text"  name="phone" placeholder="Phone number">
                                </div>
                                <div class="error" style="display: none" id="inputErr"></div>
                                <button type="button" id="btn-signup">
                                    Sign up
                                </button>
                                <p>
                                    <span>
                                        Already have an account?
                                    </span>
                                    <b onclick="toggle()" class="pointer">
                                        Sign in here
                                    </b>
                                </p>
                            </div>
                            <div class="form sign-up" id="signUpOtp" style="display: none">
                                <h3 class="h3">Enter OPT sent from your phone</h3>
                                <div class="form-group" style="margin-top: 50px; margin-bottom: 50px">
                                    <input type="text" maxlength="1" class="opt" id="otp1" data-next="2" placeholder="">
                                    <input type="text" maxlength="1" class="opt" id="otp2" data-next="3" placeholder="" disabled="">
                                    <input type="text" maxlength="1" class="opt" id="otp3" data-next="4" placeholder="" disabled="">
                                    <input type="text" maxlength="1" class="opt" id="otp4" data-next="5" placeholder="" disabled="">
                                    <input type="text" maxlength="1" class="opt" id="otp5" data-next="6" placeholder="" disabled="">
                                    <input type="text" maxlength="1" class="opt" id="otp6" data-next="7" placeholder="" disabled="">
                                </div>
                                <div class="error" style="display: none" id="inputErr2"></div>
                                <div id="sLoader"></div>
                                <p id="eCtr">
                                    <span>
                                        Not receiver?
                                    </span>
                                    <b  class="pointer" id="resent" onclick="return resent()">
                                        re-sent
                                    </b>
                                </p>
                            </div>
                            <div class="form sign-up" id="verified" style="display: none">
                                <div style="margin-top: 50px; margin-bottom: 50px; margin-left: auto; margin-right: auto;">
                                    <div style="width: 100px; height: 100px; margin-left: auto; margin-right: auto">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                        <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"></circle>
                                        <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "></polyline> </svg>
                                    </div>
                                    <p class="success">Your account successfully created and your password have been sent to your email and phone number.</p>
                                    <b onclick="toggle()" class="pointer">
                                        Sign in here
                                    </b>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
                <!-- END SIGN UP -->
                <!-- SIGN IN -->
                <div class="col align-items-center flex-col sign-in">
                    <div class="form-wrapper align-items-center">
                        <div class="form sign-in" id="signInPanel">

                            <div class="input-group">
                                <i class='fa fa-user'></i>
                                <input type="text" name="username" placeholder="Username" name="username">
                            </div>
                            <div class="input-group">
                                <i class='fa fa-lock'></i>
                                <input type="password" name="password" placeholder="Password">
                            </div>
                            <div class="error" style="display: none" id="loginErr"></div>
                            <button id="btn-login">
                                Sign in
                            </button>
                            <p>
                                <b>
                                    Forgot password?
                                </b>
                            </p>
                            <p>
                                <span>
                                    Don't have an account?
                                </span>
                                <b onclick="toggle()" class="pointer">
                                    Sign up here
                                </b>
                            </p>
                        </div>
                        <div class="form sign-in" id="signInOtp" style="display: none">
                            <h3 class="h3">Enter OPT sent from your phone</h3>
                            <div class="form-group" style="margin-top: 50px; margin-bottom: 50px">
                                <input type="text" maxlength="1" class="lOpt" id="lOpt1" data-next="2" placeholder="">
                                <input type="text" maxlength="1" class="lOpt" id="lOpt2" data-next="3" placeholder="" disabled="">
                                <input type="text" maxlength="1" class="lOpt" id="lOpt3" data-next="4" placeholder="" disabled="">
                                <input type="text" maxlength="1" class="lOpt" id="lOpt4" data-next="5" placeholder="" disabled="">
                                <input type="text" maxlength="1" class="lOpt" id="lOpt5" data-next="6" placeholder="" disabled="">
                                <input type="text" maxlength="1" class="lOpt" id="lOpt6" data-next="7" placeholder="" disabled="">
                            </div>
                            <div class="error" style="display: none" id="loginErr2"></div>
                            <div id="lLoader"></div>
                            <p id="lCtr">
                                <span>
                                    Not receiver?
                                </span>
                                <b  class="pointer" id="resent" onclick="return resent2()">
                                    re-sent
                                </b>
                            </p>
                        </div>
                    </div>
                    <div class="form-wrapper">

                    </div>
                </div>
                <!-- END SIGN IN -->
            </div>
            <!-- END FORM SECTION -->
            <!-- CONTENT SECTION -->
            <div class="row content-row">
                <!-- SIGN IN CONTENT -->
                <div class="col align-items-center flex-col">
                    <div class="text sign-in">
                        <h2>
                            Welcome
                        </h2>

                    </div>
                    <div class="img sign-in">

                    </div>
                </div>
                <!-- END SIGN IN CONTENT -->
                <!-- SIGN UP CONTENT -->
                <div class="col align-items-center flex-col">
                    <div class="img sign-up">

                    </div>
                    <div class="text sign-up">
                        <h2>
                            Join with us
                        </h2>

                    </div>
                </div>
                <!-- END SIGN UP CONTENT -->
            </div>
            <!-- END CONTENT SECTION -->
        </div>
        <!-- partial -->
        <script  src="<?php echo ASSETS_URL ?>script.js"></script>
        <script  src="<?php echo VENDORS_URL ?>jquery/dist/jquery.min.js"></script>
        <?php
        if (isset($this->customlibrary)) {
            echo "\n";
            foreach ($this->customlibrary as $js) {
                echo "\t<script type='text/javascript' src='" . URL . "views/" . $js . ".js'></script>\n";
            }
        }
        ?>
    </body>
</html>

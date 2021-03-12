<?php require 'partials/head.php'; ?>
    <div class="container">
        <div class="card o-hidden shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="/contacts" id="contactForm">
                            <div class="col-md-12 border-bottom-primary p-2 mt-lg-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2 class="h4 text-gray-900 pl-5"> Multi Contact Form </h2>
                                    </div>

                                    <div class="col-md-6 text-right-lg">
                                        <div class="pr-lg-4-5 pl-lg-0 pl-5">
                                            <button class="btn btn-secondary" id="addBtn" type="button"> Add Contact </button>
                                            <button class="btn btn-secondary" id="validateBtn" type="button"> Validate </button>
                                            <button class="btn btn-secondary" id="submitBtn"> Save </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo flash()->display() ?>
                            <div class="col-md-12">
                                <!-- <form method="POST" action="/contacts" id="contactForm"> -->
                                    <div class="row" id="contactFormContainer">
                                        <!--First Half of card-->
                                        <?php if(!is_array($contacts) || (is_array($contacts) && count($contacts) == 0)) { ?>
                                            <div class="col-md-6 subContactForm">
                                                <div class="p-4">
                                                    <div class="h5 border-bottom-primary">Contact</div>
                                                    <!-- <div class="user">
                                                        <div class="form-group row m-0 p-0">
                                                            <div class="col-4 form-label p-4">
                                                                Name
                                                            </div>
                                                            <div class="col-8  p-2">
                                                                <input type="text" name="name[]" class="form-control name">
                                                                <p class="text-danger name-error"></p>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row m-0 p-0">
                                                            <div class="col-4 form-label p-4">
                                                                Email
                                                            </div>
                                                            <div class="col-8  p-2">
                                                                <input type="email" name="email[]" class="form-control email">
                                                                <p class="text-danger email-error"></p>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row m-0 p-0">
                                                            <div class="col-4 form-label p-4">
                                                                Phone Number
                                                            </div>
                                                            <div class="col-8  p-2">
                                                                <input type="number" name="number[]" class="form-control phone">
                                                                <p class="text-danger number-error"></p>
                                                            </div>
                                                        </div>
                                                    </div> -->

                                                    <?php require 'partials/form.php'; ?>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if(is_array($contacts)) foreach($contacts as $key => $contactObj) { ?>
                                            <?php if($key == 0){ ?>
                                                <!--First Half of card-->
                                                <div class="col-md-6 subContactForm">
                                                    <div class="p-4">
                                                        <div class="h5 border-bottom-primary">Contact</div>
                                                        <?php require 'partials/form.php'; ?>
                                                    </div>
                                                </div>
                                                <?php continue; ?>
                                            <?php } ?>
                                            <div class="col-md-6 subContactForm">
                                                <!--Other cards-->
                                                <div class="p-4">
                                                    <div class="mb-5">
                                                        <div class="h5 float-left">Contact</div>
                                                        <div class="float-right btn btn-secondary mt-n3 remove-btn">Remove</div>
                                                    </div>
                                                    <div class="border-bottom-primary mt-n4 mb-2"></div>
                                                    <div>
                                                        <?php require 'partials/form.php'; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <!-- </form> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo getenv('APP_URL') .'public/js/index.js' ?>"></script>
<?php require 'partials/footer.php'; ?>

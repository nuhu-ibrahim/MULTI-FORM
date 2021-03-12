<div class="user">
    <div class="form-group row m-0 p-0">
        <div class="col-4 form-label p-4">
            Name
        </div>
        <div class="col-8  p-2">
            <input 
                type="text" 
                name="name[]" 
                value="<?php echo $contactObj['contact']->name ?? "" ?>" 
                class="form-control name">
            <p class="text-danger name-error"><?php echo $contactObj['errors']['name'] ?? "" ?></p>
        </div>
    </div>

    <div class="form-group row m-0 p-0">
        <div class="col-4 form-label p-4">
            Email
        </div>
        <div class="col-8  p-2">
            <input type="email" name="email[]" value="<?php echo $contactObj['contact']->email ?? "" ?>" class="form-control email">
            <p class="text-danger email-error"><?php echo $contactObj['errors']['email'] ?? "" ?></p>
        </div>
    </div>

    <div class="form-group row m-0 p-0">
        <div class="col-4 form-label p-4">
            Phone Number
        </div>
        <div class="col-8  p-2">
            <input type="number" name="number[]" value="<?php echo $contactObj['contact']->number ?? "" ?>" class="form-control phone">
            <p class="text-danger number-error"><?php echo $contactObj['errors']['number'] ?? "" ?></p>
        </div>
    </div>
</div>
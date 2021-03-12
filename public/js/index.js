(function(window, undefined) {
    var Validator = {
        constructor: function(form, subForm, btn, action, config) {
            this._elForm = form;
            this._elSubForm = subForm;
            this._elBtn = btn;
            this._action = action;
            this._els = config.fields || {};

            this.init();
        },

        init: function() {
            this.addFormListener();
        },

        addFormListener: function() {
            var btnSelector = this._elBtn;
            var validateBtn = document.querySelector(btnSelector);
            validateBtn.addEventListener('click', this.validate.bind(this), false);
        },

        validate: function(e) {
        	var isValid = true;
        	var formSelector = this._elForm.substring(1);
        	var subFormSelector = this._elSubForm;
        	var contactForms = document.getElementById(formSelector).querySelectorAll(subFormSelector); 
        	var elFields = this._els;
        	var action = this._action;
			for(contactForm of contactForms){
	            for (var field in elFields) {
	                var el = contactForm.querySelector(field),
	                    elVal = el.value;
	                var errorEl = contactForm.querySelector(elFields[field].errorTag);

	                if(elFields[field].required && elVal === ''){
	                	var error = "This field is required";
	                	errorEl.innerHTML = error;
	                	isValid = false;
	                }else if(elVal.length > elFields[field].maxlength){
	                	var error = `The length of this field cannot exceed ${elFields[field].maxlength}`;
	                	errorEl.innerHTML = error;
	                	isValid = false;
	                }else if(elVal.length < elFields[field].minlength){
	                	var error = `The length of this field cannot be less than ${elFields[field].minlength}`;
	                	errorEl.innerHTML = error;
	                	isValid = false;
	                }else if(elFields[field].type === "text" && !/^[a-zA-Z\s]*$/.test(elVal)){
	                	var error = "This field must be text only";
	                	errorEl.innerHTML = error;
	                	isValid = false;
	                }else if(elFields[field].type === "email" && !/\S+@\S+\.\S+/.test(elVal)){
	                	var error = "This field must be a valid email";
	                	errorEl.innerHTML = error;
	                	isValid = false;
	                }else if(elFields[field].type === "phone" && !/^\d+$/.test(elVal)){
	                	var error = "This field must be a valid phone with only numbers";
	                	errorEl.innerHTML = error;
	                	isValid = false;
	                }else{
	                	errorEl.innerHTML = "";
	                }
	            } 
			}

			if(action == "submit" && isValid){
				// Submit form here
				var contactFormSelector = this._elForm.substring(1);
				var contactForm = document.getElementById(contactFormSelector);

				contactForm.submit();
			}

            e.preventDefault();
        },
    }

    var form1 = Object.create(Validator);
    var form2 = Object.create(Validator);

    var valRules = {
	    fields: {
	        '.name': {
	            required: true,
	            maxlength: 50,
	            minlength: 2,
	            type: "text",
	            errorTag: ".name-error"
	        },
	        '.email': {
	        	required: true,
	            maxlength: 50,
	            type: "email",
	            minlength: 3,
	            errorTag: ".email-error"
	        },
	        '.phone': {
	        	required: true,
	            maxlength: 15,
	            type: "phone",
	            minlength: 5,
	            errorTag: ".number-error"
	        }
	    }
	}

	form1.constructor('#contactForm', '.subContactForm', '#validateBtn', "validate", valRules);
	form2.constructor('#contactForm', '.subContactForm', '#submitBtn', "submit", valRules);

	var RemoveDiv = {
        constructor: function(elClass, closingClass) {
            this._elClass = elClass;
            this._elClosingClass = closingClass;
            this.init();
        },

        init: function() {
            this.addFormListener();
        },

        addFormListener: function() {
            var remBtnSelector = this._elClass;
            var removeBtns = document.querySelectorAll(remBtnSelector);

            for(removeBtn of removeBtns){
            	removeBtn.addEventListener('click', this.remove.bind(this), false);
            }
        },

        remove: function(e) {
        	closingClassSelector = this._elClosingClass
        	var subContactForm = e.target.closest(closingClassSelector);  
        	subContactForm.remove();
        },
    }

    var remove = Object.create(RemoveDiv);
    remove.constructor('.remove-btn', '.subContactForm');

    var ElementInclusion = {
    	constructor: function(btn, container, template, remove, removeBtn, formsDiv) {
    		this._elAddBtn = btn;
            this._elContainer = container;
            this._elTemplace = template;
            this._removeObj = remove;

            this._elRemoveBtn = removeBtn;
            this.formsDiv = formsDiv;

            this.init();
        },

        init: function() {
            this.addFormListener();
        },

        addFormListener: function() {
            var addBtnSelector = this._elAddBtn;
            var addBtn = document.querySelector(addBtnSelector);
            addBtn.addEventListener('click', this.include.bind(this), false);
        },

        include: function(e) {
        	var formContainerSelector = this._elContainer;
        	var formContainer = document.querySelector(formContainerSelector);
        	var template = this._elTemplace;
        	var removeObj = this._removeObj;

        	removeBtnSelector = this._elRemoveBtn;
            formsDiv = this.formsDiv;


        	var div = document.createElement('div');
        	div.className = "col-md-6 subContactForm";
        	div.innerHTML = template;

        	formContainer.appendChild(div);

        	removeObj.constructor(removeBtnSelector, formsDiv);
        },
    }

    var include = Object.create(ElementInclusion);
    template = 
    	`
	    	<div class="p-4">
                <div class="mb-5">
                    <div class="h5 float-left">Contact</div>
                    <div class="float-right btn btn-secondary mt-n3 remove-btn">Remove</div>
                </div>
                <div class="border-bottom-primary mt-n4 mb-2"></div>
                <div>
                    <div class="user">
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
                    </div>
                </div>
            </div>
    	`;

    include.constructor('#addBtn', '#contactFormContainer', template, remove, '.remove-btn', '.subContactForm');
})(window, undefined);
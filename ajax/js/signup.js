require(["dojo/dom", "dojo/on", "dojo/request", "dojo/dom-form"], 
    function(dom, on, request, domForm){
        var sign_up_form = dom.byId('signUpForm');
        
        // Attach an event handler
        on(sign_up_form, "submit", function(evt){
            
            // prevent the page from navigating after submit
            evt.stopPropagation();
            evt.preventDefault();
            
            username = dom.byId('username');
            password1 = dom.byId('password1');
            password2 = dom.byId('password2');
            error_msg = "placeholder";
            
            // if data exists, try to login
            if (username.value.length == 0 || password1.value.length == 0 || password2.value.length == 0) {
                error_msg = "Enter a username and a password twice.";
                dom.byId("message").innerHTML = error_msg;
            } else if (password1.value != password2.value) {
                error_msg = "The two passwords don't match";
                dom.byId("message").innerHTML = error_msg;
            } else {
                // Post the data to the server
                request.post("../ajax/signup.php", {
                    // Send the username and password
                    data: domForm.toObject("signUpForm"),
                    // Wait 2 seconds for a response
                    timeout: 2000
                }).then(
                    function(response){
                        console.log(response);
                        if (response == true) { // if good credentials
                            //error_msg = "Working.";
                            window.location.href = "http://localhost/work-journal/application/signin.php";
                            //dom.byId("message").innerHTML = error_msg;
                        } else { //if bad credentials, show error message
                            error_msg = "Username taken.";
                            dom.byId("message").innerHTML = error_msg;
                        }
                    },
                    function(error){
                            console.log(error);
                    }
                );
            }
        });
    }
);
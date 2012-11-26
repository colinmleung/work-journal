require(["dojo/dom", "dojo/on", "dojo/request", "dojo/dom-form"], 
    function(dom, on, request, domForm){
        var sign_in_form = dom.byId('signinForm');
        
        // Attach an event handler
        on(sign_in_form, "submit", function(evt){
            
            // prevent the page from navigating after submit
            evt.stopPropagation();
            evt.preventDefault();
            
            username = dom.byId('username');
            password = dom.byId('password');
            error_msg = "placeholder";
            
            // if data exists, try to login
            if (username.value.length == 0 || password.value.length == 0) {
                error_msg = "Enter a username and password.";
                dom.byId("message").innerHTML = error_msg;
            } else {
                // Post the data to the server
                request.post("../ajax/signin.php", {
                    // Send the username and password
                    data: domForm.toObject("signinForm"),
                    // Wait 2 seconds for a response
                    timeout: 5000
                }).then(
                    function(response){
                        console.log(response);
                        if (response == 1) { // if good credentials
                            //error_msg = "Working.";
                            window.location.href = "http://localhost/work-journal/application/write.php";
                            //dom.byId("message").innerHTML = error_msg;
                        } else { //if bad credentials, show error message
                            error_msg = "Enter a valid username and password combination.";
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
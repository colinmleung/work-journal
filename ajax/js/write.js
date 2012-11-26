require(["dojo/dom", "dojo/on", "dojo/request", "dojo/dom-form", "dojo/dom-attr", "dojo/dom-construct", "dojo/domReady!"], 
    function(dom, on, request, domForm, domAttr, domConstruct){
        var entry_form = dom.byId('entry');
        var entry_form_children = entry_form.childNodes[1];
        
        create_button = dom.byId('create');
        save_button = dom.byId('save');
        delete_button = dom.byId('delete');
        clear_button = dom.byId('clear');
        forward_button = dom.byId('forward');
        backward_button = dom.byId('backward');
        first_header = dom.byId('entry[header][0]');
        first_response = dom.byId('entry[response][0]');
        date_node = dom.byId("date");
        template_select = dom.byId("template_name");
        
        on(create_button, "click", function(evt){
            
            // prevent the page from navigating after submit
            evt.stopPropagation();
            evt.preventDefault();
            
            error_msg = "placeholder";
            
            template_name = template_select.options[template_select.selectedIndex].text;
            
            // Post the data to the server
            request.post("../ajax/write_create.php", {
                // Send the data
                data : {template_name : template_name}
            }).then(
                function(response){
                    console.log(response);
                    new_entry = JSON.parse(response);
                    // delete all existing blocks
                    form_length = entry_form_children.length;
                    for (i = 7; i < form_length; i++)  {
                            domConstruct.destroy(entry_form_children[7]);
                    }
                    // create new blocks
                    for (i = 0; i < new_entry.header.length; i++) {
                        header_string = "entry[header]["+i+"]";
                        response_string = "entry[response]["+i+"]";
                        domConstruct.create("textarea", 
                                            {rows: "1",
                                            cols: "200",
                                            name: header_string,
                                            id: header_string},
                                            entry_form_children);
                        domConstruct.create("textarea",
                                            {rows: "10",
                                            cols: "200",
                                            name: response_string,
                                            id: response_string},
                                            entry_form_children);
                    }
                    // insert the headers
                    form_length = entry_form_children.length;
                    for (i = 7; i < form_length; i=i+2) {
                            index = (i-7)/2;
                            entry_form_children[i].innerText = new_entry.header[index];
                    }
                    // disable the delete button
                    domAttr.set(delete_button, "disabled", "disabled");
                },
                function(error){
                        console.log(error);
                }
            );
        });
        
        // Attach an event handler
        on(save_button, "click", function(evt){
            
            // prevent the page from navigating after submit
            evt.stopPropagation();
            evt.preventDefault();
            
            entry_header = [];
            entry_response = [];
            for (i = 7; i < entry_form_children.length; i++) {
                if ((i % 2) == 1) {
                    entry_header[(i-7)/2] = entry_form_children[i].innerText;
                } else {
                    entry_response[(i-8)/2] = entry_form_children[i].innerText;
                }
            }
            
            error_msg = "placeholder";
            
            entry_header = JSON.stringify(entry_header);
            entry_response = JSON.stringify(entry_response);
            
            // Post the data to the server
            request.post("../ajax/write_save.php", {
                // Send the data
                data: {
                    entry_h: entry_header,
                    entry_r: entry_response
                }
            }).then(
                function(response){
                console.log(response);
                    if (response) {
                        // modify the Write view
                        // enable the delete button
                        domAttr.remove(delete_button, "disabled");
                    } else {
                    }
                },
                function(error){
                        console.log(error);
                }
            );
        });
        
        on(delete_button, "click", function(evt){
            
            // prevent the page from navigating after submit
            evt.stopPropagation();
            evt.preventDefault();
            
            error_msg = "placeholder";
            
            // Post the data to the server
            request.post("../ajax/write_delete.php", {
                // Send the data
            }).then(
                function(response){
                console.log(response);
                    if (response) {
                        // set a blank entry
                            // delete extra text areas
                        for (i = 9; i < entry_form_children.length; i++)  {
                            domConstruct.destroy(entry_form_children[i]);
                        }
                            // empty out the first header and response
                        first_header.innerText = "";
                        first_response.innerText = "";
                        // disable the delete button
                        domAttr.set(delete_button, "disabled", "disabled");
                    }
                },
                function(error){
                        console.log(error);
                }
            );
        });
        
        on(clear_button, "click", function(evt){
            
            // prevent the page from navigating after submit
            evt.stopPropagation();
            evt.preventDefault();
            
            error_msg = "placeholder";
            
            // Post the data to the server
            request.post("../ajax/write_clear.php", {
                // Send the data
            }).then(
                function(response){
                console.log(response);
                    if (response) {
                        // empty the responses
                        for (i = 8; i < entry_form_children.length; i=i+2) {
                            entry_form_children[i].innerText = "";
                        }
                    }
                },
                function(error){
                        console.log(error);
                }
            );
        });
        
        on(forward_button, "click", function(evt){
            
            // prevent the page from navigating after submit
            evt.stopPropagation();
            evt.preventDefault();
            
            error_msg = "placeholder";
            
            // Post the data to the server
            request.post("../ajax/write_forward.php", {
                // Send the data
            }).then(
                function(response){
                console.log(response); // reponse is the timestamp
                        // increment the date
                            //convert php date to javascript date
                    timestamp = +response + 86400;
                    date_string = date_converter("Y-m-d", timestamp); // response+86400 to correct for date_converter
                    console.log(date_string);
                    date_node.innerText = date_string;
                    // set a blank entry
                        // delete extra text areas
                    for (i = 9; i < entry_form_children.length; i++)  {
                        domConstruct.destroy(entry_form_children[i]);
                    }
                        // empty put the first header and response
                    first_header.innerText = "";
                    first_response.innerText = "";
                    // disable the delete button
                    domAttr.set(delete_button, "disabled", "disabled");
                },
                function(error){
                        console.log(error);
                }
            );
        });
        
        on(backward_button, "click", function(evt){
            
            // prevent the page from navigating after submit
            evt.stopPropagation();
            evt.preventDefault();
            
            error_msg = "placeholder";
            
            // Post the data to the server
            request.post("../ajax/write_backward.php", {
                // Send the data
            }).then(
                function(response){
                    console.log(response); // reponse is the timestamp
                        // increment the date
                            //convert php date to javascript date
                    timestamp = +response + 86400;
                    date_string = date_converter("Y-m-d", timestamp); // response+86400 to correct for date_converter
                    console.log(date_string);
                    date_node.innerText = date_string;
                    // set a blank entry
                        // delete extra text areas
                    for (i = 9; i < entry_form_children.length; i++)  {
                        domConstruct.destroy(entry_form_children[i]);
                    }
                        // empty put the first header and response
                    first_header.innerText = "";
                    first_response.innerText = "";
                    // disable the delete button
                    domAttr.set(delete_button, "disabled", "disabled");
                },
                function(error){
                        console.log(error);
                }
            );
        });
    }
);
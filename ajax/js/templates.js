require(["dojo/dom", "dojo/on", "dojo/request", "dojo/dom-form", "dojo/dom-construct", "dojo/domReady!"], 
    function(dom, on, request, domForm, domConstruct){
        add_header_button = dom.byId("add_header");
        delete_template_button = dom.byId("delete");
        template_form = dom.byId("templateForm");
        first_header = dom.byId("template[header][0]");
        save_button = dom.byId("save");
        create_button = dom.byId("create");
        
        
        
        on(create_button, "click", function(evt){
            
            // prevent the page from navigating after submit
            evt.stopPropagation();
            evt.preventDefault();
            
            error_msg = "placeholder";
            
            // Post the data to the server
            request.post("../ajax/templates_create.php", {
            }).then(
                function(response){
                    console.log(response);
                    // set a blank entry
                        // delete extra text areas
                    for (i = template_form.length - 2; i > 4; i--)  {
                        domConstruct.destroy(template_form.children[i]);
                    }
                        // empty out the first header and response
                    first_header.innerText = "";
                    // disable the delete button
                    domAttr.set(delete_template_button, "disabled", "disabled");
                },
                function(error){
                        console.log(error);
                }
            );
        });
        
        on(save_button, "click", function(evt){
            
            // prevent the page from navigating after submit
            evt.stopPropagation();
            evt.preventDefault();
            
            // get the template_array
            for (i = 4; i < template_form.length - 1; i = i + 2) {
                header_array[(i-4)/2] = template_form.children[i].innerText;
            }
            
            header_array = JSON.stringify(header_array);
            
            // Post the data to the server
            request.post("../ajax/templates_save.php", {
                // Send the data
                data: {
                    name: template_form.children[3].innerText,
                    template_h: header_array,
                }
            }).then(
                function(response){
                console.log(response);
                    if (response) {
                        // enable the delete button
                        domAttr.remove(delete_button, "disabled");
                    }
                },
                function(error){
                        console.log(error);
                }
            );
        });
        
        on(delete_template_button, "click", function(evt) {
            evt.stopPropagation();
            evt.preventDefault();
           
            request.post("../ajax/templates_delete.php",{
            }).then(
                function(response) {
                    // set a blank entry
                        // delete extra text areas
                    for (i = template_form.length - 2; i > 4; i--)  {
                        domConstruct.destroy(template_form.children[i]);
                    }
                        // empty out the first header and response
                    first_header.innerText = "";
                    // disable the delete button
                    domAttr.set(delete_template_button, "disabled", "disabled");
                }
            );
        });
        
        on(add_header_button, "click", function(evt) {
            evt.stopPropagation();
            evt.preventDefault();
            
            // get the template_array
            for (i = 4; i < template_form.length - 1; i = i + 2) {
                header_array[(i-4)/2] = template_form.children[i].innerText;
            }
            
            header_array = JSON.stringify(header_array);
            header_array_length = header_array.length;
           
            request.post("../ajax/templates_add.php",{
                data: {
                        name: template_form.children[3].innerText,
                        header: header_array
                    }
            }).then(
                function(response) {
                    // insert a new header before the Add button
                    header_string = "template[header][" + header_array_length + "]";
                    domConstruct.create("textarea", 
                                            {rows: "1",
                                            cols: "200",
                                            name: header_string,
                                            id: header_string},
                                            add_header_button,
                                            "before");
                    // insert a new delete button before the Add button
                    delete_string = "delete_header[" + header_array_length + "]";
                    domConstruct.create("input",
                                            {type: "submit",
                                            value: "Delete",
                                            name: delete_string,
                                            id: delete_string},
                                            add_header_button,
                                            "before");
                }
            );
        });
    }
);
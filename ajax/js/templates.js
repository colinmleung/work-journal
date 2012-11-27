require(["dojo/dom", "dojo/on", "dojo/request", "dojo/dom-form", "dojo/dom-attr", "dojo/dom-construct", "dojo/domReady!"], 
    function(dom, on, request, domForm, domAttr, domConstruct){
        add_header_button = dom.byId("add_header");
        delete_template_button = dom.byId("delete");
        template_form = dom.byId("templateForm");
        first_header = dom.byId("template[header][0]");
        template_name = dom.byId("template[name]");
        save_button = dom.byId("save");
        create_button = dom.byId("create");
        
        for(i = 5; i < template_form.length - 1; i = i + 2) {
            delete_header_button = template_form.children[i];
            on(delete_header_button, "click", function(evt){
                // prevent the page from navigating after submit
                evt.stopPropagation();
                evt.preventDefault();
                
                // get the template_array
                header_array = [];
                for (j = 4; j < template_form.length - 1; j = j + 2) {
                    header_array[(j-4)/2] = template_form.children[j].innerText;
                }
                
                header_array_string = JSON.stringify(header_array);
                
                // get the delete array and delete button id
                delete_button_id = evt.target.id;
                delete_index = delete_button_id.match(/\d+/g);
                delete_array = [];
                delete_array[delete_index[0]] = "Delete";

                // get the header id
                header_id_string = "template[header][" + delete_index[0] + "]";
            
                // Post the data to the server
                request.post("../ajax/templates_save.php", {
                    // Send the data
                    data: {
                        name: template_form.children[3].innerText,
                        template_h: header_array_string,
                        delete_a: delete_array
                    }
                }).then(
                    function(response) {
                        console.log(response);
                        // delete the header and its delete button
                        domConstruct.destroy(header_id_string);
                        domConstruct.destroy(delete_button_id);
                        
                        // rename all the header and delete buttons
                        for (k = 4; k < template_form.length - 1; k = k+2) {
                            k_plus_one = +k + 1;
                            old_header = template_form.children[k];
                            old_delete = template_form.children[k_plus_one];
                            
                            new_index = (+k - 4)/2;
                            new_header_string = "template[header][" + new_index + "]";
                            new_delete_string = "delete_header[" + new_index + "]";
                            domAttr.set(old_header, "name", new_header_string);
                            domAttr.set(old_header, "id", new_header_string);
                            domAttr.set(old_delete, "name", new_delete_string);
                            domAttr.set(old_delete, "id", new_delete_string);
                        }
                        
                        // if only one header is left, delete its delete button
                        if (header_array.length == 2) {
                            delete_string = "delete_header[0]";
                            domConstruct.destroy(delete_string);
                        }
                    }
                );
            });
        }
        
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
                    template_name.innerText = "";
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
            
            header_array = [];
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
                        domAttr.remove(delete_template_button, "disabled");
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
                    for (i = template_form.length - 2; i > 4; i--) {
                        domConstruct.destroy(template_form.children[i]);
                    }
                        // empty out the first header and response
                    first_header.innerText = "";
                    template_name.innerText = "";
                    // disable the delete button
                    domAttr.set(delete_template_button, "disabled", "disabled");
                }
            );
        });
        
        on(add_header_button, "click", function(evt) {
            evt.stopPropagation();
            evt.preventDefault();
            
            header_array = [];
            // get the template_array
            for (i = 4; i < template_form.length - 1; i = i + 2) {
                header_array[(i-4)/2] = template_form.children[i].innerText;
            }
            
            header_array_string = JSON.stringify(header_array);
           
            request.post("../ajax/templates_add.php",{
                data: {
                        name: template_form.children[3].innerText,
                        header: header_array_string
                    }
            }).then(
                function(response) {
                    // if this is the creation of the second header, create a delete button for the first header
                    if (header_array.length == 1) {
                        delete_string = "delete_header[0]";
                        domConstruct.create("input",
                                                {type: "submit",
                                                value: "Delete",
                                                name: delete_string,
                                                id: delete_string},
                                                add_header_button,
                                                "before");
                    }
                    // insert a new header before the Add button
                    header_string = "template[header][" + header_array.length + "]";
                    domConstruct.create("textarea", 
                                            {rows: "1",
                                            cols: "200",
                                            name: header_string,
                                            id: header_string},
                                            add_header_button,
                                            "before");
                    // insert a new delete button before the Add button
                    delete_string = "delete_header[" + header_array.length + "]";
                    domConstruct.create("input",
                                            {type: "submit",
                                            value: "Delete",
                                            name: delete_string,
                                            id: delete_string},
                                            add_header_button,
                                            "before");
                    //beginning of COPYPASTA
                    on(delete_header_button, "click", function(evt){
                        // prevent the page from navigating after submit
                        evt.stopPropagation();
                        evt.preventDefault();
                        
                        // get the template_array
                        header_array = [];
                        for (j = 4; j < template_form.length - 1; j = j + 2) {
                            header_array[(j-4)/2] = template_form.children[j].innerText;
                        }
                        
                        header_array_string = JSON.stringify(header_array);
                        
                        // get the delete array and delete button id
                        delete_button_id = evt.target.id;
                        delete_index = delete_button_id.match(/\d+/g);
                        delete_array = [];
                        delete_array[delete_index[0]] = "Delete";

                        // get the header id
                        header_id_string = "template[header][" + delete_index[0] + "]";
                    
                        // Post the data to the server
                        request.post("../ajax/templates_save.php", {
                            // Send the data
                            data: {
                                name: template_form.children[3].innerText,
                                template_h: header_array_string,
                                delete_a: delete_array
                            }
                        }).then(
                            function(response) {
                                console.log(response);
                                // delete the header and its delete button
                                domConstruct.destroy(header_id_string);
                                domConstruct.destroy(delete_button_id);
                                
                                // rename all the header and delete buttons
                                for (k = 4; k < template_form.length - 1; k = k+2) {
                                    k_plus_one = +k + 1;
                                    old_header = template_form.children[k];
                                    old_delete = template_form.children[k_plus_one];
                                    
                                    new_index = (+k - 4)/2;
                                    new_header_string = "template[header][" + new_index + "]";
                                    new_delete_string = "delete_header[" + new_index + "]";
                                    domAttr.set(old_header, "name", new_header_string);
                                    domAttr.set(old_header, "id", new_header_string);
                                    domAttr.set(old_delete, "name", new_delete_string);
                                    domAttr.set(old_delete, "id", new_delete_string);
                                }
                                
                                // if only one header is left, delete its delete button
                                if (header_array.length == 2) {
                                    delete_string = "delete_header[0]";
                                    domConstruct.destroy(delete_string);
                                }
                            }
                        );
                    }); // END OF COPYPASTA
                }
            );
        });
    }
);
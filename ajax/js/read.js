require(["dojo/dom", "dojo/on", "dojo/request", "dojo/dom-form", "dojo/dom-construct", "dojo/domReady!"],
    function(dom, on, request, domForm, domConstruct){
        read_form = dom.byId("read_form");
        
        daily_button = dom.byId("day");
        weekly_button = dom.byId("week");
        monthly_button = dom.byId("month");
        semesterly_button = dom.byId("semester");
        
        read_area = dom.byId("reading");
        
        on(daily_button, "click", function(evt){
            evt.stopPropagation();
            evt.preventDefault();
            
            request.post("../ajax/read.php", {
            }).then(
                function(response){
                    console.log(response);
                    //erase read_area
                    domConstruct.empty(read_area);
                    
                    reading_array = JSON.parse(response);
                    for (i = 0; i < reading_array.length; i++) {
                        date = reading_array[i].date;
                        domConstruct.create("p", 
                                            null,
                                            read_area);
                        read_area.lastElementChild.innerText = date;
                        
                        entry_headers = reading_array[i].header;
                        entry_responses = reading_array[i].response;
                        for (j = 0; j < entry_headers.length; j++) {
                            entry_header = entry_headers[j];
                            entry_response = entry_responses[j];
                            domConstruct.create("p", 
                                                null,
                                               read_area);
                            read_area.lastElementChild.innerText = entry_header;
                            domConstruct.create("p", 
                                                null,
                                               read_area);
                            read_area.lastElementChild.innerText = entry_response;
                        }
                    }
                }
            );
        });
        
        on(weekly_button, "click", function(evt){
            evt.stopPropagation();
            evt.preventDefault();
            
            request.post("../ajax/read.php", {
            }).then(
                function(response){
                    console.log(response);
                    //erase read_area
                    domConstruct.empty(read_area);
                    
                    reading_array = JSON.parse(response);
                    for (i = 0; i < reading_array.length; i++) {
                        date = reading_array[i].date;
                        domConstruct.create("p", 
                                            null,
                                            read_area);
                        read_area.lastElementChild.innerText = date;
                        
                        entry_headers = reading_array[i].header;
                        entry_responses = reading_array[i].response;
                        for (j = 0; j < entry_headers.length; j++) {
                            entry_header = entry_headers[j];
                            entry_response = entry_responses[j];
                            domConstruct.create("p", 
                                                null,
                                               read_area);
                            read_area.lastElementChild.innerText = entry_header;
                            domConstruct.create("p", 
                                                null,
                                               read_area);
                            read_area.lastElementChild.innerText = entry_response;
                        }
                    }
                }
            );
        });
        
        on(monthly_button, "click", function(evt){
            evt.stopPropagation();
            evt.preventDefault();
            
            request.post("../ajax/read.php", {
            }).then(
                function(response){
                    console.log(response);
                    //erase read_area
                    domConstruct.empty(read_area);
                    
                    reading_array = JSON.parse(response);
                    for (i = 0; i < reading_array.length; i++) {
                        date = reading_array[i].date;
                        domConstruct.create("p", 
                                            null,
                                            read_area);
                        read_area.lastElementChild.innerText = date;
                        
                        entry_headers = reading_array[i].header;
                        entry_responses = reading_array[i].response;
                        for (j = 0; j < entry_headers.length; j++) {
                            entry_header = entry_headers[j];
                            entry_response = entry_responses[j];
                            domConstruct.create("p", 
                                                null,
                                               read_area);
                            read_area.lastElementChild.innerText = entry_header;
                            domConstruct.create("p", 
                                                null,
                                               read_area);
                            read_area.lastElementChild.innerText = entry_response;
                        }
                    }
                }
            );
        });
        
        on(semesterly_button, "click", function(evt){
            evt.stopPropagation();
            evt.preventDefault();
            
            request.post("../ajax/read.php", {
            }).then(
                function(response){
                    console.log(response);
                    //erase read_area
                    domConstruct.empty(read_area);
                    
                    reading_array = JSON.parse(response);
                    for (i = 0; i < reading_array.length; i++) {
                        date = reading_array[i].date;
                        domConstruct.create("p", 
                                            null,
                                            read_area);
                        read_area.lastElementChild.innerText = date;
                        
                        entry_headers = reading_array[i].header;
                        entry_responses = reading_array[i].response;
                        for (j = 0; j < entry_headers.length; j++) {
                            entry_header = entry_headers[j];
                            entry_response = entry_responses[j];
                            domConstruct.create("p", 
                                                null,
                                               read_area);
                            read_area.lastElementChild.innerText = entry_header;
                            domConstruct.create("p", 
                                                null,
                                               read_area);
                            read_area.lastElementChild.innerText = entry_response;
                        }
                    }
                }
            );
        });
    }
);
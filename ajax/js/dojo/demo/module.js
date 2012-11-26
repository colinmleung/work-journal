// Require the module we just created
require(["demo/myModule"], function(myModule){
    // Use our module to change the text in the greeting
    myModule.setText("greeting", "Hello Dojo!");
 
    // After a few seconds, restore the text to its original state
    setTimeout(function(){
        myModule.restoreText("greeting");
    }, 3000);
});
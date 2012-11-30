require(["dojo/dom", "dojo/fx", "dojo/domReady!"], function(dom, fx){
    // The piece we had before...
    var greeting = dom.byId("greeting");
    greeting.innerHTML += " from Dojo!";
 
    // ...but now, with an animation!
    fx.slideTo({
        top: 100,
        left: 200,
        node: greeting
    }).play();
});
/* This function is called from within the Flash player */
function ap_stopAll(playerID) {
    for(var i = 1;i<=document.getElementsByTagName("object").length;i++) {
        var currentID = "audioplayer"+i.toString();
        if(i != playerID) {
            document.getElementById(currentID).SetVariable("closePlayer", 1);
        } else {
            document.getElementById(currentID).SetVariable("closePlayer", 0);
        }
    }
}

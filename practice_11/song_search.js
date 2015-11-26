document.observe("dom:loaded", function() {
    $("b_xml").observe("click", function(){
            var val =  $("top");
            // alert(val.value);
        
            new Ajax.Request("songs_xml.php", {
            method: "get",
            parameters: {top : val.value},
            onSuccess: showSongs_XML,
            onFailure: ajaxFailed,
            onException: ajaxFailed
        });
        //construct a Prototype Ajax.request object
    });
    $("b_json").observe("click", function(){
            var val =  $("top");
            // alert(val.value);
        
            new Ajax.Request("songs_json.php", {
            method: "get",
            parameters: {top : val.value},
            onSuccess: showSongs_JSON,
            onFailure: ajaxFailed,
            onException: ajaxFailed
        });
        //construct a Prototype Ajax.request object
    });
});

function showSongs_XML(ajax) {
    alert(ajax.responseText);

    $("songs").innerHTML = "";
    var len =  $("top").value;

    for (var i = 0; i < len; i++) {
        // console.log("correct is "+correct);
        var li = document.createElement("li");

        var title = ajax.responseXML.getElementsByTagName("title")[i].firstChild.nodeValue;
        var artist = ajax.responseXML.getElementsByTagName("artist")[i].firstChild.nodeValue;
        var genre = ajax.responseXML.getElementsByTagName("genre")[i].firstChild.nodeValue;
        var time = ajax.responseXML.getElementsByTagName("time")[i].firstChild.nodeValue;

        li.innerHTML = title + ", by " + artist + " [" + genre + "] " + "(" + time + ") ";
        $("songs").appendChild(li);
    }
}

function showSongs_JSON(ajax) {
    alert(ajax.responseText);
    // console.log(ajax.responseText);
    $("songs").innerHTML = "";

    var data = JSON.parse(ajax.responseText);
    for (var i = 0; i < data.songs.length; i++) {
        var correct;
        for (var j = 0; j < 10; j++) {
            var rank = data.songs[j].rank;
            if (i == rank-1) {
                // console.log("i is "+i);
                // console.log("rank is "+rank);
                correct = j;
                break;
            }
        }

        var li = document.createElement("li");
                li.innerHTML = data.songs[correct].title + ", by " + data.songs[correct].artist + " [" + data.songs[correct].genre + "] " + "(" + data.songs[correct].time + ") ";
        $("songs").appendChild(li);
    }
    
}

function ajaxFailed(ajax, exception) {
    var errorMessage = "Error making Ajax request:\n\n";
    if (exception) {
        errorMessage += "Exception: " + exception.message;
    } else {
        errorMessage += "Server status:\n" + ajax.status + " " + ajax.statusText + 
                        "\n\nServer response text:\n" + ajax.responseText;
    }
    alert(errorMessage);
}

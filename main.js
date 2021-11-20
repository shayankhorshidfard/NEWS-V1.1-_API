var portpostbtn = document.getElementById("portpostbtn");
var portpostcontainer = document.getElementById("portpostcontainer");

if (portpostbtn) {
    portpostbtn.addEventListener("click", function() {
        var ourRequest = new XMLHttpRequest();
        ourRequest.open('GET', magicalData.siteURL + '/wp-json/wp/v2/posts?categories=6&order=asc');
        ourRequest.onload = function() {
            if (ourRequest.status >= 200 && ourRequest.status < 400) {
                var data = JSON.parse(ourRequest.responseText);
                createHTML(data);
                portpostbtn.remove();
            } else {
                console.log("We connected to the server, but it returned an error.");
            }
        };

        ourRequest.onerror = function() {
            console.log("Connection error");
        };

        ourRequest.send();
    });
}

function createHTML(postsData) {
    var ourHTMLString = '';
    for (i = 0; i < postsData.length; i++) {
        ourHTMLString += '<h2>' + postsData[i].title.rendered + '</h2>';
        ourHTMLString += postsData[i].content.rendered;
    }
    portfolioPostsContainer.innerHTML = ourHTMLString;
}
function replaceImgs() {
  var imgs = document.querySelectorAll('img[src^="bg"]'); //document.getElementsByTagName("img");
  for (var i = 0; i < imgs.length; i++) {
    var imgsrc = imgs[i].src.split("/").pop();

    if (imgsrc == "bg") {
      imgs[i].src =
        "http://localhost/" +
        imgs[i].parentElement.offsetWidth +
        "x" +
        imgs[i].parentElement.offsetHeight;
    } else {
      var match = imgsrc.match(/bg(\d+x\d+)/);
      if (match != null && match.length > 0) {
        imgs[i].src = "http://localhost/" + match[1];
      } else {
        match = imgsrc.match(/bg(\d+)/);
        if (match != null && match.length > 0) {
          imgs[i].src = "http://localhost/" + match[1] + "x" + match[1];
        }
      }
    }
  }
}

window.onload = replaceImgs();

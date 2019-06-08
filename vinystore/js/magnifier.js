function magnify(zoom) {
    var img, glass, w, h, bw;
    img = document.getElementById("record-img");
    /*create magnifier glass:*/
    glass = document.createElement("DIV");
    glass.setAttribute("class", "img-magnifier-glass");
    /*insert magnifier glass:*/
    img.parentElement.insertBefore(glass, img);
    /*set background properties for the magnifier glass:*/
    glass.style.backgroundImage = "url('" + img.src + "')";
    glass.style.backgroundRepeat = "no-repeat";
    glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
    bw = 3;
    w = glass.offsetWidth / 2;
    h = glass.offsetHeight / 2;
    /*execute a function when someone moves the magnifier glass over the image:*/
    glass.addEventListener("mousemove", moveMagnifier);
    img.addEventListener("mousemove", moveMagnifier);
    /*and also for touch screens:*/
    glass.addEventListener("touchmove", moveMagnifier);
    img.addEventListener("touchmove", moveMagnifier);
    function moveMagnifier(e) {
      var pos, x, y;
      /*prevent any other actions that may occur when moving over the image*/
      e.preventDefault();
      /*get the cursor's x and y positions:*/
      pos = getCursorPos(e);
      x = pos.x;
      y = pos.y;
      /*prevent the magnifier glass from being positioned outside the image:*/
      if (x > img.width - (w / zoom)) {x = img.width - (w / zoom);}
      if (x < w / zoom) {x = w / zoom;}
      if (y > img.height - (h / zoom)) {y = img.height - (h / zoom);}
      if (y < h / zoom) {y = h / zoom;}
      /*set the position of the magnifier glass:*/
      glass.style.left = (x - w) + "px";
      glass.style.top = (y - h) + "px";
      /*display what the magnifier glass "sees":*/
      glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
    }
    function getCursorPos(e) {
      var a, x = 0, y = 0;
      e = e || window.event;
      /*get the x and y positions of the image:*/
      a = img.getBoundingClientRect();
      /*calculate the cursor's x and y coordinates, relative to the image:*/
      x = e.pageX - a.left;
      y = e.pageY - a.top;
      /*consider any page scrolling:*/
      x = x - window.pageXOffset;
      y = y - window.pageYOffset;
      return {x : x, y : y};
    }
  }

  function Logare() {
    var user = document.getElementById("user").value;
    var parola = document.getElementById("parola").value;
  
    let xhr = new XMLHttpRequest();
  
    xhr.open("POST", "http://localhost:81/php/login.php");
  
    xhr.addEventListener("load", function loadCallback() {
      switch (xhr.status) {
        case 200:
          console.log("Success, te-ai conectat");
          console.log("*" + xhr.response.trim() + "*");
          console.log(user);
          if (xhr.response.trim()) {
            console.log("login reusit", xhr.response.trim());
            makeLogOutButton(user);
            window.location.assign('http://localhost:81/php/login.php');
            localStorage.setItem('currentUser', JSON.stringify({
              name: user,
              token: xhr.response.trim(),
            }));
          } else {
            console.log("Username sau parola incorecte");
            alert("Username incorect");
            document.getElementById("user").value = '';
          }
  
          break;
        case 404:
          console.log("Oops! Not found");
          break;
      }
    });
  
    xhr.addEventListener("error", function errorCallback() {
      console.log("Network error");
    });
  
    let payload = {
      user: `${user}`,
      parola: `${parola}`
    }
    xhr.send(JSON.stringify(payload));
  }
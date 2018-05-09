<style>
/* Set height to 100% for body and html to enable the background image to cover the whole page: */
body, html {
    height: 100%
}

.bgimg {
    /* Background image */
    background-image: url('http://www.countscontractingnc.com/wp-content/uploads/2015/09/parking-charlotte-sealcoating.jpg');
    /* Full-screen */
    width: 100%;
    height: 500px;
    /* Center the background image */
    background-position: center;
    /* Scale and zoom in the image */
    background-size: cover;
    /* Add position: relative to enable absolutely positioned elements inside the image (place text) */
    position: relative;
    /* Add a white text color to all elements inside the .bgimg container */
    color: white;
    /* Add a font */
    font-family: "Calibri", Calibri, monospace;
    /* Set the font-size to 25 pixels */
    font-size: 5vw;
}

/* Position text in the top-left corner */
.topleft {
    font-size: 16px;
    top: 0;
    left: 16px;
    position: absolute;
}

/* Position text in the bottom-left corner */
.bottomleft {
    font-size: 30px;
    bottom: 0;
    left: 16px;
    position: absolute;
}

/* Position text in the middle */
.middle {
    top: 50%;
    left: 50%;
    position: absolute;
    transform: translate(-50%, -50%);
    text-align: center;
}

/* Style the <hr> element */
hr {
    margin: auto;
    width: 40%;
}
</style>
<body>

<div class="bgimg">
  <div class="topleft">
    <p>Rowan Parking Development Team</p>
  </div>
  <div class="middle">
    <h1>COMING SOON</h1>
    <hr>
    <p id="demo"></p>
  </div>
  <div class="bottomleft">
    <p>Lot Management</p>
  </div>
</div>

<script>
// Set the date we're counting down to
var countDownDate = new Date("Apr 19, 2018 18:30:00").getTime();

// Update the count down every 1 second
var countdownfunction = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(countdownfunction);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
}, 1000);
</script>
</body>
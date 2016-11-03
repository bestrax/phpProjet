<?php
    session_start();
    include 'assets/php/header.php';
    pageHeader('', ['index'], 1);
?>

<div id="container">

    <div class="info">
        <i class="fa fa-clock-o type" aria-hidden="true"></i>
        <div>
            <label for="hour"> When do you want to pick-up ? : </label>
            <select name="hour" id="hour-selector" title="hour">
                <option value="9h">9PM</option>
                <option value="9h15">10PM</option>
                <option value="9h30">11PM</option>
                <option value="9h45">12PM</option>
                <option value="9h">1AM</option>
                <option value="9h15">2AM</option>
                <option value="9h30">3AM</option>
                <option value="9h45">4AM</option>
                <option value="9h15">5AM</option>
                <option value="9h30">6AM</option>
                <option value="9h45">7AM</option>
            </select>
            <span class="fa fa-chevron-down select-down" aria-hidden="true"></span>

            <a href="product.php" class="button btn-lg no-link select-product">Select product <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>

    <div class="content">
        <p>On Bake Express you can order and pay online for the products you want. Then you just need to come to our office to pick-up your order.<br/>
        You no more less time in waiting for a product that is not available !</p>
        <div id="map"></div>
    </div>

</div>

<script src="assets/js/master.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnJ23ZmykJ3XTHmXqQWYiRuKqhV0LyBDI&callback=initMap"></script>

<?php
    include 'assets/php/footer.php';
?>
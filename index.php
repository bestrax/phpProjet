<?php
    session_start();
    include 'assets/php/partials/header.php';
    pageHeader('', ['index'], 1);
?>

<div id="container">

    <div class="info">
        <i class="fa fa-clock-o type" aria-hidden="true"></i>
        <div>
            <form action="product.php" method="post">
                <label for="pickup"> When do you want to pick-up ? : </label>
                <select name="pickup" id="hour-selector" title="hour">
                    <option value="9PM">9PM</option>
                    <option value="10PM">10PM</option>
                    <option value="11PM">11PM</option>
                    <option value="12PM">12PM</option>
                    <option value="1AM">1AM</option>
                    <option value="2AM">2AM</option>
                    <option value="3AM">3AM</option>
                    <option value="4AM">4AM</option>
                    <option value="5AM">5AM</option>
                    <option value="6AM">6AM</option>
                    <option value="7AM">7AM</option>
                </select>
                <span class="fa fa-chevron-down select-down" aria-hidden="true"></span>

                <button type="submit" href="product.php" class="button btn-lg no-link select-product">Select product <i class="fa fa-arrow-right"></i></button>
            </form>
        </div>
    </div>

    <div class="content">
        <p>On Bake Express you can order and pay online for the products you want. Then you just need to come to our office to pick-up your order.<br/>
        You will no more loose time in waiting for a product that is not available !</p>
        <div id="map"></div>
    </div>

</div>

<script src="assets/js/master.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnJ23ZmykJ3XTHmXqQWYiRuKqhV0LyBDI&callback=initMap"></script>

<?php
    include 'assets/php/partials/footer.php';
?>
<footer>
    <section style="padding-top: 30px;" id="footer">
        <div class="container">
            <div class="row text-center text-xs-center text-sm-left text-md-left">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <h4>UVA CABS</h4>
                    <ul class="list-unstyled quick-links">

                        <li><img src="img/logo.png" style="width:100px; height:100px;" alt=""></li>
                        <br>
                        <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Address: Badulla</a></li>
                        <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Phone: 012-3456789</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <h4>Quick links</h4>
                    <ul class="list-unstyled quick-links">
                        <li><a href="index.php"><i class="fa fa-angle-double-right"></i>Home</a></li>
                        <li><a href="booking.php"><i class="fa fa-angle-double-right"></i>Book Now</a></li>
                        <li><a href="contactus.php"><i class="fa fa-angle-double-right"></i>Contact Us</a></li>
                        <li><a href="aboutus.php"><i class="fa fa-angle-double-right"></i>About Us</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <h4>Find us on google </h4>
                    <ul class="list-unstyled quick-links">
                        <li>
                            <div id="googleMap" style="width:270px;height:200px;"></div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                    <p class="h6">&copy 2020 All right Reversed |<a class="text-green ml-2" href="index.php" target="_blank">Uva Cabs</a></p>
                </div>
                </hr>
            </div>
        </div>
    </section>
</footer>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    function myMap() {
        var mapProp = {
            center: new google.maps.LatLng(6.9934, 81.0550),
            zoom: 10,
        };
        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASA4AbCdVOD796Z6ZOUG5w7hSHStCQBhA&callback=myMap"></script>
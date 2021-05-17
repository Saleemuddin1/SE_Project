<!DOCTYPE HTML>

<html>

<head>
  <title>Software Eng. Project</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="assets/css/main.css" />

  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script>
    < link rel = "stylesheet"
    href = "assets/css/noscript.css" / >
  </script>

  <!-- jQuery library -->
  <script src="assets/js/jquery.min.js"></script>

  <!-- Google Maps JS library -->
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyAe2uLVMvaWQKid8tSAjb09UgRIxLjc918"></script>

  <!-- place search API Google library -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAe2uLVMvaWQKid8tSAjb09UgRIxLjc918&libraries=places"></script>

  <script>
    var searchInput = 'search_input';
    $(document).ready(function() {
      var autocomplete;
      autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
        types: ['geocode'],
      });

      google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var near_place = autocomplete.getPlace();
        document.getElementById('loc_lat').value = near_place.geometry.location.lat();
        document.getElementById('loc_long').value = near_place.geometry.location.lng();

        document.getElementById('latitude_view').innerHTML = near_place.geometry.location.lat();
        document.getElementById('longitude_view').innerHTML = near_place.geometry.location.lng();
      });
    });

    $(document).on('change', '#' + searchInput, function() {
      document.getElementById('latitude_input').value = '';
      document.getElementById('longitude_input').value = '';

      document.getElementById('latitude_view').innerHTML = '';
      document.getElementById('longitude_view').innerHTML = '';
    });
  </script>
  <style>
    a.fixed {
      position: fixed;
      right: 0;
      top: 0;
      width: 260px;
      border: 1px White;
    }
  </style>
  <style>
    a.fixed1 {
      position: fixed;
      right: 1;
      top: 0;
      width: 260px;
      border: 1px White;
    }
  </style>

</head>

<body class="is-preload">

  <!-- Wrapper -->
  <div id="wrapper">

    <!-- Header -->
    <header id="header">
      <div class="logo">
        <span class="icon fa-gem"></span>
      </div>
      <?php
      include_once("process1.php");
      $host = 'localhost';
      $user = 'root';
      $pass = '';
      $db = 'register';

      $db = mysqli_connect($host, $user, $pass, $db);
      $sql = "SELECT username, email, password FROM signup WHERE username = '" . $_SESSION['username'] . "'";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_array($result);

      $sql_r = "SELECT name, email, place, message FROM review WHERE email = '" . $row['email'] . "'";
      $res1 = mysqli_query($db, $sql_r);
      if (mysqli_num_rows($res1) == 0) {
        echo "No review posted yet";
      }


      //********************************************************************************************** */
      // Updating the username and password: THIS CODE IS NOT WORKING



      //NOT WORKING UPTO HERE
      //************************************************************************************************* */
      ?>

      <form action="#userlogin">
        <button type="submit" style="width:auto; background-color:green; opacity:0.3;" id="signup" title="View My Page"> <?php echo "Welcome " . $row['username']; ?></button>
      </form>




      <form action="index.html">
        <button type="submit" style="width:auto;" id="login" title="Log Out Of Feed">Logout</button>
      </form>
      <div class="content">
        <div class="inner">
          <h1>Search for Local Places near you!</h1>
          <p>Overwhelmed by Google search results? Want to support your local community? Try Guide Galileo to get the most accurate <br>
            and authentic reviews from our locals. Let's go local!!! </p>
        </div>
        <!-- Autocomplete location search input -->
        <div class="form-group">
          <label>Search for Local Places</label>
          <input type="text" class="form-control" id="search_input" placeholder="Your Places" />
          <input type="hidden" id="loc_lat" />
          <input type="hidden" id="loc_long" />
          <button type="submit" onclick="showResults()">Submit</button>
          <button id="find-me" type="submit" onclick="currentLocation()">My Location</button>
          <p id="demo"></p>
          <p id="status"></p>
          <a id="map-link" target="_blank"></a>
          <script>
            function currentLocation() {
              const status = document.querySelector('#status');
              const mapLink = document.querySelector('#map-link');
              var search = document.getElementById('search_input');

              mapLink.href = '';
              mapLink.textContent = '';

              function success(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                status.textContent = '';

                var geocoder = new google.maps.Geocoder();
                var lat = parseFloat(latitude);
                var lng = parseFloat(longitude);
                var latlng = new google.maps.LatLng(lat, lng);
                geocoder.geocode({
                  location: latlng
                }, (results, status) => {
                  if (status === "OK") {
                    search.value = results[0].formatted_address;
                  }
                });
              }

              function error() {
                status.textContent = 'Unable to retrieve your location';
              }

              if (!navigator.geolocation) {
                status.textContent = 'Geolocation is not supported by your browser';
              } else {
                status.textContent = 'Locating…';
                navigator.geolocation.getCurrentPosition(success, error);
                $.get("http://maps.googleapis.com/geocode/json?latlng-" + latitude + "," + longitude + "&sensor-false", function(data) {
                  console.log(data);
                })
              }

            }
            document.querySelector('#find-me').addEventListener('click', geoFindMe);
          </script>
          <script>
            function showResults() {

            }
          </script>
        </div>

      </div>
      <nav>
        <ul>
          <li><a href="#intro">Intro</a></li>
          <li><a href="#work">Work</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#contact">Reviews</a></li>
        </ul>
      </nav>
    </header>


    <!-- Main -->
    <div id="main">


      <article id="userlogin">
        <h2 class="major">My Profile</h2>
        <span> <a href="#userlogin">Edit</a></span>

        <div>
          <form action="#">
            <label for="usename">Username: </label>
            <input type="text" value="<?php echo "" . $row['username']; ?>" name="username"><br>

            <label for="usename">Password: </label>
            <input type="password" value="<?php echo "" . $row['password']; ?>" name="password2">

            <button type="submit" name="update">Save changes</button><br><br>

            <label for="usename">Email: </label>
            <input type="email" value="<?php echo "" . $row['email']; ?>" required><br>

            <label for="review"> To View Your Reviews Till Now Click Below: </label>





          </form>
        </div>
        <form action="update.php" method="POST">
          <button type="submit" name="update">CLICK HERE</button><br><br>
        </form>

        <span class="image main"><img src="images/dinnerwbf.jpg" alt="" /></span>
        <p>Moment: Dinner with my boyfriend in Las Vegas</p>
        <span><a href="#" style="float:right;">Edit</a></span>

      </article>



      <!-- Intro -->
      <article id="intro">
        <h2 class="major">Intro</h2>
        <span class="image main"><img src="images/pic01.jpg" alt="" /></span>
        <p>Welcome to Guide Galileo! </p>

        <p>Been in situtation where you couldn't find accurate information on place you want to go? Let down your worry since you're being guided by Guide Galileo's state-of-the-art search and filter systems. We directly connect with Local Buinesesses and all our reviews are mostly local which will provide an accurate information of what to expect on your trip</p>

        <p>We are missioned to promote indigenous business, shed light on historical significance, frugal living cost and a lot more. Please click on <a href="#work">Our Work</a> to find more information about our exciting work.</p>
      </article>

      <!-- Work -->
      <article id="work">
        <h2 class="major">Work</h2>
        <span class="image main"><img src="images/pic02.jpg" alt="" /></span>
        <p>Adipiscing magna sed dolor elit. Praesent eleifend dignissim arcu, at eleifend sapien imperdiet ac. Aliquam erat volutpat. Praesent urna nisi, fringila lorem et vehicula lacinia quam. Integer sollicitudin mauris nec lorem luctus ultrices.</p>
        <p>Nullam et orci eu lorem consequat tincidunt vivamus et sagittis libero. Mauris aliquet magna magna sed nunc rhoncus pharetra. Pellentesque condimentum sem. In efficitur ligula tate urna. Maecenas laoreet massa vel lacinia pellentesque lorem ipsum dolor. Nullam et orci eu lorem consequat tincidunt. Vivamus et sagittis libero. Mauris aliquet magna magna sed nunc rhoncus amet feugiat tempus.</p>
      </article>

      <!-- About -->
      <article id="about">
        <h2 class="major">About Us</h2>
        <span class="image main"><img src="images/pic03.jpg" alt="" /></span>
        <p>We started Guide Galileo as a fun project during our senior year. However, as we learnt more about the significance of Local business and their impace on a community; we decided to promote local business since they often go unnoticed if not marketed properly. And most of Local business runs on word of mouth or the owners cannot simply afford to bear the expensive cost of Marketing. In order to generate income and promote Indigenous businesses and local heritage sites, we as a group came up with an idea to filter raw information provided by Google and only show authentic and highly reviewed results</p>
      </article>

      <!-- Reviews -->
      <article id="contact">
        <h2 class="major">Reviews</h2>
        <form method="post" action="#">
          <div class="fields">
            <div class="field half">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" />
            </div>
            <div class="field half">
              <label for="email">Email</label>
              <input type="text" name="email" id="email" />
            </div>
            <div class="field">
              <label for="message">Message</label>
              <textarea name="message" id="message" rows="4"></textarea>
            </div>
          </div>
          <ul class="actions">
            <li><input type="submit" value="Send Message" class="primary" /></li>
            <li><input type="reset" value="Reset" /></li>
          </ul>
        </form>
        <ul class="icons">
          <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
          <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
          <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
          <li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
        </ul>
      </article>

      <!-- Elements -->
      <article id="elements">
        <h2 class="major">Elements</h2>

        <section>
          <h3 class="major">Text</h3>
          <p>This is <b>bold</b> and this is <strong>strong</strong>. This is <i>italic</i> and this is <em>emphasized</em>.
            This is <sup>superscript</sup> text and this is <sub>subscript</sub> text.
            This is <u>underlined</u> and this is code: <code>for (;;) { ... }</code>. Finally, <a href="#">this is a link</a>.</p>
          <hr />
          <h2>Heading Level 2</h2>
          <h3>Heading Level 3</h3>
          <h4>Heading Level 4</h4>
          <h5>Heading Level 5</h5>
          <h6>Heading Level 6</h6>
          <hr />
          <h4>Blockquote</h4>
          <blockquote>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan faucibus. Vestibulum ante ipsum primis in faucibus lorem ipsum dolor sit amet nullam adipiscing eu felis.</blockquote>
          <h4>Preformatted</h4>
          <pre><code>i = 0;

while (!deck.isInOrder()) {
    print 'Iteration ' + i;
    deck.shuffle();
    i++;
}

print 'It took ' + i + ' iterations to sort the deck.';</code></pre>
        </section>

        <section>
          <h3 class="major">Lists</h3>

          <h4>Unordered</h4>
          <ul>
            <li>Dolor pulvinar etiam.</li>
            <li>Sagittis adipiscing.</li>
            <li>Felis enim feugiat.</li>
          </ul>

          <h4>Alternate</h4>
          <ul class="alt">
            <li>Dolor pulvinar etiam.</li>
            <li>Sagittis adipiscing.</li>
            <li>Felis enim feugiat.</li>
          </ul>

          <h4>Ordered</h4>
          <ol>
            <li>Dolor pulvinar etiam.</li>
            <li>Etiam vel felis viverra.</li>
            <li>Felis enim feugiat.</li>
            <li>Dolor pulvinar etiam.</li>
            <li>Etiam vel felis lorem.</li>
            <li>Felis enim et feugiat.</li>
          </ol>
          <h4>Icons</h4>
          <ul class="icons">
            <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="#" class="icon brands fa-github"><span class="label">Github</span></a></li>
          </ul>

          <h4>Actions</h4>
          <ul class="actions">
            <li><a href="#" class="button primary">Default</a></li>
            <li><a href="#" class="button">Default</a></li>
          </ul>
          <ul class="actions stacked">
            <li><a href="#" class="button primary">Default</a></li>
            <li><a href="#" class="button">Default</a></li>
          </ul>
        </section>

        <section>
          <h3 class="major">Table</h3>
          <h4>Default</h4>
          <div class="table-wrapper">
            <table>
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Item One</td>
                  <td>Ante turpis integer aliquet porttitor.</td>
                  <td>29.99</td>
                </tr>
                <tr>
                  <td>Item Two</td>
                  <td>Vis ac commodo adipiscing arcu aliquet.</td>
                  <td>19.99</td>
                </tr>
                <tr>
                  <td>Item Three</td>
                  <td> Morbi faucibus arcu accumsan lorem.</td>
                  <td>29.99</td>
                </tr>
                <tr>
                  <td>Item Four</td>
                  <td>Vitae integer tempus condimentum.</td>
                  <td>19.99</td>
                </tr>
                <tr>
                  <td>Item Five</td>
                  <td>Ante turpis integer aliquet porttitor.</td>
                  <td>29.99</td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="2"></td>
                  <td>100.00</td>
                </tr>
              </tfoot>
            </table>
          </div>

          <h4>Alternate</h4>
          <div class="table-wrapper">
            <table class="alt">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Item One</td>
                  <td>Ante turpis integer aliquet porttitor.</td>
                  <td>29.99</td>
                </tr>
                <tr>
                  <td>Item Two</td>
                  <td>Vis ac commodo adipiscing arcu aliquet.</td>
                  <td>19.99</td>
                </tr>
                <tr>
                  <td>Item Three</td>
                  <td> Morbi faucibus arcu accumsan lorem.</td>
                  <td>29.99</td>
                </tr>
                <tr>
                  <td>Item Four</td>
                  <td>Vitae integer tempus condimentum.</td>
                  <td>19.99</td>
                </tr>
                <tr>
                  <td>Item Five</td>
                  <td>Ante turpis integer aliquet porttitor.</td>
                  <td>29.99</td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="2"></td>
                  <td>100.00</td>
                </tr>
              </tfoot>
            </table>
          </div>
        </section>

        <section>
          <h3 class="major">Buttons</h3>
          <ul class="actions">
            <li><a href="#" class="button primary">Primary</a></li>
            <li><a href="#" class="button">Default</a></li>
          </ul>
          <ul class="actions">
            <li><a href="#" class="button">Default</a></li>
            <li><a href="#" class="button small">Small</a></li>
          </ul>
          <ul class="actions">
            <li><a href="#" class="button primary icon solid fa-download">Icon</a></li>
            <li><a href="#" class="button icon solid fa-download">Icon</a></li>
          </ul>
          <ul class="actions">
            <li><span class="button primary disabled">Disabled</span></li>
            <li><span class="button disabled">Disabled</span></li>
          </ul>
        </section>

        <section>
          <h3 class="major">Form</h3>
          <form method="post" action="#">
            <div class="fields">
              <div class="field half">
                <label for="demo-name">Name</label>
                <input type="text" name="demo-name" id="demo-name" value="" placeholder="Jane Doe" />
              </div>
              <div class="field half">
                <label for="demo-email">Email</label>
                <input type="email" name="demo-email" id="demo-email" value="" placeholder="jane@untitled.tld" />
              </div>
              <div class="field">
                <label for="demo-category">Category</label>
                <select name="demo-category" id="demo-category">
                  <option value="">-</option>
                  <option value="1">Manufacturing</option>
                  <option value="1">Shipping</option>
                  <option value="1">Administration</option>
                  <option value="1">Human Resources</option>
                </select>
              </div>
              <div class="field half">
                <input type="radio" id="demo-priority-low" name="demo-priority" checked>
                <label for="demo-priority-low">Low</label>
              </div>
              <div class="field half">
                <input type="radio" id="demo-priority-high" name="demo-priority">
                <label for="demo-priority-high">High</label>
              </div>
              <div class="field half">
                <input type="checkbox" id="demo-copy" name="demo-copy">
                <label for="demo-copy">Email me a copy</label>
              </div>
              <div class="field half">
                <input type="checkbox" id="demo-human" name="demo-human" checked>
                <label for="demo-human">Not a robot</label>
              </div>
              <div class="field">
                <label for="demo-message">Message</label>
                <textarea name="demo-message" id="demo-message" placeholder="Enter your message" rows="6"></textarea>
              </div>
            </div>
            <ul class="actions">
              <li><input type="submit" value="Send Message" class="primary" /></li>
              <li><input type="reset" value="Reset" /></li>
            </ul>
          </form>
        </section>

      </article>

    </div>

    <!-- Footer -->
    <footer id="footer">
      <p class="copyright">&copy; Software Eng. Project Design: <a href="https://html5up.net">Team 3</a>.</p>
    </footer>

  </div>

  <!-- BG -->
  <div id="bg"></div>

  <!-- Scripts -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/browser.min.js"></script>
  <script src="assets/js/breakpoints.min.js"></script>
  <script src="assets/js/util.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>

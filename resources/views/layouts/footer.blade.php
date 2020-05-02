<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-3">
                <h3>Pagesat e sigurta me</h3>
                <p>
                    <img src="/img/cards.png" alt="" class="img-responsive">
                </p>
            </div>
            <div class="col-md-3 col-sm-3">
                <h3>Rreth</h3>
                <ul>
                    <li><a href="about.html">Rreth nesh</a></li>
                    {{-- <li><a href="faq.html">Faq</a></li> --}}
                    <li><a href="contacts.html">Kontakti</a></li>
                    <li><a href="#0" data-toggle="modal" data-target="#login_2">Kyqu</a></li>
                    <li><a href="#0" data-toggle="modal" data-target="#register">Regjistrohu</a></li>
                    <li><a href="#0">Termat dhe kushtet</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-3" id="newsletter">
                <h3>Risitë</h3>
                <p>
                    Bëhu pjesë e risive tona për të marr informata te reja
                </p>
                <div id="message-newsletter_2">
                </div>
                <form method="post" action="assets/newsletter.php" name="newsletter_2" id="newsletter_2">
                    <div class="form-group">
                        <input name="email_newsletter_2" id="email_newsletter_2" type="email" value="" placeholder="Emaili juaj" class="form-control">
                    </div>
                    <input type="submit" value="Abonohu" class="btn_1" id="submit-newsletter_2">
                </form>
            </div>
{{--             <div class="col-md-2 col-sm-3">
                <h3>Paramentrat</h3>
                <div class="styled-select">
                    <select class="form-control" name="lang" id="lang">
                        <option value="English" selected>English</option>
                        <option value="French">French</option>
                        <option value="Spanish">Spanish</option>
                        <option value="Russian">Russian</option>
                    </select>
                </div>
                <div class="styled-select">
                    <select class="form-control" name="currency" id="currency">
                        <option value="USD" selected>USD</option>
                        <option value="EUR">EUR</option>
                        <option value="GBP">GBP</option>
                        <option value="RUB">RUB</option>
                    </select>
                </div>
            </div> --}}
        </div><!-- End row -->
        <div class="row">
            <div class="col-md-12">
                <div id="social_footer">
                    <ul>
                        <li><a href="#0"><i class="icon-facebook"></i></a></li>
                        <li><a href="#0"><i class="icon-twitter"></i></a></li>
                        <li><a href="#0"><i class="icon-google"></i></a></li>
                        <li><a href="#0"><i class="icon-instagram"></i></a></li>
                        <li><a href="#0"><i class="icon-pinterest"></i></a></li>
                        <li><a href="#0"><i class="icon-vimeo"></i></a></li>
                        <li><a href="#0"><i class="icon-youtube-play"></i></a></li>
                    </ul>
                    <p>
                        © Quick Food 2015
                    </p>
                </div>
            </div>
        </div><!-- End row -->
    </div><!-- End container -->
</footer>
<!-- End Footer =============================================== -->

<div class="layer"></div><!-- Mobile menu overlay mask -->

<!-- Login modal -->   

@if($errors->has('email') && $errors->first('email') != 'The email has already been taken.')
<script type="text/javascript">
    window.addEventListener('load', function () {
        $("#login_2").modal()
    });
</script>
@endif

<div class="modal fade" id="login_2" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
  <div class="modal-dialog">
     <div class="modal-content modal-popup">
        <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
        <form action="/login" method="POST" class="popup-form" id="myLogin">
            @csrf
            <div class="login_icon"><i class="icon_lock_alt"></i></div>
            @if ($errors->has('email') && $errors->first('email') != 'The email has already been taken.')
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->get('email') as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <input type="text" class="form-control form-white" name="email" placeholder="Username">
            <input type="password" class="form-control form-white" name="password" placeholder="Password">
            <div class="text-left">
              <a href="#" data-toggle="modal" data-target="#forget">Keni harruar fjalëkalimin?</a> | 
              <a href="#" data-toggle="modal" data-target="#register">Regjistrohu</a>
          </div>
          <button type="submit" class="btn btn-submit">Kyqu</button>
      </form>
  </div>
</div>
</div><!-- End modal -->   

@if($errors->has(['password', 'name']))
<script type="text/javascript">
    window.addEventListener('load', function () {
        $("#register").modal()
    });
</script>
@endif

<!-- Register modal -->   
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myRegister" aria-hidden="true">
  <div class="modal-dialog">
     <div class="modal-content modal-popup">
        <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
        <form action="/register" method="POST" class="popup-form" id="myRegister">
            @csrf
            <div class="login_icon"><i class="icon_lock_alt"></i></div>
            @if($errors->has(['password', 'name']))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <input type="text" class="form-control form-white" name="name" placeholder="Name">
            <input type="text" class="form-control form-white" name="lastname" placeholder="Last Name">
            <input type="email" class="form-control form-white" name="email" placeholder="Email">
            <input type="password" class="form-control form-white" name="password" placeholder="Password"  id="password1">
            <input type="password" class="form-control form-white" name="password_confirmation" placeholder="Confirm password"  id="password2">
            <div id="pass-info" class="clearfix"></div>
            <div class="checkbox-holder text-left">
              <div class="checkbox">
                 <input type="checkbox" value="accept_2" id="check_2" name="check_2" />
                 <label for="check_2"><span>Unë e pranoj<strong>Termat &amp; Kushtet</strong></span></label>
             </div>
         </div>
         <button type="submit" class="btn btn-submit">Regjistrohu</button>
     </form>
 </div>
</div>
</div><!-- End Register modal -->

<!-- Forget modal -->   
<div class="modal fade" id="forget" tabindex="-1" role="dialog" aria-labelledby="forget" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-popup">
            <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
            <form action="/password/reset" method="POST" class="popup-form" id="forget">
                @csrf
                <div class="login_icon"><i class="icon_lock_alt"></i></div>
                <input type="text" class="form-control form-white" name="email" placeholder="Email">
                <button type="submit" class="btn btn-submit">Submit</button>
            </form>
        </div>
    </div>
</div><!-- End modal -->  
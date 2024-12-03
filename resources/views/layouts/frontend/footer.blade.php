<!-- Footer Start -->
<div class="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="footer-widget">
            <h3 class="title">Get in Touch</h3>
            <div class="contact-info">
              <p><i class="fa fa-map-marker"></i>{{$getSetting->street}}, {{$getSetting->city}}, {{$getSetting->country}}</p>
              <p><i class="fa fa-envelope"></i>{{$getSetting->email}}</p>
              <p><i class="fa fa-phone"></i>+2{{$getSetting->street}}</p>
              <div class="social">
                {{-- <a href=""><i class="fab fa-twitter"></i></a> --}}
                {{-- <a href=""><i class="fab fa-linkedin-in"></i></a> --}}
                <a href="{{ $getSetting->facebook }}" rel="nofollow"><i class="fab fa-facebook-f"></i></a>
                <a href="{{ $getSetting->instagram }}" rel="nofollow"><i class="fab fa-instagram"></i></a>
                <a href="{{ $getSetting->youtube }}" rel="nofollow"><i class="fab fa-youtube"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="footer-widget">
            <h3 class="title">Useful Links</h3>
            <ul>
              @foreach ($related_sites as $site)

              <li><a href="{{$site->url}}">{{$site->name}}</a></li>
                
              @endforeach
              
            </ul>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="footer-widget">
            <h3 class="title">Quick Links</h3>
            <ul>
              <li><a href="#">Lorem ipsum</a></li>
              <li><a href="#">Pellentesque</a></li>
              <li><a href="#">Aenean vulputate</a></li>
              <li><a href="#">Vestibulum sit amet</a></li>
              <li><a href="#">Nam dignissim</a></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="footer-widget">
            <h3 class="title">Newsletter</h3>
            <div class="newsletter">
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Vivamus sed porta dui. Class aptent taciti sociosqu
              </p>
              <form action="{{route('frontend.news-subscribe')}}" method="post">
                @csrf
                <input
                  class="form-control"
                  type="email"
                  name="email"
                  placeholder="Your email here"
                />
                @error('email')
                  <div class="text-danger">{{$message}}</div>
                @enderror
                <button type="submit" class="btn">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer End -->

  {{-- <!-- Footer Menu Start -->
  <div class="footer-menu">
    <div class="container">
      <div class="f-menu">
        <a href="">Terms of use</a>
        <a href="">Privacy policy</a>
        <a href="">Cookies</a>
        <a href="">Accessibility help</a>
        <a href="">Advertise with us</a>
        <a href="">Contact us</a>
      </div>
    </div>
  </div>
  <!-- Footer Menu End --> --}}

  <!-- Footer Bottom Start -->
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-6 copyright">
          <p>
            Copyright &copy; <a href="">{{config('app.name')}}</a>. All Rights
            Reserved
          </p>
        </div>

        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
        <div class="col-md-6 template-by">
          <p>Designed By <a href="https://www.linkedin.com/in/mohamad-farag-4b10b9230?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app">Mohamed Farag</a></p>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer Bottom End -->

  <!-- Back to Top -->
  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

  <script src="{{asset('assets/front-end/lib/slick/slick.min.js')}}"></script>
  <script src="{{asset('assets/front-end/lib/easing/easing.min.js')}}"></script>

  <!-- Template Javascript -->
  <script src="{{asset('assets/front-end/js/main.js')}}"></script>
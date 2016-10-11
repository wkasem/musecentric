<footer class="page-footer" style="margin-top:0;">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <h5 class="white-text">Contact</h5>
          <form action="/feedback" method="post">
            {{ csrf_field() }}
            @if(!Auth::check())
              <div class="row">
                <div class="input-field col s6">
                  <input type="text" placeholder="Your Name" name="name" class="grey-text" />
                </div>
                <div class="input-field col s6">
                  <input type="email" placeholder="Your Email" name="email" class="grey-text" />
                </div>
              </div>
              @endif
          <div class="row">
            <div class="input-field col s12">
              <textarea placeholder="Type Your Massage" name="msg" class="materialize-textarea grey-text"></textarea>
              <button type="submit" class="btn-flat red white-text">Send</button>
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      © {{ date('Y') }} musecentric.com
      <a target="_blank" class="white-text right" href="https://www.facebook.com/Musecentric-302631036756803/">Facebook</a>
      </div>
    </div>
  </footer>

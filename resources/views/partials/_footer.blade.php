<footer class="footer">

<div class="container">

  <div class="row">
    <div class="col-md-12">
LaraBrain is part of the WJ Gilmore, LLC educational network. &middot; Questions? E-mail us at support@larabrain.com.<br />
Built using the amazing <a href="http://laravel.com">Laravel framework</a>. Laravel is a trademark of Taylor Otwell.<br />
The Skype logo is a trade mark of Skype and LaraBrain is not affiliated, sponsored, authorized or otherwise associated by/with the Skype group of companies.
<br /><br />
    </div>

  </div>

</div>

</footer>

@if (getenv('APP_ENV') == 'production')

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-21509545-11', 'auto');
  ga('send', 'pageview');

</script>

@endif

</body>
</html>
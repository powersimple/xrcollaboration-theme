

      
        <footer class="footer">
         
            <div class="row">
             <div class="container">
              <span class="full-center">Made possible by the generous support of our sponsors:</span>
              <div class="row"><div class="col-xs-offset-4 col-xs-4 col-sm-offset-5 col-sm-2"><img src="/wp-content/uploads/2020/05/XRC-Logos_telekomm.svg" alt="Deutsche Telekom logo"></div><div class="col-xs-4 col-sm-5"></div></div>
                <div id="sponsor-footer" class="row"></div>
            </div>

            <div class="row bg-dark" id="bottom-bar">
             <div class="container">
              <div class="col-xs-8 col-sm-10">
              <img class="xri-logo" src="/wp-content/uploads/2020/05/XR-Ignite-logodarkbg.svg" alt="XR Ignite Logo">
                <span class="copyright font-alt"><span>&copy; 2020 XR Ignite, Inc.</span><span>All Rights Reserved</span></span>
              </div>
              <div class="col-xs-4 col-sm-2">
                <div class="footer-social-links"><a href="https://www.facebook.com/groups/243526886903209/" class="fa fa-facebook"  title="Like our Facebook Page"></a>
                <a href="https://twitter.com/xrcollaboration" class="fa fa-twitter" title="Follow us with us on Twitter"></a>
                <a href="https://www.linkedin.com/groups/12387265/" class="fa fa-linkedin" title="Connect with us on LinkedIn"></a>
                </div>
              
              </div>
            </div>
          </div>
        </footer>
      </div>
<script src="<?php echo get_stylesheet_directory_uri()?>/assets/lib/jquery/dist/jquery.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
     
    
    <script src="<?php echo get_stylesheet_directory_uri()?>/vendor.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri()?>/assets/js/plugins.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri()?>/assets/js/main.js"></script>
 <!--   <script src="<?php echo get_stylesheet_directory_uri()?>/main.min.js"></script>-->
 <script>

   
</script>
<?php wp_footer(); ?>

<!-- Facebook Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '270382797454860');
    fbq('track', 'PageView');


    document.addEventListener( 'wpcf7mailsent', function( event ) {
      var pdf = '/wp-content/uploads/2020/05/XR-Collaboration-V4.pdf'

  var link = document.createElement('a');
      link.href = pdf;
      link.download = 'XR-Collaboration-A-Global-Resource-Guide.pdf';
      link.dispatchEvent(new MouseEvent('click'));
   
}, false );
</script>
<noscript><img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=270382797454860&ev=PageView&noscript=1"
    /></noscript>
<!-- End Facebook Pixel Code -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-162942830-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-162942830-1');
</script>

</body>
</html>
